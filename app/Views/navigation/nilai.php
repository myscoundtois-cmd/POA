<div class="main-content">


    <div class="table-section">

        <!-- HALAMAN PILIH NILAI -->
        <div id="halaman-pilih-nilai">

            <div class="table-toolbar">
                <?php if (session('role') == 'admin' || session('role') == 'guru'): ?>
                    <div class="toolbar-left">
                        <small class="text-muted">
                            Pilih kelas, mata pelajaran, dan pertemuan untuk melihat nilai penugasan siswa
                        </small>
                    </div>
                <?php endif; ?>

                <div class="toolbar-right">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari kelas atau mapel..."
                        onkeyup="searchNilaiMenu(this)"
                        style="max-width: 240px;">
                </div>
                <div class="toolbar-right">
                    <button class="btn btn-secondary" type="button" onclick="resetNilaiView()">
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </button>
                </div>
            </div>

            <?php if (session('role') == 'admin' || session('role') == 'guru'): ?>
                <div class="table-responsive mt-4">
                    <table class="table table-hover" id="table-kelas-nilai">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $kelasList = [];

                            if (!empty($mapel)) {
                                foreach ($mapel as $m) {
                                    $kelasList[$m['kelas']][] = $m;
                                }
                            }

                            $noKelas = 1;
                            ?>

                            <?php foreach ($kelasList as $kelas => $daftarMapel): ?>

                                <tr
                                    class="kelas-nilai-row"
                                    onclick="toggleMapelKelasNilai(this,'mapel-kelas-<?= $kelas ?>')">

                                    <td><?= $noKelas++ ?></td>

                                    <td>
                                        <div class="kelas-title">
                                            <span class="kelas-badge">Kelas</span>
                                            <strong><?= esc($kelas) ?></strong>
                                            <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                        </div>
                                    </td>

                                </tr>

                                <tr
                                    id="mapel-kelas-<?= $kelas ?>"
                                    class="mapel-dropdown-row"
                                    style="display:none;">

                                    <td colspan="5">

                                        <div class="mapel-box">

                                            <table class="table table-hover mb-0">

                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Mata Pelajaran</th>
                                                        <th>Guru Pengajar</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    <?php foreach ($daftarMapel as $index => $m): ?>

                                                        <tr
                                                            class="mapel-nilai-row"
                                                            onclick="togglePertemuanNilai(this,'pertemuan-<?= $m['id_mapel'] ?>')">

                                                            <td><?= $index + 1 ?></td>

                                                            <td>
                                                                <div class="mapel-title">
                                                                    <span class="mapel-dot"></span>
                                                                    <strong><?= esc($m['nama_mapel']) ?></strong>
                                                                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <?= esc($m['created_by'] ?? '-') ?>
                                                            </td>

                                                            <td>
                                                                <span class="text-muted">
                                                                    Klik untuk melihat pertemuan
                                                                </span>
                                                            </td>

                                                        </tr>

                                                        <tr
                                                            id="pertemuan-<?= $m['id_mapel'] ?>"
                                                            class="pertemuan-dropdown-row"
                                                            style="display:none;">

                                                            <td colspan="4">

                                                                <div class="pertemuan-list">

                                                                    <?php
                                                                    $adaPertemuan = false;

                                                                    if (!empty($tugasUji)) :

                                                                        foreach ($tugasUji as $p) :

                                                                            if (
                                                                                $p['id_mapel'] == $m['id_mapel']
                                                                            ) :

                                                                                $adaPertemuan = true;
                                                                    ?>

                                                                                <button
                                                                                    type="button"
                                                                                    onclick="bukaHalamanDetailNilai(
    event,
    '<?= esc($kelas) ?>',
    '<?= esc($m['nama_mapel']) ?>',
    '<?= esc($m['id_mapel']) ?>',
    '<?= esc($p['pertemuan']) ?>',
    '<?= esc($m['created_by']) ?>'
)">

                                                                                    Pertemuan <?= esc($p['pertemuan']) ?>

                                                                                </button>

                                                                        <?php
                                                                            endif;

                                                                        endforeach;

                                                                    endif;

                                                                    if (!$adaPertemuan):
                                                                        ?>

                                                                        <span class="text-muted">
                                                                            Belum ada pertemuan
                                                                        </span>

                                                                    <?php endif; ?>

                                                                </div>

                                                            </td>

                                                        </tr>

                                                    <?php endforeach; ?>

                                                </tbody>

                                            </table>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            <?php elseif (session('role') == 'wali' || session('role') == 'murid'): ?>
                <div class="table-responsive mt-4">
                    <table class="table table-hover">
                        <?php if (!empty($lihat_nilai)): ?>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pertemuan</th>
                                    <th>Nama</th>
                                    <th>NIS</th>
                                    <th>Kelas</th>
                                    <th>Mapel</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($lihat_nilai as $w): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>Pertemuan ke-<?= $w['pertemuan'] ?></td>
                                        <td><?= $w['nama'] ?></td>
                                        <td><?= $w['nis'] ?></td>
                                        <td><?= $w['kelas'] ?></td>
                                        <td><?= $w['nama_mapel'] ?? '-' ?></td>
                                        <td><?= $w['nilai'] ?? '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            <?php endif; ?>
        </div>


        <!-- HALAMAN DETAIL NILAI -->
        <div id="halaman-detail-nilai" style="display:none;">

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

                <div class="toolbar-right">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari pada hasil..."
                        onkeyup="searchTable(this, 'table-nilai')"
                        style="max-width: 240px;">
                </div>
            </div>

            <div class="nilai-info-box mt-4">
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
                    <strong id="info-jumlah">0 Siswa</strong>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-hover" id="table-nilai">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Mata Pelajaran</th>
                            <th>Pertemuan</th>
                            <th>Status</th>
                            <th>Nilai</th>
                            <?php if (session('role') == 'admin' || session('role') == 'guru'): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody id="nilai-result-body"></tbody>
                </table>

                <div class="empty-state" id="nilai-empty-state" style="display:none;">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <p>Belum ada data nilai untuk pilihan ini.</p>
                </div>
            </div>
        </div>

    </div>

</div>


<style>
    .kelas-nilai-row {
        cursor: pointer;
        background: #ffffff;
    }

    .kelas-nilai-row:hover {
        background: #f8fafc;
    }

    .kelas-title {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .kelas-title strong {
        font-size: 16px;
        color: #0f172a;
    }

    .kelas-badge {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        border-radius: 999px;
        padding: 3px 9px;
        font-size: 12px;
        font-weight: 600;
    }

    .kelas-title .dropdown-icon {
        margin-left: auto;
    }

    .mapel-dropdown-row>td {
        background: #f8fafc;
        padding: 14px;
    }

    .mapel-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #2563eb;
        border-radius: 10px;
        padding: 12px;
    }

    .mapel-nilai-row {
        cursor: pointer;
        background: #ffffff;
    }

    .mapel-nilai-row:hover {
        background: #f1f5f9;
    }

    .mapel-title {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .mapel-title strong {
        color: #1e293b;
        font-size: 14px;
    }

    .mapel-title .dropdown-icon {
        margin-left: auto;
        color: #64748b;
    }

    .mapel-dot {
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #2563eb;
        display: inline-block;
    }

    .pertemuan-dropdown-row>td {
        background: #f8fafc;
        padding: 12px 16px;
    }

    .pertemuan-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        padding-left: 20px;
    }

    .pertemuan-list button {
        border: 1px solid #dbeafe;
        background: #eef4ff;
        color: #2563eb;
        padding: 7px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
    }

    .pertemuan-list button:hover {
        background: #2563eb;
        color: #ffffff;
    }

    .nilai-info-box {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .nilai-info-box div {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 14px;
    }

    .nilai-info-box span {
        display: block;
        font-size: 13px;
        color: #64748b;
        margin-bottom: 4px;
    }

    .nilai-info-box strong {
        font-size: 15px;
        color: #0f172a;
    }

    .dropdown-icon {
        font-size: 13px;
        color: #64748b;
        transition: 0.2s;
    }

    @media (max-width: 768px) {
        .nilai-info-box {
            grid-template-columns: 1fr;
        }

        .pertemuan-list {
            padding-left: 0;
        }
    }
</style>


<script>
    let selectedFilterNilai = null;

    let dataNilai = <?= json_encode($jawabanSiswa ?? []) ?>;

    function setChevronDown(icon) {
        if (icon) {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }

    function setChevronUp(icon) {
        if (icon) {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
    }

    function toggleMapelKelasNilai(kelasRow, rowId) {
        const selectedDropdown = document.getElementById(rowId);
        const isOpen = selectedDropdown.style.display === 'table-row';

        const mapelDropdownRows = document.querySelectorAll('.mapel-dropdown-row');
        const kelasRows = document.querySelectorAll('.kelas-nilai-row');
        const pertemuanRows = document.querySelectorAll('.pertemuan-dropdown-row');
        const mapelRows = document.querySelectorAll('.mapel-nilai-row');

        mapelDropdownRows.forEach(row => {
            row.style.display = 'none';
        });

        pertemuanRows.forEach(row => {
            row.style.display = 'none';
        });

        kelasRows.forEach(row => {
            setChevronDown(row.querySelector('.dropdown-icon'));
        });

        mapelRows.forEach(row => {
            setChevronDown(row.querySelector('.dropdown-icon'));
        });

        if (!isOpen) {
            selectedDropdown.style.display = 'table-row';
            setChevronUp(kelasRow.querySelector('.dropdown-icon'));
        }
    }

    function togglePertemuanNilai(mapelRow, rowId) {
        const selectedDropdown = document.getElementById(rowId);
        const parentMapelDropdown = mapelRow.closest('.mapel-dropdown-row');
        const isOpen = selectedDropdown.style.display === 'table-row';

        if (parentMapelDropdown) {
            const pertemuanRows = parentMapelDropdown.querySelectorAll('.pertemuan-dropdown-row');
            const mapelRows = parentMapelDropdown.querySelectorAll('.mapel-nilai-row');

            pertemuanRows.forEach(row => {
                row.style.display = 'none';
            });

            mapelRows.forEach(row => {
                setChevronDown(row.querySelector('.dropdown-icon'));
            });
        }

        if (!isOpen) {
            selectedDropdown.style.display = 'table-row';
            setChevronUp(mapelRow.querySelector('.dropdown-icon'));
        }
    }

    function bukaHalamanDetailNilai(
        event,
        kelas,
        mapel,
        id_mapel,
        pertemuan,
        created_by
    ) {
        event.stopPropagation();

        selectedFilterNilai = {
            kelas,
            mapel,
            id_mapel,
            pertemuan,
            created_by
        };

        const filteredData = dataNilai.filter(item => {

            return String(item.id_mapel) === String(id_mapel) &&
                String(item.pertemuan) === String(pertemuan);

        });

        document.getElementById('halaman-pilih-nilai').style.display = 'none';
        document.getElementById('halaman-detail-nilai').style.display = 'block';

        document.getElementById('detail-info-nilai').innerText =
            `Menampilkan nilai kelas ${kelas}, ${mapel}, pertemuan ke-${pertemuan}`;

        document.getElementById('info-kelas').innerText = kelas;
        document.getElementById('info-mapel').innerText = mapel;
        document.getElementById('info-pertemuan').innerText = 'Pertemuan ' + pertemuan;
        document.getElementById('info-jumlah').innerText = filteredData.length + ' Siswa';

        renderNilaiTable(filteredData);

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

    function renderNilaiTable(data) {

        const tbody = document.getElementById('nilai-result-body');
        const emptyState = document.getElementById('nilai-empty-state');

        tbody.innerHTML = '';

        if (data.length === 0) {
            emptyState.style.display = 'block';
            return;
        }

        emptyState.style.display = 'none';

        data.forEach((item, index) => {

            const status = Number(item.nilai) >= 75 ?
                'cukup' :
                'tidak cukup';

            const statusClass = Number(item.nilai) >= 75 ?
                'aktif' :
                'nonaktif';

            tbody.innerHTML += `
        <tr>
            <td>${index + 1}</td>

            <td>${item.nama_siswa ?? '-'}</td>

            <td>${document.getElementById('info-kelas').innerText}</td>

            <td>${document.getElementById('info-mapel').innerText}</td>

            <td>Pertemuan ${item.pertemuan}</td>

            <td>
                <span class="status ${statusClass}">
                    ${status}
                </span>
            </td>

            <td>${item.nilai ?? 0}</td>
            <?php if (session('role') == 'admin' || session('role') == 'guru'): ?>
           <td>
                <a href="<?= base_url('readNilai') ?>/${item.id_user}/${item.id_mapel}/${item.pertemuan}"
                class="btn btn-sm btn-primary">

                <i class="fa-solid fa-eye"></i>
                </a>
            </td>
            <?php endif; ?>
        </tr>
        `;
        });
    }

    function searchNilaiMenu(input) {
        const keyword = input.value.toLowerCase().trim();

        if (keyword === '') {
            resetNilaiView();
            return;
        }

        const kelasRows = document.querySelectorAll('.kelas-nilai-row');
        const mapelDropdownRows = document.querySelectorAll('.mapel-dropdown-row');
        const pertemuanRows = document.querySelectorAll('.pertemuan-dropdown-row');
        const mapelRows = document.querySelectorAll('.mapel-nilai-row');

        kelasRows.forEach(row => {
            const kelas = row.dataset.kelas;
            let showKelas = kelas.includes(keyword);

            const dropdown = row.nextElementSibling;
            const daftarMapel = dropdown.querySelectorAll('.mapel-nilai-row');

            daftarMapel.forEach(mapelRow => {
                const mapel = mapelRow.dataset.mapel.toLowerCase();
                const cocok = mapel.includes(keyword) || kelas.includes(keyword);

                mapelRow.style.display = cocok ? '' : 'none';

                if (cocok) {
                    showKelas = true;
                }
            });

            row.style.display = showKelas ? '' : 'none';
            dropdown.style.display = showKelas ? 'table-row' : 'none';

            if (showKelas) {
                setChevronUp(row.querySelector('.dropdown-icon'));
            } else {
                setChevronDown(row.querySelector('.dropdown-icon'));
            }
        });

        mapelDropdownRows.forEach(row => {
            const visibleMapel = row.querySelectorAll('.mapel-nilai-row:not([style*="display: none"])');

            if (visibleMapel.length === 0) {
                row.style.display = 'none';
            }
        });

        pertemuanRows.forEach(row => {
            row.style.display = 'none';
        });

        mapelRows.forEach(row => {
            setChevronDown(row.querySelector('.dropdown-icon'));
        });
    }

    function resetNilaiView() {
        selectedFilterNilai = null;

        const kelasRows = document.querySelectorAll('.kelas-nilai-row');
        const mapelRows = document.querySelectorAll('.mapel-nilai-row');
        const mapelDropdownRows = document.querySelectorAll('.mapel-dropdown-row');
        const pertemuanRows = document.querySelectorAll('.pertemuan-dropdown-row');

        kelasRows.forEach(row => {
            row.style.display = '';
            setChevronDown(row.querySelector('.dropdown-icon'));
        });

        mapelRows.forEach(row => {
            row.style.display = '';
            setChevronDown(row.querySelector('.dropdown-icon'));
        });

        mapelDropdownRows.forEach(row => {
            row.style.display = 'none';
        });

        pertemuanRows.forEach(row => {
            row.style.display = 'none';
        });

        document.getElementById('halaman-detail-nilai').style.display = 'none';
        document.getElementById('halaman-pilih-nilai').style.display = 'block';

        document.getElementById('nilai-result-body').innerHTML = '';
        document.getElementById('nilai-empty-state').style.display = 'none';
    }

    function searchTable(input, tableId) {
        const keyword = input.value.toLowerCase().trim();
        const table = document.getElementById(tableId);
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    }
</script>