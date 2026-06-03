<div class="main-content">
    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <small class="text-muted d-block mb-4">
            Daftar mata pelajaran, materi, pertemuan, dan soal pembelajaran
        </small>

        <?php
        $bgColors = ['bg1', 'bg2', 'bg3', 'bg4', 'bg1'];
        ?>

        <!-- LIST MAPEL -->
        <div id="mapel-container">

            <div class="row mt-4 g-4">

                <?php if (!empty($mapel)): ?>
                    <?php foreach ($mapel as $index => $m): ?>

                        <div class="col-md-3">

                            <div class="dashboard-card <?= $bgColors[$index % count($bgColors)] ?> mapel-card"
                                data-id="<?= esc($m['id_mapel']) ?>"
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
                <?php else: ?>

                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fa-solid fa-book"></i>
                            <p>Belum ada mata pelajaran.</p>
                        </div>
                    </div>

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
                                    <option value="<?= esc($g['nama']); ?>">
                                        <?= esc($g['nama']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>
                    </span>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Mapel
                </button>

            </form>

        </div>

        <!-- DETAIL MAPEL -->
        <div id="mapel-detail" style="display:none;">

            <!-- NAVIGASI DETAIL -->
            <div class="navbar-pertemuan mb-4">

                <button class="btn action-btn action-success mb-2" id="btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </button>

                <button class="btn action-btn action-success mb-2" id="btn-tambah">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Pertemuan
                </button>

                <button class="btn action-btn action-success mb-2" id="btn-buat-soal">
                    <i class="fa-solid fa-clipboard-question"></i>
                    Buat Soal
                </button>

                <button class="btn action-btn action-success mb-2" id="btn-lihat">
                    <i class="fa-solid fa-book"></i>
                    Lihat Pertemuan
                </button>

            </div>

            <!-- CONTAINER PERTEMUAN -->
            <div id="con-pertemuan">

                <div class="accordion" id="accordionPertemuan">

                    <?php if (!empty($materi)): ?>
                        <?php foreach ($materi as $key => $m): ?>

                            <div class="accordion-item materi-card"
                                data-id-mapel="<?= esc($m['id_mapel']) ?>">

                                <h2 class="accordion-header" id="heading<?= $key ?>">
                                    <button class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?= $key ?>"
                                        aria-expanded="false">

                                        <?= 'Pertemuan ke-' . esc($m['pertemuan']) ?>

                                    </button>
                                </h2>

                                <div id="collapse<?= $key ?>"
                                    class="accordion-collapse collapse"
                                    data-bs-parent="#accordionPertemuan">

                                    <div class="accordion-body">

                                        <h5><?= esc($m['nama_mapel']) ?></h5>

                                        <p>
                                            <strong>Guru:</strong>
                                            <?= esc($m['created_by']) ?>
                                        </p>

                                        <p>
                                            <strong>Kelas:</strong>
                                            <?= esc($m['kelas']) ?>
                                        </p>

                                        <div class="d-flex gap-2 flex-wrap">

                                            <a href="<?= site_url('materi/' . $m['file_mapel']) ?>"
                                                target="_blank"
                                                class="btn btn-primary btn-sm">

                                                <i class="fa-solid fa-file-arrow-down"></i>
                                                Download Materi

                                            </a>

                                            <button type="button"
                                                class="btn btn-success btn-sm btn-lihat-soal"
                                                data-id-mapel="<?= esc($m['id_mapel']) ?>"
                                                data-mapel="<?= esc($m['nama_mapel']) ?>"
                                                data-kelas="<?= esc($m['kelas']) ?>"
                                                data-pertemuan="<?= esc($m['pertemuan']) ?>">

                                                <i class="fa-solid fa-list-check"></i>
                                                Lihat Soal

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="empty-state">
                            <i class="fa-solid fa-book-open"></i>
                            <p>Tidak ada pertemuan untuk mata pelajaran ini.</p>
                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <!-- CONTAINER LIHAT SOAL -->
            <div id="con-lihat-soal" style="display:none;">

                <div class="table-toolbar mb-4">

                    <div class="toolbar-left">
                        <small class="text-muted" id="info-soal-pertemuan">
                            Daftar soal yang harus dikerjakan siswa
                        </small>
                    </div>

                    <div class="toolbar-right">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Cari soal..."
                            onkeyup="searchTable(this, 'table-soal-pertemuan')"
                            style="max-width: 220px;">

                        <button class="btn btn-secondary" id="btn-kembali-pertemuan">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali
                        </button>
                    </div>

                </div>

                <div class="row mt-4 g-4">

                    <div class="col-md-4">
                        <div class="dashboard-card bg1">
                            <div class="card-wave"></div>
                            <h5>Mata Pelajaran</h5>
                            <h2 id="soal-mapel-card">-</h2>
                            <i class="fa-solid fa-book"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card bg2">
                            <div class="card-wave"></div>
                            <h5>Pertemuan</h5>
                            <h2 id="soal-pertemuan-card">-</h2>
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card bg3">
                            <div class="card-wave"></div>
                            <h5>Total Soal</h5>
                            <h2 id="soal-total-card">0</h2>
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                    </div>

                </div>

                <div class="table-responsive mt-4">

                    <table class="table table-hover" id="table-soal-pertemuan">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Ujian</th>
                                <th>Mapel</th>
                                <th>Kelas</th>
                                <th>Pertemuan</th>
                                <th>Tipe Soal</th>
                                <th>Durasi</th>
                                <th>Jumlah Soal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($tugasUji)): ?>
                                <?php $no = 1; ?>

                                <?php foreach ($tugasUji as $t): ?>

                                    <tr class="row-tugas-soal"
                                        data-id-mapel="<?= esc($t['id_mapel']) ?>"
                                        data-pertemuan="<?= esc($t['pertemuan']) ?>"
                                        data-jumlah-soal="<?= esc($t['jumlah_soal'] ?? 0) ?>">

                                        <td><?= $no++; ?></td>

                                        <td>
                                            <strong>
                                                <?= !empty($t['judul']) ? esc($t['judul']) : 'Tanpa Judul'; ?>
                                            </strong>
                                        </td>

                                        <td>
                                            <?= !empty($t['nama_mapel']) ? esc($t['nama_mapel']) : '<span class="text-muted">-</span>'; ?>
                                        </td>

                                        <td>
                                            <?= !empty($t['kelas']) ? esc($t['kelas']) : '<span class="text-muted">-</span>'; ?>
                                        </td>

                                        <td>
                                            Pertemuan <?= !empty($t['pertemuan']) ? esc($t['pertemuan']) : '-'; ?>
                                        </td>

                                        <td>
                                            <?php if (($t['tipe_soal'] ?? '') == 'pg'): ?>
                                                <span class="badge-soft primary">Pilihan Ganda</span>
                                            <?php elseif (($t['tipe_soal'] ?? '') == 'esai'): ?>
                                                <span class="badge-soft warning">Esai</span>
                                            <?php else: ?>
                                                <span class="badge-soft danger">Belum jelas</span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?= !empty($t['durasi']) ? esc($t['durasi']) . ' menit' : '<span class="text-muted">-</span>'; ?>
                                        </td>

                                        <td>
                                            <span class="badge-soft success">
                                                <?= esc($t['jumlah_soal'] ?? 0); ?> soal
                                            </span>
                                        </td>

                                        <td>
                                            <div class="action-table">

                                                <button class="btn btn-sm btn-primary" title="Detail Soal">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>

                                                <button class="btn btn-sm btn-warning" title="Edit Soal">
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

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="9">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-clipboard-question"></i>
                                            <p>Belum ada soal yang dibuat.</p>
                                        </div>
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- CONTAINER TAMBAH PERTEMUAN -->
            <div id="con-tambah-pertemuan">

                <form action="<?= base_url('materi') ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <input type="hidden"
                        name="id_mapel"
                        class="detail_id_mapel">

                    <div class="profile-row">
                        <span class="label">Nama Mapel</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text"
                                name="nama_mapel"
                                class="form-control detail_mapel"
                                readonly>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Pengajar</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text"
                                name="guru"
                                class="form-control detail_guru"
                                readonly>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Kelas</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text"
                                name="kelas"
                                class="form-control detail_kelas"
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

            <!-- CONTAINER BUAT SOAL -->
            <div id="con-buat-soal">

                <form id="formUjian">

                    <input type="hidden"
                        name="id_mapel"
                        class="detail_id_mapel">

                    <div class="profile-row">
                        <span class="label">Judul Ujian</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text"
                                name="judul"
                                class="form-control"
                                required>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Tipe Soal</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <select name="tipe_soal"
                                class="form-control"
                                required>

                                <option value="">-- Pilih Tipe Soal --</option>
                                <option value="pg">Pilihan Ganda</option>
                                <option value="esai">Esai</option>

                            </select>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Pertemuan</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <select name="pertemuan"
                                class="form-control"
                                required>

                                <option value="">-- Pilih Pertemuan --</option>

                                <?php for ($i = 1; $i <= 23; $i++): ?>
                                    <option value="<?= $i ?>">
                                        Pertemuan <?= $i ?>
                                    </option>
                                <?php endfor; ?>

                            </select>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Durasi</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="number"
                                name="durasi"
                                class="form-control"
                                min="1"
                                required>
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        Buat Ujian
                    </button>

                </form>

            </div>

            <!-- CONTAINER INPUT SOAL -->
            <div id="container-soal" style="display:none;">

                <hr>

                <h4>Daftar Soal</h4>

                <input type="hidden" id="id_mapel">

                <div id="list-soal"></div>

                <button type="button"
                    class="btn btn-success"
                    onclick="tambahSoal()">

                    Tambah Soal

                </button>

                <button type="button"
                    class="btn btn-primary"
                    onclick="simpanSoal()">

                    Simpan Semua Soal

                </button>

            </div>

        </div>

    </div>
</div>

<script>
    let nomorSoal = 0;
    let tipeSoalAktif = '';

    const formUjian = document.getElementById('formUjian');

    if (formUjian) {
        formUjian.addEventListener('submit', function(e) {

            e.preventDefault();

            const formData = new FormData(this);

            fetch("<?= base_url('soaluji/simpan') ?>", {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {

                    if (result.status) {

                        document.getElementById('id_mapel').value =
                            formData.get('id_mapel');

                        tipeSoalAktif =
                            formData.get('tipe_soal');

                        document.getElementById('formUjian')
                            .style.display = 'none';

                        document.getElementById('container-soal')
                            .style.display = 'block';

                        document.getElementById('list-soal')
                            .innerHTML = '';

                        nomorSoal = 0;

                        if (tipeSoalAktif === 'pg') {
                            tambahSoalPG();
                        } else {
                            tambahSoalEssay();
                        }

                    } else {
                        alert('Gagal membuat ujian');
                    }

                })
                .catch(error => {
                    console.error(error);
                    alert('Terjadi kesalahan saat membuat ujian');
                });

        });
    }

    function tambahSoalPG() {

        nomorSoal++;

        let html = `
            <div class="card p-3 mb-3 soal-item">

                <h5>Soal PG ${nomorSoal}</h5>

                <textarea
                    class="form-control mb-2 soal"
                    placeholder="Masukkan pertanyaan"
                    rows="3"></textarea>

                <input
                    type="text"
                    class="form-control mb-2 a"
                    placeholder="Jawaban A">

                <input
                    type="text"
                    class="form-control mb-2 b"
                    placeholder="Jawaban B">

                <input
                    type="text"
                    class="form-control mb-2 c"
                    placeholder="Jawaban C">

                <input
                    type="text"
                    class="form-control mb-2 d"
                    placeholder="Jawaban D">

                <select class="form-control kunci">
                    <option value="">Pilih Kunci Jawaban</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>

            </div>
        `;

        document.getElementById('list-soal')
            .insertAdjacentHTML('beforeend', html);

    }

    function tambahSoalEssay() {

        nomorSoal++;

        let html = `
            <div class="card p-3 mb-3 soal-item">

                <h5>Soal Essay ${nomorSoal}</h5>

                <textarea
                    class="form-control mb-2 soal"
                    placeholder="Masukkan pertanyaan essay"
                    rows="4"></textarea>

            </div>
        `;

        document.getElementById('list-soal')
            .insertAdjacentHTML('beforeend', html);

    }

    function tambahSoal() {

        if (tipeSoalAktif === 'pg') {
            tambahSoalPG();
        } else if (tipeSoalAktif === 'esai') {
            tambahSoalEssay();
        } else {
            alert('Tipe soal belum dipilih');
        }

    }

    function simpanSoal() {

        const idMapel =
            document.getElementById('id_mapel').value;

        let dataSoal = [];

        document.querySelectorAll('.soal-item')
            .forEach(item => {

                dataSoal.push({

                    soal: item.querySelector('.soal')?.value || '',

                    a: item.querySelector('.a')?.value || '',
                    b: item.querySelector('.b')?.value || '',
                    c: item.querySelector('.c')?.value || '',
                    d: item.querySelector('.d')?.value || '',

                    kunci: item.querySelector('.kunci')?.value || ''

                });

            });

        fetch("<?= base_url('soaluji/simpanSoal') ?>", {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({

                    id_mapel: idMapel,
                    soal: dataSoal

                })

            })
            .then(res => res.json())
            .then(result => {

                if (result.status) {

                    alert('Semua soal berhasil disimpan');

                    document.getElementById('list-soal')
                        .innerHTML = '';

                    nomorSoal = 0;

                } else {
                    alert('Gagal menyimpan soal');
                }

            })
            .catch(error => {
                console.error(error);
                alert('Terjadi kesalahan saat menyimpan soal');
            });

    }

    document.addEventListener('DOMContentLoaded', function() {

        const btnTambah = document.getElementById('btn-tambah');
        const btnLihat = document.getElementById('btn-lihat');
        const btnBuatSoal = document.getElementById('btn-buat-soal');
        const btnBack = document.getElementById('btn-back');
        const btnKembaliPertemuan = document.getElementById('btn-kembali-pertemuan');

        const conPertemuan = document.getElementById('con-pertemuan');
        const conTambahPertemuan = document.getElementById('con-tambah-pertemuan');
        const conBuatSoal = document.getElementById('con-buat-soal');
        const conLihatSoal = document.getElementById('con-lihat-soal');
        const containerSoal = document.getElementById('container-soal');

        function hideAllDetailContent() {
            conPertemuan.style.display = 'none';
            conTambahPertemuan.style.display = 'none';
            conBuatSoal.style.display = 'none';
            conLihatSoal.style.display = 'none';
            containerSoal.style.display = 'none';
        }

        conPertemuan.style.display = 'block';
        conTambahPertemuan.style.display = 'none';
        conBuatSoal.style.display = 'none';
        conLihatSoal.style.display = 'none';
        containerSoal.style.display = 'none';

        btnTambah.addEventListener('click', function() {
            hideAllDetailContent();
            conTambahPertemuan.style.display = 'block';
        });

        btnLihat.addEventListener('click', function() {
            hideAllDetailContent();
            conPertemuan.style.display = 'block';
        });

        btnBuatSoal.addEventListener('click', function() {
            hideAllDetailContent();

            if (formUjian) {
                formUjian.style.display = 'block';
            }

            conBuatSoal.style.display = 'block';
        });

        document.querySelectorAll('.mapel-card').forEach(card => {

            card.addEventListener('click', function() {

                const idMapel = this.dataset.id;
                const namaMapel = this.dataset.mapel;
                const kelas = this.dataset.kelas;
                const guru = this.dataset.guru;

                document.querySelectorAll('.detail_id_mapel')
                    .forEach(el => {
                        el.value = idMapel;
                    });

                document.querySelectorAll('.detail_mapel')
                    .forEach(el => {
                        el.value = namaMapel;
                    });

                document.querySelectorAll('.detail_kelas')
                    .forEach(el => {
                        el.value = kelas;
                    });

                document.querySelectorAll('.detail_guru')
                    .forEach(el => {
                        el.value = guru;
                    });

                document.querySelectorAll('.materi-card')
                    .forEach(item => {

                        if (item.dataset.idMapel == idMapel) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }

                    });

                document.getElementById('mapel-container')
                    .style.display = 'none';

                document.getElementById('mapel-detail')
                    .style.display = 'block';

                hideAllDetailContent();
                conPertemuan.style.display = 'block';

            });

        });

        document.querySelectorAll('.btn-lihat-soal').forEach(button => {

            button.addEventListener('click', function() {

                const idMapel = this.dataset.idMapel;
                const namaMapel = this.dataset.mapel;
                const kelas = this.dataset.kelas;
                const pertemuan = this.dataset.pertemuan;

                let totalSoal = 0;
                let totalUjian = 0;

                document.querySelectorAll('.row-tugas-soal').forEach(row => {

                    if (
                        row.dataset.idMapel == idMapel &&
                        row.dataset.pertemuan == pertemuan
                    ) {
                        row.style.display = '';
                        totalUjian++;
                        totalSoal += Number(row.dataset.jumlahSoal || 0);
                    } else {
                        row.style.display = 'none';
                    }

                });

                document.getElementById('soal-mapel-card').innerText =
                    namaMapel;

                document.getElementById('soal-pertemuan-card').innerText =
                    pertemuan;

                document.getElementById('soal-total-card').innerText =
                    totalSoal;

                document.getElementById('info-soal-pertemuan').innerText =
                    'Daftar soal ' + namaMapel + ' kelas ' + kelas + ' untuk pertemuan ke-' + pertemuan;

                hideAllDetailContent();
                conLihatSoal.style.display = 'block';

            });

        });

        btnKembaliPertemuan.addEventListener('click', function() {
            hideAllDetailContent();
            conPertemuan.style.display = 'block';
        });

        btnBack.addEventListener('click', function() {

            document.getElementById('mapel-detail')
                .style.display = 'none';

            document.getElementById('mapel-container')
                .style.display = 'block';

            hideAllDetailContent();
            conPertemuan.style.display = 'block';

        });

    });
</script>