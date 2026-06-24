<div class="main-content">

    <?php
    $roleSoal = session()->get('role');
    $canJawabSoal = $roleSoal === 'murid';
    $canEditSoal = in_array($roleSoal, ['admin', 'guru']);
    ?>


    <div class="table-section">

        <div class="table-toolbar mb-4">
            <div class="toolbar-left">
                <button type="button" class="btn btn-secondary" onclick="history.back()">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </button>
            </div>
            <div class="toolbar-right">
                <small class="text-muted">Kelola soal dan kunci jawaban secara ringkas</small>
            </div>
        </div>

        <?php if (!empty($soal)): ?>

            <h4 class="mb-4">
                Pertemuan Ke-<?= esc($soal[0]['pertemuan']) ?>
                <?= esc($soal[0]['judul']) ?>
            </h4>

            <form id="formSoal"
                action="<?= base_url('murid/simpanJawaban') ?>"
                method="post">

                <?php foreach ($soal as $index => $row): ?>

                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <input type="hidden"
                                name="id_mapel[]"
                                value="<?= $row['id_mapel'] ?>">

                            <input type="hidden"
                                name="id_soal[]"
                                value="<?= $row['id_soal'] ?>">

                            <!-- PERTANYAAN -->

                            <h6 class="mb-3 view-mode">
                                <?= ($index + 1) ?>.
                                <?= esc($row['pertanyaan']) ?>
                            </h6>

                            <textarea
                                class="form-control edit-mode d-none mb-3"
                                name="pertanyaan[<?= $row['id_soal'] ?>]"
                                rows="3"><?= esc($row['pertanyaan']) ?></textarea>

                            <!-- GAMBAR -->

                            <?php if (!empty($row['gambar'])): ?>
                                <img
                                    src="<?= base_url('uploads/soal/' . $row['gambar']) ?>"
                                    class="img-fluid rounded mb-3"
                                    >
                            <?php endif; ?>

                            <!-- PILIHAN GANDA -->

                            <?php if ($row['tipe_soal'] == 'pg'): ?>

                                <!-- A -->

                                <div class="mb-2">

                                    <div class="view-mode">
                                        <input class="form-check-input"
                                            type="radio"
                                            <?= !$canJawabSoal ? 'disabled' : '' ?>
                                            name="jawaban[<?= $row['id_soal'] ?>]"
                                            value="A">

                                        <label class="form-check-label">
                                            A. <?= esc($row['opsi_a']) ?>
                                        </label>
                                    </div>

                                    <input
                                        type="text"
                                        class="form-control edit-mode d-none bg-light"
                                        readonly
                                        name="opsi_a[<?= $row['id_soal'] ?>]"
                                        value="<?= esc($row['opsi_a']) ?>">
                                </div>

                                <!-- B -->

                                <div class="mb-2">

                                    <div class="view-mode">
                                        <input class="form-check-input"
                                            type="radio"
                                            <?= !$canJawabSoal ? 'disabled' : '' ?>
                                            name="jawaban[<?= $row['id_soal'] ?>]"
                                            value="B">

                                        <label class="form-check-label">
                                            B. <?= esc($row['opsi_b']) ?>
                                        </label>
                                    </div>

                                    <input
                                        type="text"
                                        class="form-control edit-mode d-none bg-light"
                                        readonly
                                        name="opsi_b[<?= $row['id_soal'] ?>]"
                                        value="<?= esc($row['opsi_b']) ?>">
                                </div>

                                <!-- C -->

                                <div class="mb-2">

                                    <div class="view-mode">
                                        <input class="form-check-input"
                                            type="radio"
                                            <?= !$canJawabSoal ? 'disabled' : '' ?>
                                            name="jawaban[<?= $row['id_soal'] ?>]"
                                            value="C">

                                        <label class="form-check-label">
                                            C. <?= esc($row['opsi_c']) ?>
                                        </label>
                                    </div>

                                    <input
                                        type="text"
                                        class="form-control edit-mode d-none bg-light"
                                        readonly
                                        name="opsi_c[<?= $row['id_soal'] ?>]"
                                        value="<?= esc($row['opsi_c']) ?>">
                                </div>

                                <!-- D -->

                                <div class="mb-2">

                                    <div class="view-mode">
                                        <input class="form-check-input"
                                            type="radio"
                                            <?= !$canJawabSoal ? 'disabled' : '' ?>
                                            name="jawaban[<?= $row['id_soal'] ?>]"
                                            value="D">

                                        <label class="form-check-label">
                                            D. <?= esc($row['opsi_d']) ?>
                                        </label>
                                    </div>

                                    <input
                                        type="text"
                                        class="form-control edit-mode d-none bg-light"
                                        readonly
                                        name="opsi_d[<?= $row['id_soal'] ?>]"
                                        value="<?= esc($row['opsi_d']) ?>">
                                </div>

                                <!-- KUNCI -->

                                <div class="edit-mode d-none mt-3">

                                    <label class="form-label">
                                        Kunci Jawaban
                                    </label>

                                    <select
                                        class="form-select"
                                        name="kunci[<?= $row['id_soal'] ?>]">

                                        <option value="A" <?= $row['kunci'] == 'A' ? 'selected' : '' ?>>
                                            A
                                        </option>

                                        <option value="B" <?= $row['kunci'] == 'B' ? 'selected' : '' ?>>
                                            B
                                        </option>

                                        <option value="C" <?= $row['kunci'] == 'C' ? 'selected' : '' ?>>
                                            C
                                        </option>

                                        <option value="D" <?= $row['kunci'] == 'D' ? 'selected' : '' ?>>
                                            D
                                        </option>

                                    </select>

                                </div>

                            <?php elseif ($row['tipe_soal'] == 'esai'): ?>

                                <div class="view-mode">
                                    <textarea
                                        class="form-control"
                                        rows="4"
                                        placeholder="Tulis jawaban Anda"
                                        <?= !$canJawabSoal ? 'disabled' : '' ?>
                                        name="jawabanEssay[<?= $row['id_soal'] ?>]"></textarea>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div>

                <?php endforeach; ?>

                <div class="d-flex gap-2 mt-4">

                    <?php if ($canJawabSoal): ?>
                        <button
                            type="submit"
                            id="btnJawab"
                            class="btn btn-primary">
                            Simpan Semua Jawaban
                        </button>
                    <?php endif; ?>

                    <?php if ($canEditSoal): ?>

                        <button
                            type="button"
                            id="btnEdit"
                            class="btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit Soal dan Kunci
                        </button>

                        <button
                            type="button"
                            id="btnCancelEdit"
                            class="btn btn-secondary d-none">
                            <i class="fa-solid fa-arrow-left"></i>
                            Batal Edit
                        </button>

                        <button
                            type="submit"
                            id="btnUpdate"
                            formaction="<?= base_url('soal/update') ?>"
                            class="btn btn-success d-none">
                            <i class="fa-solid fa-floppy-disk"></i>
                            Simpan Perubahan
                        </button>

                    <?php endif; ?>

                </div>

            </form>

        <?php else: ?>

            <div class="alert alert-info">
                Belum ada soal untuk mapel ini.
            </div>

        <?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const btnEdit = document.getElementById('btnEdit');
        const btnCancelEdit = document.getElementById('btnCancelEdit');
        const btnJawab = document.getElementById('btnJawab');
        const btnUpdate = document.getElementById('btnUpdate');

        if (btnEdit) {

            btnEdit.addEventListener('click', function() {

                document.querySelectorAll('.view-mode').forEach(el => {
                    el.classList.add('d-none');
                });

                document.querySelectorAll('.edit-mode').forEach(el => {
                    el.classList.remove('d-none');
                });

                if (btnJawab) {
                    btnJawab.classList.add('d-none');
                }

                if (btnUpdate) {
                    btnUpdate.classList.remove('d-none');
                }

                if (btnCancelEdit) {
                    btnCancelEdit.classList.remove('d-none');
                }

                btnEdit.classList.add('d-none');
            });

        }

        if (btnCancelEdit) {
            btnCancelEdit.addEventListener('click', function() {
                document.querySelectorAll('.view-mode').forEach(el => {
                    el.classList.remove('d-none');
                });

                document.querySelectorAll('.edit-mode').forEach(el => {
                    el.classList.add('d-none');
                });

                if (btnJawab) {
                    btnJawab.classList.remove('d-none');
                }

                if (btnUpdate) {
                    btnUpdate.classList.add('d-none');
                }

                btnEdit.classList.remove('d-none');
                btnCancelEdit.classList.add('d-none');
            });
        }

    });
</script>