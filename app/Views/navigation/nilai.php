<div class="main-content">
    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <!-- HALAMAN PILIH NILAI -->
        <div id="halaman-pilih-nilai">

            <div class="table-toolbar">
                <div class="toolbar-left">
                    <small class="text-muted">
                        Pilih kelas, mata pelajaran, dan pertemuan untuk melihat nilai penugasan siswa
                    </small>
                </div>

                <div class="toolbar-right">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari kelas atau mapel..."
                        onkeyup="searchNilaiMenu(this)"
                        style="max-width: 240px;">

                    <button class="btn btn-secondary" type="button" onclick="resetNilaiView()">
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </button>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-hover" id="table-kelas-nilai">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Wali Kelas</th>
                            <th>Jumlah Mapel</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>

                    <tbody>

                        <!-- KELAS 7 -->
                        <tr
                            class="kelas-nilai-row"
                            data-kelas="7"
                            onclick="toggleMapelKelasNilai(this, 'mapel-kelas-7')">
                            <td>1</td>
                            <td>
                                <div class="kelas-title">
                                    <span class="kelas-badge">Kelas</span>
                                    <strong>7</strong>
                                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                </div>
                            </td>
                            <td>Bu Ivana Mayada</td>
                            <td>4 Mapel</td>
                            <td>
                                <span class="text-muted">Klik baris ini untuk melihat mata pelajaran kelas 7</span>
                            </td>
                        </tr>

                        <tr id="mapel-kelas-7" class="mapel-dropdown-row" style="display:none;">
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
                                            <tr class="mapel-nilai-row" data-kelas="7" data-mapel="Matematika" onclick="togglePertemuanNilai(this, 'pertemuan-7-matematika')">
                                                <td>1</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Matematika</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Pak Andi Saputra</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-7-matematika" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Matematika', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Matematika', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Matematika', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="7" data-mapel="Bahasa Indonesia" onclick="togglePertemuanNilai(this, 'pertemuan-7-bindo')">
                                                <td>2</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Bahasa Indonesia</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Bu Rina Lestari</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-7-bindo" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Bahasa Indonesia', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Bahasa Indonesia', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Bahasa Indonesia', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="7" data-mapel="Bahasa Inggris" onclick="togglePertemuanNilai(this, 'pertemuan-7-binggris')">
                                                <td>3</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Bahasa Inggris</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Bu Maya Salsabila</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-7-binggris" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Bahasa Inggris', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Bahasa Inggris', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'Bahasa Inggris', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="7" data-mapel="IPA" onclick="togglePertemuanNilai(this, 'pertemuan-7-ipa')">
                                                <td>4</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>IPA</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Pak Dimas Pratama</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-7-ipa" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'IPA', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'IPA', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '7', 'IPA', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>


                        <!-- KELAS 8 -->
                        <tr
                            class="kelas-nilai-row"
                            data-kelas="8"
                            onclick="toggleMapelKelasNilai(this, 'mapel-kelas-8')">
                            <td>2</td>
                            <td>
                                <div class="kelas-title">
                                    <span class="kelas-badge">Kelas</span>
                                    <strong>8</strong>
                                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                </div>
                            </td>
                            <td>Pak Ahmad Fauzi</td>
                            <td>4 Mapel</td>
                            <td>
                                <span class="text-muted">Klik baris ini untuk melihat mata pelajaran kelas 8</span>
                            </td>
                        </tr>

                        <tr id="mapel-kelas-8" class="mapel-dropdown-row" style="display:none;">
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
                                            <tr class="mapel-nilai-row" data-kelas="8" data-mapel="Matematika" onclick="togglePertemuanNilai(this, 'pertemuan-8-matematika')">
                                                <td>1</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Matematika</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Pak Andi Saputra</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-8-matematika" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Matematika', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Matematika', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Matematika', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="8" data-mapel="Bahasa Indonesia" onclick="togglePertemuanNilai(this, 'pertemuan-8-bindo')">
                                                <td>2</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Bahasa Indonesia</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Bu Rina Lestari</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-8-bindo" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Bahasa Indonesia', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Bahasa Indonesia', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Bahasa Indonesia', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="8" data-mapel="Bahasa Inggris" onclick="togglePertemuanNilai(this, 'pertemuan-8-binggris')">
                                                <td>3</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Bahasa Inggris</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Bu Maya Salsabila</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-8-binggris" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Bahasa Inggris', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Bahasa Inggris', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'Bahasa Inggris', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="8" data-mapel="IPA" onclick="togglePertemuanNilai(this, 'pertemuan-8-ipa')">
                                                <td>4</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>IPA</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Pak Dimas Pratama</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-8-ipa" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'IPA', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'IPA', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '8', 'IPA', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>


                        <!-- KELAS 9 -->
                        <tr
                            class="kelas-nilai-row"
                            data-kelas="9"
                            onclick="toggleMapelKelasNilai(this, 'mapel-kelas-9')">
                            <td>3</td>
                            <td>
                                <div class="kelas-title">
                                    <span class="kelas-badge">Kelas</span>
                                    <strong>9</strong>
                                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                </div>
                            </td>
                            <td>Bu Siti Aisyah</td>
                            <td>4 Mapel</td>
                            <td>
                                <span class="text-muted">Klik baris ini untuk melihat mata pelajaran kelas 9</span>
                            </td>
                        </tr>

                        <tr id="mapel-kelas-9" class="mapel-dropdown-row" style="display:none;">
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
                                            <tr class="mapel-nilai-row" data-kelas="9" data-mapel="Matematika" onclick="togglePertemuanNilai(this, 'pertemuan-9-matematika')">
                                                <td>1</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Matematika</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Pak Andi Saputra</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-9-matematika" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Matematika', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Matematika', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Matematika', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="9" data-mapel="Bahasa Indonesia" onclick="togglePertemuanNilai(this, 'pertemuan-9-bindo')">
                                                <td>2</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Bahasa Indonesia</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Bu Rina Lestari</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-9-bindo" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Bahasa Indonesia', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Bahasa Indonesia', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Bahasa Indonesia', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="9" data-mapel="Bahasa Inggris" onclick="togglePertemuanNilai(this, 'pertemuan-9-binggris')">
                                                <td>3</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>Bahasa Inggris</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Bu Maya Salsabila</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-9-binggris" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Bahasa Inggris', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Bahasa Inggris', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'Bahasa Inggris', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr class="mapel-nilai-row" data-kelas="9" data-mapel="IPA" onclick="togglePertemuanNilai(this, 'pertemuan-9-ipa')">
                                                <td>4</td>
                                                <td>
                                                    <div class="mapel-title">
                                                        <span class="mapel-dot"></span>
                                                        <strong>IPA</strong>
                                                        <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                                    </div>
                                                </td>
                                                <td>Pak Dimas Pratama</td>
                                                <td><span class="text-muted">Klik untuk melihat pertemuan</span></td>
                                            </tr>

                                            <tr id="pertemuan-9-ipa" class="pertemuan-dropdown-row" style="display:none;">
                                                <td colspan="4">
                                                    <div class="pertemuan-list">
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'IPA', '1')">Pertemuan 1</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'IPA', '2')">Pertemuan 2</button>
                                                        <button type="button" onclick="bukaHalamanDetailNilai(event, '9', 'IPA', '3')">Pertemuan 3</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
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
                            <th>Aksi</th>
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


    <!-- MODAL DETAIL NILAI -->
    <div class="modal fade" id="modalDetailNilai" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Detail Nilai Siswa</h5>
                        <small class="text-muted">Informasi lengkap nilai penugasan siswa</small>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="profile-row">
                        <span class="label">Nama</span>
                        <span class="separator">:</span>
                        <span class="value" id="detailNamaNilai"></span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Kelas</span>
                        <span class="separator">:</span>
                        <span class="value" id="detailKelasNilai"></span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Mata Pelajaran</span>
                        <span class="separator">:</span>
                        <span class="value" id="detailMapelNilai"></span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Pertemuan</span>
                        <span class="separator">:</span>
                        <span class="value" id="detailPertemuanNilai"></span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Status</span>
                        <span class="separator">:</span>
                        <span class="value" id="detailStatusNilai"></span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Nilai</span>
                        <span class="separator">:</span>
                        <span class="value" id="detailAngkaNilai"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>


    <!-- MODAL EDIT NILAI -->
    <div class="modal fade" id="modalEditNilai" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Edit Nilai Siswa</h5>
                        <small class="text-muted">Ubah nilai dan status penugasan siswa</small>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formEditNilai">
                        <input type="hidden" id="editIndexNilai">

                        <div class="profile-row">
                            <span class="label">Nama</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="text" id="editNamaNilai" class="form-control">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Kelas</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select id="editKelasNilai" class="form-control">
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Mata Pelajaran</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select id="editMapelNilai" class="form-control">
                                    <option value="Matematika">Matematika</option>
                                    <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                    <option value="Bahasa Inggris">Bahasa Inggris</option>
                                    <option value="IPA">IPA</option>
                                </select>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Pertemuan</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select id="editPertemuanNilai" class="form-control">
                                    <option value="1">Pertemuan 1</option>
                                    <option value="2">Pertemuan 2</option>
                                    <option value="3">Pertemuan 3</option>
                                </select>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Status</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select id="editStatusNilai" class="form-control">
                                    <option value="Tuntas">Tuntas</option>
                                    <option value="Belum Tuntas">Belum Tuntas</option>
                                </select>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Nilai</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="number" id="editAngkaNilai" class="form-control" min="0" max="100">
                            </span>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" class="btn btn-primary" onclick="submitEditNilaiFrontend()">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
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

    .mapel-dropdown-row > td {
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

    .pertemuan-dropdown-row > td {
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

    let dataNilai = [
        {
            nama: 'Budi Santoso',
            kelas: '7',
            mapel: 'Matematika',
            pertemuan: '1',
            status: 'Tuntas',
            nilai: 90
        },
        {
            nama: 'Dina Permata',
            kelas: '7',
            mapel: 'Matematika',
            pertemuan: '1',
            status: 'Tuntas',
            nilai: 86
        },
        {
            nama: 'Rizky Ramadhan',
            kelas: '7',
            mapel: 'Bahasa Indonesia',
            pertemuan: '2',
            status: 'Belum Tuntas',
            nilai: 72
        },
        {
            nama: 'Siti Aisyah',
            kelas: '8',
            mapel: 'Bahasa Inggris',
            pertemuan: '1',
            status: 'Tuntas',
            nilai: 88
        },
        {
            nama: 'Ahmad Fauzi',
            kelas: '8',
            mapel: 'Matematika',
            pertemuan: '2',
            status: 'Tuntas',
            nilai: 82
        },
        {
            nama: 'Maya Salsabila',
            kelas: '8',
            mapel: 'IPA',
            pertemuan: '3',
            status: 'Belum Tuntas',
            nilai: 74
        },
        {
            nama: 'Rahmat Hidayat',
            kelas: '9',
            mapel: 'IPA',
            pertemuan: '3',
            status: 'Belum Tuntas',
            nilai: 70
        },
        {
            nama: 'Putri Lestari',
            kelas: '9',
            mapel: 'Bahasa Indonesia',
            pertemuan: '2',
            status: 'Tuntas',
            nilai: 91
        },
        {
            nama: 'Andi Saputra',
            kelas: '9',
            mapel: 'Matematika',
            pertemuan: '1',
            status: 'Tuntas',
            nilai: 89
        }
    ];

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

    function bukaHalamanDetailNilai(event, kelas, mapel, pertemuan) {
        event.stopPropagation();

        selectedFilterNilai = {
            kelas: kelas,
            mapel: mapel,
            pertemuan: pertemuan
        };

        const filteredData = dataNilai.filter(item => {
            return item.kelas === kelas &&
                item.mapel === mapel &&
                item.pertemuan === pertemuan;
        });

        document.getElementById('halaman-pilih-nilai').style.display = 'none';
        document.getElementById('halaman-detail-nilai').style.display = 'block';

        document.getElementById('detail-info-nilai').innerText =
            'Menampilkan nilai kelas ' + kelas + ', ' + mapel + ', pertemuan ke-' + pertemuan;

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
            const realIndex = dataNilai.indexOf(item);
            const statusClass = item.status === 'Tuntas' ? 'aktif' : 'nonaktif';

            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.nama}</td>
                    <td>${item.kelas}</td>
                    <td>${item.mapel}</td>
                    <td>Pertemuan ${item.pertemuan}</td>
                    <td>
                        <span class="status ${statusClass}">${item.status}</span>
                    </td>
                    <td>${item.nilai}</td>
                    <td>
                        <div class="action-table">
                            <button class="btn btn-sm btn-primary" title="Detail Nilai" onclick="openDetailNilai(${realIndex})">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <button class="btn btn-sm btn-warning" title="Edit Nilai" onclick="openEditNilaiModal(${realIndex})">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class="btn btn-sm btn-danger" title="Hapus Nilai" onclick="hapusNilaiDummy(${realIndex})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
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

    function openDetailNilai(index) {
        const item = dataNilai[index];

        document.getElementById('detailNamaNilai').innerText = item.nama;
        document.getElementById('detailKelasNilai').innerText = item.kelas;
        document.getElementById('detailMapelNilai').innerText = item.mapel;
        document.getElementById('detailPertemuanNilai').innerText = 'Pertemuan ' + item.pertemuan;
        document.getElementById('detailStatusNilai').innerText = item.status;
        document.getElementById('detailAngkaNilai').innerText = item.nilai;

        const modalElement = document.getElementById('modalDetailNilai');
        const modal = new bootstrap.Modal(modalElement);

        modal.show();
    }

    function openEditNilaiModal(index) {
        const item = dataNilai[index];

        document.getElementById('editIndexNilai').value = index;
        document.getElementById('editNamaNilai').value = item.nama;
        document.getElementById('editKelasNilai').value = item.kelas;
        document.getElementById('editMapelNilai').value = item.mapel;
        document.getElementById('editPertemuanNilai').value = item.pertemuan;
        document.getElementById('editStatusNilai').value = item.status;
        document.getElementById('editAngkaNilai').value = item.nilai;

        const modalElement = document.getElementById('modalEditNilai');
        const modal = new bootstrap.Modal(modalElement);

        modal.show();
    }

    function submitEditNilaiFrontend() {
        const index = document.getElementById('editIndexNilai').value;

        dataNilai[index].nama = document.getElementById('editNamaNilai').value;
        dataNilai[index].kelas = document.getElementById('editKelasNilai').value;
        dataNilai[index].mapel = document.getElementById('editMapelNilai').value;
        dataNilai[index].pertemuan = document.getElementById('editPertemuanNilai').value;
        dataNilai[index].status = document.getElementById('editStatusNilai').value;
        dataNilai[index].nilai = document.getElementById('editAngkaNilai').value;

        const modalElement = document.getElementById('modalEditNilai');
        const modal = bootstrap.Modal.getInstance(modalElement);

        modal.hide();

        if (selectedFilterNilai) {
            const filteredData = dataNilai.filter(item => {
                return item.kelas === selectedFilterNilai.kelas &&
                    item.mapel === selectedFilterNilai.mapel &&
                    item.pertemuan === selectedFilterNilai.pertemuan;
            });

            document.getElementById('info-jumlah').innerText = filteredData.length + ' Siswa';
            renderNilaiTable(filteredData);
        }
    }

    function hapusNilaiDummy(index) {
        if (confirm('Yakin ingin menghapus data nilai ini?')) {
            dataNilai.splice(index, 1);

            if (selectedFilterNilai) {
                const filteredData = dataNilai.filter(item => {
                    return item.kelas === selectedFilterNilai.kelas &&
                        item.mapel === selectedFilterNilai.mapel &&
                        item.pertemuan === selectedFilterNilai.pertemuan;
                });

                document.getElementById('info-jumlah').innerText = filteredData.length + ' Siswa';
                renderNilaiTable(filteredData);
            }
        }
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