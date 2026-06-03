<div class="main-content">

    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <div class="table-toolbar">

            <div class="toolbar-left">
                <div>
                    <h5 class="mb-1">Data Soal</h5>
                    <small class="text-muted" id="info-mapel-soal">
                        Menampilkan seluruh data soal yang sudah dibuat.
                    </small>
                </div>
            </div>

            <div class="toolbar-right">
                <input
                    type="text"
                    class="form-control"
                    placeholder="Cari soal atau ujian..."
                    onkeyup="searchTable(this, 'table-soal')"
                    style="max-width: 240px;">

                <button
                    class="btn btn-primary"
                    onclick="showPage('mapel', document.querySelector('[onclick*=mapel]'))">

                    <i class="fa-solid fa-plus"></i>
                    Buat Soal

                </button>
            </div>

        </div>

        <div class="row mt-4 g-4">

            <div class="col-md-4">
                <div class="dashboard-card bg1">
                    <div class="card-wave"></div>

                    <h5>Total Ujian</h5>
                    <h2 id="total-ujian-card">0</h2>

                    <i class="fa-solid fa-clipboard-question"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card bg2">
                    <div class="card-wave"></div>

                    <h5>Total Soal</h5>
                    <h2 id="total-soal-card">0</h2>

                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card bg3">
                    <div class="card-wave"></div>

                    <h5>Mapel Dipilih</h5>
                    <h2 id="mapel-dipilih-card">Semua</h2>

                    <i class="fa-solid fa-book"></i>
                </div>
            </div>

        </div>

    </div>

    <div class="table-section">

        <div class="table-responsive">

            <table class="table table-hover" id="table-soal">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Ujian</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                        <th>Pertemuan</th>
                        <th>Tipe</th>
                        <th>Durasi</th>
                        <th>Jumlah Soal</th>
                        <th>Pengajar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php if (!empty($tugasUji)): ?>
                        <?php $no = 1; ?>

                        <?php foreach ($tugasUji as $row): ?>

                            <tr class="row-soal"
                                data-id-mapel="<?= esc($row['id_mapel']) ?>"
                                data-jumlah-soal="<?= esc($row['jumlah_soal']) ?>">

                                <td><?= $no++; ?></td>

                                <td>
                                    <strong>
                                        <?= !empty($row['judul']) ? esc($row['judul']) : 'Tanpa Judul'; ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= !empty($row['nama_mapel']) ? esc($row['nama_mapel']) : '<span class="text-muted">Mapel tidak ditemukan</span>'; ?>
                                </td>

                                <td>
                                    <?= !empty($row['kelas']) ? esc($row['kelas']) : '<span class="text-muted">-</span>'; ?>
                                </td>

                                <td>
                                    Pertemuan <?= !empty($row['pertemuan']) ? esc($row['pertemuan']) : '-'; ?>
                                </td>

                                <td>
                                    <?php if ($row['tipe_soal'] == 'pg'): ?>
                                        <span class="badge-soft primary">Pilihan Ganda</span>
                                    <?php elseif ($row['tipe_soal'] == 'esai'): ?>
                                        <span class="badge-soft warning">Esai</span>
                                    <?php else: ?>
                                        <span class="badge-soft danger">Belum jelas</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?= !empty($row['durasi']) ? esc($row['durasi']) . ' menit' : '<span class="text-muted">-</span>'; ?>
                                </td>

                                <td>
                                    <span class="badge-soft success">
                                        <?= esc($row['jumlah_soal']); ?> soal
                                    </span>
                                </td>

                                <td>
                                    <?= !empty($row['created_by']) ? esc($row['created_by']) : '<span class="text-muted">-</span>'; ?>
                                </td>

                                <td>
                                    <div class="action-table">

                                        <button
                                            class="btn btn-sm btn-primary"
                                            title="Detail Soal"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalDetailSoal<?= $row['id_tugas']; ?>">

                                            <i class="fa-solid fa-eye"></i>

                                        </button>

                                        <button
                                            class="btn btn-sm btn-warning"
                                            title="Edit Soal">

                                            <i class="fa-solid fa-pen"></i>

                                        </button>

                                        <button
                                            class="btn btn-sm btn-danger"
                                            title="Hapus Soal"
                                            onclick="confirmDelete('soal')">

                                            <i class="fa-solid fa-trash"></i>

                                        </button>

                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="modalDetailSoal<?= $row['id_tugas']; ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Ujian</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="profile-row">
                                                <span class="label">Judul Ujian</span>
                                                <span class="separator">:</span>
                                                <span class="value"><?= esc($row['judul']); ?></span>
                                            </div>

                                            <div class="profile-row">
                                                <span class="label">Mata Pelajaran</span>
                                                <span class="separator">:</span>
                                                <span class="value"><?= esc($row['nama_mapel']); ?></span>
                                            </div>

                                            <div class="profile-row">
                                                <span class="label">Kelas</span>
                                                <span class="separator">:</span>
                                                <span class="value"><?= esc($row['kelas']); ?></span>
                                            </div>

                                            <div class="profile-row">
                                                <span class="label">Pertemuan</span>
                                                <span class="separator">:</span>
                                                <span class="value">Pertemuan <?= esc($row['pertemuan']); ?></span>
                                            </div>

                                            <div class="profile-row">
                                                <span class="label">Tipe Soal</span>
                                                <span class="separator">:</span>
                                                <span class="value">
                                                    <?= $row['tipe_soal'] == 'pg' ? 'Pilihan Ganda' : 'Esai'; ?>
                                                </span>
                                            </div>

                                            <div class="profile-row">
                                                <span class="label">Durasi</span>
                                                <span class="separator">:</span>
                                                <span class="value"><?= esc($row['durasi']); ?> menit</span>
                                            </div>

                                            <div class="profile-row">
                                                <span class="label">Jumlah Soal</span>
                                                <span class="separator">:</span>
                                                <span class="value"><?= esc($row['jumlah_soal']); ?> soal</span>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">
                                                Tutup
                                            </button>

                                            <button class="btn btn-warning">
                                                <i class="fa-solid fa-pen"></i>
                                                Edit
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="10">
                                <div class="empty-state">
                                    <i class="fa-solid fa-clipboard-question"></i>
                                    <p>Belum ada data soal yang dibuat.</p>
                                </div>
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>
    function openDataSoal(idMapel, namaMapel, kelasMapel) {

        showPage('data_soal');

        const rows = document.querySelectorAll('.row-soal');

        let totalUjian = 0;
        let totalSoal = 0;

        rows.forEach(row => {

            if (row.dataset.idMapel == idMapel) {

                row.style.display = '';
                totalUjian++;
                totalSoal += Number(row.dataset.jumlahSoal || 0);

            } else {

                row.style.display = 'none';

            }

        });

        document.getElementById('info-mapel-soal').innerText =
            'Menampilkan data soal untuk ' + namaMapel + ' kelas ' + kelasMapel + '.';

        document.getElementById('total-ujian-card').innerText = totalUjian;
        document.getElementById('total-soal-card').innerText = totalSoal;
        document.getElementById('mapel-dipilih-card').innerText = namaMapel;

        if (totalUjian === 0) {
            document.getElementById('info-mapel-soal').innerText =
                'Belum ada soal untuk ' + namaMapel + ' kelas ' + kelasMapel + '.';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {

        const rows = document.querySelectorAll('.row-soal');

        let totalUjian = 0;
        let totalSoal = 0;

        rows.forEach(row => {
            totalUjian++;
            totalSoal += Number(row.dataset.jumlahSoal || 0);
        });

        const totalUjianCard = document.getElementById('total-ujian-card');
        const totalSoalCard = document.getElementById('total-soal-card');

        if (totalUjianCard) {
            totalUjianCard.innerText = totalUjian;
        }

        if (totalSoalCard) {
            totalSoalCard.innerText = totalSoal;
        }

    });
</script>