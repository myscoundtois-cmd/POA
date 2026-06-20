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
                                    <img
                                        src="<?= base_url('uploads/' . $row['foto']); ?>"
                                        alt="Foto Guru"
                                        class="table-img">
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
                                            title="Edit Data">
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
    <script>
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
    </script>
</div>