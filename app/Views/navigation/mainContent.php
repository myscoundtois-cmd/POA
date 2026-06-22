<!-- Main Content -->
<div class="main-content">

    <?php if (session('role') === 'admin'): ?>

        <div class="row mt-4 g-4">
            <div class="col-md-3">
                <div class="dashboard-card bg1">
                    <div class="card-wave"></div>
                    <h5>Total Siswa</h5>
                    <h2><?= $total_siswa ?? 0 ?></h2>
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg2">
                    <div class="card-wave"></div>
                    <h5>Total Guru</h5>
                    <h2><?= $total_guru ?? 0 ?></h2>
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg3">
                    <div class="card-wave"></div>
                    <h5>Total Kelas</h5>
                    <h2><?= $total_kelas ?? 0 ?></h2>
                    <i class="fa-solid fa-school"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg4">
                    <div class="card-wave"></div>
                    <h5>Total Mapel</h5>
                    <h2><?= $total_mapel ?? 0 ?></h2>
                    <i class="fa-solid fa-book-open"></i>
                </div>
            </div>
        </div>

        <div class="table-section admin-purpose-section mt-4">
            <div class="admin-purpose-head">
                <div>
                    <span class="admin-purpose-label">Tentang Aplikasi</span>
                    <h5>Sistem Penugasan Online Adaptif</h5>
                    <p>
                        Aplikasi ini dibuat untuk membantu SMPN 2 Pesisir Utara mengelola penugasan siswa secara digital, adaptif, dan mudah dipantau. Sistem ini mendukung guru dalam menyusun tugas, melihat perkembangan siswa, serta memantau hasil belajar secara lebih cepat melalui data yang tersaji di dashboard.
                    </p>
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-4">
                    <div class="admin-purpose-card">
                        <div class="admin-purpose-icon">
                            <i class="fa-solid fa-clipboard-list"></i>
                        </div>
                        <div>
                            <h6>Penugasan Lebih Terarah</h6>
                            <p>
                                Guru dapat mengelola materi, soal, dan tugas dalam satu sistem agar proses pembelajaran tidak bergantung pada rekap manual.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="admin-purpose-card">
                        <div class="admin-purpose-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div>
                            <h6>Pemantauan Real-Time</h6>
                            <p>
                                Perkembangan nilai siswa dapat dilihat lebih cepat sehingga guru dan wali kelas dapat mengambil keputusan evaluasi dengan tepat.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="admin-purpose-card">
                        <div class="admin-purpose-icon">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <div>
                            <h6>Pembelajaran Adaptif</h6>
                            <p>
                                Sistem diarahkan untuk menyesuaikan proses penugasan dengan kemampuan siswa agar pembelajaran lebih personal dan relevan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .admin-purpose-section {
                overflow: hidden;
            }

            .admin-purpose-head {
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                padding: 20px;
                margin-bottom: 10px;
            }

            .admin-purpose-label {
                display: inline-block;
                background: #eff6ff;
                color: #2563eb;
                border-radius: 999px;
                padding: 6px 12px;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 10px;
            }

            .admin-purpose-head h5 {
                margin: 0 0 8px;
                color: #0f172a;
                font-weight: 700;
            }

            .admin-purpose-head p {
                margin: 0;
                color: #64748b;
                font-size: 14px;
                line-height: 1.7;
            }

            .admin-purpose-card {
                height: 100%;
                background: #ffffff;
                border: 1px solid #e5e7eb;
                border-radius: 16px;
                padding: 16px;
                display: flex;
                gap: 14px;
                transition: 0.25s;
            }

            .admin-purpose-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 22px rgba(0, 0, 0, 0.06);
            }

            .admin-purpose-icon {
                width: 44px;
                height: 44px;
                min-width: 44px;
                border-radius: 14px;
                background: #eff6ff;
                color: #2563eb;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
            }

            .admin-purpose-card h6 {
                margin: 0 0 6px;
                color: #0f172a;
                font-weight: 700;
            }

            .admin-purpose-card p {
                margin: 0;
                color: #64748b;
                font-size: 13px;
                line-height: 1.6;
            }

            @media (max-width: 768px) {
                .admin-purpose-card {
                    flex-direction: column;
                }
            }
        </style>


    <?php elseif (session('role') === 'guru'): ?>

        <?php
        $mapelListGuru = isset($mapel) && is_array($mapel) ? $mapel : [];
        $materiListGuru = isset($materi) && is_array($materi) ? $materi : [];
        $nilaiListGuru = isset($jawabanSiswa) && is_array($jawabanSiswa) ? $jawabanSiswa : [];
        $namaGuru = session()->get('nama') ?? '-';

        $mapelGuruAktif = [];
        foreach ($mapelListGuru as $m) {
            if (($m['created_by'] ?? '') === $namaGuru || empty($m['created_by'])) {
                $mapelGuruAktif[] = $m;
            }
        }

        if (empty($mapelGuruAktif)) {
            $mapelGuruAktif = $mapelListGuru;
        }

        $kelasGuru = [];
        foreach ($mapelGuruAktif as $m) {
            if (!empty($m['kelas'])) {
                $kelasGuru[$m['kelas']] = true;
            }
        }

        $totalNilaiGuru = count($nilaiListGuru);
        $jumlahNilaiGuru = 0;
        $nilaiRendahGuru = 0;
        $nilaiTerbaruGuru = array_slice(array_reverse($nilaiListGuru), 0, 5);

        foreach ($nilaiListGuru as $n) {
            $nilai = (int)($n['nilai'] ?? 0);
            $jumlahNilaiGuru += $nilai;

            if ($nilai > 0 && $nilai < 75) {
                $nilaiRendahGuru++;
            }
        }

        $rataNilaiGuru = $totalNilaiGuru > 0 ? round($jumlahNilaiGuru / $totalNilaiGuru) : 0;
        $totalMateriGuru = count($materiListGuru);
        ?>

        <div class="guru-dashboard">
            <div class="guru-hero">
                <div>
                    <span class="guru-label">Dashboard Guru</span>
                    <h4>Ringkasan Aktivitas Pembelajaran</h4>
                    <p>
                        Pantau mata pelajaran, kelas yang diajar, materi, serta hasil penugasan siswa secara lebih ringkas.
                    </p>
                </div>

                <div class="guru-status-box">
                    <span>Rata-rata Nilai</span>
                    <strong><?= $rataNilaiGuru ?></strong>
                </div>
            </div>

            <div class="row mt-4 g-4">
                <div class="col-md-3">
                    <div class="dashboard-card bg1">
                        <div class="card-wave"></div>
                        <h5>Kelas yang Diajar</h5>
                        <h2><?= $total_kelas_guru ?? count($kelasGuru) ?></h2>
                        <i class="fa-solid fa-users-line"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg2">
                        <div class="card-wave"></div>
                        <h5>Mapel Aktif</h5>
                        <h2><?= $mapel_guru ?? count($mapelGuruAktif) ?></h2>
                        <i class="fa-solid fa-book-open-reader"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg3">
                        <div class="card-wave"></div>
                        <h5>Total Materi</h5>
                        <h2><?= $totalMateriGuru ?></h2>
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg4">
                        <div class="card-wave"></div>
                        <h5>Perlu Perhatian</h5>
                        <h2><?= $nilaiRendahGuru ?></h2>
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>
            </div>

            <div class="row mt-4 g-4">
                <div class="col-lg-5">
                    <div class="table-section guru-info-card">
                        <h5>Informasi Mengajar</h5>

                        <div class="guru-info-list">
                            <div class="guru-info-item">
                                <i class="fa-solid fa-chalkboard-user"></i>
                                <div>
                                    <span>Nama Guru</span>
                                    <strong><?= esc($namaGuru) ?></strong>
                                </div>
                            </div>

                            <div class="guru-info-item">
                                <i class="fa-solid fa-school"></i>
                                <div>
                                    <span>Wali Kelas</span>
                                    <strong>
                                        <?php if (!empty($wali_kelas)): ?>
                                            <?php foreach ($wali_kelas as $row): ?>
                                                <?= esc($row['kelas']) ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </strong>
                                </div>
                            </div>

                            <div class="guru-info-item">
                                <i class="fa-solid fa-clipboard-check"></i>
                                <div>
                                    <span>Nilai Masuk</span>
                                    <strong><?= $totalNilaiGuru ?> Data</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="table-section">
                        <div class="table-toolbar">
                            <div class="toolbar-left">
                                <h5 class="mb-0">Mata Pelajaran yang Dikelola</h5>
                            </div>
                            <div class="toolbar-right">
                                <small class="text-muted">Ringkasan mapel dan kelas</small>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Pengajar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($mapelGuruAktif)): ?>
                                        <?php foreach ($mapelGuruAktif as $i => $m): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= esc($m['nama_mapel'] ?? '-') ?></td>
                                                <td><?= esc($m['kelas'] ?? '-') ?></td>
                                                <td><?= esc($m['created_by'] ?? $namaGuru) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4">
                                                <div class="empty-state">
                                                    <i class="fa-solid fa-book-open"></i>
                                                    <p>Belum ada mata pelajaran yang dikelola.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-section mt-4">
                <div class="table-toolbar">
                    <div class="toolbar-left">
                        <h5 class="mb-0">Nilai Terbaru Siswa</h5>
                    </div>
                    <div class="toolbar-right">
                        <small class="text-muted">Maksimal 5 data terakhir</small>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Pertemuan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($nilaiTerbaruGuru)): ?>
                                <?php foreach ($nilaiTerbaruGuru as $i => $n): ?>
                                    <?php
                                    $nilai = (int)($n['nilai'] ?? 0);
                                    $status = $nilai >= 75 ? 'Tuntas' : 'Perlu Perhatian';
                                    $class = $nilai >= 75 ? 'aktif' : 'nonaktif';
                                    ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($n['nama_siswa'] ?? $n['nama'] ?? '-') ?></td>
                                        <td>Pertemuan <?= esc($n['pertemuan'] ?? '-') ?></td>
                                        <td><strong><?= $nilai ?></strong></td>
                                        <td><span class="status <?= $class ?>"><?= esc($status) ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-clipboard-check"></i>
                                            <p>Belum ada nilai terbaru.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <style>
            .guru-hero {
                background: #ffffff;
                border: 1px solid #dbeafe;
                border-radius: 20px;
                padding: 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            }

            .guru-label {
                display: inline-block;
                background: #eff6ff;
                color: #2563eb;
                border: 1px solid #dbeafe;
                border-radius: 999px;
                padding: 6px 12px;
                font-size: 13px;
                font-weight: 700;
                margin-bottom: 10px;
            }

            .guru-hero h4 {
                margin: 0 0 6px;
                color: #0f172a;
                font-weight: 700;
            }

            .guru-hero p {
                margin: 0;
                color: #64748b;
                font-size: 14px;
                line-height: 1.6;
            }

            .guru-status-box {
                min-width: 170px;
                background: #eff6ff;
                border: 1px solid #bfdbfe;
                border-radius: 16px;
                padding: 16px;
                text-align: center;
            }

            .guru-status-box span {
                display: block;
                color: #1d4ed8;
                font-size: 13px;
                margin-bottom: 6px;
                font-weight: 600;
            }

            .guru-status-box strong {
                color: #1e3a8a;
                font-size: 32px;
                line-height: 1;
            }

            .guru-info-card {
                height: 100%;
            }

            .guru-info-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
                margin-top: 16px;
            }

            .guru-info-item {
                display: flex;
                align-items: center;
                gap: 12px;
                background: #f8fafc;
                border: 1px solid #e5e7eb;
                border-radius: 14px;
                padding: 14px;
            }

            .guru-info-item i {
                width: 42px;
                height: 42px;
                min-width: 42px;
                border-radius: 12px;
                background: #eff6ff;
                color: #2563eb;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .guru-info-item span {
                display: block;
                color: #64748b;
                font-size: 13px;
                margin-bottom: 3px;
            }

            .guru-info-item strong {
                color: #0f172a;
                font-size: 14px;
            }

            @media (max-width: 768px) {
                .guru-hero {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .guru-status-box {
                    width: 100%;
                }
            }
        </style>

    <?php elseif (session('role') === 'wali'): ?>

        <?php
        $nilaiAnak = isset($jawabanSiswa) && is_array($jawabanSiswa) ? $jawabanSiswa : [];
        $mapelList = isset($mapel) && is_array($mapel) ? $mapel : [];

        $mapelById = [];
        foreach ($mapelList as $m) {
            $mapelById[$m['id_mapel']] = $m;
        }

        $namaAnak = '-';
        $nisAnak = '-';
        $kelasAnak = '-';

        if (!empty($nilaiAnak)) {
            $first = $nilaiAnak[0];

            $namaAnak = $first['nama_siswa'] ?? $first['nama'] ?? '-';
            $nisAnak = $first['nis'] ?? '-';
            $kelasAnak = $first['kelas'] ?? '-';

            if ($kelasAnak === '-' && !empty($first['id_mapel']) && isset($mapelById[$first['id_mapel']])) {
                $kelasAnak = $mapelById[$first['id_mapel']]['kelas'] ?? '-';
            }
        }

        $totalNilai = count($nilaiAnak);
        $jumlahNilai = 0;
        $nilaiTertinggi = 0;
        $nilaiTerendah = 0;
        $mapelDinilai = [];
        $grafikMapel = [];

        foreach ($nilaiAnak as $row) {
            $idMapel = $row['id_mapel'] ?? null;
            $nilai = (int)($row['nilai'] ?? 0);

            $jumlahNilai += $nilai;

            if ($nilai > $nilaiTertinggi) {
                $nilaiTertinggi = $nilai;
            }

            if ($nilaiTerendah === 0 || $nilai < $nilaiTerendah) {
                $nilaiTerendah = $nilai;
            }

            if ($idMapel) {
                $mapelDinilai[$idMapel] = true;

                if (!isset($grafikMapel[$idMapel])) {
                    $grafikMapel[$idMapel] = [
                        'nama_mapel' => $mapelById[$idMapel]['nama_mapel'] ?? 'Mata Pelajaran',
                        'labels' => [],
                        'nilai' => []
                    ];
                }

                $grafikMapel[$idMapel]['labels'][] = 'Pertemuan ' . ($row['pertemuan'] ?? '-');
                $grafikMapel[$idMapel]['nilai'][] = $nilai;
            }
        }

        $rataRata = $totalNilai > 0 ? round($jumlahNilai / $totalNilai) : 0;
        $totalMapel = count($mapelDinilai);
        $statusAkademik = $rataRata >= 75 ? 'Baik' : 'Perlu Pendampingan';
        $statusClass = $rataRata >= 75 ? 'aktif' : 'nonaktif';
        $nilaiTerbaru = array_slice(array_reverse($nilaiAnak), 0, 5);
        ?>

        <div class="wali-dashboard">

            <div class="wali-hero">
                <div>
                    <span class="wali-label">Dashboard Wali Murid</span>
                    <h4>Perkembangan Akademik Anak</h4>
                    <p>Pantau data anak, mata pelajaran, dan nilai penugasan secara ringkas.</p>
                </div>

                <div class="wali-status <?= $statusClass === 'aktif' ? 'status-good' : 'status-warning' ?>">
                    <span>Status Akademik</span>
                    <strong class="<?= $statusClass ?>"><?= esc($statusAkademik) ?></strong>
                </div>
            </div>

            <div class="row mt-4 g-4">
                <div class="col-md-3">
                    <div class="dashboard-card bg1">
                        <div class="card-wave"></div>
                        <h5>Rata-rata Nilai</h5>
                        <h2><?= $rataRata ?></h2>
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg2">
                        <div class="card-wave"></div>
                        <h5>Mapel Dinilai</h5>
                        <h2><?= $totalMapel ?></h2>
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg3">
                        <div class="card-wave"></div>
                        <h5>Total Penilaian</h5>
                        <h2><?= $totalNilai ?></h2>
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg4">
                        <div class="card-wave"></div>
                        <h5>Nilai Tertinggi</h5>
                        <h2><?= $nilaiTertinggi ?></h2>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="row mt-4 g-4">
                <div class="col-lg-4">
                    <div class="table-section wali-anak-card">
                        <h5>Data Anak</h5>

                        <div class="wali-anak-icon">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>

                        <div class="wali-info-row">
                            <span>Nama Anak</span>
                            <strong><?= esc($namaAnak) ?></strong>
                        </div>

                        <div class="wali-info-row">
                            <span>NIS</span>
                            <strong><?= esc($nisAnak) ?></strong>
                        </div>

                        <div class="wali-info-row">
                            <span>Kelas</span>
                            <strong><?= esc($kelasAnak) ?></strong>
                        </div>

                        <div class="wali-info-row">
                            <span>Nilai Terendah</span>
                            <strong><?= $nilaiTerendah ?></strong>
                        </div>

                        <div class="wali-info-row">
                            <span>Nilai Tertinggi</span>
                            <strong><?= $nilaiTertinggi ?></strong>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="table-section">
                        <div class="table-toolbar">
                            <div class="toolbar-left">
                                <h5 class="mb-0">Nilai Terbaru Anak</h5>
                            </div>

                            <div class="toolbar-right">
                                <small class="text-muted">Menampilkan 5 nilai terakhir</small>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Pertemuan</th>
                                        <th>Nilai</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($nilaiTerbaru)): ?>
                                        <?php foreach ($nilaiTerbaru as $i => $row): ?>
                                            <?php
                                            $idMapel = $row['id_mapel'] ?? null;
                                            $namaMapel = $mapelById[$idMapel]['nama_mapel'] ?? '-';
                                            $nilai = (int)($row['nilai'] ?? 0);
                                            $status = $nilai >= 75 ? 'Cukup' : 'Perlu Ditingkatkan';
                                            $class = $nilai >= 75 ? 'aktif' : 'nonaktif';
                                            ?>

                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= esc($namaMapel) ?></td>
                                                <td>Pertemuan <?= esc($row['pertemuan'] ?? '-') ?></td>
                                                <td><strong><?= $nilai ?></strong></td>
                                                <td>
                                                    <span class="status <?= $class ?>">
                                                        <?= esc($status) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">
                                                <div class="empty-state">
                                                    <i class="fa-solid fa-clipboard-check"></i>
                                                    <p>Belum ada data nilai anak.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($grafikMapel)): ?>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <div class="row mt-4 g-4">
                    <?php $chartNo = 1; ?>
                    <?php foreach ($grafikMapel as $grafik): ?>

                        <div class="col-md-6">
                            <div class="table-section">
                                <h5 class="mb-3">Grafik Nilai <?= esc($grafik['nama_mapel']) ?></h5>
                                <canvas id="chartWali<?= $chartNo ?>"></canvas>
                            </div>
                        </div>

                        <script>
                            new Chart(document.getElementById('chartWali<?= $chartNo ?>'), {
                                type: 'line',
                                data: {
                                    labels: <?= json_encode($grafik['labels']) ?>,
                                    datasets: [{
                                        label: 'Nilai',
                                        data: <?= json_encode($grafik['nilai']) ?>,
                                        borderWidth: 3,
                                        tension: 0.4,
                                        fill: false
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            max: 100
                                        }
                                    }
                                }
                            });
                        </script>

                        <?php $chartNo++; ?>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

        <style>
            .wali-hero {
                background: #ffffff;
                border: 1px solid #e5e7eb;
                border-radius: 20px;
                padding: 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            }

            .wali-label {
                display: inline-block;
                background: #eff6ff;
                color: #2563eb;
                border-radius: 999px;
                padding: 6px 12px;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 10px;
            }

            .wali-hero h4 {
                margin: 0 0 6px;
                color: #0f172a;
                font-weight: 700;
            }

            .wali-hero p {
                margin: 0;
                color: #64748b;
                font-size: 14px;
            }

            .wali-status {
                min-width: 180px;
                border-radius: 16px;
                padding: 16px;
                text-align: center;
            }

            .wali-status.status-good {
                background: #f0fdf4;
                border: 1px solid #bbf7d0;
            }

            .wali-status.status-warning {
                background: #fff7ed;
                border: 1px solid #fed7aa;
            }

            .wali-status span {
                display: block;
                color: #475569;
                font-size: 13px;
                margin-bottom: 6px;
            }

            .wali-status strong.aktif {
                color: #16a34a;
            }

            .wali-status strong.nonaktif {
                color: #dc2626;
            }

            .wali-anak-card {
                height: 100%;
            }

            .wali-anak-icon {
                width: 74px;
                height: 74px;
                border-radius: 50%;
                background: #eff6ff;
                color: #2563eb;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
                margin: 16px auto 22px;
            }

            .wali-info-row {
                display: flex;
                justify-content: space-between;
                gap: 14px;
                padding: 12px 0;
                border-bottom: 1px solid #f1f5f9;
            }

            .wali-info-row span {
                color: #64748b;
                font-size: 14px;
            }

            .wali-info-row strong {
                color: #0f172a;
                font-size: 14px;
                text-align: right;
            }

            @media (max-width: 768px) {
                .wali-hero {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .wali-status {
                    width: 100%;
                }
            }
        </style>

    <?php elseif (session('role') === 'murid'): ?>

        <?php
        $nilaiSiswa = isset($jawabanSiswa) && is_array($jawabanSiswa) ? $jawabanSiswa : [];
        $mapelList = isset($mapel) && is_array($mapel) ? $mapel : [];

        $mapelById = [];
        foreach ($mapelList as $m) {
            if (isset($m['id_mapel'])) {
                $mapelById[$m['id_mapel']] = $m;
            }
        }

        $namaSiswa = session()->get('nama') ?? '-';
        $nisSiswa = session()->get('nis') ?? '-';
        $kelasSiswa = session()->get('kelas') ?? '-';

        if (!empty($nilaiSiswa)) {
            $first = $nilaiSiswa[0];

            $namaSiswa = $first['nama_siswa'] ?? $first['nama'] ?? $namaSiswa;
            $nisSiswa = $first['nis'] ?? $nisSiswa;
            $kelasSiswa = $first['kelas'] ?? $kelasSiswa;

            if (($kelasSiswa === '-' || empty($kelasSiswa)) && !empty($first['id_mapel']) && isset($mapelById[$first['id_mapel']])) {
                $kelasSiswa = $mapelById[$first['id_mapel']]['kelas'] ?? '-';
            }
        }

        $totalNilai = count($nilaiSiswa);
        $jumlahNilai = 0;
        $nilaiTertinggi = 0;
        $nilaiTerendah = 0;
        $mapelDinilai = [];
        $grafikMapel = [];
        $rekapMapel = [];

        foreach ($nilaiSiswa as $row) {
            $idMapel = $row['id_mapel'] ?? null;
            $nilai = (int)($row['nilai'] ?? 0);
            $pertemuan = $row['pertemuan'] ?? '-';

            $jumlahNilai += $nilai;

            if ($nilai > $nilaiTertinggi) {
                $nilaiTertinggi = $nilai;
            }

            if ($nilaiTerendah === 0 || $nilai < $nilaiTerendah) {
                $nilaiTerendah = $nilai;
            }

            if ($idMapel) {
                $namaMapel = $mapelById[$idMapel]['nama_mapel'] ?? 'Mata Pelajaran';
                $mapelDinilai[$idMapel] = true;

                if (!isset($grafikMapel[$idMapel])) {
                    $grafikMapel[$idMapel] = [
                        'nama_mapel' => $namaMapel,
                        'labels' => [],
                        'nilai' => []
                    ];
                }

                $grafikMapel[$idMapel]['labels'][] = 'Pertemuan ' . $pertemuan;
                $grafikMapel[$idMapel]['nilai'][] = $nilai;

                if (!isset($rekapMapel[$idMapel])) {
                    $rekapMapel[$idMapel] = [
                        'nama_mapel' => $namaMapel,
                        'jumlah' => 0,
                        'total' => 0,
                        'terakhir' => 0,
                        'pertemuan_terakhir' => '-'
                    ];
                }

                $rekapMapel[$idMapel]['jumlah']++;
                $rekapMapel[$idMapel]['total'] += $nilai;
                $rekapMapel[$idMapel]['terakhir'] = $nilai;
                $rekapMapel[$idMapel]['pertemuan_terakhir'] = $pertemuan;
            }
        }

        $rataRata = $totalNilai > 0 ? round($jumlahNilai / $totalNilai) : 0;
        $totalMapel = count($mapelDinilai);
        $nilaiTerbaru = array_slice(array_reverse($nilaiSiswa), 0, 5);
        $nilaiTerakhir = !empty($nilaiTerbaru) ? (int)($nilaiTerbaru[0]['nilai'] ?? 0) : 0;
        $statusBelajar = $rataRata >= 75 ? 'Baik' : 'Perlu Ditingkatkan';
        $statusClass = $rataRata >= 75 ? 'aktif' : 'nonaktif';
        ?>

        <div class="murid-dashboard">

            <div class="murid-hero">
                <div>
                    <span class="murid-label">Dashboard Murid</span>
                    <h4>Ringkasan Perkembangan Nilai</h4>
                    <p>
                        Lihat nilai terbaru, rata-rata belajar, dan perkembangan setiap mata pelajaran secara ringkas.
                    </p>
                </div>

                <div class="murid-status-box <?= $statusClass === 'aktif' ? 'status-good' : 'status-warning' ?>">
                    <span>Status Belajar</span>
                    <strong class="<?= $statusClass ?>">
                        <?= esc($statusBelajar) ?>
                    </strong>
                </div>
            </div>

            <div class="row mt-4 g-4">

                <div class="col-md-3">
                    <div class="dashboard-card bg1">
                        <div class="card-wave"></div>
                        <h5>Rata-rata Nilai</h5>
                        <h2><?= $rataRata ?></h2>
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg2">
                        <div class="card-wave"></div>
                        <h5>Mapel Dinilai</h5>
                        <h2><?= $totalMapel ?></h2>
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg3">
                        <div class="card-wave"></div>
                        <h5>Total Penilaian</h5>
                        <h2><?= $totalNilai ?></h2>
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card bg4">
                        <div class="card-wave"></div>
                        <h5>Nilai Terbaru</h5>
                        <h2><?= $nilaiTerakhir ?></h2>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>

            </div>

            <div class="row mt-4 g-4">

                <div class="col-lg-4">
                    <div class="table-section murid-profile-card">
                        <h5>Data Siswa</h5>

                        <div class="murid-avatar">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>

                        <div class="murid-info-row">
                            <span>Nama</span>
                            <strong><?= esc($namaSiswa) ?></strong>
                        </div>

                        <div class="murid-info-row">
                            <span>NIS</span>
                            <strong><?= esc($nisSiswa ?: '-') ?></strong>
                        </div>

                        <div class="murid-info-row">
                            <span>Kelas</span>
                            <strong><?= esc($kelasSiswa ?: '-') ?></strong>
                        </div>

                        <div class="murid-info-row">
                            <span>Nilai Tertinggi</span>
                            <strong><?= $nilaiTertinggi ?></strong>
                        </div>

                        <div class="murid-info-row">
                            <span>Nilai Terendah</span>
                            <strong><?= $nilaiTerendah ?></strong>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="table-section">
                        <div class="table-toolbar">
                            <div class="toolbar-left">
                                <h5 class="mb-0">Nilai Terbaru</h5>
                            </div>

                            <div class="toolbar-right">
                                <small class="text-muted">Menampilkan maksimal 5 nilai terakhir</small>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Pertemuan</th>
                                        <th>Nilai</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($nilaiTerbaru)): ?>
                                        <?php foreach ($nilaiTerbaru as $i => $row): ?>
                                            <?php
                                            $idMapel = $row['id_mapel'] ?? null;
                                            $namaMapel = $mapelById[$idMapel]['nama_mapel'] ?? '-';
                                            $nilai = (int)($row['nilai'] ?? 0);
                                            $status = $nilai >= 75 ? 'Tuntas' : 'Belum Tuntas';
                                            $class = $nilai >= 75 ? 'aktif' : 'nonaktif';
                                            ?>

                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= esc($namaMapel) ?></td>
                                                <td>Pertemuan <?= esc($row['pertemuan'] ?? '-') ?></td>
                                                <td><strong><?= $nilai ?></strong></td>
                                                <td>
                                                    <span class="status <?= $class ?>">
                                                        <?= esc($status) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">
                                                <div class="empty-state">
                                                    <i class="fa-solid fa-clipboard-check"></i>
                                                    <p>Belum ada nilai yang masuk.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-4 g-4">

                <div class="col-lg-6">
                    <div class="table-section">
                        <h5 class="mb-3">Rekap Mata Pelajaran</h5>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        <th>Rata-rata</th>
                                        <th>Nilai Terakhir</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($rekapMapel)): ?>
                                        <?php $rekapNo = 1; ?>
                                        <?php foreach ($rekapMapel as $rekap): ?>
                                            <?php
                                            $rataMapel = $rekap['jumlah'] > 0 ? round($rekap['total'] / $rekap['jumlah']) : 0;
                                            ?>

                                            <tr>
                                                <td><?= $rekapNo++ ?></td>
                                                <td><?= esc($rekap['nama_mapel']) ?></td>
                                                <td><strong><?= $rataMapel ?></strong></td>
                                                <td>
                                                    <?= $rekap['terakhir'] ?>
                                                    <small class="text-muted">
                                                        Pertemuan <?= esc($rekap['pertemuan_terakhir']) ?>
                                                    </small>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4">
                                                <div class="empty-state">
                                                    <i class="fa-solid fa-book-open"></i>
                                                    <p>Belum ada rekap mata pelajaran.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="table-section murid-note-card">
                        <h5 class="mb-3">Catatan Belajar</h5>

                        <div class="murid-note-list">
                            <div class="murid-note-item">
                                <i class="fa-solid fa-circle-check"></i>
                                <div>
                                    <strong>Rata-rata saat ini</strong>
                                    <p><?= $rataRata ?> dari 100. Gunakan data ini untuk melihat perkembangan belajar.</p>
                                </div>
                            </div>

                            <div class="murid-note-item">
                                <i class="fa-solid fa-book"></i>
                                <div>
                                    <strong>Mata pelajaran aktif</strong>
                                    <p><?= $totalMapel ?> mata pelajaran sudah memiliki data nilai.</p>
                                </div>
                            </div>

                            <div class="murid-note-item">
                                <i class="fa-solid fa-chart-simple"></i>
                                <div>
                                    <strong>Evaluasi mandiri</strong>
                                    <p>Perhatikan mata pelajaran dengan nilai di bawah 75 agar bisa diperbaiki pada tugas berikutnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php if (!empty($grafikMapel)): ?>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <div class="row mt-4 g-4">
                    <?php $chartNo = 1; ?>
                    <?php foreach ($grafikMapel as $grafik): ?>

                        <div class="col-md-6">
                            <div class="table-section">
                                <h5 class="mb-3">Grafik Nilai <?= esc($grafik['nama_mapel']) ?></h5>
                                <canvas id="chartMurid<?= $chartNo ?>"></canvas>
                            </div>
                        </div>

                        <script>
                            new Chart(document.getElementById('chartMurid<?= $chartNo ?>'), {
                                type: 'line',
                                data: {
                                    labels: <?= json_encode($grafik['labels']) ?>,
                                    datasets: [{
                                        label: 'Nilai',
                                        data: <?= json_encode($grafik['nilai']) ?>,
                                        borderWidth: 3,
                                        tension: 0.4,
                                        fill: false
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            max: 100
                                        }
                                    }
                                }
                            });
                        </script>

                        <?php $chartNo++; ?>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>

        <style>
            .murid-hero {
                background: #ffffff;
                border: 1px solid #e5e7eb;
                border-radius: 20px;
                padding: 24px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            }

            .murid-label {
                display: inline-block;
                background: #eff6ff;
                color: #2563eb;
                border-radius: 999px;
                padding: 6px 12px;
                font-size: 13px;
                font-weight: 600;
                margin-bottom: 10px;
            }

            .murid-hero h4 {
                margin: 0 0 6px;
                color: #0f172a;
                font-weight: 700;
            }

            .murid-hero p {
                margin: 0;
                color: #64748b;
                font-size: 14px;
            }

            .murid-status-box {
                min-width: 180px;
                border-radius: 16px;
                padding: 16px;
                text-align: center;
            }

            .murid-status-box.status-good {
                background: #f0fdf4;
                border: 1px solid #bbf7d0;
            }

            .murid-status-box.status-warning {
                background: #fff7ed;
                border: 1px solid #fed7aa;
            }

            .murid-status-box span {
                display: block;
                color: #475569;
                font-size: 13px;
                margin-bottom: 6px;
            }

            .murid-status-box strong.aktif {
                color: #16a34a;
            }

            .murid-status-box strong.nonaktif {
                color: #dc2626;
            }

            .murid-profile-card,
            .murid-note-card {
                height: 100%;
            }

            .murid-avatar {
                width: 74px;
                height: 74px;
                border-radius: 50%;
                background: #eff6ff;
                color: #2563eb;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
                margin: 16px auto 22px;
            }

            .murid-info-row {
                display: flex;
                justify-content: space-between;
                gap: 14px;
                padding: 12px 0;
                border-bottom: 1px solid #f1f5f9;
            }

            .murid-info-row span {
                color: #64748b;
                font-size: 14px;
            }

            .murid-info-row strong {
                color: #0f172a;
                font-size: 14px;
                text-align: right;
            }

            .murid-note-list {
                display: flex;
                flex-direction: column;
                gap: 14px;
            }

            .murid-note-item {
                display: flex;
                align-items: flex-start;
                gap: 12px;
                background: #f8fafc;
                border: 1px solid #e5e7eb;
                border-radius: 14px;
                padding: 14px;
            }

            .murid-note-item i {
                color: #2563eb;
                font-size: 18px;
                margin-top: 3px;
            }

            .murid-note-item strong {
                display: block;
                color: #0f172a;
                margin-bottom: 4px;
            }

            .murid-note-item p {
                margin: 0;
                color: #64748b;
                font-size: 13px;
            }

            @media (max-width: 768px) {
                .murid-hero {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .murid-status-box {
                    width: 100%;
                }
            }
        </style>

    <?php endif; ?>

</div>