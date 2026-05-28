<div class="main-content">

    <?= $this->include('content/navbar') ?>

    <div class="table-section">

        <h5 class="mb-4">Halaman Profile</h5>

        <div class="profile-body">

            <!-- PROFILE IMAGE & BUTTON -->
            <div class="profile-data">

                <div class="profile-img">
                    <img src="<?= base_url('uploads/' . session('foto')); ?>" alt="Profile">
                </div>

                <div class="profile-action">

                    <button
                        class="btn btn-warning btn-sm color-button edit-btn"
                        type="button">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>

                    <button
                        class="btn btn-primary btn-sm color-button save-btn"
                        type="button"
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

                <form action="" method="post">

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

                <form action="#" method="post">

                    <!-- EMAIL -->
                    <div class="profile-row">

                        <span class="label">Email</span>

                        <span class="separator">:</span>

                        <span class="value">
                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="<?= session()->get('email') ?>">
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
                                name="old_password">

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

    // =========================
    // STATE
    // =========================

    let editing = false;
    let passwordMode = false;

    // =========================
    // EDIT PROFILE
    // =========================

    editBtn.addEventListener('click', () => {

        const values = document.querySelectorAll('#profile-list .value');

        if (!editing) {

            values.forEach(value => {

                const text = value.innerText.trim();
                const name = value.dataset.name;

                value.innerHTML = `
                    <input
                        type="text"
                        name="${name}"
                        value="${text}"
                        class="form-control">
                `;

            });

            editBtn.innerHTML =
                '<i class="fa-solid fa-xmark"></i>';

            editBtn.classList.remove('btn-warning');
            editBtn.classList.add('btn-danger');

            saveBtn.style.display = 'inline-block';

            editing = true;

        } else {

            values.forEach(value => {

                const input = value.querySelector('input');

                value.innerHTML = input.value;

            });

            editBtn.innerHTML =
                '<i class="fa-regular fa-pen-to-square"></i>';

            editBtn.classList.remove('btn-danger');
            editBtn.classList.add('btn-warning');

            saveBtn.style.display = 'none';

            editing = false;

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