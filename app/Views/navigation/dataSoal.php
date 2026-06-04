<div class="main-content">
    <?= $this->include('content/navbar') ?>
    <div class="table-section">
        <?php if (!empty($soal)): ?>

            <?php foreach ($soal as $index => $row): ?>

                <div class="mb-4">

                    <h6>
                        <?= ($index + 1) ?>.
                        <?= esc($row['pertanyaan']) ?>
                    </h6>

                    <hr>

                    <?php if ($row['tipe_soal'] == 'pg'): ?>

                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="jawaban[<?= $row['id_soal'] ?>]"
                                value="A">

                            <label class="form-check-label">
                                <?= esc($row['opsi_a']) ?>
                            </label>
                        </div>

                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="jawaban[<?= $row['id_soal'] ?>]"
                                value="B">

                            <label class="form-check-label">
                                <?= esc($row['opsi_b']) ?>
                            </label>
                        </div>

                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="jawaban[<?= $row['id_soal'] ?>]"
                                value="C">

                            <label class="form-check-label">
                                <?= esc($row['opsi_c']) ?>
                            </label>
                        </div>

                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="jawaban[<?= $row['id_soal'] ?>]"
                                value="D">

                            <label class="form-check-label">
                                <?= esc($row['opsi_d']) ?>
                            </label>
                        </div>

                    <?php elseif ($row['tipe_soal'] == 'esai'): ?>

                        <textarea
                            class="form-control"
                            name="jawaban[<?= $row['id_soal'] ?>]"
                            rows="4"
                            placeholder="Tulis jawaban Anda"></textarea>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p>Belum ada soal untuk mapel ini.</p>

        <?php endif; ?>
    </div>
</div>