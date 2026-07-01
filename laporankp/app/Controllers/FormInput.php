<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\IndikatorModel;
use App\Models\PenilaianModel;

class FormInput extends BaseController
{
    public function listKriteria()
    {
        $model = new KriteriaModel();
        $data['kriteria'] = $model->findAll();

        return view('kriteria_list', $data);
    }

    public function kriteria($id_kriteria)
    {
        $indikatorModel = new \App\Models\IndikatorModel();
        $penilaianModel = new \App\Models\PenilaianModel();

        $indikator = $indikatorModel
            ->where('id_kriteria', $id_kriteria)
            ->findAll();

        foreach ($indikator as &$i) {
            $penilaian = $penilaianModel
                ->where('id_indikator', $i['id_indikator'])
                ->orderBy('id_penilaian', 'DESC')
                ->first();

            $i['penilaian'] = $penilaian;
        }

        $data['indikator'] = $indikator;
        $data['id_kriteria'] = $id_kriteria;

        return view('form_input', $data);
    }

    public function simpan()
    {
        $model = new \App\Models\PenilaianModel();

        $statusPost = $this->request->getPost('status');
        $catatan = $this->request->getPost('catatan');
        
        $files = $this->request->getFiles(); 

        if (!$statusPost) {
            return redirect()->back()->with('error', 'Tidak ada data yang dipilih untuk disimpan.');
        }

        foreach ($statusPost as $id_indikator => $val) {

            $namaFile = null;

            // 1. Cek apakah ada file baru yang diunggah saat ini
            if (isset($files['file_bukti'][$id_indikator])) {
                $file = $files['file_bukti'][$id_indikator];
                if ($file->isValid() && !$file->hasMoved()) {
                    $namaFile = $file->getRandomName();
                    $file->move('writable/uploads', $namaFile);
                }
            }

            // 2. Ambil data lama di database untuk pengecekan file eksis
            $dataLama = $model
                ->where('id_indikator', $id_indikator)
                ->first();

            // 3. ROMBAK TOTAL LOGIKA PERHITUNGAN BARU
            if ($val == "tersedia") {
                // Cek apakah ada file baru saat ini ATAU ada file lama di database
                if ($namaFile || (!empty($dataLama['file_bukti']) && $val == "tersedia")) {
                    // Poin 4 (Tersedia, ada file)
                    $nilai  = 4;
                    $status = 'Sangat Baik';
                } else {
                    // Poin 1 (Tersedia, tidak ada file)
                    $nilai  = 1;
                    $status = 'Kurang';
                }
            } else { 
                // Poin 0 (Tidak tersedia)
                $nilai  = 0;
                $status = 'Tidak Terpenuhi';
            }

            // 4. Siapkan array data untuk disimpan
            $dataSimpan = [
                'id_indikator' => $id_indikator,
                'status'       => $status,
                'nilai'        => $nilai,
                'catatan'      => $catatan[$id_indikator] ?? null,
            ];

            // Jika ada file baru diunggah, masukkan ke array simpan
            if ($namaFile) {
                $dataSimpan['file_bukti'] = $namaFile;
            }

            if ($dataLama) {
                // Kondisi REVISI jika status diubah menjadi "tidak" (Tidak Tersedia), hapus file fisik lama
                if ($val == 'tidak') {
                    if (
                        !empty($dataLama['file_bukti']) &&
                        file_exists('writable/uploads/' . $dataLama['file_bukti'])
                    ) {
                        unlink('writable/uploads/' . $dataLama['file_bukti']);
                    }
                    $dataSimpan['file_bukti'] = null;
                }

                $model->update($dataLama['id_penilaian'], $dataSimpan);

            } else {
                // Jika data baru belum ada di DB dan bernilai tidak tersedia, file tetap null
                if ($val == 'tidak') {
                    $dataSimpan['file_bukti'] = null;
                }
                $model->insert($dataSimpan);
            }
        }

        return redirect()->back()->with('success', 'Semua data penilaian berhasil diperbarui berdasarkan aturan perhitungan baru.');
    }

    public function hasilPenilaian($id_kriteria)
    {
        $kriteriaModel = new \App\Models\KriteriaModel();
        $indikatorModel = new \App\Models\IndikatorModel();

        $data['kriteria'] = $kriteriaModel->find($id_kriteria);

        if (!$data['kriteria']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Kriteria tidak ditemukan");
        }

        $data['hasil'] = $indikatorModel->db->table('indikator')
            ->select('indikator.*, penilaian.id_penilaian, penilaian.status, penilaian.nilai, penilaian.catatan, penilaian.file_bukti, penilaian.created_at')
            ->join('penilaian', 'penilaian.id_indikator = indikator.id_indikator', 'left')
            ->where('indikator.id_kriteria', $id_kriteria)
            ->orderBy('indikator.id_indikator', 'ASC')
            ->get()
            ->getResultArray();

        $totalNilai = 0;

        foreach ($data['hasil'] as $item) {
            $totalNilai += (int)($item['nilai'] ?? 0);
        }

        $bobot = (float)$data['kriteria']['bobot'];
        $nilaiAkhir = $totalNilai * ($bobot / 100);

        $data['totalNilai'] = $totalNilai;
        $data['nilaiAkhir'] = round($nilaiAkhir, 2);

        return view('hasil_penilaian', $data);
    }

    public function hapus($id_penilaian)
    {
        $model = new \App\Models\PenilaianModel();
        $dataPenilaian = $model->find($id_penilaian);

        if ($dataPenilaian) {
            $indikatorModel = new \App\Models\IndikatorModel();
            $indikator = $indikatorModel->find($dataPenilaian['id_indikator']);
            $id_kriteria = $indikator['id_kriteria'];

            $fileBukti = $dataPenilaian['file_bukti'];
            if (!empty($fileBukti) && file_exists('writable/uploads/' . $fileBukti)) {
                unlink('writable/uploads/' . $fileBukti);
            }

            $model->delete($id_penilaian);
            return redirect()->to(base_url('hasil/' . $id_kriteria))->with('success', 'Data penilaian dan file bukti terkait berhasil dihapus secara permanen.');
        }

        return redirect()->to(base_url('kriteria'))->with('error', 'Data penilaian tidak ditemukan.');
    }
}