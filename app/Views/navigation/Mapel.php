<div class="main-content">
    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <h5 class="mb-4">Data Mata Pelajaran</h5>

        <?php
        $bgColors = ['bg1', 'bg2', 'bg3', 'bg4', 'bg5'];
        ?>

        <!-- LIST MAPEL -->
        <div id="mapel-container">

            <div class="row mt-4 g-4">

                <?php if (!empty($mapel)): ?>
                    <?php foreach ($mapel as $index => $m): ?>

                        <div class="col-md-3">

                            <div class="dashboard-card <?= $bgColors[$index % count($bgColors)] ?> mapel-card"
                                data-id="<?= $m['id_mapel'] ?>"
                                data-mapel="<?= esc($m['nama_mapel']) ?>"
                                data-kelas="<?= esc($m['kelas']) ?>"
                                data-guru="<?= esc($m['created_by']) ?>"
                                style="cursor:pointer;">

                                <div class="card-wave"></div>

                                <h6><?= esc($m['nama_mapel']); ?></h6>
                                <h3>Kelas <?= esc($m['kelas']); ?></h3>

                                <i class="fa-solid fa-book"></i>

                            </div>

                        </div>

                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

            <hr class="my-4">

            <!-- FORM TAMBAH MAPEL -->
            <form action="<?= base_url('mapel') ?>" method="post">

                <div class="profile-row">
                    <span class="label">Nama Mapel</span>
                    <span class="separator">:</span>
                    <span class="value">
                        <input type="text" name="nama_mapel" class="form-control" required>
                    </span>
                </div>

                <div class="profile-row">
                    <span class="label">Untuk Kelas</span>
                    <span class="separator">:</span>
                    <span class="value">
                        <select name="kelas" class="form-control" required>
                            <option value="">-- Pilih Kelas --</option>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                        </select>
                    </span>
                </div>

                <div class="profile-row">
                    <span class="label">Pengajar</span>
                    <span class="separator">:</span>
                    <span class="value">
                        <select name="guru" class="form-control" required>

                            <option value="">-- Pilih Guru --</option>

                            <?php if (!empty($guru)): ?>
                                <?php foreach ($guru as $g): ?>

                                    <option value="<?= $g['nama']; ?>">
                                        <?= esc($g['nama']); ?>
                                    </option>

                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>
                    </span>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    Tambah Mapel
                </button>

            </form>

        </div>

        <!-- DETAIL MAPEL -->
        <div id="mapel-detail" style="display:none;">

            <div class="navbar-pertemuan">

                <button class="btn action-btn action-success mb-4" id="btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </button>

                <button class="btn action-btn action-success mb-4">
                    <i class="fa-solid fa-book"></i>
                    Lihat Pertemuan
                </button>

                <button class="btn action-btn action-success mb-4">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Pertemuan
                </button>
            </div>

            <div id="con-pertemuan">
                // Pertemuan akan ditampilkan disini setelah klik salah satu mapel
                <div class="pertemuan">

                </div>
            </div>

            <div id="con-tambah-pertemuan">
                // bagian ini tidak di tampilkan lebih dulu, akan muncul setelah klik tombol tambah pertemuan
                <form action="<?= base_url('materi') ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <input type="hidden"
                        name="id_mapel"
                        id="detail_id_mapel">

                    <div class="profile-row">
                        <span class="label">Nama Mapel</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text"
                                name="nama_mapel"
                                id="detail_mapel"
                                class="form-control"
                                readonly>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Pengajar</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text"
                                name="guru"
                                id="detail_guru"
                                class="form-control"
                                readonly>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Kelas</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text"
                                name="kelas"
                                id="detail_kelas"
                                class="form-control"
                                readonly>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Pertemuan</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text"
                                name="pertemuan"
                                class="form-control"
                                required>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">File Materi</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="file"
                                name="file_mapel"
                                class="form-control"
                                required>
                        </span>
                    </div>

                    <button type="submit"
                        class="btn btn-primary mt-3">
                        Simpan Materi
                    </button>

                </form>
            </div>

        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const cards = document.querySelectorAll('.mapel-card');

        cards.forEach(card => {

            card.addEventListener('click', function() {

                const idMapel = this.dataset.id;
                const namaMapel = this.dataset.mapel;
                const kelas = this.dataset.kelas;
                const guru = this.dataset.guru;

                document.getElementById('detail_id_mapel').value = idMapel;
                document.getElementById('detail_mapel').value = namaMapel;
                document.getElementById('detail_kelas').value = kelas;
                document.getElementById('detail_guru').value = guru;

                document.getElementById('mapel-container').style.display = 'none';
                document.getElementById('mapel-detail').style.display = 'block';

            });

        });

        document.getElementById('btn-back').addEventListener('click', function() {

            document.getElementById('mapel-detail').style.display = 'none';
            document.getElementById('mapel-container').style.display = 'block';

        });

    });
</script>