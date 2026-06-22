<?= $this->include('content/headstyle') ?>

<body>

    <!-- =========================
        SIDEBAR
    ========================== -->

    <div class="sidebar" id="sidebar">

        <!-- LOGO SIDEBAR -->
        <div class="sidebar-brand">
            <img
                src="<?= base_url('image/unpam logo.png') ?>"
                alt="Logo Sekolah">

            <div class="sidebar-brand-text">
                <h4>SMPN 2</h4>
                <span>Pesisir Utara</span>
            </div>
        </div>

        <!-- MENU -->
        <ul class="menu-list">

            <li>
                <a href="#"
                    class="menu-link active"
                    data-page="dashboard"
                    onclick="showPage('dashboard', this)">

                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>

                </a>
            </li>

            <?php if (session('role') == 'admin'): ?>

                <li>
                    <a href="#"
                        class="menu-link"
                        data-page="data_siswa"
                        onclick="showPage('data_siswa', this)">

                        <i class="fa-solid fa-users"></i>
                        <span>Data Siswa</span>

                    </a>
                </li>

                <li>
                    <a href="#"
                        class="menu-link"
                        data-page="data_guru"
                        onclick="showPage('data_guru', this)">

                        <i class="fa-solid fa-chalkboard-user"></i>
                        <span>Data Guru</span>

                    </a>
                </li>

            <?php endif; ?>

            <?php if (session('role') == 'admin' || session('role') == 'guru' || session('role') == 'murid'): ?>

                <li>
                    <a href="#"
                        class="menu-link"
                        data-page="mapel"
                        onclick="showPage('mapel', this)">

                        <i class="fa-solid fa-book"></i>
                        <span>Mata Pelajaran</span>

                    </a>
                </li>

            <?php endif; ?>

            <li>
                <a href="#"
                    class="menu-link"
                    data-page="nilai"
                    onclick="showPage('nilai', this)">

                    <i class="fa-solid fa-clipboard-check"></i>
                    <span>Data Nilai</span>

                </a>
            </li>

            <li>
                <a href="#"
                    class="menu-link"
                    data-page="profile"
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
                    <span>Logout</span>

                </a>
            </li>

        </ul>

        <!-- FOOTER -->
        <div class="sidebar-footer">
            <small>© 2026 SMPN 2</small>
        </div>

    </div>

    <div class="sidebar-overlay" onclick="toggleSidebar(false)"></div>


    <!-- =========================
        MAIN LAYOUT
    ========================== -->

    <div class="layout-content" id="layoutContent">

        <!-- =========================
    HEADER
========================== -->

<?= $this->include('content/navbar') ?>

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

        <div id="nilai-murid" class="content-page">
            <?= $this->include('navigation/NilaiMurid') ?>
        </div>

    </div>


    <!-- =========================
        JAVASCRIPT
    ========================== -->

    <script>
        const openMapel = <?= session()->getFlashdata('open_mapel') ? 'true' : 'false' ?>;
        const successMessage = <?= json_encode(
            session()->getFlashdata('success') ??
            session()->getFlashdata('berhasil') ??
            session()->getFlashdata('pesan') ??
            session()->getFlashdata('message') ??
            ''
        ) ?>;
        const errorMessage = <?= json_encode(
            session()->getFlashdata('error') ??
            session()->getFlashdata('gagal') ??
            ''
        ) ?>;

        function toggleSidebar(force = null) {
            if (force === true) {
                document.body.classList.add('sidebar-open');
                return;
            }

            if (force === false) {
                document.body.classList.remove('sidebar-open');
                return;
            }

            document.body.classList.toggle('sidebar-open');
        }

        function closeSidebarMobile() {
            if (window.innerWidth <= 768) {
                document.body.classList.remove('sidebar-open');
            }
        }

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
            } else {
                const activeMenu = document.querySelector(`.menu-link[data-page="${pageId}"]`);

                if (activeMenu) {
                    activeMenu.classList.add('active');
                }
            }
            const navbarProfile = document.getElementById('navbarProfile');

            if (navbarProfile) {
                navbarProfile.style.display = pageId === 'profile' ? 'none' : 'flex';
            }
            updateNavbarTitle(pageId);

            if (pageId) {
                localStorage.setItem('lastActiveDashboardPage', pageId);

                if (window.location.hash.replace('#', '') !== pageId) {
                    history.replaceState(null, '', '#' + pageId);
                }
            }

            closeSidebarMobile();
        }

        document.addEventListener('DOMContentLoaded', function() {

            const hash = window.location.hash.replace('#', '');

            if (openMapel) {

                showPage('mapel');

                const mapelContainer = document.getElementById('mapel-container');
                const mapelDetail = document.getElementById('mapel-detail');
                const conPertemuan = document.getElementById('con-pertemuan');
                const conTambahPertemuan = document.getElementById('con-tambah-pertemuan');
                const conBuatSoal = document.getElementById('con-buat-soal');

                if (mapelContainer) {
                    mapelContainer.style.display = 'none';
                }

                if (mapelDetail) {
                    mapelDetail.style.display = 'block';
                }

                if (conPertemuan) {
                    conPertemuan.style.display = 'none';
                }

                if (conTambahPertemuan) {
                    conTambahPertemuan.style.display = 'none';
                }

                if (conBuatSoal) {
                    conBuatSoal.style.display = 'block';
                }

                return;
            }

            const lastPage = localStorage.getItem('lastActiveDashboardPage');

            if (hash && document.getElementById(hash)) {

                showPage(hash);

            } else if (lastPage && document.getElementById(lastPage)) {

                showPage(lastPage);

            } else {

                const firstMenu = document.querySelector('.menu-link');

                showPage('dashboard', firstMenu);

            }

            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    const activePage = document.querySelector('.content-page[style*="display: block"]');

                    if (activePage && activePage.id) {
                        localStorage.setItem('lastActiveDashboardPage', activePage.id);
                    }
                });
            });

            if (successMessage) {
                showDashboardPopup(successMessage, 'success');
            }

            if (errorMessage) {
                showDashboardPopup(errorMessage, 'error');
            }

        });

        function showDashboardPopup(message, type = 'success') {
            const popup = document.createElement('div');
            popup.className = 'dashboard-popup ' + (type === 'error' ? 'error' : 'success');
            popup.innerHTML = `
                <div class="dashboard-popup-icon">
                    <i class="fa-solid ${type === 'error' ? 'fa-circle-xmark' : 'fa-circle-check'}"></i>
                </div>
                <div>
                    <strong>${type === 'error' ? 'Gagal' : 'Berhasil'}</strong>
                    <p>${message}</p>
                </div>
            `;

            document.body.appendChild(popup);

            setTimeout(() => {
                popup.classList.add('show');
            }, 100);

            setTimeout(() => {
                popup.classList.remove('show');
                setTimeout(() => popup.remove(), 400);
            }, 3200);
        }

        function confirmLogout() {

            if (confirm('Yakin ingin keluar dari sistem?')) {

                window.location.href = "<?= base_url('/logout') ?>";

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
                },
                'nilai-murid': {
                    title: 'Nilai Murid',
                    subtitle: 'Lihat hasil nilai berdasarkan tugas dan mata pelajaran'
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