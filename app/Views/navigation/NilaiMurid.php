<div class="main-content">

    <div class="table-section koreksi-page">

        <?php
        $detailNilai = isset($detailNilai) && is_array($detailNilai) ? $detailNilai : [];
        $detailSoal = isset($detailSoal) && is_array($detailSoal) ? $detailSoal : [];
        $jawabanParsed = isset($jawabanParsed) && is_array($jawabanParsed) ? $jawabanParsed : [];
        $mapelDetail = isset($mapelDetail) && is_array($mapelDetail) ? $mapelDetail : [];
        $roleKoreksi = session('role');
        $canKoreksi = in_array($roleKoreksi, ['admin', 'guru']);

        $statusParsed = isset($statusParsed) && is_array($statusParsed) ? $statusParsed : [];
        foreach (['status', 'status_koreksi', 'koreksi', 'status_jawaban', 'hasil_koreksi'] as $statusKey) {
            if (!empty($detailNilai[$statusKey])) {
                $decodedStatus = is_array($detailNilai[$statusKey])
                    ? $detailNilai[$statusKey]
                    : json_decode((string) $detailNilai[$statusKey], true);

                if (is_array($decodedStatus)) {
                    $statusParsed = array_replace($statusParsed, $decodedStatus);
                }
            }
        }

        $jumlahSoal = count($detailSoal);
        $jumlahPg = 0;
        $jumlahEsai = 0;
        $pgBenar = 0;
        $pgSalah = 0;
        $pgBelumDijawab = 0;

        foreach ($detailSoal as $soal) {
            $tipeSoal = $soal['tipe_soal'] ?? '';
            $idSoal = $soal['id_soal'] ?? null;
            $jawaban = $idSoal ? ($jawabanParsed[$idSoal] ?? '') : '';

            if ($tipeSoal === 'pg') {
                $jumlahPg++;

                if ($jawaban === '') {
                    $pgBelumDijawab++;
                } elseif (($soal['kunci'] ?? '') === $jawaban) {
                    $pgBenar++;
                } else {
                    $pgSalah++;
                }
            }

            if ($tipeSoal === 'esai') {
                $jumlahEsai++;
            }
        }

        if (!function_exists('tampilkanJawabanPg')) {
            function tampilkanJawabanPg($jawaban, $soal)
            {
                switch ($jawaban) {
                    case 'A':
                        return 'A. ' . esc($soal['opsi_a'] ?? '-');
                    case 'B':
                        return 'B. ' . esc($soal['opsi_b'] ?? '-');
                    case 'C':
                        return 'C. ' . esc($soal['opsi_c'] ?? '-');
                    case 'D':
                        return 'D. ' . esc($soal['opsi_d'] ?? '-');
                    default:
                        return '<span class="text-muted">Belum dijawab</span>';
                }
            }
        }

        if (!function_exists('tampilkanKunciPg')) {
            function tampilkanKunciPg($kunci, $soal)
            {
                switch ($kunci) {
                    case 'A':
                        return 'A. ' . esc($soal['opsi_a'] ?? '-');
                    case 'B':
                        return 'B. ' . esc($soal['opsi_b'] ?? '-');
                    case 'C':
                        return 'C. ' . esc($soal['opsi_c'] ?? '-');
                    case 'D':
                        return 'D. ' . esc($soal['opsi_d'] ?? '-');
                    default:
                        return '-';
                }
            }
        }
        ?>

        <?php if (!empty($detailNilai)): ?>

            <form action="<?= base_url('/koreksi') ?>" method="post" enctype="multipart/form-data" id="formKoreksiNilai">

                <input type="hidden" name="id_user" value="<?= esc($detailNilai['id_user'] ?? '') ?>">
                <input type="hidden" name="id_mapel" value="<?= esc($detailNilai['id_mapel'] ?? '') ?>">
                <input type="hidden" name="pertemuan" value="<?= esc($detailNilai['pertemuan'] ?? '') ?>">
                <input type="hidden" name="id_jawaban" value="<?= esc($detailNilai['id_jawaban'] ?? '') ?>">

                <div class="koreksi-hero">
                    <div>
                        <span class="koreksi-label"><?= $canKoreksi ? 'Koreksi Nilai Siswa' : 'Detail Nilai Siswa' ?></span>
                        <h5><?= esc($detailNilai['nama_siswa'] ?? '-') ?></h5>
                        <p>
                            <?= $canKoreksi ? 'Periksa jawaban siswa pada setiap soal. Pilihan ganda ditampilkan otomatis, sedangkan esai perlu dikoreksi manual oleh guru.' : 'Lihat rincian jawaban, kunci jawaban, status, dan nilai pada pertemuan ini.' ?>
                        </p>
                    </div>

                    <div class="koreksi-score-box">
                        <span>Nilai Saat Ini</span>
                        <strong><?= esc($detailNilai['nilai'] ?? '-') ?></strong>
                    </div>
                </div>

                <div class="koreksi-summary-grid mt-4">
                    <div>
                        <span>Nama Siswa</span>
                        <strong><?= esc($detailNilai['nama_siswa'] ?? '-') ?></strong>
                    </div>

                    <div>
                        <span>Mata Pelajaran</span>
                        <strong><?= esc($mapelDetail['nama_mapel'] ?? '-') ?></strong>
                    </div>

                    <div>
                        <span>Pertemuan</span>
                        <strong>Pertemuan <?= esc($detailNilai['pertemuan'] ?? '-') ?></strong>
                    </div>

                    <div>
                        <span>Total Soal</span>
                        <strong><?= $jumlahSoal ?> Soal</strong>
                    </div>
                </div>

                <div class="koreksi-recap-grid mt-3">
                    <div class="recap-card success">
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <span>PG Benar</span>
                            <strong><?= $pgBenar ?></strong>
                        </div>
                    </div>

                    <div class="recap-card danger">
                        <i class="fa-solid fa-circle-xmark"></i>
                        <div>
                            <span>PG Salah</span>
                            <strong><?= $pgSalah ?></strong>
                        </div>
                    </div>

                    <div class="recap-card warning">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <div>
                            <span>Esai Perlu Koreksi</span>
                            <strong><?= $jumlahEsai ?></strong>
                        </div>
                    </div>

                    <div class="recap-card neutral">
                        <i class="fa-solid fa-list-check"></i>
                        <div>
                            <span>PG Belum Dijawab</span>
                            <strong><?= $pgBelumDijawab ?></strong>
                        </div>
                    </div>
                </div>

                <div class="koreksi-note mt-4">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>
                        <?= $canKoreksi ? 'Jawaban pilihan ganda hanya bersifat informasi karena status benar atau salah sudah dapat dibandingkan dengan kunci jawaban. Koreksi manual hanya diperlukan pada soal esai.' : 'Rincian ini bersifat informasi. Status benar atau salah mengikuti hasil koreksi terakhir yang tersimpan di sistem.' ?>
                    </span>
                </div>

                <div class="koreksi-question-list mt-4">

                    <?php if (!empty($detailSoal)): ?>
                        <?php foreach ($detailSoal as $i => $s): ?>
                            <?php
                            $idSoal = $s['id_soal'] ?? null;
                            $tipeSoal = $s['tipe_soal'] ?? '-';
                            $jawaban = $idSoal ? ($jawabanParsed[$idSoal] ?? '') : '';
                            $isPg = $tipeSoal === 'pg';
                            $isEsai = $tipeSoal === 'esai';
                            $statusTersimpan = strtolower((string)($statusParsed[$idSoal] ?? $s['status'] ?? $s['status_koreksi'] ?? ''));

                            $statusText = 'Menunggu Koreksi';
                            $statusClass = 'waiting';

                            if ($isPg) {
                                if ($jawaban === '') {
                                    $statusText = 'Belum Dijawab';
                                    $statusClass = 'neutral';
                                } elseif ($jawaban === ($s['kunci'] ?? '')) {
                                    $statusText = 'Benar';
                                    $statusClass = 'success';
                                } else {
                                    $statusText = 'Salah';
                                    $statusClass = 'danger';
                                }
                            }

                            if ($isEsai && in_array($statusTersimpan, ['benar', 'salah'])) {
                                $statusText = $statusTersimpan === 'benar' ? 'Benar' : 'Salah';
                                $statusClass = $statusTersimpan === 'benar' ? 'success' : 'danger';
                            }
                            ?>

                            <div class="koreksi-question-card">

                                <div class="question-card-header">
                                    <div class="question-number">
                                        <span>No</span>
                                        <strong><?= $i + 1 ?></strong>
                                    </div>

                                    <div class="question-meta">
                                        <span class="type-badge <?= $isPg ? 'pg' : 'esai' ?>">
                                            <?= $isPg ? 'Pilihan Ganda' : 'Esai' ?>
                                        </span>

                                        <span class="result-badge <?= $statusClass ?>">
                                            <?= esc($statusText) ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="question-content">
                                    <label>Pertanyaan</label>
                                    <div class="question-text">
                                        <?= esc($s['pertanyaan'] ?? '-') ?>
                                    </div>

                                    <?php if (!empty($s['gambar'])): ?>
                                        <div class="question-image mt-3">
                                            <img src="<?= base_url('uploads/soal/' . $s['gambar']) ?>" alt="Gambar Soal">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($isPg): ?>

                                    <div class="answer-grid mt-3">
                                        <div class="answer-box">
                                            <label>Jawaban Siswa</label>
                                            <strong><?= tampilkanJawabanPg($jawaban, $s) ?></strong>
                                        </div>

                                        <div class="answer-box key">
                                            <label>Kunci Jawaban</label>
                                            <strong><?= tampilkanKunciPg($s['kunci'] ?? '', $s) ?></strong>
                                        </div>
                                    </div>

                                <?php elseif ($isEsai): ?>

                                    <div class="answer-box essay mt-3">
                                        <label>Jawaban Siswa</label>
                                        <div class="essay-answer">
                                            <?php
                                            $jawabanEsai = trim((string)$jawaban, '[]');
                                            echo $jawabanEsai !== '' ? esc($jawabanEsai) : '<span class="text-muted">Belum dijawab</span>';
                                            ?>
                                        </div>
                                    </div>

                                    <?php if ($canKoreksi): ?>
                                        <div class="essay-correction mt-3">
                                            <label>Status Koreksi Esai</label>
                                            <select
                                                name="status[<?= esc($s['id_soal']) ?>]"
                                                class="form-control"
                                                required>
                                                <option value="" <?= !in_array($statusTersimpan, ['benar', 'salah']) ? 'selected' : '' ?>>Pilih status koreksi</option>
                                                <option value="benar" <?= $statusTersimpan === 'benar' ? 'selected' : '' ?>>Benar</option>
                                                <option value="salah" <?= $statusTersimpan === 'salah' ? 'selected' : '' ?>>Salah</option>
                                            </select>
                                            <small>
                                                Status otomatis mengikuti hasil koreksi terakhir jika data sudah pernah dikoreksi.
                                            </small>
                                        </div>
                                    <?php else: ?>
                                        <div class="essay-correction mt-3 readonly-status">
                                            <label>Status Koreksi Esai</label>
                                            <div class="readonly-status-box <?= $statusClass ?>">
                                                <?= esc($statusText) ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                <?php endif; ?>

                            </div>

                        <?php endforeach; ?>
                    <?php else: ?>

                        <div class="empty-state">
                            <i class="fa-solid fa-clipboard-question"></i>
                            <p>Belum ada detail soal yang dapat dikoreksi.</p>
                        </div>

                    <?php endif; ?>

                </div>

                <div class="koreksi-footer-action mt-4">
                    <button type="button" class="btn btn-secondary" onclick="history.back()">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </button>

                    <?php if ($canKoreksi && $jumlahEsai > 0): ?>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan Koreksi Esai
                        </button>
                    <?php else: ?>
                        <button type="button" class="btn btn-outline-primary" disabled>
                            <i class="fa-solid fa-circle-check"></i>
                            Tidak Ada Koreksi yang Perlu Disimpan
                        </button>
                    <?php endif; ?>
                </div>

            </form>

        <?php else: ?>

            <div class="empty-state">
                <i class="fa-solid fa-clipboard-check"></i>
                <p>Detail nilai belum tersedia.</p>
            </div>

        <?php endif; ?>

    </div>

</div>

<style>
    .koreksi-page {
        overflow: hidden;
    }

    .koreksi-hero {
        background: linear-gradient(135deg, #eff6ff, #ffffff);
        border: 1px solid #dbeafe;
        border-radius: 18px;
        padding: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
    }

    .koreksi-label {
        display: inline-block;
        background: #ffffff;
        color: #2563eb;
        border: 1px solid #dbeafe;
        border-radius: 999px;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .koreksi-hero h5 {
        margin: 0 0 6px;
        color: #0f172a;
        font-weight: 700;
    }

    .koreksi-hero p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
        max-width: 760px;
    }

    .koreksi-score-box {
        min-width: 150px;
        background: #2563eb;
        color: #ffffff;
        border-radius: 16px;
        padding: 16px;
        text-align: center;
    }

    .koreksi-score-box span {
        display: block;
        font-size: 13px;
        opacity: 0.9;
        margin-bottom: 4px;
    }

    .koreksi-score-box strong {
        font-size: 32px;
        line-height: 1;
    }

    .koreksi-summary-grid,
    .koreksi-recap-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .koreksi-summary-grid>div {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 14px;
    }

    .koreksi-summary-grid span,
    .recap-card span {
        display: block;
        color: #64748b;
        font-size: 13px;
        margin-bottom: 4px;
    }

    .koreksi-summary-grid strong,
    .recap-card strong {
        color: #0f172a;
        font-size: 15px;
        font-weight: 700;
    }

    .recap-card {
        border-radius: 14px;
        padding: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        border: 1px solid #e5e7eb;
        background: #ffffff;
    }

    .recap-card i {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .recap-card.success i {
        background: #dcfce7;
        color: #16a34a;
    }

    .recap-card.danger i {
        background: #fee2e2;
        color: #dc2626;
    }

    .recap-card.warning i {
        background: #fef3c7;
        color: #d97706;
    }

    .recap-card.neutral i {
        background: #e0f2fe;
        color: #0369a1;
    }

    .koreksi-note {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 14px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .koreksi-note i {
        color: #2563eb;
        margin-top: 3px;
    }

    .koreksi-question-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .koreksi-question-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
    }

    .question-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 14px;
        margin-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }

    .question-number {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .question-number span {
        color: #64748b;
        font-size: 13px;
    }

    .question-number strong {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .question-meta {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 8px;
    }

    .type-badge,
    .result-badge {
        border-radius: 999px;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 700;
    }

    .type-badge.pg {
        background: #eef4ff;
        color: #2563eb;
        border: 1px solid #dbeafe;
    }

    .type-badge.esai {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .result-badge.success {
        background: #dcfce7;
        color: #16a34a;
    }

    .result-badge.danger {
        background: #fee2e2;
        color: #dc2626;
    }

    .result-badge.waiting {
        background: #fef3c7;
        color: #d97706;
    }

    .result-badge.neutral {
        background: #e2e8f0;
        color: #475569;
    }

    .question-content label,
    .answer-box label,
    .essay-correction label {
        display: block;
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .question-text {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 14px;
        color: #0f172a;
        line-height: 1.7;
    }

    .question-image img {
        max-width: 420px;
        width: 100%;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
    }

    .answer-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
    }

    .answer-box {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 14px;
    }

    .answer-box strong {
        color: #0f172a;
        font-size: 14px;
        line-height: 1.6;
    }

    .answer-box.key {
        background: #f0fdf4;
        border-color: #bbf7d0;
    }

    .answer-box.essay {
        background: #f8fafc;
    }

    .essay-answer {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 12px;
        color: #0f172a;
        line-height: 1.7;
        min-height: 90px;
    }

    .essay-correction {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 14px;
        padding: 14px;
    }

    .readonly-status-box {
        border-radius: 12px;
        padding: 10px 12px;
        font-size: 14px;
        font-weight: 700;
        display: inline-flex;
        min-width: 150px;
        justify-content: center;
    }

    .readonly-status-box.success {
        background: #dcfce7;
        color: #16a34a;
        border: 1px solid #bbf7d0;
    }

    .readonly-status-box.danger {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .readonly-status-box.waiting {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .readonly-status-box.neutral {
        background: #e2e8f0;
        color: #475569;
        border: 1px solid #cbd5e1;
    }

    .essay-correction small {
        display: block;
        margin-top: 6px;
        color: #92400e;
        font-size: 12px;
    }

    .koreksi-footer-action {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 14px;
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
    }

    .koreksi-footer-action .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 10px;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .koreksi-hero,
        .question-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .koreksi-score-box {
            width: 100%;
        }

        .koreksi-summary-grid,
        .koreksi-recap-grid,
        .answer-grid {
            grid-template-columns: 1fr;
        }

        .question-meta {
            justify-content: flex-start;
        }

        .koreksi-footer-action {
            justify-content: stretch;
        }

        .koreksi-footer-action .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>
