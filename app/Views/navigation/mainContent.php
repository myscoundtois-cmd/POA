<!-- Main Content -->
<div class="main-content">

    <!-- Navbar -->
    <?= $this->include('content/navbar') ?>

    <!-- Cards -->
    <div class="row mt-4 g-4">

        <div class="col-md-3">
            <div class="dashboard-card bg1">
                <div class="card-wave"></div>

                <h5>Total Siswa</h5>
                <h2>1.250</h2>

                <i class="fa-solid fa-user-graduate"></i>

            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card bg2">
                <div class="card-wave"></div>

                <h5>Total Guru</h5>
                <h2>85</h2>

                <i class="fa-solid fa-chalkboard-user"></i>

            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card bg3">
                <div class="card-wave"></div>
                <h5>Total Kelas</h5>
                <h2>35</h2>

                <i class="fa-solid fa-school"></i>

            </div>
        </div>

        <div class="col-md-3">
            <div class="dashboard-card bg4">
                <div class="card-wave"></div>

                <h5>Tugas Aktif</h5>
                <h2>120</h2>

                <i class="fa-solid fa-book-open"></i>

            </div>
        </div>

    </div>


    <!-- quick action -->
    <div class="quick-action">

        <a href="#" class="action-btn action-primary">
            <i class="fa-solid fa-user-plus"></i>
            Tambah Siswa
        </a>

        <a href="#" class="action-btn action-success">
            <i class="fa-solid fa-plus"></i>
            Tambah Guru
        </a>

        <a href="#" class="action-btn action-warning">
            <i class="fa-solid fa-book"></i>
            Tambah Mapel
        </a>

    </div>


    <!-- Table -->
    <div class="table-section">

        <h5 class="mb-4">Data Siswa Terbaru</h5>

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