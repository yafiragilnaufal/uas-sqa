# UAS SQA – Entri Nilai Mahasiswa USTI

Aplikasi web PHP sederhana untuk entri dan validasi nilai mahasiswa sebagai bahan pengujian SQA.

---

## Struktur Project

```
uas-sqa-nilai/
├── nilai.php                  ← Halaman utama aplikasi (jalankan di browser)
├── src/
│   └── NilaiHelper.php        ← Fungsi hitungGrade() & validasiInput()
├── tests/
│   └── NilaiHelperTest.php    ← Test case PHPUnit (9 tests)
├── .github/
│   └── workflows/
│       └── ci.yml             ← Konfigurasi GitHub Actions CI/CD
├── composer.json
├── .gitignore
└── README.md
```

---

## Cara Menjalankan Aplikasi

1. Pastikan XAMPP sudah berjalan (Apache aktif)
2. Copy folder `uas-sqa-nilai` ke `C:\xampp\htdocs\`
3. Buka browser → `http://localhost/uas-sqa-nilai/nilai.php`

---

## Cara Menjalankan PHPUnit

```bash
# Install PHPUnit via Composer (hanya sekali)
composer install

# Jalankan semua test
vendor\bin\phpunit --testdox tests
```

Hasil yang diharapkan: **OK (9 tests, 9 assertions)**

---

## Logika Validasi

Validasi berjalan secara bertingkat (cascading):

| Urutan | Kondisi                  | Kode Status      | Pesan Error                          |
|--------|--------------------------|------------------|--------------------------------------|
| 1      | Nama kosong              | `nama_kosong`    | Nama mahasiswa tidak boleh kosong!   |
| 2      | Nilai kosong             | `nilai_kosong`   | Nilai tidak boleh kosong!            |
| 3      | Nilai bukan angka        | `nilai_invalid`  | Nilai harus berupa angka!            |
| 4      | Nilai di luar 0–100      | `nilai_range`    | Nilai harus berada antara 0 – 100!   |
| 5      | Semua valid              | `success`        | Grade ditampilkan                    |

---

## Tabel Konversi Huruf Mutu

| Rentang Nilai | Grade |
|---------------|-------|
| 85 – 100      | A     |
| 70 – 84       | B     |
| 55 – 69       | C     |
| 40 – 54       | D     |
| 0  – 39       | E     |

---

## CI/CD

Workflow GitHub Actions berjalan otomatis setiap `push` ke branch `main`.  
Pipeline: Checkout → Setup PHP 8.2 → Composer Install → PHPUnit
