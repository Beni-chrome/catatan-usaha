#!/bin/bash

echo "Menjalankan XAMPP..."
sudo /opt/lampp/lampp start

echo "Menjalankan Laravel API di port 8000..."
cd /opt/lampp/htdocs/catatan-usaha/api
/opt/lampp/bin/php artisan serve --host=127.0.0.1 --port=8000 > ../laravel.log 2>&1 &

echo "Menjalankan CodeIgniter 4 Frontend di port 8080..."
cd /opt/lampp/htdocs/catatan-usaha/web
/opt/lampp/bin/php spark serve --host=0.0.0.0 --port=8080 > ../ci4.log 2>&1 &

echo "Aplikasi berhasil dijalankan."
echo "Laravel API : http://127.0.0.1:8000"
echo "CI4 Web     : http://localhost:8080/login"

xdg-open http://localhost:8080/login >/dev/null 2>&1
