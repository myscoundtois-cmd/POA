<!-- Main Content -->
<div class="main-content">

    <!-- Navbar -->

    <!-- Cards -->
    <?php if (session('role') === 'admin'): ?>
        <div class="row mt-4 g-4">

            <div class="col-md-3">
                <div class="dashboard-card bg1">
                    <div class="card-wave"></div>

                    <h5>Total Siswa</h5>
                    <h2><?= $total_siswa ?> </h2>

                    <i class="fa-solid fa-user-graduate"></i>

                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg2">
                    <div class="card-wave"></div>

                    <h5>Total Guru</h5>
                    <h2><?= $total_guru ?></h2>

                    <i class="fa-solid fa-chalkboard-user"></i>

                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg3">
                    <div class="card-wave"></div>
                    <h5>Total Kelas</h5>
                    <h2><?= $total_kelas ?></h2>

                    <i class="fa-solid fa-school"></i>

                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg4">
                    <div class="card-wave"></div>

                    <h5>Total Mapel</h5>
                    <h2><?= $total_mapel ?></h2>

                    <i class="fa-solid fa-book-open"></i>

                </div>
            </div>

        </div>
    <?php elseif (session('role') == 'guru'): ?>
        <div class="row mt-4 g-4">

            <div class="col-md-3">
                <div class="dashboard-card bg1">
                    <div class="card-wave"></div>

                    <h5>Kelas Yang diajar</h5>
                    <h2><?= !empty($total_kelas_guru) ?> </h2>

                    <i class="fa-solid fa-user-graduate"></i>

                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg2">
                    <div class="card-wave"></div>

                    <h5>Mapel Yang diajar</h5>
                    <h2><?= !empty($mapel_guru) ?></h2>

                    <i class="fa-solid fa-chalkboard-user"></i>

                </div>
            </div>

            <div class="col-md-3">
                <div class="dashboard-card bg3">
                    <div class="card-wave"></div>
                    <h5>Wali Murid Kelas</h5>
                    <h2>
                        <?php if (!empty($wali_kelas)): ?>
                            <?php foreach ($wali_kelas as $row): ?>
                                <?= esc($row['kelas']) ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </h2>

                    <i class="fa-solid fa-school"></i>

                </div>
            </div>

        </div>
    <?php elseif (session('role') == 'wali' || session('role') == 'murid'): ?>

        <div class="table-section">
            <div class="table-toolbar">
                <?php if (!empty($wali)): ?>
                    <?php foreach ($wali as $w): ?>
                        <tr>
                            <td><strong>Nama <span>:</span></strong><?= $w['nama']; ?></td>
                            <td><strong>NIS <span>:</span></strong><?= $w['nis']; ?></td>
                            <td><strong>Kelas <span>:</span></strong><?= $w['kelas']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
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

                $grafikMapel[$idMapel]['labels'][] =
                    'Pertemuan ' . $j['pertemuan'];

                $grafikMapel[$idMapel]['nilai'][] =
                    (int) $j['nilai'];
            }
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="row mt-4 g-4">

            <?php $no = 1; ?>

            <?php foreach ($grafikMapel as $idMapel => $grafik): ?>

                <div class="col-md-6">

                    <div class="dashboard-card bg5">

                        <div class="card-wave"></div>

                        <h5 class="mb-3" style="color:black;">
                            <?= esc($grafik['nama_mapel']) ?>
                        </h5>

                        <canvas id="chart<?= $no ?>"></canvas>

                    </div>

                </div>

                <script>
                    new Chart(
                        document.getElementById('chart<?= $no ?>'), {
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
                        }
                    );
                </script>

                <?php $no++; ?>

            <?php endforeach; ?>

        </div>
    <?php elseif (session('role') == 'wali' || session('role') == 'murid' || session('role') ?? ''): ?>
        <div class="table-section">
            <div class="table-toolbar">
                <?php if (!empty($wali)): ?>
                    <?php foreach ($wali as $w): ?>
                        <tr>
                            <td><strong>Nama <span>:</span></strong><?= $w['nama']; ?></td>
                            <td><strong>NIS <span>:</span></strong><?= $w['nis']; ?></td>
                            <td><strong>Kelas <span>:</span></strong><?= $w['kelas']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
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


                $grafikMapel[$idMapel]['labels'][] =
                    'Pertemuan ' . $j['pertemuan'];

                $grafikMapel[$idMapel]['nilai'][] =
                    (int) $j['nilai'];
            }
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="row mt-4 g-4">

            <?php $no = 1; ?>

            <?php foreach ($grafikMapel as $idMapel => $grafik): ?>

                <div class="col-md-6">

                    <div class="dashboard-card bg5">

                        <div class="card-wave"></div>

                        <h5 class="mb-3" style="color:black;">
                            <?= esc($grafik['nama_mapel']) ?>
                        </h5>

                        <canvas id="chart<?= $no ?>"></canvas>

                    </div>

                </div>

                <script>
                    new Chart(
                        document.getElementById('chart<?= $no ?>'), {
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
                        }
                    );
                </script>

                <?php $no++; ?>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>
</div>