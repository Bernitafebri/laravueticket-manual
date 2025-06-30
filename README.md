## Instalasi

Aplikasi ini menggunakan framework Laravel versi 10, dengan frontend VueJS 3.
Langkah-langkah instalasi :

1. Unduh repository ke dalam komputer menggunakan perintah `git clone`.

```
git clone https://github.com/Bernitafebri/laravueticket-manual.git
```

2. Masuk ke dalam folder aplikasi melalui terminal menggunakan perintah `cd laravueticket-manual`.

```
cd laravueticket-manual
```

3. Mengunduh library yang ada di composer.json dengan perintah `composer install` dan modul node dengan `npm install/npm update`.

```
composer install
```

```
npm install
```

4. Copy file .env dengan perintah

```
copy .env.example .env
```

5. Migrate database

```
php artisan migrate
```

6. Buat database di phpmyadmin atau langsung saja gunakan perintah migrate untuk migrasi tabel database

```
php artisan migrate
```

Nanti akan muncul perintah buat database, ketikan "yes".

7. Memasukan data yg ada di seeder ke database

```
php artisan db:seed
```

8. Buat kunci aplikasi dan jwt

```
php artisan key:generate
```

```
php artisan jwt:secret
```

9. Untuk menjalankan aplikasi ketik perintah `php artisan serve` dan `npm run dev`

```
php artisan serve
```

```
npm run dev
```
