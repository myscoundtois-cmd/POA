<div class="main-content">

    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <div class="table-toolbar">

            <div class="toolbar-left">
                <small class="text-muted">
                    Daftar siswa yang terdaftar di sistem
                </small>
            </div>
            <div class="toolbar-right">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari siswa..."
                    onkeyup="searchTable(this, 'table-siswa')"
                    style="max-width: 220px;">

                <button class="btn btn-primary" type="button" onclick="openTambahSiswaModal()">
                    <i class="fa-solid fa-user-plus"></i>
                    Tambah Siswa
                </button>
            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover" id="table-siswa">

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

                    <?php if (!empty($siswa)): ?>
                        <?php $no = 1; ?>
                        <?php foreach ($siswa as $row): ?>

                            <tr>
                                <td><?= $no++; ?></td>

                                <td>
                                    <?php if (!empty($row['foto'])): ?>
                                        <img
                                            src="<?= base_url('uploads/' . $row['foto']); ?>"
                                            alt="Foto Siswa"
                                            class="table-img">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada foto</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?= !empty($row['nama']) ? esc($row['nama']) : '<span class="text-muted">Belum diisi</span>'; ?>
                                </td>

                                <td>
                                    <?= !empty($row['nis']) ? esc($row['nis']) : '<span class="text-muted">Belum diisi</span>'; ?>
                                </td>

                                <td>
                                    <?= !empty($row['kelas']) ? esc($row['kelas']) : '<span class="text-muted">Belum diisi</span>'; ?>
                                </td>

                                <td>
                                    <?= !empty($row['jenis_kelamin']) ? esc($row['jenis_kelamin']) : '<span class="text-muted">Belum diisi</span>'; ?>
                                </td>

                                <td>
                                    <?= !empty($row['email']) ? esc($row['email']) : '<span class="text-muted">Belum diisi</span>'; ?>
                                </td>

                                <td>
                                    <?= !empty($row['alamat']) ? esc($row['alamat']) : '<span class="text-muted">Belum diisi</span>'; ?>
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
                                            onclick="confirmDelete('siswa')">
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
                                    <i class="fa-solid fa-user-graduate"></i>
                                    <p>Belum ada data siswa.</p>
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?>

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
                                    <option value="VII">VII</option>
                                    <option value="VIII">VIII</option>
                                    <option value="IX">IX</option>
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

    <script>
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
</script>

</div>