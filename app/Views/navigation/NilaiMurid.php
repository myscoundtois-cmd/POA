<div class="main-content">

    <div class="table-section">
        <div class="table-responsive">
            <form action="<?= base_url('/koreksi') ?>" method="post" enctype="multipart/form-data">

                <div class="table-toolbar">
                    <table class="table table-hover">
                        <?php if (!empty($detailNilai)): ?>
                            <input type="hidden" name="id_user" value="<?= $detailNilai['id_user'] ?>">
                            <input type="hidden" name="id_mapel" value="<?= $detailNilai['id_mapel'] ?>">
                            <input type="hidden" name="pertemuan" value="<?= $detailNilai['pertemuan'] ?>">
                            <input type="hidden" name="id_jawaban" value="<?= $detailNilai['id_jawaban'] ?>">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Pertemuan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td><?= esc($detailNilai['nama_siswa'] ?? '-') ?></td>

                                    <td>
                                        <?= esc($mapelDetail['nama_mapel'] ?? '-') ?>
                                    </td>

                                    <td><?= esc($detailNilai['pertemuan'] ?? '-') ?></td>

                                    <td><?= esc($detailNilai['nilai'] ?? '-') ?></td>
                                </tr>
                            </tbody>
                        <?php endif; ?>
                    </table>


                    <table class="table table-bordered">


                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban Siswa</th>
                                <th>Status B/S</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (!empty($detailSoal)): ?>

                                <?php foreach ($detailSoal as $i => $s): ?>

                                    <tr>

                                        <td><?= $i + 1 ?></td>

                                        <td>
                                            <?= esc($s['pertanyaan']) ?>
                                        </td>

                                        <td>

                                            <?php
                                            $jawaban =
                                                $jawabanParsed[$s['id_soal']] ?? '-';

                                            if ($s['tipe_soal'] == 'pg') {

                                                switch ($jawaban) {

                                                    case 'A':
                                                        echo 'A. ' . esc($s['opsi_a']);
                                                        break;

                                                    case 'B':
                                                        echo 'B. ' . esc($s['opsi_b']);
                                                        break;

                                                    case 'C':
                                                        echo 'C. ' . esc($s['opsi_c']);
                                                        break;

                                                    case 'D':
                                                        echo 'D. ' . esc($s['opsi_d']);
                                                        break;

                                                    default:
                                                        echo '-';
                                                }
                                            } else {

                                                echo esc(trim($jawaban, '[]'));
                                            }
                                            ?>

                                        </td>
                                        <?php if ($s['tipe_soal'] == 'pg'): ?>
                                            <td class="<?= ($jawaban == $s['kunci']) ? 'table-success' : 'table-danger' ?>">
                                                <?= esc($s['kunci']) ?>
                                            </td>
                                        <?php elseif ($s['tipe_soal'] == 'esai'): ?>
                                            <td>
                                                <div class="profile-row">
                                                    <span class="value">
                                                        <select
                                                            name="status[<?= $s['id_soal'] ?>]"
                                                            class="form-control"
                                                            required>
                                                            <option value="benar">Benar</option>
                                                            <option value="salah">Salah</option>
                                                        </select>
                                                    </span>
                                                </div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            Simpan Koreksi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>