<div class="navbar-custom">

   <h4 class="navbar-title">
    Dashboard <?= ucfirst(session()->get('role')) ?>
</h4>

<small class="text-muted navbar-subtitle">
    Selamat datang kembali di sistem akademik
</small>

    <a href="#"
        onclick="showPage('profile', document.querySelector('[onclick*=profile]'))"
        class="profile navbar-profile">

        <div class="profile-info">
            <span><?= session()->get('nama') ?></span>
            <small><?= ucfirst(session()->get('role')) ?></small>
        </div>

        <img src="<?= base_url('uploads/' . session()->get('foto')); ?>" alt="">

    </a>

</div>