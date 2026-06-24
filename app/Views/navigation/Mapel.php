<div class="main-content">


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
                                data-guru="<?= esc($m['created_by']) ?>">

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

            <?php if (session('role') == 'admin'): ?>
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
            <?php endif; ?>
        </div>

        <!-- DETAIL MAPEL -->
        <div id="mapel-detail" class="is-hidden">

            <div class="navbar-pertemuan">

                <button class="btn action-btn action-success mb-4" id="btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </button>

                <button class="btn action-btn action-success mb-4" id="btn-lihat">
                    <i class="fa-solid fa-book"></i>
                    Lihat Pertemuan
                </button>

                <?php if (session('role') == 'admin' || session('role') == 'guru'): ?>
                    <button class="btn action-btn action-success mb-4" id="btn-tambah">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Pertemuan
                    </button>
                <?php endif; ?>

                <?php if (session('role') == 'guru'): ?>
                    <button class="btn action-btn action-success mb-4" id="btn-buat-soal">
                        <i class="fa-solid fa-clipboard-question"></i>
                        Buat Soal
                    </button>
                <?php endif; ?>
            </div>

            <div id="con-pertemuan">

                <div class="accordion" id="accordionPertemuan">

                    <?php if (!empty($materi)): ?>
                        <?php foreach ($materi as $key => $m): ?>

                            <div class="accordion-item materi-card"
                                data-id-mapel="<?= $m['id_mapel'] ?>">

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

                                        <div class="mapel-action-group">
                                            <a href="<?= site_url('materi/' . $m['file_mapel']) ?>"
                                                target="_blank"
                                                class="btn btn-warning btn-sm text-white mapel-mini-action">
                                                <i class="fa-solid fa-file-arrow-down"></i>
                                                Download Materi
                                            </a>

                                            <a href="<?= base_url('ReadSoal/' . $m['id_mapel']) . '/' . $m['pertemuan'] ?>"
                                                class="btn btn-primary btn-sm mapel-mini-action mapel-lihat-soal-btn">
                                                <i class="fa-solid fa-list"></i>
                                                Lihat Soal
                                            </a>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <p>Tidak ada pertemuan untuk mata pelajaran ini.</p>

                    <?php endif; ?>

                </div>
            </div>

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

            <div id="con-buat-soal">

                <div class="col-lg-5">
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

                        <div class="d-flex gap-2 flex-wrap mt-3">
                            <button type="button" class="btn btn-secondary" onclick="kembaliKePertemuanMapel()">
                                <i class="fa-solid fa-arrow-left"></i>
                                Kembali
                            </button>

                            <button type="submit" class="btn btn-primary">
                                Buat Ujian
                            </button>
                        </div>

                    </form>
                </div>
                <div class="col-lg-7">
                    <div class="table-section guru-mapel-card">
                        <div class="table-toolbar">
                            <div class="toolbar-left">
                                <h5 class="mb-0">Mata Pelajaran yang Dikelola</h5>
                            </div>
                            <div class="toolbar-right">
                                <small class="text-muted">Ringkasan mapel dan kelas</small>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Soal</th>
                                        <th>Pertemuan</th>
                                        <th>Tipe Soal</th>
                                        <th>Durasi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($JudulTugas)): ?>
                                        <?php foreach ($JudulTugas as $i => $row): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= esc($row['judul']) ?></td>
                                                <td>Pertemuan <?= esc($row['pertemuan']) ?></td>
                                                <td><?= esc($row['tipe_soal']) ?></td>
                                                <td><?= esc($row['durasi']) ?> Menit</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa-solid fa-plus"></i>
                                                        Buat Soal
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">
                                                <div class="empty-state">
                                                    <i class="fa-solid fa-clipboard-check"></i>
                                                    <p>Belum ada soal yang dibuat.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="container-soal" class="is-hidden">

                <hr>

                <h4>Daftar Soal</h4>

                <input type="hidden" id="id_mapel">

                <div id="list-soal"></div>

                <button type="button"
                    class="btn btn-secondary mb-2"
                    onclick="kembaliKeFormUjianMapel()">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Form Ujian
                </button>

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

    document.getElementById('formUjian').addEventListener('submit', function(e) {

        e.preventDefault();

        const formData = new FormData(this);

        fetch("<?= base_url('soaluji/simpan') ?>", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(result => {

                console.log(result);

                if (result.status) {

                    // simpan id mapel
                    document.getElementById('id_mapel').value =
                        formData.get('id_mapel');

                    // simpan tipe soal
                    tipeSoalAktif =
                        formData.get('tipe_soal');

                    // sembunyikan form ujian
                    document.getElementById('formUjian')
                        .style.display = 'none';

                    // tampilkan container soal
                    document.getElementById('container-soal')
                        .style.display = 'block';

                    // kosongkan soal lama
                    document.getElementById('list-soal')
                        .innerHTML = '';

                    nomorSoal = 0;

                    // buat soal pertama
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

    function tambahSoalPG() {

        nomorSoal++;

        let html = `
    <div class="card p-3 mb-3 soal-item">

        <h5>Soal PG ${nomorSoal}</h5>

        <label class="mb-1">Gambar Soal (Opsional)</label>

        <input
            type="text"
            class="id_mapel">

        <input
            type="file"
            class="form-control mb-2 gambar"
            accept="image/*">

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

        <label class="mb-1">Gambar Soal (Opsional)</label>
        <input
            type="file"
            class="form-control mb-2 gambar"
            accept="image/*">

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

        const formData = new FormData();

        const idMapel = document.getElementById('id_mapel').value;
        const pertemuan = document.querySelector('#formUjian select[name="pertemuan"]').value;

        formData.append('id_mapel', idMapel);
        formData.append('pertemuan', pertemuan);
        formData.append('tipe_soal', tipeSoalAktif);

        const items = document.querySelectorAll('.soal-item');

        formData.append('jumlah_soal', items.length);

        items.forEach((item, i) => {

            formData.append('soal_' + i, item.querySelector('.soal').value);

            if (tipeSoalAktif === 'pg') {

                formData.append('a_' + i, item.querySelector('.a')?.value || '');
                formData.append('b_' + i, item.querySelector('.b')?.value || '');
                formData.append('c_' + i, item.querySelector('.c')?.value || '');
                formData.append('d_' + i, item.querySelector('.d')?.value || '');
                formData.append('kunci_' + i, item.querySelector('.kunci')?.value || '');
            }

            const gambar = item.querySelector('.gambar');

            if (gambar && gambar.files.length > 0) {
                formData.append('gambar_' + i, gambar.files[0]);
            }
        });

        fetch("<?= base_url('soaluji/simpanSoal') ?>", {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(result => {
                if (result.status) {
                    alert('Berhasil disimpan');
                    document.getElementById('list-soal').innerHTML = '';
                    nomorSoal = 0;
                } else {
                    alert(result.message);
                }
            });
    }

    function kembaliKePertemuanMapel() {
        const conPertemuan = document.getElementById('con-pertemuan');
        const conTambahPertemuan = document.getElementById('con-tambah-pertemuan');
        const conBuatSoal = document.getElementById('con-buat-soal');
        const containerSoal = document.getElementById('container-soal');
        const formUjian = document.getElementById('formUjian');

        if (conPertemuan) conPertemuan.style.display = 'block';
        if (conTambahPertemuan) conTambahPertemuan.style.display = 'none';
        if (conBuatSoal) conBuatSoal.style.display = 'none';
        if (containerSoal) containerSoal.style.display = 'none';
        if (formUjian) formUjian.style.display = 'block';
    }

    function kembaliKeFormUjianMapel() {
        const containerSoal = document.getElementById('container-soal');
        const formUjian = document.getElementById('formUjian');

        if (containerSoal) containerSoal.style.display = 'none';
        if (formUjian) formUjian.style.display = 'block';
    }

    document.addEventListener('DOMContentLoaded', function() {

        const btnLihat = document.getElementById('btn-lihat');
        const btnTambah = document.getElementById('btn-tambah');
        const btnBuatSoal = document.getElementById('btn-buat-soal');
        const btnBack = document.getElementById('btn-back');

        const conPertemuan = document.getElementById('con-pertemuan');
        const conTambahPertemuan = document.getElementById('con-tambah-pertemuan');
        const conBuatSoal = document.getElementById('con-buat-soal');

        // Set tampilan awal jika elemen ada
        if (conPertemuan) {
            conPertemuan.style.display = 'block';
        }

        if (conTambahPertemuan) {
            conTambahPertemuan.style.display = 'none';
        }

        if (conBuatSoal) {
            conBuatSoal.style.display = 'none';
        }

        // Tombol Tambah Pertemuan
        if (btnTambah) {
            btnTambah.addEventListener('click', function() {

                if (conPertemuan) {
                    conPertemuan.style.display = 'none';
                }

                if (conBuatSoal) {
                    conBuatSoal.style.display = 'none';
                }

                if (conTambahPertemuan) {
                    conTambahPertemuan.style.display = 'block';
                }

            });
        }

        // Tombol Lihat Pertemuan
        if (btnLihat) {
            btnLihat.addEventListener('click', function() {

                if (conPertemuan) {
                    conPertemuan.style.display = 'block';
                }

                if (conBuatSoal) {
                    conBuatSoal.style.display = 'none';
                }

                if (conTambahPertemuan) {
                    conTambahPertemuan.style.display = 'none';
                }

            });
        }

        // Tombol Buat Soal
        if (btnBuatSoal) {
            btnBuatSoal.addEventListener('click', function() {

                if (conPertemuan) {
                    conPertemuan.style.display = 'none';
                }

                if (conTambahPertemuan) {
                    conTambahPertemuan.style.display = 'none';
                }

                if (conBuatSoal) {
                    conBuatSoal.style.display = 'block';
                }

            });
        }

        // Klik Card Mata Pelajaran
        const cards = document.querySelectorAll('.mapel-card');

        cards.forEach(card => {

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

                const mapelContainer =
                    document.getElementById('mapel-container');

                const mapelDetail =
                    document.getElementById('mapel-detail');

                if (mapelContainer) {
                    mapelContainer.style.display = 'none';
                }

                if (mapelDetail) {
                    mapelDetail.style.display = 'block';
                }

            });

        });

        // Tombol Kembali
        if (btnBack) {

            btnBack.addEventListener('click', function() {

                const mapelDetail =
                    document.getElementById('mapel-detail');

                const mapelContainer =
                    document.getElementById('mapel-container');

                if (mapelDetail) {
                    mapelDetail.style.display = 'none';
                }

                if (mapelContainer) {
                    mapelContainer.style.display = 'block';
                }

            });

        }

    });
</script>