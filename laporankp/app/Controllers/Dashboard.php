<?php

namespace App\Controllers;
use App\Models\KriteriaModel;

class Dashboard extends BaseController
{
    public function index()
{
    // Cek apakah sudah login
    if (!session()->get('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    $db = \Config\Database::connect();

    $kriteria = $db
        ->table('kriteria')
        ->get()
        ->getResult();

    foreach($kriteria as $k)
    {
        $k->indikator = $db->table('indikator')
            ->where('id_kriteria', $k->id_kriteria)
            ->get()
            ->getResult();
    }
    $sudahDiisi = $db->table('penilaian')->countAllResults();

    $totalIndikator = $db->table('indikator')->countAllResults();
    $belumDiisi = $totalIndikator - $sudahDiisi;

    $totalNilaiAkreditasi = 0;

    foreach ($kriteria as $k) {

        $hasil = $db->table('indikator')
            ->select('penilaian.nilai')
            ->join(
                'penilaian',
                'penilaian.id_indikator = indikator.id_indikator',
                'left'
            )
            ->where('indikator.id_kriteria', $k->id_kriteria)
            ->get()
            ->getResultArray();

        $totalNilai = 0;

        foreach ($hasil as $h) {
            $totalNilai += (int)($h['nilai'] ?? 0);
        }

        $nilaiAkhir = $totalNilai * ($k->bobot / 100);

        $totalNilaiAkreditasi += $nilaiAkhir;
    }

    $data = [
    'username'         => session()->get('nama'),
    'role'             => session()->get('role'),
    'kriteria'         => $kriteria,
    'total_kriteria'   => round($totalNilaiAkreditasi, 2),
    'sudah_diisi'      => $sudahDiisi,
    'belum_upload'     => $belumDiisi,
    'total_akreditasi' => round($totalNilaiAkreditasi, 2)
];

    return view('dashboard', $data);
}

    public function logout()
    {
        // Hancurkan semua session login
        session()->destroy();

        // Alihkan kembali ke halaman login
        return redirect()->to(base_url('login'));
    }
}