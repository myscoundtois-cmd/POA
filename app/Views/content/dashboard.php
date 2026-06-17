<?php if (session()->getFlashdata('open_mapel')) : ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // buka halaman mapel
            showPage('mapel');

            // tampilkan detail mapel
            document.getElementById('mapel-container').style.display = 'none';
            document.getElementById('mapel-detail').style.display = 'block';

            // tampilkan form soal
            document.getElementById('con-pertemuan').style.display = 'none';
            document.getElementById('con-tambah-pertemuan').style.display = 'none';
            document.getElementById('con-buat-soal').style.display = 'block';

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

            <?php if (session('role') == 'admin'): ?>
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
            <?php endif; ?>

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

    <div id="data_soal" class="content-page">
        <?= $this->include('navigation/dataSoal') ?>
    </div>


    <!-- =========================
        JAVASCRIPT
    ========================== -->

    <script>
        function showPage(pageId, element = null) {

            const pages = document.querySelectorAll('.content-page');

            pages.forEach(page => {
                page.style.display = 'none';
            });

            const activePage = document.getElementById(pageId);

            if (!activePage) {
                console.error('Halaman tidak ditemukan:', pageId);
                return;
            }

            activePage.style.display = 'block';

            const menus = document.querySelectorAll('.menu-link');

            menus.forEach(menu => {
                menu.classList.remove('active');
            });

            if (element) {
                element.classList.add('active');
            }

            const navbarProfiles = document.querySelectorAll('.navbar-profile');

            navbarProfiles.forEach(navbarProfile => {
                navbarProfile.style.display =
                    pageId === 'profile' ? 'none' : 'flex';
            });

            updateNavbarTitle(pageId);
        }

        // Jalankan setelah halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function() {

            const hash = window.location.hash.replace('#', '');

            // Jika datang dari redirect dashboard#data_soal
            if (hash && document.getElementById(hash)) {

                showPage(hash);

            } else {

                const firstMenu = document.querySelector('.menu-link');

                showPage(
                    'dashboard',
                    firstMenu
                );

            }

        });

        // Logout
        function confirmLogout() {

            if (confirm('Yakin ingin keluar dari sistem?')) {

                window.location.href =
                    "<?= base_url('/logout') ?>";

            }

        }

        function searchTable(input, tableId) {

            const keyword = input.value.toLowerCase();
            const table = document.getElementById(tableId);

            if (!table) return;

            const rows = table.querySelectorAll('tbody tr');

            rows.forEach(row => {

                const text = row.innerText.toLowerCase();

                row.style.display =
                    text.includes(keyword) ? '' : 'none';

            });

        }

        function confirmDelete(type) {

            const message = 'Yakin ingin menghapus data ' + type + '?';

            if (confirm(message)) {
                alert('Fitur hapus belum disambungkan ke backend.');
            }

        }

        function updateNavbarTitle(pageId) {

            const titles = {
                dashboard: {
                    title: 'Dashboard <?= ucfirst(session()->get('role')) ?>',
                    subtitle: 'Selamat datang kembali di sistem akademik'
                },
                data_siswa: {
                    title: 'Data Siswa',
                    subtitle: 'Kelola informasi siswa yang terdaftar di sistem'
                },
                data_guru: {
                    title: 'Data Guru',
                    subtitle: 'Kelola informasi guru dan tenaga pengajar'
                },
                mapel: {
                    title: 'Mata Pelajaran',
                    subtitle: 'Kelola mata pelajaran, materi, dan soal pembelajaran'
                },
                data_soal: {
                    title: 'Data Soal',
                    subtitle: 'Kelola soal dan ujian yang sudah dibuat'
                },
                nilai: {
                    title: 'Data Nilai',
                    subtitle: 'Kelola dan pantau nilai siswa'
                },
                profile: {
                    title: 'Profile Pengguna',
                    subtitle: 'Kelola informasi akun dan keamanan pengguna'
                }
            };

            const navbarTitles = document.querySelectorAll('.navbar-title');
            const navbarSubtitles = document.querySelectorAll('.navbar-subtitle');

            navbarTitles.forEach(title => {
                title.innerText =
                    titles[pageId]?.title || 'Dashboard';
            });

            navbarSubtitles.forEach(subtitle => {
                subtitle.innerText =
                    titles[pageId]?.subtitle ||
                    'Selamat datang kembali di sistem akademik';
            });

        }
    </script>

</body>

</html>