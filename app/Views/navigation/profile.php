<div class="main-content">
    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <h5 class="mb-4">Halaman Profile</h5>

        <div class="profile-body">
            <div class="profile-data">
                <button class="btn btn-warning btn-sm" type="button"><i class="fa-regular fa-pen-to-square"></i></button>
                <button class="btn btn-secondary btn-sm" type="button"><i class="fa-solid fa-user-gear"></i></button>
            </div>
            <div href="<?= base_url('/profile') ?>" class="profile-img">
                <img src="<?= base_url('uploads/' . session('foto')); ?>" alt="">
            </div>

            <div class="profile-data">
                <span><strong>Nama</strong> : <?= session()->get('nama') ?></span>
                <span><strong>Email</strong> : <?= session()->get('email') ?></span>
            </div>
        </div>

    </div>
</div>