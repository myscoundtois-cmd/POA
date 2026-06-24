<div class="main-content">

    <div class="table-section profile-page-section">

        <?php
        $role = session()->get('role');
        $roleLabel = [
            'admin' => 'Tata Usaha',
            'guru'  => 'Guru',
            'murid' => 'Murid',
            'wali'  => 'Wali Murid'
        ];

        $fotoProfile = session()->get('foto') ?: 'default.png';
        $namaProfile = session()->get('nama') ?: '-';
        $emailProfile = session()->get('email') ?: '-';
        $labelRole = $roleLabel[$role] ?? ucfirst((string) $role);

        $profileData = [
            'nama'          => 'Nama Lengkap',
            'email'         => 'Email',
            'alamat'        => 'Alamat',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tgl_lahir'    => 'Tanggal Lahir'
        ];

        if ($role === 'murid') {
            $profileData = array_merge(
                ['nis' => 'NIS'],
                $profileData
            );
        }

        if ($role === 'wali') {
            $profileData = array_merge(
                ['nis' => 'NIS Anak'],
                $profileData
            );
        }
        ?>

        <div class="profile-header-card">

            <div class="profile-header-left">

                <div class="profile-img profile-img-large">
                    <img src="<?= base_url('uploads/foto/' . $fotoProfile); ?>" alt="Foto Profile" onerror="this.onerror=null;this.src='<?= base_url('image/unpam logo.png'); ?>';">
                </div>

                <div class="profile-title-text">
                    <span class="profile-badge"><?= esc($labelRole) ?></span>
                    <h5><?= esc($namaProfile) ?></h5>
                    <p><?= esc($emailProfile) ?></p>
                </div>

            </div>

            <div class="profile-action">

                <button
                    class="btn btn-warning btn-sm color-button edit-btn"
                    type="button"
                    title="Edit Profile">
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>

                <button
                    class="btn btn-primary btn-sm color-button save-btn is-hidden"
                    type="submit"
                    form="profile-form"
                    
                    title="Simpan Perubahan">
                    <i class="fa-regular fa-paper-plane"></i>
                </button>

                <button
                    class="btn btn-secondary btn-sm color-button password-btn"
                    type="button"
                    title="Ubah Password">
                    <i class="fa-solid fa-user-gear"></i>
                </button>

            </div>

        </div>

        <div class="profile-body profile-body-revisi">

            <div class="profile-list" id="profile-list">

                <div class="profile-section-title">
                    <h5>Data Profile</h5>
                    <small class="text-muted">
                        Data utama akun yang digunakan dalam sistem akademik.
                    </small>
                </div>

                <form
                    action="<?= base_url('/edit') ?>"
                    method="post"
                    enctype="multipart/form-data"
                    id="profile-form">

                    <div class="upload-wrapper is-hidden" >
                        <div class="profile-row">
                            <span class="label">Foto Profile</span>
                            <span class="separator">:</span>
                            <span class="value">
                                <input
                                    type="file"
                                    name="foto"
                                    class="form-control upload-input">
                                <small class="text-muted">
                                    Kosongkan jika tidak ingin mengganti foto.
                                </small>
                            </span>
                        </div>
                    </div>

                    <div class="profile-row">
                        <span class="label">Role</span>
                        <span class="separator">:</span>
                        <span class="value readonly-value">
                            <?= esc($labelRole) ?>
                        </span>
                    </div>

                    <?php foreach ($profileData as $field => $label): ?>

                        <div class="profile-row">

                            <span class="label"><?= esc($label) ?></span>

                            <span class="separator">:</span>

                            <span class="value" data-name="<?= esc($field) ?>">
                                <?= session()->get($field) ? esc(session()->get($field)) : '<span class="text-muted">Belum diisi</span>' ?>
                            </span>

                        </div>

                    <?php endforeach; ?>

                </form>

            </div>

            <div class="profile-list is-hidden" id="password-edit" >

                <div class="profile-section-title">
                    <h5>Ubah Password</h5>
                    <small class="text-muted">
                        Gunakan password baru yang mudah diingat, tetapi tidak mudah ditebak.
                    </small>
                </div>

                <form action="<?= base_url('/editpas') ?>" method="post">

                    <div class="profile-row">
                        <span class="label">Email</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="<?= esc(session()->get('email')) ?>"
                                readonly>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Password Lama</span>
                        <span class="separator">:</span>
                        <span class="value password-box">
                            <input
                                type="password"
                                class="form-control password-input"
                                name="old_password"
                                placeholder="Masukkan password lama">

                            <button
                                type="button"
                                class="toggle-password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Password Baru</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input
                                type="password"
                                class="form-control"
                                name="new_password"
                                placeholder="Masukkan password baru">
                        </span>
                    </div>

                    <div class="profile-row">
                        <span class="label">Konfirmasi Password</span>
                        <span class="separator">:</span>
                        <span class="value">
                            <input
                                type="password"
                                class="form-control"
                                name="confirm_password"
                                placeholder="Ulangi password baru">
                        </span>
                    </div>

                    <div class="profile-password-submit">
                        <button class="btn btn-primary color-button btn-sm" type="submit">
                            <i class="fa-regular fa-paper-plane"></i>
                            Simpan Password
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
<script>
    const editBtn = document.querySelector('.edit-btn');
    const saveBtn = document.querySelector('.save-btn');
    const passwordBtn = document.querySelector('.password-btn');

    const profileList = document.querySelector('#profile-list');
    const passwordEdit = document.querySelector('#password-edit');

    const toggleBtn = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('.password-input');

    const uploadWrapper = document.querySelector('.upload-wrapper');

    let editing = false;
    let passwordMode = false;

    if (editBtn) {
        editBtn.addEventListener('click', () => {

            const values = document.querySelectorAll('#profile-list .value[data-name]');

            if (!editing) {

                values.forEach(value => {

                    let text = value.innerText.trim();
                    const name = value.dataset.name;

                    if (text === 'Belum diisi') {
                        text = '';
                    }

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

                    } else if (name === 'tgl_lahir') {

                        value.innerHTML = `
                            <input
                                type="date"
                                name="${name}"
                                value="${text}"
                                class="form-control">
                        `;

                    } else if (name === 'email') {

                        value.innerHTML = `
                            <input
                                type="email"
                                name="${name}"
                                value="${text}"
                                class="form-control">
                        `;

                    } else if (name === 'alamat') {

                        value.innerHTML = `
                            <textarea
                                name="${name}"
                                class="form-control"
                                rows="3">${text}</textarea>
                        `;

                    } else {

                        value.innerHTML = `
                            <input
                                type="text"
                                name="${name}"
                                value="${text}"
                                class="form-control">
                        `;
                    }

                });

                if (uploadWrapper) {
                    uploadWrapper.style.display = 'block';
                }

                editBtn.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                editBtn.classList.remove('btn-warning');
                editBtn.classList.add('btn-danger');

                saveBtn.style.display = 'inline-block';
                editing = true;

            } else {
                location.reload();
            }
        });
    }

    if (passwordBtn) {
        passwordBtn.addEventListener('click', () => {
            passwordMode = !passwordMode;

            profileList.style.display = passwordMode ? 'none' : 'block';
            passwordEdit.style.display = passwordMode ? 'block' : 'none';
        });
    }

    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';

            toggleBtn.innerHTML = isPassword ?
                '<i class="fa-regular fa-eye-slash"></i>' :
                '<i class="fa-regular fa-eye"></i>';
        });
    }
</script>