<?= $this->include('content/headstyle') ?>

<body>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="logo">
            <img src="<?= base_url('image/unpam logo.png') ?>"
                alt=""
                style="width: 50px; height: auto;">
            SMPN 2
        </div>

        <ul>

            <li>
                <a href="#" onclick="showPage('dashboard')">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="#" onclick="showPage('data_siswa')">
                    <i class="fa-solid fa-users"></i>
                    Data Siswa
                </a>
            </li>

            <li>
                <a href="#" onclick="showPage('data_guru')">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    Data Guru
                </a>
            </li>

            <li>
                <a href="#" onclick="showPage('mapel')">
                    <i class="fa-solid fa-book"></i>
                    Mata Pelajaran
                </a>
            </li>

            <li>
                <a href="#" onclick="showPage('absensi')">
                    <i class="fa-solid fa-clipboard-check"></i>
                    Absensi
                </a>
            </li>

            <li>
                <a href="<?= base_url('/logout') ?>">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </a>
            </li>

        </ul>

    </div>


    <!-- CONTENT -->

    <div id="dashboard" class="content-page">
        <?= $this->include('navigation/mainContent') ?>
    </div>

    <div id="data_siswa" class="content-page">
        <?= $this->include('navigation/dataSiswa') ?>
    </div>

    <div id="data_guru" class="content-page">
        <h1>Data Guru</h1>
    </div>

    <div id="mapel" class="content-page">
        <h1>Mata Pelajaran</h1>
    </div>

    <div id="absensi" class="content-page">
        <h1>Absensi</h1>
    </div>


    <!-- JAVASCRIPT -->
    <script>
        function showPage(pageId) {

            // Ambil semua halaman
            const pages = document.querySelectorAll('.content-page');

            // Sembunyikan semua halaman
            pages.forEach(page => {
                page.style.display = 'none';
            });

            // Tampilkan halaman yang dipilih
            document.getElementById(pageId).style.display = 'block';
        }

        // Halaman pertama yang tampil
        showPage('dashboard');
    </script>

</body>

</html>