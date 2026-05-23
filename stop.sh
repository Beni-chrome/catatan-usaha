#!/bin/bash

echo "Menghentikan Laravel API..."
pkill -f "artisan serve --host=127.0.0.1 --port=8000"

echo "Menghentikan CodeIgniter 4..."
pkill -f "spark serve --host=0.0.0.0 --port=8080"

echo "Menghentikan XAMPP..."
sudo /opt/lampp/lampp stop

echo "Semua server berhasil dihentikan."
