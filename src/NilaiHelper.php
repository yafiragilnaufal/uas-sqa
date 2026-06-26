<?php

/**
 * Menghitung huruf mutu berdasarkan nilai angka (0-100).
 *
 * Rentang Grade:
 *   A : 85 - 100
 *   B : 70 - 84
 *   C : 55 - 69
 *   D : 40 - 54
 *   E :  0 - 39
 *
 * @param int $n Nilai angka (diasumsikan sudah tervalidasi 0-100)
 * @return string Huruf mutu ('A', 'B', 'C', 'D', atau 'E')
 */
function hitungGrade(int $n): string
{
    if ($n >= 85) return 'A';
    if ($n >= 70) return 'B';
    if ($n >= 55) return 'C';
    if ($n >= 40) return 'D';
    return 'E';
}

/**
 * Memvalidasi input nama dan nilai dari form.
 *
 * Urutan validasi (cascading):
 *   1. Nama tidak boleh kosong
 *   2. Nilai tidak boleh kosong
 *   3. Nilai harus berupa angka (is_numeric)
 *   4. Nilai harus berada dalam rentang 0-100
 *   5. Jika semua valid → 'success'
 *
 * @param string|null $nama  Input nama mahasiswa
 * @param string|null $nilai Input nilai mahasiswa
 * @return string Kode status: 'nama_kosong' | 'nilai_kosong' | 'nilai_invalid' | 'nilai_range' | 'success'
 */
function validasiInput(?string $nama, ?string $nilai): string
{
    $nama  = trim($nama  ?? '');
    $nilai = trim($nilai ?? '');

    if ($nama  === '')          return 'nama_kosong';
    if ($nilai === '')          return 'nilai_kosong';
    if (!is_numeric($nilai))    return 'nilai_invalid';

    $n = (int)$nilai;
    if ($n < 0 || $n > 100)    return 'nilai_range';

    return 'success';
}
