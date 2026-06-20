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

    <?php elseif (session('role') === 'guru'): ?>

        <div class="row mt-4 g-4">
            <div class="col-md-3">
                <div class="dashboard-card bg1">
                    <div class="card-wave"></div>
                    <h5>Kelas yang Diajar</h5>
                    <h2><?= $total_kelas_guru ?? 0 ?></h2>
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg2">
                    <div class="card-wave"></div>
                    <h5>Mapel yang Diajar</h5>
                    <h2><?= $mapel_guru ?? 0 ?></h2>
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg3">
                    <div class="card-wave"></div>
                    <h5>Wali Kelas</h5>
                    <h2>
                        <?php if (!empty($wali_kelas)): ?>
                            <?php foreach ($wali_kelas as $row): ?>
                                <?= esc($row['kelas']) ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </h2>
                    <i class="fa-solid fa-school"></i>
                </div>
            </div>
        </div>

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

                <div class="wali-status">
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
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                padding: 16px;
                text-align: center;
            }

            .wali-status span {
                display: block;
                color: #64748b;
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
        $grafikMapel = [];

        if (!empty($jawabanSiswa)) {
            foreach ($jawabanSiswa as $j) {
                $idMapel = $j['id_mapel'];

                if (!isset($grafikMapel[$idMapel])) {
                    $grafikMapel[$idMapel] = [
                        'nama_mapel' => '',
                        'labels' => [],
                        'nilai' => []
                    ];

                    if (!empty($mapel)) {
                        foreach ($mapel as $m) {
                            if ($m['id_mapel'] == $idMapel) {
                                $grafikMapel[$idMapel]['nama_mapel'] = $m['nama_mapel'];
                                break;
                            }
                        }
                    }
                }

                $grafikMapel[$idMapel]['labels'][] = 'Pertemuan ' . $j['pertemuan'];
                $grafikMapel[$idMapel]['nilai'][] = (int)$j['nilai'];
            }
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="row mt-4 g-4">
            <?php if (!empty($grafikMapel)): ?>
                <?php $no = 1; ?>

                <?php foreach ($grafikMapel as $grafik): ?>
                    <div class="col-md-6">
                        <div class="dashboard-card bg5">
                            <div class="card-wave"></div>
                            <h5 class="mb-3" style="color:black;"><?= esc($grafik['nama_mapel']) ?></h5>
                            <canvas id="chart<?= $no ?>"></canvas>
                        </div>
                    </div>

                    <script>
                        new Chart(document.getElementById('chart<?= $no ?>'), {
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

                    <?php $no++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="table-section">
                        <div class="empty-state">
                            <i class="fa-solid fa-clipboard-check"></i>
                            <p>Belum ada data nilai.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    <?php endif; ?>

</div>
