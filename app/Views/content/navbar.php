<div class="navbar-custom">

    <div>
        <h4>
            Dashboard <?= ucfirst(session()->get('role')) ?>
        </h4>

        <small class="text-muted">
            Selamat datang kembali di sistem akademik
        </small>
    </div>

    <a href="#"
        onclick="showPage('profile')"
        class="profile navbar-profile">

        <div class="profile-info">
            <span><?= session()->get('nama') ?></span>
            <small><?= ucfirst(session()->get('role')) ?></small>
        </div>

        <img src="<?= base_url('uploads/' . session()->get('foto')); ?>" alt="">

    </a>

</div>