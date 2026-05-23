# CATATAN USAHA

CATATAN USAHA adalah aplikasi web catatan penjualan multi-tenant yang dapat digunakan oleh berbagai jenis usaha. Setiap usaha memiliki akun sendiri, data penjualan sendiri, produk sendiri, logo sendiri, dan tema warna sendiri.

## Deskripsi

Aplikasi ini dibangun dengan arsitektur dua aplikasi dalam satu folder:

- Laravel 11 sebagai backend API
- CodeIgniter 4 sebagai frontend
- MySQL sebagai database
- Bootstrap 5.3.8 sebagai UI lokal
- Laravel Sanctum sebagai autentikasi API
- Chart.js sebagai grafik dashboard
- DomPDF untuk export PDF
- PhpSpreadsheet untuk export Excel

CodeIgniter 4 tidak mengakses database secara langsung. Semua data dikirim dan diterima melalui Laravel API menggunakan `ApiClient.php`.

## Struktur Folder

```text
catatan-usaha/
├── api/        # Laravel 11 Backend API
├── web/        # CodeIgniter 4 Frontend
├── start.sh    # Menjalankan semua server lokal
├── stop.sh     # Menghentikan semua server lokal
└── README.md
 
