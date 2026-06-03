<?php if (session()->getFlashdata('show_pgessay')): ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('mapel-container').style.display = 'none';
            document.getElementById('mapel-detail').style.display = 'block';

            document.getElementById('con-pertemuan').style.display = 'none';
            document.getElementById('con-tambah-pertemuan').style.display = 'none';
            document.getElementById('con-buat-soal').style.display = 'block';

            document.getElementById('pgessay').style.display = 'block';

        });
    </script>

<?php endif; ?>
<?= $this->include('content/headstyle') ?>

<body>

    <!-- =========================
        SIDEBAR
    ========================== -->

    <div class="sidebar">

        <!-- LOGO -->
        <div class="logo">

            <img
                src="<?= base_url('image/unpam logo.png') ?>"
                alt="Logo Sekolah">

            <div class="logo-text">
                <h4>SMPN 2</h4>
                <span>Pesisir Utara</span>
            </div>

        </div>

        <!-- MENU -->
        <ul class="menu-list">

            <li>
                <a href="#"
                    class="menu-link active"
                    onclick="showPage('dashboard', this)">

                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>

                </a>
            </li>

            <li>
                <a href="#"
                    class="menu-link"
                    onclick="showPage('data_siswa', this)">

                    <i class="fa-solid fa-users"></i>
                    <span>Data Siswa</span>

                </a>
            </li>

            <li>
                <a href="#"
                    class="menu-link"
                    onclick="showPage('data_guru', this)">

                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Data Guru</span>

                </a>
            </li>

            <li>
                <a href="#"
                    class="menu-link"
                    onclick="showPage('mapel', this)">

                    <i class="fa-solid fa-book"></i>
                    <span>Mata Pelajaran</span>

                </a>
            </li>

            <li>
                <a href="#"
                    class="menu-link"
                    onclick="showPage('nilai', this)">

                    <i class="fa-solid fa-clipboard-check"></i>
                    <span>Data Nilai</span>

                </a>
            </li>

            <li>
                <a href="#"
                    class="menu-link"
                    onclick="showPage('profile', this)">

                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>

                </a>
            </li>

            <li class="logout-menu">


                <a href="#"
                    class="logout-btn"
                    onclick="confirmLogout()">

                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout

                </a>



            </li>

        </ul>

        <!-- FOOTER -->
        <div class="sidebar-footer">

            <small>
                © 2026 SMPN 2
            </small>

        </div>

    </div>


    <!-- =========================
        CONTENT
    ========================== -->

    <div id="dashboard" class="content-page">
        <?= $this->include('navigation/mainContent') ?>
    </div>

    <div id="data_siswa" class="content-page">
        <?= $this->include('navigation/dataSiswa') ?>
    </div>

    <div id="data_guru" class="content-page">
        <?= $this->include('navigation/dataGuru') ?>
    </div>

    <div id="mapel" class="content-page">
        <?= $this->include('navigation/Mapel') ?>
    </div>

    <div id="nilai" class="content-page">
        <?= $this->include('navigation/nilai') ?>
    </div>

    <div id="profile" class="content-page">
        <?= $this->include('navigation/profile') ?>
    </div>


    <!-- =========================
        JAVASCRIPT
    ========================== -->

    <script>
        function showPage(pageId, element) {

            // semua halaman
            const pages =
                document.querySelectorAll('.content-page');

            pages.forEach(page => {

                page.style.display = 'none';

            });

            // tampilkan halaman aktif
            document.getElementById(pageId)
                .style.display = 'block';

            // reset active menu
            const menus =
                document.querySelectorAll('.menu-link');

            menus.forEach(menu => {

                menu.classList.remove('active');

            });

            // tambahkan active
            if (element) {

                element.classList.add('active');

            }

        }

        // default page
        showPage(
            'dashboard',
            document.querySelector('.menu-link')
        );

        //logout
        function confirmLogout() {

            if (confirm('Yakin ingin keluar dari sistem?')) {

                window.location.href =
                    "<?= base_url('/logout') ?>";

            }

        }
    </script>

</body>

</html>