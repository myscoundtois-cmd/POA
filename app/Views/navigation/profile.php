<div class="main-content">

    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <h5 class="mb-4">Halaman Profile</h5>

        <div class="profile-body">

            <!-- PROFILE IMAGE & BUTTO<div class="main-content">
    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <h5 class="mb-4">Profile Pengguna</h5>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="profile-body">

            <div class="profile-data">
                <div class="profile-img">
                    <img src="<?= base_url('uploads/' . session()->get('foto')) ?>" alt="Foto Profile">
                </div>

                <div class="profile-action">
                    <span class="status aktif">
                        <?= ucfirst(session()->get('role')) ?>
                    </span>
                </div>
            </div>

            <div class="profile-list">

                <form action="<?= base_url('profile/edit') ?>" method="post" enctype="multipart/form-data">

                    <div class="profile-row">
                        <span class="label">Nama</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text" name="nama" class="form-control" value="<?= session()->get('nama') ?>">
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Email</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="email" name="email" class="form-control" value="<?= session()->get('email') ?>">
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">NIS</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text" name="nis" class="form-control" value="<?= session()->get('nis') ?>">
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Kelas</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="text" name="kelas" class="form-control" value="<?= session()->get('kelas') ?>">
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Jenis Kelamin</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" <?= session()->get('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>
                                    Laki-laki
                                </option>
                                <option value="Perempuan" <?= session()->get('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>
                                    Perempuan
                                </option>
                            </select>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Tanggal Lahir</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="date" name="tgl_lahir" class="form-control" value="<?= session()->get('tgl_lahir') ?>">
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Alamat</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <textarea name="alamat" class="form-control" rows="3"><?= session()->get('alamat') ?></textarea>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Foto</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input type="file" name="foto" class="form-control">
                        </span>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        Simpan Perubahan
                    </button>

                </form>

            </div>

        </div>

    </div>

    <div class="table-section">

        <h5 class="mb-4">Ubah Password</h5>

        <form action="<?= base_url('profile/password') ?>" method="post">

            <div class="profile-row">
                <span class="label">Password Baru</span>
                <span class="separator">:</span>
                <span class="value">
                    <input type="password" name="new_password" class="form-control" required>
                </span>
            </div>

            <div class="profile-row">
                <span class="label">Konfirmasi Password</span>
                <span class="separator">:</span>
                <span class="value">
                    <input type="password" name="confirm_password" class="form-control" required>
                </span>
            </div>

            <button type="submit" class="btn btn-success mt-3">
                Ubah Password
            </button>

        </form>

    </div>
</div>N -->
            <div class="profile-data">

                <div class="profile-img">
                    <img src="<?= base_url('uploads/' . session('foto')); ?>" alt="Profile">
                </div>

                <!-- BUTTON TERPISAH -->
                <div class="profile-action">

                    <button
                        class="btn btn-warning btn-sm color-button edit-btn"
                        type="button">

                        <i class="fa-regular fa-pen-to-square"></i>

                    </button>

                    <button
                        class="btn btn-primary btn-sm color-button save-btn"
                        type="submit"
                        form="profile-form"
                        style="display:none;">

                        <i class="fa-regular fa-paper-plane"></i>

                    </button>

                    <button
                        class="btn btn-secondary btn-sm color-button password-btn"
                        type="button">

                        <i class="fa-solid fa-user-gear"></i>

                    </button>

                </div>

            </div>

            <!-- PROFILE LIST -->
            <div class="profile-list" id="profile-list">

                <form
                    action="<?= base_url('/edit') ?>"
                    method="post"
                    enctype="multipart/form-data"
                    id="profile-form">

                    <div class="upload-wrapper" style="display:none;">
                        <input
                            type="file"
                            name="foto"
                            class="form-control upload-input">
                    </div>
                    <?php
                    $profileData = [
                        'nis'             => 'NIS',
                        'nama'            => 'Nama',
                        'email'           => 'Email',
                        'alamat'          => 'Alamat',
                        'jenis_kelamin'   => 'Jenis Kelamin',
                        'tgl_lahir'       => 'Tanggal Lahir',
                        'kelas'           => 'Kelas'
                    ];

                    foreach ($profileData as $field => $label):
                    ?>

                        <div class="profile-row">

                            <span class="label"><?= $label ?></span>

                            <span class="separator">:</span>

                            <span class="value" data-name="<?= $field ?>">
                                <?= session()->get($field) ?>
                            </span>

                        </div>

                    <?php endforeach; ?>

                </form>

            </div>

            <!-- PASSWORD EDIT -->
            <div class="profile-list" id="password-edit" style="display:none;">

                <form action="<?= base_url('/editpas') ?>" method="post">

                    <!-- EMAIL -->
                    <div class="profile-row">

                        <span class="label">Email</span>

                        <span class="separator">:</span>

                        <span class="value">
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="<?= session()->get('email') ?>" readonly>
                        </span>

                    </div>

                    <!-- OLD PASSWORD -->
                    <div class="profile-row">

                        <span class="label">Old Password</span>

                        <span class="separator">:</span>

                        <span class="value password-box">
                            <input
                                type="password"
                                class="form-control password-input"
                                value="<?= session()->get('password') ?>">

                            <button
                                type="button"
                                class="toggle-password">

                                <i class="fa-regular fa-eye"></i>

                            </button>

                        </span>

                    </div>

                    <!-- NEW PASSWORD -->
                    <div class="profile-row">

                        <span class="label">New Password</span>

                        <span class="separator">:</span>

                        <span class="value">
                            <input
                                type="password"
                                class="form-control"
                                name="new_password">
                        </span>

                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="profile-row">

                        <span class="label">Confirm Password</span>

                        <span class="separator">:</span>

                        <span class="value">
                            <input
                                type="password"
                                class="form-control"
                                name="confirm_password">
                        </span>

                    </div>
                    <br>
                    <button class="btn btn-primary color-button btn-sm"
                        type="submit"><i class="fa-regular fa-paper-plane"></i>
                        Send
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>
<script>
    // =========================
    // ELEMENT
    // =========================

    const editBtn = document.querySelector('.edit-btn');
    const saveBtn = document.querySelector('.save-btn');
    const passwordBtn = document.querySelector('.password-btn');

    const profileList = document.querySelector('#profile-list');
    const passwordEdit = document.querySelector('#password-edit');

    const toggleBtn = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('.password-input');

    const uploadWrapper = document.querySelector('.upload-wrapper');

    // =========================
    // STATE
    // =========================

    let editing = false;
    let passwordMode = false;

    // =========================
    // EDIT PROFILE
    // =========================

    editBtn.addEventListener('click', () => {

        const values = document.querySelectorAll(
            '#profile-list .value[data-name]'
        );

        if (!editing) {

            values.forEach(value => {

                const text = value.innerText.trim();
                const name = value.dataset.name;

                // =========================
                // RADIO BUTTON
                // =========================

                if (name === 'jenis_kelamin') {

                    value.innerHTML = `
                    
                        <div class="gender-group">

                            <label>
                                <input 
                                    type="radio" 
                                    name="jenis_kelamin"
                                    value="Laki-laki"
                                    ${text === 'Laki-laki' ? 'checked' : ''}
                                >
                                Laki-laki
                            </label>

                            <label>
                                <input 
                                    type="radio" 
                                    name="jenis_kelamin"
                                    value="Perempuan"
                                    ${text === 'Perempuan' ? 'checked' : ''}
                                >
                                Perempuan
                            </label>

                        </div>

                    `;

                }

                // =========================
                // DATE INPUT
                // =========================
                else if (name === 'tgl_lahir') {

                    value.innerHTML = `
                    
                        <input
                            type="date"
                            name="${name}"
                            value="${text}"
                            class="form-control">

                    `;
                }

                // =========================
                // EMAIL INPUT
                // =========================
                else if (name === 'email') {

                    value.innerHTML = `
                    
                        <input
                            type="email"
                            name="${name}"
                            value="${text}"
                            class="form-control">

                    `;
                }

                // =========================
                // INPUT TEXT
                // =========================
                else {

                    value.innerHTML = `
                    
                        <input
                            type="text"
                            name="${name}"
                            value="${text}"
                            class="form-control">

                    `;
                }

            });

            // tampilkan upload
            uploadWrapper.style.display = 'block';

            // ubah tombol
            editBtn.innerHTML =
                '<i class="fa-solid fa-xmark"></i>';

            editBtn.classList.remove('btn-warning');
            editBtn.classList.add('btn-danger');

            // tampilkan save
            saveBtn.style.display = 'inline-block';

            editing = true;

        } else {

            // reload untuk reset tampilan
            location.reload();

        }

    });

    // =========================
    // PASSWORD MODE
    // =========================

    passwordBtn.addEventListener('click', () => {

        passwordMode = !passwordMode;

        profileList.style.display =
            passwordMode ? 'none' : 'block';

        passwordEdit.style.display =
            passwordMode ? 'block' : 'none';

    });

    // =========================
    // SHOW PASSWORD
    // =========================

    toggleBtn.addEventListener('click', () => {

        const isPassword =
            passwordInput.type === 'password';

        passwordInput.type =
            isPassword ? 'text' : 'password';

        toggleBtn.innerHTML = isPassword ?
            '<i class="fa-regular fa-eye-slash"></i>' :
            '<i class="fa-regular fa-eye"></i>';

    });
</script>