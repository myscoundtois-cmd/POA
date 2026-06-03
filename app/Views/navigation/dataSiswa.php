<div class="main-content">

    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <div class="table-toolbar">

            <div class="toolbar-left">
                <h5 class="mb-0">Data Siswa</h5>
            </div>

            <div class="toolbar-right">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari siswa..."
                    onkeyup="searchTable(this, 'table-siswa')"
                    style="max-width: 220px;">

                <button class="btn btn-primary">
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

</div>