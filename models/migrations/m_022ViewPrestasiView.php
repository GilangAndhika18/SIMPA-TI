<?php

use app\cores\Blueprint;
use app\cores\Schema;
use app\models\BaseMigration;

class m_022ViewPrestasiView implements BaseMigration
{
    public function up(): array
    {
        return Schema::query("
CREATE VIEW view_prestasi AS
SELECT 
    j.id,    
    m.nama,
    m.id_user,
    m.nim,
    m.jurusan,
    m.prodi,
    m.tahun_masuk,
    p.peringkat,
    COALESCE(a.nama, 'Tidak ada admin') AS admin_nama,
    j.tim,
    j.judul_kompetisi,
    j.judul_kompetisi_en,
    j.tempat_kompetisi,
    j.tempat_kompetisi_en,
    j.url_kompetisi,
    j.tanggal_mulai,
    j.tanggal_akhir,
    j.jumlah_pt,
    j.jumlah_peserta,
    j.no_surat_tugas,
    j.tanggal_surat_tugas,
    j.file_surat_tugas,
    j.file_sertifikat,
    j.foto_kegiatan,
    j.file_poster,
    j.validasi,
    jl.jenis_lomba,
    tl.tingkat_lomba,
    tl.skor + p.skor  AS skor

FROM prestasi j
LEFT JOIN jenis_lomba jl ON jl.id = j.id_jenis_kompetisi
LEFT JOIN tingkat_lomba tl ON tl.id = j.id_tingkat_kompetisi
LEFT JOIN mahasiswa m ON m.id = j.id_mahasiswa
LEFT JOIN peringkat p ON p.id = j.id_peringkat
LEFT JOIN admin a ON a.id = j.id_admin;
");

    }

    public function down(): array
    {
        return Schema::query("DROP VIEW view_prestasi");
    }
}
