<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"> <a href="https://pestphp.com/" target="_blank"></a></a></p>


## Requirement

- PHP 8.0
- Laravel 8
- MongoDB

# Langkah-langkah menjalankan project

- Clone project ke direktori yang anda inginkan
- Jalankan command `composer install`
- Buat file baru yang bernama `.env`
- Copy seluruh isi dari file `.env.example`, kemudian paste isi ke file `.env` anda
- Konfigurasi `DB_CONNECTION` di file `.env` menjadi 'mongodb'
- Konfigurasi `DB_DATABASE` di file `.env` anda dengan nama database anda
- Jalankan command `php artisan key:generate`
- Jalankan `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`
- Jalankan `php artisan jwt:secret`
- Jalankan project dengan command `php artisan serve`
- API sudah berjalan


## Running Tests

Untuk menjalankan unit test anda bisa menjalankan command

`php artisan test`

## Documentation

Api Documentation bisa dilihat dibawah ini, pastikan project sudah berjalan terlebih dahulu

`https://documenter.getpostman.com/view/5053441/2s9YR9XXqq`

Agar memudahkan saat testing, berikut saya lampirkan postman collection yang saya gunakan untuk testing :

`https://drive.google.com/file/d/1Fr0UOuBxdo40pd8uXnsOMhl-50nB1-Xr/view?usp=sharing`