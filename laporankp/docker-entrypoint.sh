#!/bin/bash
set -e

# Render/Railway kasih env var PORT secara dinamis (biasanya bukan 80)
# Default ke 80 kalau PORT gak diset (misal waktu run lokal)
PORT="${PORT:-80}"

echo "==> Menyesuaikan Apache untuk listen di port $PORT"

# Ganti port yang didengerin Apache (default: 80)
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf
exec "$@"