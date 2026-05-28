<div class="navbar-custom">

    <div>
        <h4>Dashboard <?= session()->get('role') ?></h4>
    </div>

    <a href="#" onclick="showPage('profile')" class="profile">
        <img src="<?= base_url('uploads/' . session('foto')); ?>" alt="">
    </a>
</div>