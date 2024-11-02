# CARA SET UP LARAVEL PROJECT INI PERTAMA KALI SETELAH DI PULL REQUEST:

1. Jalankan perintah git clone `https://github.com/satyamahinsa/web-inventy.git`
2. Jalankan perintah `composer install`
3. Jalankan perintah `cp .env.example .env`
4. Ganti isi pada file `.env` menggunakan file yang sudah kami sediakan di link berikut ini : `https://drive.google.com/drive/folders/1hmJ1cewDry4D7tDOUz1MZLJ1n6nsWjHy?usp=sharing`
5. Jalankan perintah `php artisan key:generate`
6. Jalankan perintah `php artisan migrate`
7. Jika ingin membuka direktori project, dapat masuk ke dalam Folder "Project Directory"

## SETUP LARAVEL BREEZE

- `composer require laravel/breeze --dev`
- `php artisan breeze:install`
- `npm install`
- `npm run dev`

## Refresh Cheatsheet:
- `php artisan route:clear`
- `php artisan optimize:clear`

## Reset Activity:
- `git reset --hard HEAD~()`"() Diisi Dengan Konstanta Keberapa Terakhir Melakukan Aktivitas, Contoh: `git reset --hard HEAD~1`"

# WEB-iNVENTY