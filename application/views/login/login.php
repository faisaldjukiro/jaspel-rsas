<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/0/0c/LOGO_KOTA_GORONTALO.png"
        type="image/x-icon">
    <title>Login Jaspel RSAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background: #ecf0f3;
    }

    .wrapper {
        max-width: 400px;
        min-height: 500px;
        margin: 80px auto;
        padding: 40px 30px 30px 30px;
        background-color: #ecf0f3;
        border-radius: 15px;
        box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
    }

    .logo {
        width: 80px;
        margin: auto;
    }

    .logo img {
        width: 100%;
        height: 80px;
        object-fit: cover;
        border-radius: 80%;
        box-shadow: 0px 0px 3px #5f5f5f,
            0px 0px 0px 5px #ecf0f3,
            8px 8px 15px #a7aaa7,
            -8px -8px 15px #fff;
    }

    .wrapper .name {
        font-weight: 600;
        font-size: 1.4rem;
        letter-spacing: 1.3px;
        padding-left: 10px;
        color: #555;
    }

    .wrapper .form-field input {
        width: 100%;
        display: block;
        border: none;
        outline: none;
        background: none;
        font-size: 1.2rem;
        color: #666;
        padding: 10px 15px 10px 10px;
    }

    .wrapper .form-field {
        padding-left: 10px;
        margin-bottom: 20px;
        border-radius: 20px;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
    }

    .wrapper .form-field .fas {
        color: #555;
    }

    .wrapper .btn {
        box-shadow: none;
        width: 100%;
        height: 40px;
        background-color: #03A9F4;
        color: #fff;
        border-radius: 25px;
        box-shadow: 3px 3px 3px #b1b1b1,
            -3px -3px 3px #fff;
        letter-spacing: 1.3px;
    }

    .wrapper .btn:hover {
        background-color: #039BE5;
    }

    .wrapper a {
        text-decoration: none;
        font-size: 0.8rem;
        color: #03A9F4;
    }

    .wrapper a:hover {
        color: #039BE5;
    }

    @media(max-width: 380px) {
        .wrapper {
            margin: 30px 20px;
            padding: 40px 15px 15px 15px;
        }
    }

    #captchaImage {
        width: 600px;
        height: auto;
    }

    .refresh-btn {
        width: 1px;
        height: 1px;
        font-size: 10px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        background-color: transparent;
        color: #333;
    }

    .refresh-btn i {
        font-size: 14px;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/0c/LOGO_KOTA_GORONTALO.png" alt="">
        </div>
        <div class="text-center mt-4 name">
            JASPEL RSAS
        </div>
        <?php if ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <form action="<?= base_url('LoginController/proses_login'); ?>" method="POST" class="p-3 mt-3">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="username" id="username" placeholder="PEG" autocomplete="off" required>
            </div>
            <div class="form-field d-flex align-items-center position-relative">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="fas fa-eye position-absolute" id="togglePassword"
                    style="right: 10px; cursor: pointer;"></span>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-shield-alt"></span>
                <input type="text" name="captcha" id="captcha" placeholder="Masukkan CAPTCHA" required>
            </div>
            <div class="d-flex align-items-center mb-3">
                <img src="<?= base_url('LoginController/captcha'); ?>" id="captchaImage" alt="CAPTCHA">
                <button type="button" class="btn refresh-btn ms-2" onclick="refreshCaptcha()">
                    <i class="fas fa-sync-alt"></i>
                </button>
            </div>
            <button type="submit" class="btn mt-3">Login</button>
        </form>

        <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
        </script>
        <script>
        function refreshCaptcha() {
            document.getElementById('captchaImage').src = "<?= base_url('LoginController/captcha'); ?>?" + Math
                .random();
        }
        </script>
    </div>
</body>

</html>