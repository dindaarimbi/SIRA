#!/bin/bash
set -e
PORT="${PORT:-80}"
echo "==> Menyesuaikan Apache untuk listen di port $PORT"
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf
echo "==> DEBUG: modul MPM yang aktif sekarang:"
ls -la /etc/apache2/mods-enabled/ | grep mpm
exec "$@"