<div class="top-header">

    <div class="header-left">

        <button type="button"
            class="sidebar-toggle"
            onclick="toggleSidebar()"
            aria-label="Buka menu sidebar">

            <i class="fa-solid fa-bars"></i>

        </button>

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
            src="<?= base_url('uploads/foto/' . session()->get('foto')); ?>"
            alt="Foto Profile">

    </a>

</div>