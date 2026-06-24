<div class="main-content">

    <div class="table-section">

        <?php
        $role = session('role');
        $isAdminGuru = ($role === 'admin' || $role === 'guru');
        $isMurid = ($role === 'murid');
        $isWali = ($role === 'wali');
        $showAksiNilai = ($isAdminGuru || $isMurid);

        $mapelList = isset($mapel) && is_array($mapel) ? $mapel : [];
        $tugasList = isset($tugasUji) && is_array($tugasUji) ? $tugasUji : [];
        $nilaiList = isset($jawabanSiswa) && is_array($jawabanSiswa) ? $jawabanSiswa : [];

        $mapelById = [];
        foreach ($mapelList as $m) {
            if (isset($m['id_mapel'])) {
                $mapelById[$m['id_mapel']] = $m;
            }
        }

        $pertemuanByMapel = [];
        foreach ($tugasList as $t) {
            if (!empty($t['id_mapel']) && isset($t['pertemuan'])) {
                $pertemuanByMapel[$t['id_mapel']][$t['pertemuan']] = $t['pertemuan'];
            }
        }

        foreach ($nilaiList as $n) {
            if (!empty($n['id_mapel']) && isset($n['pertemuan'])) {
                $pertemuanByMapel[$n['id_mapel']][$n['pertemuan']] = $n['pertemuan'];
            }
        }

        foreach ($pertemuanByMapel as $idMapel => $pertemuan) {
            ksort($pertemuanByMapel[$idMapel]);
        }

        $kelasList = [];
        foreach ($mapelList as $m) {
            $kelasKey = $m['kelas'] ?? '-';
            $kelasList[$kelasKey][] = $m;
        }

        $idMapelNilaiPribadi = [];
        foreach ($nilaiList as $n) {
            if (!empty($n['id_mapel'])) {
                $idMapelNilaiPribadi[$n['id_mapel']] = true;
            }
        }

        $mapelPribadi = [];
        if ($isMurid || $isWali) {
            foreach ($mapelList as $m) {
                if (!empty($m['id_mapel']) && isset($idMapelNilaiPribadi[$m['id_mapel']])) {
                    $mapelPribadi[] = $m;
                }
            }
        }

        $namaPenggunaNilai = session()->get('nama') ?? '-';
        $kelasPenggunaNilai = session()->get('kelas') ?? '-';
        $nisPenggunaNilai = session()->get('nis') ?? '-';

        if (!empty($nilaiList)) {
            $firstNilai = $nilaiList[0];
            $namaPenggunaNilai = $firstNilai['nama_siswa'] ?? $firstNilai['nama'] ?? $namaPenggunaNilai;
            $kelasPenggunaNilai = $firstNilai['kelas'] ?? $kelasPenggunaNilai;
            $nisPenggunaNilai = $firstNilai['nis'] ?? $nisPenggunaNilai;

            if (($kelasPenggunaNilai === '-' || $kelasPenggunaNilai === '') && !empty($firstNilai['id_mapel']) && isset($mapelById[$firstNilai['id_mapel']])) {
                $kelasPenggunaNilai = $mapelById[$firstNilai['id_mapel']]['kelas'] ?? '-';
            }
        }

        $totalPertemuanTersedia = 0;
        foreach ($pertemuanByMapel as $pertemuan) {
            $totalPertemuanTersedia += count($pertemuan);
        }

        $judulHalaman = 'Data Nilai Penugasan';
        $deskripsiHalaman = 'Pilih kelas, mata pelajaran, lalu pertemuan untuk melihat nilai penugasan siswa.';

        if ($isMurid) {
            $judulHalaman = 'Data Nilai Saya';
            $deskripsiHalaman = 'Pilih mata pelajaran dan pertemuan untuk melihat hasil penugasan yang sudah dinilai.';
        }

        if ($isWali) {
            $judulHalaman = 'Data Nilai Anak';
            $deskripsiHalaman = 'Pilih mata pelajaran dan pertemuan untuk memantau hasil belajar anak.';
        }
        ?>

        <div id="halaman-pilih-nilai">

            <div class="nilai-hero">
                <div>
                    <span class="nilai-hero-label">
                        <?= $isAdminGuru ? 'Monitoring Nilai' : ($isWali ? 'Pemantauan Wali Murid' : 'Rekap Nilai Siswa') ?>
                    </span>
                    <h5><?= esc($judulHalaman) ?></h5>
                    <p><?= esc($deskripsiHalaman) ?></p>
                </div>

                <div class="nilai-hero-icon">
                    <i class="fa-solid fa-clipboard-check"></i>
                </div>
            </div>

            <div class="nilai-summary-box mt-4 mb-4">
                <?php if ($isAdminGuru): ?>
                    <div>
                        <span>Total Kelas</span>
                        <strong><?= count($kelasList) ?></strong>
                    </div>

                    <div>
                        <span>Total Mapel</span>
                        <strong><?= count($mapelList) ?></strong>
                    </div>

                    <div>
                        <span>Total Pertemuan</span>
                        <strong><?= $totalPertemuanTersedia ?></strong>
                    </div>

                    <div>
                        <span>Total Nilai</span>
                        <strong><?= count($nilaiList) ?> Data</strong>
                    </div>
                <?php else: ?>
                    <div>
                        <span><?= $isWali ? 'Nama Anak' : 'Nama Siswa' ?></span>
                        <strong><?= esc($namaPenggunaNilai) ?></strong>
                    </div>

                    <div>
                        <span>NIS</span>
                        <strong><?= esc($nisPenggunaNilai) ?></strong>
                    </div>

                    <div>
                        <span>Kelas</span>
                        <strong><?= esc($kelasPenggunaNilai) ?></strong>
                    </div>

                    <div>
                        <span>Total Nilai</span>
                        <strong><?= count($nilaiList) ?> Data</strong>
                    </div>
                <?php endif; ?>
            </div>

            <div class="table-toolbar nilai-toolbar-clean">
                <div class="toolbar-left">
                    <small class="text-muted">
                        Klik baris untuk membuka daftar mata pelajaran atau pertemuan yang tersedia.
                    </small>
                </div>
            </div>

            <?php if ($isAdminGuru): ?>

                <div class="table-responsive mt-4">
                    <table class="table table-hover" id="table-kelas-nilai">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                                <th>Jumlah Mapel</th>
                                <th>Jumlah Pertemuan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($kelasList)): ?>
                                <?php $noKelas = 1; ?>

                                <?php foreach ($kelasList as $kelas => $daftarMapel): ?>
                                    <?php
                                    $rowKelasId = 'nilai-mapel-kelas-' . md5((string)$kelas);
                                    $jumlahPertemuanKelas = 0;

                                    foreach ($daftarMapel as $m) {
                                        $jumlahPertemuanKelas += count($pertemuanByMapel[$m['id_mapel']] ?? []);
                                    }
                                    ?>

                                    <tr
                                        class="nilai-kelas-row cursor-pointer"
                                        onclick="toggleMapelNilai(this, '<?= $rowKelasId ?>')">

                                        <td><?= $noKelas++ ?></td>

                                        <td>
                                            <div class="nilai-row-title">
                                                <span class="nilai-badge">Kelas</span>
                                                <strong><?= esc($kelas) ?></strong>
                                                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                            </div>
                                        </td>

                                        <td><?= count($daftarMapel) ?> Mapel</td>

                                        <td><?= $jumlahPertemuanKelas ?> Pertemuan</td>

                                        <td>
                                            <span class="text-muted">
                                                Klik baris ini untuk melihat mata pelajaran kelas <?= esc($kelas) ?>
                                            </span>
                                        </td>

                                    </tr>

                                    <tr
                                        id="<?= $rowKelasId ?>"
                                        class="nilai-mapel-dropdown-row is-hidden"
                                        >

                                        <td colspan="5">

                                            <div class="nilai-inner-box">
                                                <div class="nilai-inner-head">
                                                    <div>
                                                        <strong>Daftar Mata Pelajaran Kelas <?= esc($kelas) ?></strong>
                                                        <small>Pilih mata pelajaran untuk membuka daftar pertemuan.</small>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Mata Pelajaran</th>
                                                                <th>Guru Pengajar</th>
                                                                <th>Jumlah Pertemuan</th>
                                                                <th>Keterangan</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php foreach ($daftarMapel as $index => $m): ?>
                                                                <?php
                                                                $idMapel = $m['id_mapel'];
                                                                $rowPertemuanId = 'nilai-pertemuan-' . $idMapel;
                                                                $jumlahPertemuan = count($pertemuanByMapel[$idMapel] ?? []);
                                                                ?>

                                                                <tr
                                                                    class="nilai-mapel-row cursor-pointer"
                                                                    onclick="togglePertemuanNilai(this, '<?= $rowPertemuanId ?>')">

                                                                    <td><?= $index + 1 ?></td>

                                                                    <td>
                                                                        <div class="nilai-mapel-title">
                                                                            <span class="nilai-mapel-dot"></span>
                                                                            <strong><?= esc($m['nama_mapel']) ?></strong>
                                                                            <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                                        </div>
                                                                    </td>

                                                                    <td><?= esc($m['created_by'] ?? '-') ?></td>

                                                                    <td>
                                                                        <span class="nilai-total-badge">
                                                                            <?= $jumlahPertemuan ?> Pertemuan
                                                                        </span>
                                                                    </td>

                                                                    <td>
                                                                        <span class="text-muted">Klik untuk melihat pertemuan</span>
                                                                    </td>

                                                                </tr>

                                                                <tr
                                                                    id="<?= $rowPertemuanId ?>"
                                                                    class="nilai-pertemuan-dropdown-row is-hidden"
                                                                    >

                                                                    <td colspan="5">
                                                                        <div class="nilai-pertemuan-box">
                                                                            <div class="nilai-pertemuan-title">
                                                                                <strong><?= esc($m['nama_mapel']) ?></strong>
                                                                                <span>Kelas <?= esc($kelas) ?></span>
                                                                            </div>

                                                                            <div class="nilai-pertemuan-list">
                                                                                <?php if (!empty($pertemuanByMapel[$idMapel])): ?>
                                                                                    <?php foreach ($pertemuanByMapel[$idMapel] as $pertemuan): ?>
                                                                                        <button
                                                                                            type="button"
                                                                                            onclick="bukaDetailNilai(
                                                                                                event,
                                                                                                '<?= esc($kelas) ?>',
                                                                                                '<?= esc($m['nama_mapel']) ?>',
                                                                                                '<?= esc($idMapel) ?>',
                                                                                                '<?= esc($pertemuan) ?>',
                                                                                                '<?= esc($m['created_by'] ?? '-') ?>'
                                                                                            )">
                                                                                            Pertemuan <?= esc($pertemuan) ?>
                                                                                        </button>
                                                                                    <?php endforeach; ?>
                                                                                <?php else: ?>
                                                                                    <span class="text-muted">Belum ada pertemuan untuk mata pelajaran ini.</span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                </tr>

                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-clipboard-check"></i>
                                            <p>Belum ada data nilai.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>

            <?php else: ?>

                <div class="table-responsive mt-4">
                    <table class="table table-hover" id="table-mapel-pribadi">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Guru Pengajar</th>
                                <th>Jumlah Pertemuan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($mapelPribadi)): ?>
                                <?php foreach ($mapelPribadi as $index => $m): ?>
                                    <?php
                                    $idMapel = $m['id_mapel'];
                                    $rowPertemuanId = 'nilai-pribadi-pertemuan-' . $idMapel;
                                    $jumlahPertemuan = count($pertemuanByMapel[$idMapel] ?? []);
                                    ?>

                                    <tr
                                        class="nilai-mapel-pribadi-row cursor-pointer"
                                        onclick="togglePertemuanPribadi(this, '<?= $rowPertemuanId ?>')">

                                        <td><?= $index + 1 ?></td>

                                        <td>
                                            <div class="nilai-mapel-title">
                                                <span class="nilai-mapel-dot"></span>
                                                <strong><?= esc($m['nama_mapel']) ?></strong>
                                                <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                            </div>
                                        </td>

                                        <td><?= esc($m['kelas'] ?? $kelasPenggunaNilai) ?></td>

                                        <td><?= esc($m['created_by'] ?? '-') ?></td>

                                        <td>
                                            <span class="nilai-total-badge">
                                                <?= $jumlahPertemuan ?> Pertemuan
                                            </span>
                                        </td>

                                        <td>
                                            <span class="text-muted">Klik untuk melihat pertemuan</span>
                                        </td>

                                    </tr>

                                    <tr
                                        id="<?= $rowPertemuanId ?>"
                                        class="nilai-pertemuan-pribadi-row is-hidden"
                                        >

                                        <td colspan="6">
                                            <div class="nilai-pertemuan-box">
                                                <div class="nilai-pertemuan-title">
                                                    <strong><?= esc($m['nama_mapel']) ?></strong>
                                                    <span><?= $isWali ? 'Nilai anak' : 'Nilai siswa' ?></span>
                                                </div>

                                                <div class="nilai-pertemuan-list">
                                                    <?php if (!empty($pertemuanByMapel[$idMapel])): ?>
                                                        <?php foreach ($pertemuanByMapel[$idMapel] as $pertemuan): ?>
                                                            <button
                                                                type="button"
                                                                onclick="bukaDetailNilai(
                                                                    event,
                                                                    '<?= esc($m['kelas'] ?? $kelasPenggunaNilai) ?>',
                                                                    '<?= esc($m['nama_mapel']) ?>',
                                                                    '<?= esc($idMapel) ?>',
                                                                    '<?= esc($pertemuan) ?>',
                                                                    '<?= esc($m['created_by'] ?? '-') ?>'
                                                                )">
                                                                Pertemuan <?= esc($pertemuan) ?>
                                                            </button>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <span class="text-muted">Belum ada pertemuan untuk mata pelajaran ini.</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-book-open"></i>
                                            <p>Belum ada data nilai yang dapat ditampilkan.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            <?php endif; ?>

        </div>

        <div id="halaman-detail-nilai" class="is-hidden">

            <div class="table-toolbar">
                <div class="toolbar-left">
                    <button class="btn btn-secondary" type="button" onclick="kembaliKeMenuNilai()">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </button>

                    <small class="text-muted ms-2" id="detail-info-nilai">
                        Data nilai siswa
                    </small>
                </div>
            </div>

            <div class="nilai-summary-box mt-4">
                <div>
                    <span>Kelas</span>
                    <strong id="info-kelas">-</strong>
                </div>

                <div>
                    <span>Mata Pelajaran</span>
                    <strong id="info-mapel">-</strong>
                </div>

                <div>
                    <span>Pertemuan</span>
                    <strong id="info-pertemuan">-</strong>
                </div>

                <div>
                    <span>Jumlah Data</span>
                    <strong id="info-jumlah">0 Data</strong>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-hover <?= $showAksiNilai ? 'has-sticky-action' : '' ?>" id="table-nilai">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th><?= $isWali ? 'Nama Anak' : 'Nama Siswa' ?></th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Pertemuan</th>
                            <th>Status</th>
                            <th>Nilai</th>
                            <?php if ($showAksiNilai): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody id="nilai-result-body"></tbody>
                </table>

                <div class="empty-state is-hidden" id="nilai-empty-state" >
                    <i class="fa-solid fa-clipboard-check"></i>
                    <p>Belum ada data nilai untuk pilihan ini.</p>
                </div>
            </div>
        </div>

    </div>

</div>
<script>
    const dataNilai = <?= json_encode($nilaiList ?? []) ?>;
    const isAdminGuruNilai = <?= $isAdminGuru ? 'true' : 'false' ?>;
    const isMuridNilai = <?= $isMurid ? 'true' : 'false' ?>;

    function setChevronDownNilai(icon) {
        if (icon) {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }

    function setChevronUpNilai(icon) {
        if (icon) {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
    }

    function toggleMapelNilai(kelasRow, rowId) {
        const selectedDropdown = document.getElementById(rowId);
        const isOpen = selectedDropdown && selectedDropdown.style.display === 'table-row';

        document.querySelectorAll('.nilai-mapel-dropdown-row').forEach(row => {
            row.style.display = 'none';
        });

        document.querySelectorAll('.nilai-pertemuan-dropdown-row').forEach(row => {
            row.style.display = 'none';
        });

        document.querySelectorAll('.nilai-kelas-row').forEach(row => {
            setChevronDownNilai(row.querySelector('.dropdown-icon'));
        });

        document.querySelectorAll('.nilai-mapel-row').forEach(row => {
            setChevronDownNilai(row.querySelector('.dropdown-icon'));
        });

        if (!isOpen && selectedDropdown) {
            selectedDropdown.style.display = 'table-row';
            setChevronUpNilai(kelasRow.querySelector('.dropdown-icon'));
        }
    }

    function togglePertemuanNilai(mapelRow, rowId) {
        const selectedDropdown = document.getElementById(rowId);
        const parentDropdown = mapelRow.closest('.nilai-mapel-dropdown-row');
        const isOpen = selectedDropdown && selectedDropdown.style.display === 'table-row';

        if (parentDropdown) {
            parentDropdown.querySelectorAll('.nilai-pertemuan-dropdown-row').forEach(row => {
                row.style.display = 'none';
            });

            parentDropdown.querySelectorAll('.nilai-mapel-row').forEach(row => {
                setChevronDownNilai(row.querySelector('.dropdown-icon'));
            });
        }

        if (!isOpen && selectedDropdown) {
            selectedDropdown.style.display = 'table-row';
            setChevronUpNilai(mapelRow.querySelector('.dropdown-icon'));
        }
    }

    function togglePertemuanPribadi(mapelRow, rowId) {
        const selectedDropdown = document.getElementById(rowId);
        const isOpen = selectedDropdown && selectedDropdown.style.display === 'table-row';

        document.querySelectorAll('.nilai-pertemuan-pribadi-row').forEach(row => {
            row.style.display = 'none';
        });

        document.querySelectorAll('.nilai-mapel-pribadi-row').forEach(row => {
            setChevronDownNilai(row.querySelector('.dropdown-icon'));
        });

        if (!isOpen && selectedDropdown) {
            selectedDropdown.style.display = 'table-row';
            setChevronUpNilai(mapelRow.querySelector('.dropdown-icon'));
        }
    }

    function bukaDetailNilai(event, kelas, mapel, idMapel, pertemuan, guru) {
        event.stopPropagation();

        const filteredData = dataNilai.filter(item => {
            return String(item.id_mapel) === String(idMapel) &&
                String(item.pertemuan) === String(pertemuan);
        });

        document.getElementById('halaman-pilih-nilai').style.display = 'none';
        document.getElementById('halaman-detail-nilai').style.display = 'block';

        document.getElementById('detail-info-nilai').innerText =
            `Menampilkan ${mapel}, pertemuan ke-${pertemuan}`;

        document.getElementById('info-kelas').innerText = kelas;
        document.getElementById('info-mapel').innerText = mapel;
        document.getElementById('info-pertemuan').innerText = 'Pertemuan ' + pertemuan;
        document.getElementById('info-jumlah').innerText = filteredData.length + ' Data';

        renderNilaiTable(filteredData, kelas, mapel, pertemuan);

        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function kembaliKeMenuNilai() {
        document.getElementById('halaman-detail-nilai').style.display = 'none';
        document.getElementById('halaman-pilih-nilai').style.display = 'block';
        document.getElementById('nilai-result-body').innerHTML = '';
        document.getElementById('nilai-empty-state').style.display = 'none';
    }

    function renderNilaiTable(data, kelas, mapel, pertemuan) {
        const tbody = document.getElementById('nilai-result-body');
        const emptyState = document.getElementById('nilai-empty-state');

        tbody.innerHTML = '';

        if (data.length === 0) {
            emptyState.style.display = 'block';
            return;
        }

        emptyState.style.display = 'none';

        data.forEach((item, index) => {
            const nilai = Number(item.nilai ?? 0);
            const status = nilai >= 75 ? 'Cukup' : 'Perlu Ditingkatkan';
            const statusClass = nilai >= 75 ? 'aktif' : 'nonaktif';
            const nama = item.nama_siswa ?? item.nama ?? '-';
            const kelasSiswa = item.kelas ?? kelas;

            let aksi = '';

            if (isAdminGuruNilai || isMuridNilai) {
                const aksiLabel = isAdminGuruNilai ? 'Koreksi' : 'Lihat';
                const aksiIcon = isAdminGuruNilai ? 'fa-pen-to-square' : 'fa-eye';

                aksi = `
                    <td class="action-sticky-cell">
                        <a href="<?= base_url('readNilai') ?>/${item.id_user}/${item.id_mapel}/${item.pertemuan}"
                            class="nilai-action-btn">
                            <i class="fa-solid ${aksiIcon}"></i>
                            <span>${aksiLabel}</span>
                        </a>
                    </td>
                `;
            }

            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${nama}</td>
                    <td>${kelasSiswa}</td>
                    <td>${mapel}</td>
                    <td>Pertemuan ${pertemuan}</td>
                    <td>
                        <span class="status ${statusClass}">
                            ${status}
                        </span>
                    </td>
                    <td><strong>${nilai}</strong></td>
                    ${aksi}
                </tr>
            `;
        });
    }
</script>
