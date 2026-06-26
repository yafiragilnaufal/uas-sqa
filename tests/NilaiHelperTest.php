<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/NilaiHelper.php';

/**
 * NilaiHelperTest
 *
 * Menguji dua fungsi pada src/NilaiHelper.php:
 *   - hitungGrade(int $n): string
 *   - validasiInput(?string $nama, ?string $nilai): string
 *
 * Total: 9 test case, 9 assertion
 */
class NilaiHelperTest extends TestCase
{
    // ──────────────────────────────────────────────────────────────────────
    // Pengujian fungsi hitungGrade()
    // ──────────────────────────────────────────────────────────────────────

    /** Nilai 90 → Grade A (rentang 85–100) */
    public function testGradeA(): void
    {
        $this->assertSame('A', hitungGrade(90));
    }

    /** Nilai 75 → Grade B (rentang 70–84) */
    public function testGradeB(): void
    {
        $this->assertSame('B', hitungGrade(75));
    }

    /** Nilai 60 → Grade C (rentang 55–69) */
    public function testGradeC(): void
    {
        $this->assertSame('C', hitungGrade(60));
    }

    /** Nilai 45 → Grade D (rentang 40–54) */
    public function testGradeD(): void
    {
        $this->assertSame('D', hitungGrade(45));
    }

    /** Nilai 20 → Grade E (rentang 0–39) */
    public function testGradeE(): void
    {
        $this->assertSame('E', hitungGrade(20));
    }

    // ──────────────────────────────────────────────────────────────────────
    // Pengujian fungsi validasiInput()
    // ──────────────────────────────────────────────────────────────────────

    /** Nama kosong, nilai valid → 'nama_kosong' */
    public function testNamaKosong(): void
    {
        $this->assertSame('nama_kosong', validasiInput('', '85'));
    }

    /** Nama valid, nilai kosong → 'nilai_kosong' */
    public function testNilaiKosong(): void
    {
        $this->assertSame('nilai_kosong', validasiInput('Budi Santoso', ''));
    }

    /** Nama valid, nilai bukan angka → 'nilai_invalid' */
    public function testNilaiBukanAngka(): void
    {
        $this->assertSame('nilai_invalid', validasiInput('Budi Santoso', 'abc'));
    }

    /** Nama valid, nilai di luar rentang (>100) → 'nilai_range' */
    public function testNilaiDiluarRange(): void
    {
        $this->assertSame('nilai_range', validasiInput('Budi Santoso', '150'));
    }
}
