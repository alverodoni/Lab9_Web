# Lab9_Web
Nama: Doni Alvero <p>
Nim: 312410663 <P>
Kelas: TI.24.A.5 <P>
Jurusan: Teknik Informatika <p>
Mata Kuliah: Pemograman Web 1 <p>

### Menjalankan MySQL Server
menunjukkan bahwa lingkungan pengembangan web lokal `(web server dan database)` pada komputer tersebut sedang aktif dan berjalan normal. Tujuan Utamanya Digunakan untuk menghidupkan `(Start)` dan mematikan `(Stop)` modul-modul server utama. Apache `(Web Server)`: Berjalan `(Running)` pada Port 80 dan 443 & MySQL `(Database Server)`: Berjalan `(Running)` pada Port 3306. Web Server xammp
<img width="953" height="642" alt="Web Server xammp" src="https://github.com/user-attachments/assets/18b29bb6-4608-45b6-b86e-cd299c353b7d" />

### index.php
```php
<?php
// index.php

// Sertakan file header, yang berisi tag <head>, CSS, dan tag <body>
include 'views/header.php';

// Logika sederhana untuk menentukan apakah pengguna harus melihat halaman login atau dashboard
// Dalam aplikasi nyata, ini akan menggunakan session
$is_logged_in = false; // Karena logika login di frontend, kita simulasikan ini.

// Tampilkan halaman Login (semua modal, dll.)
include 'modules/auth/login.php';

// Sertakan file footer, yang berisi penutup </body> dan semua skrip JS


include 'views/footer.php';
?>
```

