<div class="main-content">

    <div class="table-section">

        <div class="table-toolbar">

            <div class="toolbar-left">
                <small class="text-muted">
                    Daftar guru yang terdaftar di sistem
                </small>
            </div>

            <div class="toolbar-right">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari guru..."
                    onkeyup="searchTable(this, 'table-guru')"
                    style="max-width: 220px;">

                <button class="btn btn-primary" type="button" onclick="openTambahGuruModal()">
                    <i class="fa-solid fa-user-plus"></i>
                    Tambah Guru
                </button>
            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover" id="table-guru">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Guru</th>
                        <th>Email</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th>Tgl Lahir</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($guru)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($guru as $row): ?>

                            <tr>
                                <td><?= $no++; ?></td>

                                <td>
                                    <?php if (!empty($row['foto'])): ?>
                                        <img
                                            src="<?= base_url('uploads/' . $row['foto']); ?>"
                                            alt="Foto Guru"
                                            class="table-img">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada foto</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= esc($row['nama']); ?></td>

                                <td><?= esc($row['email']); ?></td>

                                <td>
                                    <?= !empty($row['jenis_kelamin']) ? esc($row['jenis_kelamin']) : '<span class="text-muted">Belum diisi</span>'; ?>
                                </td>

                                <td>
                                    <?= !empty($row['alamat']) ? esc($row['alamat']) : '<span class="text-muted">Belum diisi</span>'; ?>
                                </td>

                                <td>
                                    <?= !empty($row['tgl_lahir']) ? esc($row['tgl_lahir']) : '<span class="text-muted">Belum diisi</span>'; ?>
                                </td>

                                <td>
                                    <span class="status aktif">
                                        <?= ucfirst($row['role']); ?>
                                    </span>
                                </td>

                                <td>
                                    <div class="action-table">

                                        <button
                                            class="btn btn-sm btn-warning"
                                            title="Edit Data"
                                            onclick="openEditGuruModal(this)">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>

                                        <button
                                            class="btn btn-sm btn-danger"
                                            title="Hapus Data"
                                            onclick="confirmDelete('guru')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                    <p>Belum ada data guru.</p>
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


    <!-- MODAL TAMBAH GURU -->
    <div class="modal fade" id="modalTambahGuru" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Tambah Data Guru</h5>
                        <small class="text-muted">
                            Isi data guru baru yang akan ditampilkan di sistem
                        </small>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="formTambahGuru">

                        <div class="profile-row">
                            <span class="label">Foto</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="file" name="foto" class="form-control">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Nama Guru</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama guru">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Email</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="email" name="email" class="form-control" placeholder="Masukkan email guru">
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
                            <span class="label">Tanggal Lahir</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="date" name="tgl_lahir" class="form-control">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Alamat</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat guru"></textarea>
                            </span>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" class="btn btn-primary" onclick="submitTambahGuruFrontend()">
                        <i class="fa-solid fa-paper-plane"></i>
                        Simpan
                    </button>
                </div>

            </div>

        </div>
    </div>


    <!-- MODAL EDIT GURU -->
    <div class="modal fade" id="modalEditGuru" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Edit Data Guru</h5>
                        <small class="text-muted">
                            Ubah data guru yang sudah terdaftar di sistem
                        </small>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="formEditGuru">

                        <div class="profile-row">
                            <span class="label">Foto</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="file" name="foto" class="form-control">
                                <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Nama Guru</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="text" name="nama" id="editNamaGuru" class="form-control" placeholder="Masukkan nama guru">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Email</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="email" name="email" id="editEmailGuru" class="form-control" placeholder="Masukkan email guru">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Jenis Kelamin</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select name="jenis_kelamin" id="editJenisKelaminGuru" class="form-control">
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
                                <textarea name="alamat" id="editAlamatGuru" class="form-control" rows="3" placeholder="Masukkan alamat guru"></textarea>
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Tanggal Lahir</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input type="date" name="tgl_lahir" id="editTglLahirGuru" class="form-control">
                            </span>
                        </div>

                        <div class="profile-row">
                            <span class="label">Role</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <select name="role" id="editRoleGuru" class="form-control">
                                    <option value="guru">Guru</option>
                                    <option value="admin">Admin</option>
                                    <option value="murid">Murid</option>
                                    <option value="wali">Wali</option>
                                </select>
                            </span>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="button" class="btn btn-primary" onclick="submitEditGuruFrontend()">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </div>

        </div>
    </div>


    <script>
        let selectedEditGuruRow = null;

        function normalizeEmptyValue(value) {
            const text = value.trim();
            return text === 'Belum diisi' || text === 'Tidak ada foto' ? '' : text;
        }

        function setTableCellValue(cell, value) {
            const safeValue = value.trim();

            if (safeValue !== '') {
                cell.innerText = safeValue;
            } else {
                cell.innerHTML = '<span class="text-muted">Belum diisi</span>';
            }
        }

        function openTambahGuruModal() {
            const modalElement = document.getElementById('modalTambahGuru');
            const modal = new bootstrap.Modal(modalElement);

            modal.show();
        }

        function submitTambahGuruFrontend() {
            const form = document.getElementById('formTambahGuru');
            form.reset();

            const modalElement = document.getElementById('modalTambahGuru');
            const modal = bootstrap.Modal.getInstance(modalElement);

            modal.hide();
        }

        function openEditGuruModal(button) {
            selectedEditGuruRow = button.closest('tr');

            const cells = selectedEditGuruRow.children;

            const nama = normalizeEmptyValue(cells[2].innerText);
            const email = normalizeEmptyValue(cells[3].innerText);
            const jenisKelamin = normalizeEmptyValue(cells[4].innerText);
            const alamat = normalizeEmptyValue(cells[5].innerText);
            const tglLahir = normalizeEmptyValue(cells[6].innerText);
            const role = normalizeEmptyValue(cells[7].innerText).toLowerCase();

            document.getElementById('editNamaGuru').value = nama;
            document.getElementById('editEmailGuru').value = email;
            document.getElementById('editJenisKelaminGuru').value = jenisKelamin;
            document.getElementById('editAlamatGuru').value = alamat;
            document.getElementById('editTglLahirGuru').value = tglLahir;
            document.getElementById('editRoleGuru').value = role || 'guru';

            const modalElement = document.getElementById('modalEditGuru');
            const modal = new bootstrap.Modal(modalElement);

            modal.show();
        }

        function submitEditGuruFrontend() {
            if (selectedEditGuruRow) {
                const nama = document.getElementById('editNamaGuru').value;
                const email = document.getElementById('editEmailGuru').value;
                const jenisKelamin = document.getElementById('editJenisKelaminGuru').value;
                const alamat = document.getElementById('editAlamatGuru').value;
                const tglLahir = document.getElementById('editTglLahirGuru').value;
                const role = document.getElementById('editRoleGuru').value;

                setTableCellValue(selectedEditGuruRow.children[2], nama);
                setTableCellValue(selectedEditGuruRow.children[3], email);
                setTableCellValue(selectedEditGuruRow.children[4], jenisKelamin);
                setTableCellValue(selectedEditGuruRow.children[5], alamat);
                setTableCellValue(selectedEditGuruRow.children[6], tglLahir);

                selectedEditGuruRow.children[7].innerHTML = `
                    <span class="status aktif">
                        ${role.charAt(0).toUpperCase() + role.slice(1)}
                    </span>
                `;
            }

            const modalElement = document.getElementById('modalEditGuru');
            const modal = bootstrap.Modal.getInstance(modalElement);

            modal.hide();
        }
    </script>

</div>
