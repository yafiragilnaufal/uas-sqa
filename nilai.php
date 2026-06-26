<?php
$nama   = '';
$nilai  = '';
$result = null;  // null | 'nama_kosong' | 'nilai_kosong' | 'nilai_invalid' | 'nilai_range' | 'success'
$grade  = '';

require_once __DIR__ . '/src/NilaiHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim($_POST['nama']  ?? '');
    $nilai = trim($_POST['nilai'] ?? '');

    $result = validasiInput($nama, $nilai);

    if ($result === 'success') {
        $grade = hitungGrade((int)$nilai);
    }
}

$state_class = '';
if ($result === 'success')    $state_class = 'state-success';
elseif ($result !== null)     $state_class = 'state-error';

$pesan = '';
if     ($result === 'nama_kosong')   $pesan = 'Nama mahasiswa tidak boleh kosong!';
elseif ($result === 'nilai_kosong')  $pesan = 'Nilai tidak boleh kosong!';
elseif ($result === 'nilai_invalid') $pesan = 'Nilai harus berupa angka!';
elseif ($result === 'nilai_range')   $pesan = 'Nilai harus berada antara 0 &#8211; 100!';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entri Nilai Mahasiswa USTI</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Segoe UI', Arial, sans-serif;
      background: linear-gradient(135deg, #1a1f3c 0%, #2d3561 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .card {
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.30);
      padding: 44px 40px;
      width: 100%;
      max-width: 440px;
      border-top: 5px solid #C9A84C;
    }

    h1 {
      font-size: 17px;
      text-align: center;
      margin-bottom: 6px;
      color: #1a1f3c;
      font-weight: 700;
      letter-spacing: 0.3px;
    }

    .subtitle {
      text-align: center;
      font-size: 11px;
      color: #64748b;
      margin-bottom: 28px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    label {
      display: block;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.6px;
      margin-bottom: 5px;
      color: #334155;
    }

    input[type="text"] {
      width: 100%;
      padding: 11px 14px;
      border: 2px solid #e2e8f0;
      border-radius: 8px;
      font-size: 15px;
      margin-bottom: 16px;
      outline: none;
      color: #1a1f3c;
      transition: border-color 0.2s;
      font-family: 'Segoe UI', Arial, sans-serif;
    }

    input[type="text"]:focus {
      border-color: #C9A84C;
    }

    button {
      width: 100%;
      padding: 13px;
      background: #1a1f3c;
      color: #C9A84C;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      letter-spacing: 1px;
      transition: background 0.2s;
      font-family: 'Segoe UI', Arial, sans-serif;
    }

    button:hover {
      background: #2d3561;
    }

    .status {
      margin-top: 18px;
      padding: 12px 16px;
      border-radius: 10px;
      font-size: 13.5px;
      font-weight: 500;
      text-align: center;
      line-height: 1.6;
    }

    .grade-badge {
      display: inline-block;
      font-size: 30px;
      font-weight: 900;
      padding: 2px 16px;
      border-radius: 6px;
      background: #1a1f3c;
      color: #C9A84C;
      margin-left: 4px;
      vertical-align: middle;
    }

    /* ── State: BERHASIL ── */
    .state-success .status {
      background: #FEF3C7;
      color: #92400E;
      border: 1px solid #FDE68A;
    }

    /* ── State: GAGAL / ERROR ── */
    .state-error .status {
      background: #FEE2E2;
      color: #991B1B;
      border: 1px solid #FECACA;
    }

    .divider {
      height: 1px;
      background: #e2e8f0;
      margin: 20px 0;
    }
  </style>
</head>
<body>
  <div class="card <?= $state_class ?>">
    <h1>Entri Nilai Mahasiswa</h1>
    <div class="subtitle">USTI &mdash; Teknik Informatika</div>

    <form method="POST" action="">
      <label for="nama">Nama Mahasiswa</label>
      <input
        type="text"
        id="nama"
        name="nama"
        value="<?= htmlspecialchars($nama) ?>"
        placeholder="Masukkan nama mahasiswa..."
        autocomplete="off"
      >

      <label for="nilai">Nilai (0 &ndash; 100)</label>
      <input
        type="text"
        id="nilai"
        name="nilai"
        value="<?= htmlspecialchars($nilai) ?>"
        placeholder="Masukkan nilai (contoh: 85)..."
        autocomplete="off"
      >

      <button type="submit">SIMPAN NILAI</button>
    </form>

    <?php if ($result === 'success'): ?>
      <div class="status">
        Nilai <strong><?= htmlspecialchars($nilai) ?></strong>
        untuk <strong><?= htmlspecialchars($nama) ?></strong>
        &mdash; Grade: <span class="grade-badge"><?= $grade ?></span>
      </div>
    <?php elseif ($pesan !== ''): ?>
      <div class="status">&#9888; <?= $pesan ?></div>
    <?php endif; ?>
  </div>
</body>
</html>
