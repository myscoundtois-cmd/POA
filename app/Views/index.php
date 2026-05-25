<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sekolah</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css'); ?>">

    <!-- CDN -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <div class="login-card">

            <div class="logo">
                <img src="<?= base_url('image/unpam logo.png') ?>?>" alt="">
            </div>

            <h1>SMPN 2</h1>
            <p>PESISIR UTARA</p>

            <!-- LOGIN -->
            <form action="<?= base_url('auth') ?>" method="post" id="loginForm">

                <div class="input-box">
                    <i class="fa-solid fa-at"></i>
                    <input type="text" placeholder="e-mail">
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password">
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-light" type="submit">
                        Login
                    </button>

                    <button type="button"
                        class="btn btn-primary"
                        onclick="showRegister()">

                        Regist
                    </button>
                </div>

            </form>


            <!-- REGISTER -->
            <form action="<?= base_url('regist') ?>"
                method="post"
                id="registerForm">

                <div class="input-box">
                    <i class="fa-regular fa-id-badge"></i>

                    <select class="form-select form-select-sm" name="role" required>
                        <option>Pilih Status,..</option>
                        <option value="admin">TU</option>
                        <option value="guru">Guru</option>
                        <option value="murid">Murid</option>
                        <option value="wali">Wali Murid</option>
                    </select>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-file-arrow-up"></i>

                    <input type="file" class="form-control" id="inputGroupFile01" required>
                </div>

                <div class="input-box">
                    <i class="fa-regular fa-user"></i>

                    <input type="text" placeholder="Nama" required>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-at"></i>
                    <input type="text" placeholder="email" required>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password" required>
                </div>

                <div class="d-grid gap-2">

                    <button class="btn btn-success" type="submit">
                        Register
                    </button>

                    <button type="button"
                        class="btn btn-secondary"
                        onclick="showLogin()">

                        Kembali Login
                    </button>

                </div>

            </form>
            <div class="footer">
                © 2026 SMPN 2 PESISIR UTARA
            </div>

        </div>

    </div>

</body>
<script>
    function showRegister() {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'block';
    }

    function showLogin() {
        document.getElementById('registerForm').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
    }
</script>

</html>