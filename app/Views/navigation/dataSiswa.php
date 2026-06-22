<div class="main-content">

    <?php
    $kelas = isset($kelas) && is_array($kelas) ? $kelas : [];
    $siswa = isset($siswa) && is_array($siswa) ? $siswa : [];
    ?>


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
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($kelas as $index => $k): ?>

                        <tr
                            class="kelas-row"
                            onclick="toggleSiswaKelas(this, 'siswa-kelas-<?= $k['kelas'] ?>')"
                            style="cursor:pointer;">

                            <td><?= $index + 1 ?></td>

                            <td>
                                <div style="display:flex; align-items:center; justify-content:space-between;">
                                    <strong>Kelas <?= esc($k['kelas']) ?></strong>
                                    <i class="fa-solid fa-chevron-down dropdown-icon"></i>
                                </div>
                            </td>

                            <td><?= $k['jumlah_siswa'] ?> Siswa</td>

                            <td>
                                <span class="text-muted">
                                    Klik baris ini untuk melihat daftar siswa kelas <?= esc($k['kelas']) ?>
                                </span>
                            </td>

                        </tr>

                        <tr
                            id="siswa-kelas-<?= $k['kelas'] ?>"
                            class="siswa-dropdown-row"
                            style="display:none;">

                            <td colspan="4">

                                <div class="table-responsive">

                                    <table class="table table-hover has-sticky-action">

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

                                            <?php
                                            $no = 1;
                                            foreach ($siswa as $row):
                                                if ($row['kelas'] == $k['kelas']):
                                            ?>

                                                    <tr class="siswa-row">

                                                        <td><?= $no++ ?></td>

                                                        <td>
                                                            <?php if (!empty($row['foto'])): ?>
                                                                <img
                                                                    src="<?= base_url('uploads/foto/' . $row['foto']) ?>"
                                                                    width="50"
                                                                    class="img-thumbnail">
                                                            <?php else: ?>
                                                                <span class="text-muted">
                                                                    Tidak ada foto
                                                                </span>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td><?= esc($row['nama']) ?></td>
                                                        <td><?= esc($row['nis']) ?></td>
                                                        <td><?= esc($row['kelas']) ?></td>
                                                        <td><?= esc($row['jenis_kelamin']) ?></td>
                                                        <td><?= esc($row['email']) ?></td>
                                                        <td><?= esc($row['alamat']) ?></td>

                                                        <td class="action-sticky-cell">
                                                            <div class="action-table">

                                                                <button
                                                                    class="btn btn-sm btn-warning"
                                                                    title="Edit Data"
                                                                    data-id="<?= $row['id_dataUser'] ?? '' ?>"
                                                                    onclick="openEditSiswaModal(this)">
                                                                    <i class="fa-solid fa-pen"></i>
                                                                </button>

                                                                <form action="<?= base_url('delete_siswa/' . ($row['id_dataUser'] ?? '')) ?>" method="post" style="display:inline;">
                                                                    <button
                                                                        class="btn btn-sm btn-danger"
                                                                        type="submit"
                                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>

                                                            </div>
                                                        </td>

                                                    </tr>

                                            <?php
                                                endif;
                                            endforeach;
                                            ?>

                                        </tbody>

                                    </table>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

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

                    <form id="formTambahSiswa" action="<?= base_url('/tambah_siswa') ?>" method="post" enctype="multipart/form-data">

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
                                    <option value="7A">7A</option>
                                    <option value="7B">7B</option>
                                    <option value="7C">7C</option>
                                    <option value="8A">8A</option>
                                    <option value="8B">8B</option>
                                    <option value="8C">8C</option>
                                    <option value="9A">9A</option>
                                    <option value="9B">9B</option>
                                    <option value="9C">9C</option>
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
                            <span class="label">Alamat</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat siswa"></textarea>
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
                            <span class="label">password</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password siswa">
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

                    <form id="formEditSiswa" action="<?= base_url('/edit_siswa') ?>" enctype="multipart/form-data" method="post">

                        <input type="hidden" name="id_dataUser" id="editIdSiswa">

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
                                <input
                                    type="text"
                                    name="kelas"
                                    id="editKelasSiswa"
                                    class="form-control"
                                    placeholder="Masukkan NIS">
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

        function toggleSiswaKelas(kelasRow, rowId) {

            const selectedDropdown = document.getElementById(rowId);
            const isOpen = selectedDropdown.style.display === 'table-row';

            const siswaDropdownRows = document.querySelectorAll('.siswa-dropdown-row');
            const kelasRows = document.querySelectorAll('.kelas-row');

            siswaDropdownRows.forEach(row => {
                row.style.display = 'none';
            });

            kelasRows.forEach(row => {
                const icon = row.querySelector('.dropdown-icon');

                if (icon) {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });

            if (!isOpen) {
                selectedDropdown.style.display = 'table-row';

                const selectedIcon = kelasRow.querySelector('.dropdown-icon');

                if (selectedIcon) {
                    selectedIcon.classList.remove('fa-chevron-down');
                    selectedIcon.classList.add('fa-chevron-up');
                }
            }
        }

        function searchSiswaDropdown(input) {

            const keyword = input.value.toLowerCase();
            const kelasRows = document.querySelectorAll('.kelas-row');

            kelasRows.forEach(kelasRow => {

                const dropdownRow = kelasRow.nextElementSibling;
                const icon = kelasRow.querySelector('.dropdown-icon');

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

                    if (icon) {
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }

                    siswaRows.forEach(siswaRow => {
                        siswaRow.style.display = '';
                    });
                } else if (jumlahCocok > 0) {
                    kelasRow.style.display = '';
                    dropdownRow.style.display = 'table-row';

                    if (icon) {
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    }
                } else {
                    kelasRow.style.display = 'none';
                    dropdownRow.style.display = 'none';

                    if (icon) {
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                }

            });
        }

        function openTambahSiswaModal() {
            const modalElement = document.getElementById('modalTambahSiswa');
            const modal = new bootstrap.Modal(modalElement);

            modal.show();
        }

        function submitTambahSiswaFrontend() {
            document.getElementById('formTambahSiswa').submit();
        }

        function openEditSiswaModal(button) {

            selectedEditRow = button.closest('tr');

            document.getElementById('editIdSiswa').value =
                button.dataset.id;

            const cells = selectedEditRow.children;

            document.getElementById('editNamaSiswa').value = cells[2].innerText.trim();
            document.getElementById('editNisSiswa').value = cells[3].innerText.trim();
            document.getElementById('editKelasSiswa').value = cells[4].innerText.trim();
            document.getElementById('editJenisKelaminSiswa').value = cells[5].innerText.trim();
            document.getElementById('editEmailSiswa').value = cells[6].innerText.trim();
            document.getElementById('editAlamatSiswa').value = cells[7].innerText.trim();

            const modal = new bootstrap.Modal(
                document.getElementById('modalEditSiswa')
            );

            modal.show();
        }

        function submitEditSiswaFrontend() {

            document.getElementById('formEditSiswa').submit();
        }
    </script>

</div>