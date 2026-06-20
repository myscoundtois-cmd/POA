<div class="top-header">

    <div class="header-left">

        <button type="button"
            class="sidebar-toggle"
            onclick="toggleSidebar()">

            <i class="fa-solid fa-bars"></i>

        </button>

        <div class="school-brand">

            <img
                src="<?= base_url('image/unpam logo.png') ?>"
                alt="Logo Sekolah">

            <div class="school-text">
                <h4>SMPN 2</h4>
                <span>Pesisir Utara</span>
            </div>

        </div>

        <div class="header-title-box">

            <h4 class="navbar-title">
                Dashboard <?= ucfirst(session()->get('role')) ?>
            </h4>

            <span class="navbar-subtitle">
                Selamat datang kembali di sistem akademik
            </span>

        </div>

    </div>

    <a href="#"
    id="navbarProfile"
    onclick="showPage('profile', document.querySelector('.menu-link[data-page=profile]'))"
    class="navbar-profile">

        <div class="profile-info">
            <span><?= session()->get('nama') ?? 'Toto Iswanto' ?></span>
            <small><?= ucfirst(session()->get('role')) ?></small>
        </div>

        <img
            src="<?= base_url('uploads/' . session()->get('foto')); ?>"
            alt="Foto Profile">

    </a>

</div>