<div class="main-content">
    <?= $this->include('content/navbar') ?>
    <div class="table-section">

        <h5 class="mb-4">Data Guru</h5>

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Nilai</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Budi Santoso</td>
                        <td>9A</td>
                        <td>
                            <span class="status aktif">
                                Aktif
                            </span>
                        </td>
                        <td>90</td>
                    </tr>

                    <tr>
                        <td>Siti Aisyah</td>
                        <td>8B</td>
                        <td>
                            <span class="status aktif">
                                Aktif
                            </span>
                        </td>
                        <td>88</td>
                    </tr>

                    <tr>
                        <td>Rahmat</td>
                        <td>7C</td>
                        <td>
                            <span class="status nonaktif">
                                Nonaktif
                            </span>
                        </td>
                        <td>70</td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>
</div>