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

                <button class="btn action-btn action-success mb-4" id="btn-tambah">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Pertemuan
                </button>

                <button class="btn action-btn action-success mb-4" id="btn-buat-soal">
                    <i class="fa-solid fa-clipboard-question"></i>
                    Buat Soal
                </button>

                <button class="btn action-btn action-success mb-4" id="btn-lihat">
                    <i class="fa-solid fa-book"></i>
                    Lihat Pertemuan
                </button>
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

                                        <a href="<?= site_url('materi/' . $m['file_mapel']) ?>"
                                            target="_blank"
                                            class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-file-arrow-down"></i>
                                            Download Materi
                                        </a>

                                        <a href="<?= base_url('ReadSoal/' . $m['id_mapel']) . '/' . $m['pertemuan'] ?>"
                                            class="menu-link btn btn-success btn-sm">
                                            <i class="fa-solid fa-list-check"></i>
                                            Lihat Soal
                                        </a>

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

        const idMapel =
            document.getElementById('id_mapel').value;

        const pertemuan =
            document.querySelector(
                '#formUjian select[name="pertemuan"]'
            ).value;

        let dataSoal = [];

        document.querySelectorAll('.soal-item')
            .forEach(item => {

                if (tipeSoalAktif === 'pg') {

                    dataSoal.push({

                        soal: item.querySelector('.soal')?.value || '',

                        a: item.querySelector('.a')?.value || '',
                        b: item.querySelector('.b')?.value || '',
                        c: item.querySelector('.c')?.value || '',
                        d: item.querySelector('.d')?.value || '',

                        kunci: item.querySelector('.kunci')?.value || ''

                    });

                } else {

                    dataSoal.push({

                        soal: item.querySelector('.soal')?.value || ''

                    });

                }

            });

        console.log({
            id_mapel: idMapel,
            tipe_soal: tipeSoalAktif,
            pertemuan: pertemuan,
            soal: dataSoal
        });

        fetch("<?= base_url('soaluji/simpanSoal') ?>", {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json'
                },

                body: JSON.stringify({

                    id_mapel: idMapel,
                    tipe_soal: tipeSoalAktif,
                    pertemuan: pertemuan,
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

                    alert(result.message || 'Gagal menyimpan soal');

                }

            })
            .catch(error => {

                console.error(error);
                alert('Terjadi kesalahan saat menyimpan soal');

            });

    }

    document.addEventListener('DOMContentLoaded', function() {

        const btnTambah =
            document.getElementById('btn-tambah');

        const btnLihat =
            document.getElementById('btn-lihat');

        const btnBuatSoal =
            document.getElementById('btn-buat-soal');

        const conPertemuan =
            document.getElementById('con-pertemuan');

        const conTambahPertemuan =
            document.getElementById('con-tambah-pertemuan');

        const conBuatSoal =
            document.getElementById('con-buat-soal');

        conPertemuan.style.display = 'block';
        conTambahPertemuan.style.display = 'none';
        conBuatSoal.style.display = 'none';

        btnTambah.addEventListener('click', function() {

            conPertemuan.style.display = 'none';
            conBuatSoal.style.display = 'none';
            conTambahPertemuan.style.display = 'block';

        });

        btnLihat.addEventListener('click', function() {

            conPertemuan.style.display = 'block';
            conBuatSoal.style.display = 'none';
            conTambahPertemuan.style.display = 'none';

        });

        btnBuatSoal.addEventListener('click', function() {

            conPertemuan.style.display = 'none';
            conTambahPertemuan.style.display = 'none';
            conBuatSoal.style.display = 'block';

        });

        const cards =
            document.querySelectorAll('.mapel-card');

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

                document.getElementById('mapel-container')
                    .style.display = 'none';

                document.getElementById('mapel-detail')
                    .style.display = 'block';

            });

        });

        document.getElementById('btn-back')
            .addEventListener('click', function() {

                document.getElementById('mapel-detail')
                    .style.display = 'none';

                document.getElementById('mapel-container')
                    .style.display = 'block';

            });

    });
</script>