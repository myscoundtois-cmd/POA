<div class="main-content">

    <?= $this->include('content/navbar') ?>

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

                <button class="btn btn-primary">
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

</div>