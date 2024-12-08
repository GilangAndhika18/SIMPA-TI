<?php

use app\cores\Session;
use app\cores\View;
use app\helpers\Dump;

$data = View::getData();
$user = Session::get("user");
$dosen = $data["dosen"];
$prestasi = $data["prestasi"]; 

?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Prestasi</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Prestasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-5">
    <div class="form-container">
        <h3>Detail Prestasi Mahasiswa</h3>

        <!-- Alert Placeholder -->
        <div id="alert-placeholder"></div>

        <form id="prestasiForm" class="needs-validation" novalidate>

            <!-- Jenis Kompetisi -->
            <div class="mb-3">
                <label for="jenis-kompetisi" class="form-label">Jenis Kompetisi</label>
                <input type="text" class="form-control" id="jenis-kompetisi" value="<?php echo $prestasi['jenis_lomba']; ?>" readonly>
            </div>

            <!-- Tingkat Kompetisi -->
            <div class="mb-3">
                <label for="tingkat-kompetisi" class="form-label">Tingkat Kompetisi</label>
                <input type="text" class="form-control" id="tingkat-kompetisi" value="<?php echo $prestasi['tingkat_lomba']; ?>" readonly>
            </div>


            <!-- Tingkat Kompetisi -->
            <div class="mb-3">
                <label for="judul-kompetisi" class="form-label">judul kompetisi</label>
                <input type="text" class="form-control" id="tingkat-kompetisi" value="<?php echo $prestasi['judul_kompetisi']; ?>" readonly>
            </div><!-- Tingkat Kompetisi -->

            <div class="mb-3">
                <label for="judul-kompetisi-en" class="form-label">judul kompetisi en</label>
                <input type="text" class="form-control" id="tingkat-kompetisi" value="<?php echo $prestasi['judul_kompetisi_en']; ?>" readonly>
            </div>

            <!-- Kategori Kompetisi -->
            <div class="mb-3">
                <label for="kategori-kompetisi" class="form-label">Kategori Kompetisi</label>
                <input type="text" class="form-control" id="kategori-kompetisi" value="<?php echo ucfirst($jenis = $prestasi['tim'] == 0 ? 'Individu' : 'Tim'); ?>" readonly>
            </div>

            <!-- Peringkat -->
            <div class="mb-3">
                <label for="peringkat" class="form-label">Peringkat</label>
                <input type="text" class="form-control" id="peringkat" value="<?php echo $prestasi['peringkat']; ?>" readonly>
            </div>

            <!-- Tempat Kompetisi -->
            <div class="mb-3">
                <label for="tempat-kompetisi" class="form-label">Tempat Kompetisi</label>
                <input type="text" class="form-control" id="tempat-kompetisi" value="<?php echo $prestasi['tempat_kompetisi']; ?>" readonly>
            </div>

            <!-- URL Kompetisi -->
            <div class="mb-3">
                <label for="url-kompetisi" class="form-label">URL Kompetisi</label>
                <input type="url" class="form-control" id="url-kompetisi" value="<?php echo $prestasi['url_kompetisi']; ?>" readonly>
            </div>

            <!-- Tanggal Mulai -->
            <div class="mb-3">
                <label for="tanggal-mulai" class="form-label">Tanggal Mulai</label>
                <input type="text" class="form-control" id="tanggal-mulai" value="<?php echo date('Y/m/d', strtotime($prestasi['tanggal_mulai'])); ?>" readonly>
            </div>

            <!-- Tanggal Akhir -->
            <div class="mb-3">
                <label for="tanggal-akhir" class="form-label">Tanggal Akhir</label>
                <input type="text" class="form-control" id="tanggal-akhir" value="<?php echo date('Y/m/d', strtotime($prestasi['tanggal_akhir'])); ?>" readonly>
            </div>

            <!-- Jumlah PT -->
            <div class="mb-3">
                <label for="jumlah-pt" class="form-label">Jumlah PT</label>
                <input type="text" class="form-control" id="jumlah-pt" value="<?php echo $prestasi['jumlah_pt']; ?>" readonly>
            </div>

            <!-- Jumlah Peserta -->
            <div class="mb-3">
                <label for="jumlah-peserta" class="form-label">Jumlah Peserta</label>
                <input type="text" class="form-control" id="jumlah-peserta" value="<?php echo $prestasi['jumlah_peserta']; ?>" readonly>
            </div>

            <!-- No Surat Tugas -->
            <div class="mb-3">
                <label for="no-surat-tugas" class="form-label">No Surat Tugas</label>
                <input type="text" class="form-control" id="no-surat-tugas" value="<?php echo $prestasi['no_surat_tugas']; ?>" readonly>
            </div>

            <!-- Tanggal Surat Tugas -->
            <div class="mb-3">
                <label for="tanggal-surat-tugas" class="form-label">Tanggal Surat Tugas</label>
                <input type="text" class="form-control" id="tanggal-surat-tugas" value="<?php echo date('Y/m/d', strtotime($prestasi['tanggal_surat_tugas'])); ?>" readonly>
            </div>

            <!-- Kategori Partisipasi -->
            <div class="mb-3">
                <label for="kategori-partisipasi" class="form-label">skor</label>
                <input type="text" class="form-control" id="kategori-partisipasi" value="<?php echo $prestasi['skor']; ?>" readonly>
            </div>

            <!-- Dosen Pembimbing (Dynamic) -->
            <div id="dosen-container" class="mb-3">
                <label for="dosen-pembimbing" class="form-label">Dosen Pembimbing</label>
                <ul class="list-group">
                    <?php
                    $id_target = "P001"; // ID yang ingin ditampilkan
                    foreach ($dosen as $dosen_item) {
                        if ($dosen_item['id'] === $prestasi["id"]) { // Cek apakah ID sesuai dengan target
                            echo '<li class="list-group-item">' . $dosen_item['nama'] . '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <!-- Lampiran File -->
            <div class="mb-3">
                <label for="file-surat-tugas" class="form-label">File Surat Tugas</label>
                <a href="<?php echo $prestasi['file_surat_tugas']; ?>" class="btn btn-primary" target="_blank">Lihat Surat Tugas</a>
            </div>

            <div class="mb-3">
                <label for="file-sertifikat" class="form-label">File Sertifikat</label>
                <a href="<?php echo $prestasi['file_sertifikat']; ?>" class="btn btn-primary" target="_blank">Lihat Sertifikat</a>
            </div>

            <div class="mb-3">
                <label for="foto-kegiatan" class="form-label">Foto Kegiatan</label>
                <a href="<?php echo $prestasi['foto_kegiatan']; ?>" class="btn btn-primary" target="_blank">Lihat Foto</a>
            </div>

            <div class="mb-3">
                <label for="file-poster" class="form-label">File Poster</label>
                <a href="<?php echo $prestasi['file_poster']; ?>" class="btn btn-primary" target="_blank">Lihat Poster</a>
            </div>
            <!-- Tombol Validasi dan Tolak Validasi -->
            <div class="mb-3">
                <?php if ($prestasi["validasi"] == 0 && Session::get("role") == "1"): ?>
                    <!-- Tombol Validasi dan Tolak Validasi -->
                    <form method="POST" action="/dashboard/<?= $user ?>/detail-prestasi">
                        <input type="hidden" name="prestasi_id" value="<?php echo $prestasi['id']; ?>"> <!-- Menyertakan ID Prestasi -->
                        <input type="hidden" name="validasi" value="valid"> <!-- Status Validasi -->
                        <button type="submit" class="btn btn-success" name="action" value="validasi">Validasi</button>
                    </form>

                    <form method="POST" action="/dashboard/<?= $user ?>/detail-prestasi">
                        <input type="hidden" name="prestasi_id" value="<?php echo $prestasi['id']; ?>"> <!-- Menyertakan ID Prestasi -->
                        <input type="hidden" name="validasi" value="invalid"> <!-- Status Tolak Validasi -->
                        <button type="submit" class="btn btn-danger" name="action" value="tolak">Tolak Validasi</button>
                    </form>
                <?php elseif ($prestasi["validasi"] == 1): ?>
                    <!-- Pesan jika sudah divalidasi -->
                    <p>Sudah divalidasi oleh <?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>


        </form>
    </div>
</div>