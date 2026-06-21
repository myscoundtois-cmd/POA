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
                    <img src="<?= base_url('uploads/' . $fotoProfile); ?>" alt="Foto Profile">
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
                    class="btn btn-primary btn-sm color-button save-btn"
                    type="submit"
                    form="profile-form"
                    style="display:none;"
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

                    <div class="upload-wrapper" style="display:none;">
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

            <div class="profile-list" id="password-edit" style="display:none;">

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

<style>
    .profile-page-section {
        padding: 22px;
    }

    .profile-header-card {
        background: linear-gradient(135deg, #eff6ff, #ffffff);
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        margin-bottom: 22px;
    }

    .profile-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .profile-img-large {
        width: 86px;
        height: 86px;
        flex: 0 0 86px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #ffffff;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.12);
    }

    .profile-img-large img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-title-text {
        min-width: 0;
    }

    .profile-title-text h5 {
        margin: 8px 0 4px;
        color: #0f172a;
        font-size: 20px;
        font-weight: 700;
        word-break: break-word;
    }

    .profile-title-text p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        word-break: break-word;
    }

    .profile-badge {
        display: inline-block;
        background: #dbeafe;
        color: #1d4ed8;
        border-radius: 999px;
        padding: 5px 12px;
        font-size: 12px;
        font-weight: 700;
    }

    .profile-body-revisi {
        display: block;
    }

    .profile-section-title {
        margin-bottom: 18px;
    }

    .profile-section-title h5 {
        margin: 0 0 4px;
        color: #0f172a;
        font-weight: 700;
    }

    .profile-list {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        padding: 20px;
    }

    .readonly-value {
        color: #0f172a;
        font-weight: 600;
    }

    .profile-password-submit {
        margin-top: 18px;
        display: flex;
        justify-content: flex-end;
    }

    .password-box {
        position: relative;
        display: flex;
        align-items: center;
    }

    .password-box .form-control {
        padding-right: 46px;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #64748b;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .profile-page-section {
            padding: 14px;
        }

        .profile-header-card {
            flex-direction: column;
            align-items: stretch;
            padding: 16px;
        }

        .profile-header-left {
            align-items: flex-start;
        }

        .profile-img-large {
            width: 68px;
            height: 68px;
            flex-basis: 68px;
        }

        .profile-title-text h5 {
            font-size: 17px;
        }

        .profile-title-text p {
            font-size: 13px;
        }

        .profile-action {
            width: 100%;
            display: flex;
            gap: 8px;
        }

        .profile-action .btn {
            flex: 1;
        }

        .profile-list {
            padding: 16px;
            border-radius: 14px;
        }

        .profile-row {
            display: block;
        }

        .profile-row .label,
        .profile-row .separator,
        .profile-row .value {
            display: block;
            width: 100%;
        }

        .profile-row .separator {
            display: none;
        }

        .profile-row .label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #334155;
        }

        .profile-password-submit .btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .profile-header-left {
            flex-direction: column;
        }

        .profile-img-large {
            margin: 0 auto;
        }

        .profile-title-text {
            width: 100%;
            text-align: center;
        }
    }
</style>

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
