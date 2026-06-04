<div class="main-content">
    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <!-- =========================
            STEP 1: PILIH KELAS
        ========================== -->
        <div id="nilai-kelas-container">

            <div class="table-toolbar">

                <div class="toolbar-left">
                    <small class="text-muted">
                        Pilih kelas untuk melihat mata pelajaran dan nilai penugasan siswa
                    </small>
                </div>

                <div class="toolbar-right">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari kelas..."
                        onkeyup="searchKelasNilai(this)"
                        style="max-width: 220px;">
                </div>

            </div>

            <div class="table-responsive mt-4">

                <table class="table table-hover" id="table-kelas-nilai">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr class="kelas-row" data-kelas="7A">
                            <td>1</td>
                            <td><strong>7A</strong></td>
                            <td>Bu Ivana Mayada</td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="showMapelNilai('7A', 'Bu Ivana Mayada')">
                                    <i class="fa-solid fa-book"></i>
                                    Pilih Mata Pelajaran
                                </button>
                            </td>
                        </tr>

                        <tr class="kelas-row" data-kelas="7B">
                            <td>2</td>
                            <td><strong>7B</strong></td>
                            <td>Pak Ahmad Fauzi</td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="showMapelNilai('7B', 'Pak Ahmad Fauzi')">
                                    <i class="fa-solid fa-book"></i>
                                    Pilih Mata Pelajaran
                                </button>
                            </td>
                        </tr>

                        <tr class="kelas-row" data-kelas="8A">
                            <td>3</td>
                            <td><strong>8A</strong></td>
                            <td>Bu Siti Aisyah</td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="showMapelNilai('8A', 'Bu Siti Aisyah')">
                                    <i class="fa-solid fa-book"></i>
                                    Pilih Mata Pelajaran
                                </button>
                            </td>
                        </tr>

                        <tr class="kelas-row" data-kelas="8B">
                            <td>4</td>
                            <td><strong>8B</strong></td>
                            <td>Pak Rahmat Hidayat</td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="showMapelNilai('8B', 'Pak Rahmat Hidayat')">
                                    <i class="fa-solid fa-book"></i>
                                    Pilih Mata Pelajaran
                                </button>
                            </td>
                        </tr>

                        <tr class="kelas-row" data-kelas="9A">
                            <td>5</td>
                            <td><strong>9A</strong></td>
                            <td>Bu Dina Permata</td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="showMapelNilai('9A', 'Bu Dina Permata')">
                                    <i class="fa-solid fa-book"></i>
                                    Pilih Mata Pelajaran
                                </button>
                            </td>
                        </tr>

                        <tr class="kelas-row" data-kelas="9B">
                            <td>6</td>
                            <td><strong>9B</strong></td>
                            <td>Pak Budi Santoso</td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="showMapelNilai('9B', 'Pak Budi Santoso')">
                                    <i class="fa-solid fa-book"></i>
                                    Pilih Mata Pelajaran
                                </button>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- =========================
            STEP 2: PILIH MAPEL
        ========================== -->
        <div id="nilai-mapel-container" style="display:none;">

            <div class="table-toolbar">

                <div class="toolbar-left">
                    <small class="text-muted" id="nilai-mapel-info">
                        Pilih mata pelajaran untuk melihat pertemuan penugasan
                    </small>
                </div>

                <div class="toolbar-right">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari mata pelajaran..."
                        onkeyup="searchMapelNilai(this)"
                        style="max-width: 220px;">

                    <button class="btn btn-secondary" type="button" onclick="backToKelasNilai()">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </button>
                </div>

            </div>

            <div class="table-responsive mt-4">

                <table class="table table-hover" id="table-mapel-nilai">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru Pengajar</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr class="mapel-row" data-mapel="Matematika">
                            <td>1</td>
                            <td><strong>Matematika</strong></td>
                            <td>Pak Andi Saputra</td>
                            <td>
                                <span class="text-muted">Lihat nilai berdasarkan pertemuan penugasan</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="togglePertemuanNilai('pertemuan-matematika')">
                                    <i class="fa-solid fa-list"></i>
                                    Lihat Pertemuan
                                </button>
                            </td>
                        </tr>

                        <tr id="pertemuan-matematika" class="pertemuan-row" style="display:none;">
                            <td colspan="5">
                                <div class="pertemuan-list">
                                    <button type="button" onclick="showNilaiSiswa('Matematika', '1')">Pertemuan 1</button>
                                    <button type="button" onclick="showNilaiSiswa('Matematika', '2')">Pertemuan 2</button>
                                    <button type="button" onclick="showNilaiSiswa('Matematika', '3')">Pertemuan 3</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="mapel-row" data-mapel="Bahasa Indonesia">
                            <td>2</td>
                            <td><strong>Bahasa Indonesia</strong></td>
                            <td>Bu Rina Lestari</td>
                            <td>
                                <span class="text-muted">Lihat nilai berdasarkan pertemuan penugasan</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="togglePertemuanNilai('pertemuan-bindo')">
                                    <i class="fa-solid fa-list"></i>
                                    Lihat Pertemuan
                                </button>
                            </td>
                        </tr>

                        <tr id="pertemuan-bindo" class="pertemuan-row" style="display:none;">
                            <td colspan="5">
                                <div class="pertemuan-list">
                                    <button type="button" onclick="showNilaiSiswa('Bahasa Indonesia', '1')">Pertemuan 1</button>
                                    <button type="button" onclick="showNilaiSiswa('Bahasa Indonesia', '2')">Pertemuan 2</button>
                                    <button type="button" onclick="showNilaiSiswa('Bahasa Indonesia', '3')">Pertemuan 3</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="mapel-row" data-mapel="Bahasa Inggris">
                            <td>3</td>
                            <td><strong>Bahasa Inggris</strong></td>
                            <td>Bu Maya Salsabila</td>
                            <td>
                                <span class="text-muted">Lihat nilai berdasarkan pertemuan penugasan</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="togglePertemuanNilai('pertemuan-binggris')">
                                    <i class="fa-solid fa-list"></i>
                                    Lihat Pertemuan
                                </button>
                            </td>
                        </tr>

                        <tr id="pertemuan-binggris" class="pertemuan-row" style="display:none;">
                            <td colspan="5">
                                <div class="pertemuan-list">
                                    <button type="button" onclick="showNilaiSiswa('Bahasa Inggris', '1')">Pertemuan 1</button>
                                    <button type="button" onclick="showNilaiSiswa('Bahasa Inggris', '2')">Pertemuan 2</button>
                                    <button type="button" onclick="showNilaiSiswa('Bahasa Inggris', '3')">Pertemuan 3</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="mapel-row" data-mapel="IPA">
                            <td>4</td>
                            <td><strong>IPA</strong></td>
                            <td>Pak Dimas Pratama</td>
                            <td>
                                <span class="text-muted">Lihat nilai berdasarkan pertemuan penugasan</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" type="button" onclick="togglePertemuanNilai('pertemuan-ipa')">
                                    <i class="fa-solid fa-list"></i>
                                    Lihat Pertemuan
                                </button>
                            </td>
                        </tr>

                        <tr id="pertemuan-ipa" class="pertemuan-row" style="display:none;">
                            <td colspan="5">
                                <div class="pertemuan-list">
                                    <button type="button" onclick="showNilaiSiswa('IPA', '1')">Pertemuan 1</button>
                                    <button type="button" onclick="showNilaiSiswa('IPA', '2')">Pertemuan 2</button>
                                    <button type="button" onclick="showNilaiSiswa('IPA', '3')">Pertemuan 3</button>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>


        <!-- =========================
            STEP 3: DATA NILAI SISWA
        ========================== -->
        <div id="nilai-detail-container" style="display:none;">

            <div class="table-toolbar">

                <div class="toolbar-left">
                    <small class="text-muted" id="nilai-detail-info">
                        Data nilai siswa berdasarkan kelas, mata pelajaran, dan pertemuan
                    </small>
                </div>

                <div class="toolbar-right">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari siswa..."
                        onkeyup="searchTable(this, 'table-nilai')"
                        style="max-width: 220px;">

                    <button class="btn btn-secondary" type="button" onclick="backToMapelNilai()">
                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali
                    </button>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr class="nilai-row" data-kelas="7A" data-mapel="Matematika" data-pertemuan="1">
                            <td>1</td>
                            <td>Budi Santoso</td>
                            <td>7A</td>
                            <td>Matematika</td>
                            <td>Pertemuan 1</td>
                            <td>
                                <span class="status aktif">Tuntas</span>
                            </td>
                            <td>90</td>
                            <td>
                                <div class="action-table">
                                    <button class="btn btn-sm btn-primary" title="Detail Nilai">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning" title="Edit Nilai">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger" title="Hapus Nilai" onclick="confirmDelete('nilai')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="nilai-row" data-kelas="7A" data-mapel="Matematika" data-pertemuan="1">
                            <td>2</td>
                            <td>Dina Permata</td>
                            <td>7A</td>
                            <td>Matematika</td>
                            <td>Pertemuan 1</td>
                            <td>
                                <span class="status aktif">Tuntas</span>
                            </td>
                            <td>86</td>
                            <td>
                                <div class="action-table">
                                    <button class="btn btn-sm btn-primary" title="Detail Nilai">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning" title="Edit Nilai">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger" title="Hapus Nilai" onclick="confirmDelete('nilai')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="nilai-row" data-kelas="7A" data-mapel="Bahasa Indonesia" data-pertemuan="2">
                            <td>3</td>
                            <td>Rizky Ramadhan</td>
                            <td>7A</td>
                            <td>Bahasa Indonesia</td>
                            <td>Pertemuan 2</td>
                            <td>
                                <span class="status nonaktif">Belum Tuntas</span>
                            </td>
                            <td>72</td>
                            <td>
                                <div class="action-table">
                                    <button class="btn btn-sm btn-primary" title="Detail Nilai">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning" title="Edit Nilai">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger" title="Hapus Nilai" onclick="confirmDelete('nilai')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="nilai-row" data-kelas="8A" data-mapel="Bahasa Inggris" data-pertemuan="1">
                            <td>4</td>
                            <td>Siti Aisyah</td>
                            <td>8A</td>
                            <td>Bahasa Inggris</td>
                            <td>Pertemuan 1</td>
                            <td>
                                <span class="status aktif">Tuntas</span>
                            </td>
                            <td>88</td>
                            <td>
                                <div class="action-table">
                                    <button class="btn btn-sm btn-primary" title="Detail Nilai">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning" title="Edit Nilai">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger" title="Hapus Nilai" onclick="confirmDelete('nilai')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="nilai-row" data-kelas="9A" data-mapel="IPA" data-pertemuan="3">
                            <td>5</td>
                            <td>Rahmat</td>
                            <td>9A</td>
                            <td>IPA</td>
                            <td>Pertemuan 3</td>
                            <td>
                                <span class="status nonaktif">Belum Tuntas</span>
                            </td>
                            <td>70</td>
                            <td>
                                <div class="action-table">
                                    <button class="btn btn-sm btn-primary" title="Detail Nilai">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <button class="btn btn-sm btn-warning" title="Edit Nilai">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger" title="Hapus Nilai" onclick="confirmDelete('nilai')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>

                <div class="empty-state" id="nilai-empty-state" style="display:none;">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <p>Belum ada data nilai untuk pilihan ini.</p>
                </div>

            </div>

        </div>

    </div>
</div>


<script>
    let selectedKelasNilai = '';
    let selectedWaliKelas = '';

    function showMapelNilai(kelas, waliKelas) {

        selectedKelasNilai = kelas;
        selectedWaliKelas = waliKelas;

        document.getElementById('nilai-kelas-container').style.display = 'none';
        document.getElementById('nilai-mapel-container').style.display = 'block';
        document.getElementById('nilai-detail-container').style.display = 'none';

        document.getElementById('nilai-mapel-info').innerText =
            'Kelas ' + kelas + ' | Wali kelas: ' + waliKelas + '. Pilih mata pelajaran untuk melihat pertemuan penugasan.';

        const pertemuanRows = document.querySelectorAll('.pertemuan-row');

        pertemuanRows.forEach(row => {
            row.style.display = 'none';
        });
    }

    function togglePertemuanNilai(rowId) {

        const pertemuanRows = document.querySelectorAll('.pertemuan-row');

        pertemuanRows.forEach(row => {

            if (row.id === rowId) {
                row.style.display =
                    row.style.display === 'none' ? 'table-row' : 'none';
            } else {
                row.style.display = 'none';
            }

        });
    }

    function showNilaiSiswa(mapel, pertemuan) {

        const rows = document.querySelectorAll('.nilai-row');
        const emptyState = document.getElementById('nilai-empty-state');

        let totalData = 0;
        let nomor = 1;

        document.getElementById('nilai-kelas-container').style.display = 'none';
        document.getElementById('nilai-mapel-container').style.display = 'none';
        document.getElementById('nilai-detail-container').style.display = 'block';

        document.getElementById('nilai-detail-info').innerText =
            'Menampilkan nilai kelas ' + selectedKelasNilai + ', ' + mapel + ', pertemuan ke-' + pertemuan;

        rows.forEach(row => {

            const rowKelas = row.dataset.kelas;
            const rowMapel = row.dataset.mapel;
            const rowPertemuan = row.dataset.pertemuan;

            if (
                rowKelas === selectedKelasNilai &&
                rowMapel === mapel &&
                rowPertemuan === pertemuan
            ) {
                row.style.display = '';

                const numberCell = row.querySelector('td');

                if (numberCell) {
                    numberCell.innerText = nomor++;
                }

                totalData++;
            } else {
                row.style.display = 'none';
            }

        });

        if (totalData === 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }

    function backToKelasNilai() {

        selectedKelasNilai = '';
        selectedWaliKelas = '';

        document.getElementById('nilai-kelas-container').style.display = 'block';
        document.getElementById('nilai-mapel-container').style.display = 'none';
        document.getElementById('nilai-detail-container').style.display = 'none';

        const pertemuanRows = document.querySelectorAll('.pertemuan-row');

        pertemuanRows.forEach(row => {
            row.style.display = 'none';
        });
    }

    function backToMapelNilai() {

        document.getElementById('nilai-kelas-container').style.display = 'none';
        document.getElementById('nilai-mapel-container').style.display = 'block';
        document.getElementById('nilai-detail-container').style.display = 'none';
    }

    function searchKelasNilai(input) {

        const keyword = input.value.toLowerCase();
        const rows = document.querySelectorAll('.kelas-row');

        rows.forEach(row => {

            const kelas = row.dataset.kelas.toLowerCase();
            const waliKelas = row.children[2].innerText.toLowerCase();

            if (
                kelas.includes(keyword) ||
                waliKelas.includes(keyword)
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }

        });
    }

    function searchMapelNilai(input) {

        const keyword = input.value.toLowerCase();
        const rows = document.querySelectorAll('.mapel-row');

        rows.forEach(row => {

            const mapel = row.dataset.mapel.toLowerCase();
            const guru = row.children[2].innerText.toLowerCase();
            const nextPertemuanRow = row.nextElementSibling;

            if (
                mapel.includes(keyword) ||
                guru.includes(keyword)
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';

                if (
                    nextPertemuanRow &&
                    nextPertemuanRow.classList.contains('pertemuan-row')
                ) {
                    nextPertemuanRow.style.display = 'none';
                }
            }

        });
    }
</script>