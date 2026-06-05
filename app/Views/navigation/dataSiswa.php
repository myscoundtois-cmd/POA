<div class="main-content">

    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <div class="table-toolbar">

            <div class="toolbar-left">
                <small class="text-muted">
                    Pilih kelas untuk melihat daftar siswa yang terdaftar di sistem
                </small>
            </div>

            <div class="toolbar-right">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari siswa..."
                    onkeyup="searchSiswaDropdown(this)"
                    style="max-width: 220px;">

                <button class="btn btn-primary" type="button" onclick="openTambahSiswaModal()">
                    <i class="fa-solid fa-user-plus"></i>
                    Tambah Siswa
                </button>
            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover" id="table-kelas-siswa">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Jumlah Siswa</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <!-- KELAS 7 -->
                    <tr class="kelas-row" data-kelas="7">
                        <td>1</td>
                        <td><strong>Kelas 7</strong></td>
                        <td>3 Siswa</td>
                        <td>
                            <span class="text-muted">Lihat daftar siswa kelas 7</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" type="button" onclick="toggleSiswaKelas('siswa-kelas-7')">
                                <i class="fa-solid fa-users"></i>
                                Lihat Siswa
                            </button>
                        </td>
                    </tr>

                    <tr id="siswa-kelas-7" class="siswa-dropdown-row" style="display:none;">
                        <td colspan="5">

                            <div class="table-responsive">

                                <table class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>NIS</th>
                                            <th>Kelas</th>
                                            <th>JK</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr class="siswa-row">
                                            <td>1</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Budi Santoso</td>
                                            <td>2026001</td>
                                            <td>7</td>
                                            <td>Laki-laki</td>
                                            <td>budi.santoso@mail.com</td>
                                            <td>Jl. Melati No. 12</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="siswa-row">
                                            <td>2</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Dina Permata</td>
                                            <td>2026002</td>
                                            <td>7</td>
                                            <td>Perempuan</td>
                                            <td>dina.permata@mail.com</td>
                                            <td>Jl. Kenanga No. 8</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="siswa-row">
                                            <td>3</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Rizky Ramadhan</td>
                                            <td>2026003</td>
                                            <td>7</td>
                                            <td>Laki-laki</td>
                                            <td>rizky.ramadhan@mail.com</td>
                                            <td>Jl. Mawar No. 21</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </td>
                    </tr>


                    <!-- KELAS 8 -->
                    <tr class="kelas-row" data-kelas="8">
                        <td>2</td>
                        <td><strong>Kelas 8</strong></td>
                        <td>3 Siswa</td>
                        <td>
                            <span class="text-muted">Lihat daftar siswa kelas 8</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" type="button" onclick="toggleSiswaKelas('siswa-kelas-8')">
                                <i class="fa-solid fa-users"></i>
                                Lihat Siswa
                            </button>
                        </td>
                    </tr>

                    <tr id="siswa-kelas-8" class="siswa-dropdown-row" style="display:none;">
                        <td colspan="5">

                            <div class="table-responsive">

                                <table class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>NIS</th>
                                            <th>Kelas</th>
                                            <th>JK</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr class="siswa-row">
                                            <td>1</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Siti Aisyah</td>
                                            <td>2026004</td>
                                            <td>8</td>
                                            <td>Perempuan</td>
                                            <td>siti.aisyah@mail.com</td>
                                            <td>Jl. Anggrek No. 5</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="siswa-row">
                                            <td>2</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Ahmad Fauzi</td>
                                            <td>2026005</td>
                                            <td>8</td>
                                            <td>Laki-laki</td>
                                            <td>ahmad.fauzi@mail.com</td>
                                            <td>Jl. Cempaka No. 17</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="siswa-row">
                                            <td>3</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Maya Salsabila</td>
                                            <td>2026006</td>
                                            <td>8</td>
                                            <td>Perempuan</td>
                                            <td>maya.salsabila@mail.com</td>
                                            <td>Jl. Flamboyan No. 10</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </td>
                    </tr>


                    <!-- KELAS 9 -->
                    <tr class="kelas-row" data-kelas="9">
                        <td>3</td>
                        <td><strong>Kelas 9</strong></td>
                        <td>3 Siswa</td>
                        <td>
                            <span class="text-muted">Lihat daftar siswa kelas 9</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary" type="button" onclick="toggleSiswaKelas('siswa-kelas-9')">
                                <i class="fa-solid fa-users"></i>
                                Lihat Siswa
                            </button>
                        </td>
                    </tr>

                    <tr id="siswa-kelas-9" class="siswa-dropdown-row" style="display:none;">
                        <td colspan="5">

                            <div class="table-responsive">

                                <table class="table table-hover">

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>NIS</th>
                                            <th>Kelas</th>
                                            <th>JK</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr class="siswa-row">
                                            <td>1</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Rahmat Hidayat</td>
                                            <td>2026007</td>
                                            <td>9</td>
                                            <td>Laki-laki</td>
                                            <td>rahmat.hidayat@mail.com</td>
                                            <td>Jl. Dahlia No. 14</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="siswa-row">
                                            <td>2</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Putri Lestari</td>
                                            <td>2026008</td>
                                            <td>9</td>
                                            <td>Perempuan</td>
                                            <td>putri.lestari@mail.com</td>
                                            <td>Jl. Teratai No. 9</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr class="siswa-row">
                                            <td>3</td>
                                            <td>
                                                <span class="text-muted">Tidak ada foto</span>
                                            </td>
                                            <td>Andi Saputra</td>
                                            <td>2026009</td>
                                            <td>9</td>
                                            <td>Laki-laki</td>
                                            <td>andi.saputra@mail.com</td>
                                            <td>Jl. Sakura No. 3</td>
                                            <td>
                                                <div class="action-table">
                                                    <button
                                                        class="btn btn-sm btn-warning"
                                                        title="Edit Data"
                                                        onclick="openEditSiswaModal(this)">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>

                                                    <button
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus Data"
                                                        onclick="confirmDelete('siswa')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
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


    <!-- MODAL TAMBAH SISWA -->
    <div class="modal fade" id="modalTambahSiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Tambah Data Siswa</h5>
                        <small class="text-muted">
                            Isi data siswa baru yang akan ditampilkan di sistem
                        </small>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="formTambahSiswa">

                        <div class="profile-row">
                            <span class="label">Foto</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="file" name="foto" class="form-control">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Nama</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama siswa">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">NIS</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Kelas</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select name="kelas" class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Jenis Kelamin</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Email</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email siswa">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Alamat</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat siswa"></textarea>
                            </span>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" class="btn btn-primary" onclick="submitTambahSiswaFrontend()">
                        <i class="fa-solid fa-paper-plane"></i>
                        Simpan
                    </button>
                </div>

            </div>

        </div>
    </div>


    <!-- MODAL EDIT SISWA -->
    <div class="modal fade" id="modalEditSiswa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Edit Data Siswa</h5>
                        <small class="text-muted">
                            Ubah data siswa yang sudah terdaftar di sistem
                        </small>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="formEditSiswa">

                        <div class="profile-row">
                            <span class="label">Foto</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="file" name="foto" class="form-control">
                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti foto
                                </small>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Nama</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input
                                    type="text"
                                    name="nama"
                                    id="editNamaSiswa"
                                    class="form-control"
                                    placeholder="Masukkan nama siswa">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">NIS</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input
                                    type="text"
                                    name="nis"
                                    id="editNisSiswa"
                                    class="form-control"
                                    placeholder="Masukkan NIS">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Kelas</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select name="kelas" id="editKelasSiswa" class="form-control">
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Jenis Kelamin</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select name="jenis_kelamin" id="editJenisKelaminSiswa" class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Email</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input
                                    type="email"
                                    name="email"
                                    id="editEmailSiswa"
                                    class="form-control"
                                    placeholder="Masukkan email siswa">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Alamat</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <textarea
                                    name="alamat"
                                    id="editAlamatSiswa"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Masukkan alamat siswa"></textarea>
                            </span>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" class="btn btn-primary" onclick="submitEditSiswaFrontend()">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </div>

        </div>
    </div>


    <script>
        let selectedEditRow = null;

        function toggleSiswaKelas(rowId) {

            const siswaDropdownRows = document.querySelectorAll('.siswa-dropdown-row');

            siswaDropdownRows.forEach(row => {

                if (row.id === rowId) {
                    row.style.display =
                        row.style.display === 'none' ? 'table-row' : 'none';
                } else {
                    row.style.display = 'none';
                }

            });
        }

        function searchSiswaDropdown(input) {

            const keyword = input.value.toLowerCase();
            const kelasRows = document.querySelectorAll('.kelas-row');

            kelasRows.forEach(kelasRow => {

                const dropdownRow = kelasRow.nextElementSibling;

                if (
                    !dropdownRow ||
                    !dropdownRow.classList.contains('siswa-dropdown-row')
                ) {
                    return;
                }

                const siswaRows = dropdownRow.querySelectorAll('.siswa-row');
                let jumlahCocok = 0;

                siswaRows.forEach(siswaRow => {

                    const namaSiswa = siswaRow.children[2].innerText.toLowerCase();
                    const nisSiswa = siswaRow.children[3].innerText.toLowerCase();
                    const kelasSiswa = siswaRow.children[4].innerText.toLowerCase();
                    const jenisKelaminSiswa = siswaRow.children[5].innerText.toLowerCase();
                    const emailSiswa = siswaRow.children[6].innerText.toLowerCase();
                    const alamatSiswa = siswaRow.children[7].innerText.toLowerCase();

                    if (
                        namaSiswa.includes(keyword) ||
                        nisSiswa.includes(keyword) ||
                        kelasSiswa.includes(keyword) ||
                        jenisKelaminSiswa.includes(keyword) ||
                        emailSiswa.includes(keyword) ||
                        alamatSiswa.includes(keyword)
                    ) {
                        siswaRow.style.display = '';
                        jumlahCocok++;
                    } else {
                        siswaRow.style.display = 'none';
                    }

                });

                if (keyword === '') {
                    kelasRow.style.display = '';
                    dropdownRow.style.display = 'none';

                    siswaRows.forEach(siswaRow => {
                        siswaRow.style.display = '';
                    });
                } else if (jumlahCocok > 0) {
                    kelasRow.style.display = '';
                    dropdownRow.style.display = 'table-row';
                } else {
                    kelasRow.style.display = 'none';
                    dropdownRow.style.display = 'none';
                }

            });
        }

        function openTambahSiswaModal() {
            const modalElement = document.getElementById('modalTambahSiswa');
            const modal = new bootstrap.Modal(modalElement);

            modal.show();
        }

        function submitTambahSiswaFrontend() {

            const form = document.getElementById('formTambahSiswa');
            form.reset();

            const modalElement = document.getElementById('modalTambahSiswa');
            const modal = bootstrap.Modal.getInstance(modalElement);

            modal.hide();
        }

        function openEditSiswaModal(button) {

            selectedEditRow = button.closest('tr');

            const cells = selectedEditRow.children;

            const nama = cells[2].innerText.trim();
            const nis = cells[3].innerText.trim();
            const kelas = cells[4].innerText.trim();
            const jenisKelamin = cells[5].innerText.trim();
            const email = cells[6].innerText.trim();
            const alamat = cells[7].innerText.trim();

            document.getElementById('editNamaSiswa').value = nama;
            document.getElementById('editNisSiswa').value = nis;
            document.getElementById('editKelasSiswa').value = kelas;
            document.getElementById('editJenisKelaminSiswa').value = jenisKelamin;
            document.getElementById('editEmailSiswa').value = email;
            document.getElementById('editAlamatSiswa').value = alamat;

            const modalElement = document.getElementById('modalEditSiswa');
            const modal = new bootstrap.Modal(modalElement);

            modal.show();
        }

        function submitEditSiswaFrontend() {

            if (selectedEditRow) {

                selectedEditRow.children[2].innerText = document.getElementById('editNamaSiswa').value;
                selectedEditRow.children[3].innerText = document.getElementById('editNisSiswa').value;
                selectedEditRow.children[4].innerText = document.getElementById('editKelasSiswa').value;
                selectedEditRow.children[5].innerText = document.getElementById('editJenisKelaminSiswa').value;
                selectedEditRow.children[6].innerText = document.getElementById('editEmailSiswa').value;
                selectedEditRow.children[7].innerText = document.getElementById('editAlamatSiswa').value;

            }

            const modalElement = document.getElementById('modalEditSiswa');
            const modal = bootstrap.Modal.getInstance(modalElement);

            modal.hide();
        }
    </script>

</div>