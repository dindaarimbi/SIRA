#!/bin/bash
set -e
PORT="${PORT:-80}"
echo "==> Menyesuaikan Apache untuk listen di port $PORT"
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

echo "==> Memastikan hanya mpm_prefork yang aktif"
a2dismod mpm_event >/dev/null 2>&1 || true
a2dismod mpm_worker >/dev/null 2>&1 || true
a2enmod mpm_prefork >/dev/null 2>&1 || true

echo "==> Memperbaiki permission folder writable"
chown -R www-data:www-data /var/www/html/writable
chmod -R 777 /var/www/html/writable

exec "$@"