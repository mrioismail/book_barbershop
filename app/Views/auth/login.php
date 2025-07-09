<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f8fb;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .login-container {
            background: #ffffff;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        .login-container img {
            height: 40px;
            margin-bottom: 10px;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }

        .form-group label {
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px 35px 10px 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .form-group .toggle-password {
            position: absolute;
            top: 34px;
            right: 10px;
            color: #888;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: center;
        }

        .login-btn {
            background-color: #3b3b3b;
            color: white;
            padding: 10px 24px;
            font-size: 15px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin: 0 auto;
            display: inline-block;
        }

        .login-btn:hover {
            background-color: #050206;
        }

        .bottom-text {
            margin-top: 20px;
            font-size: 14px;
        }

        .bottom-text a {
            color: #3b3b3b;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="<?php echo base_url('customer/images/logo-bills.png') ?>" width="80" alt="Bills Barbershop Logo">
        <h3>Login Admin</h3>

        <?php if (session()->getFlashdata('pesan')): ?>
            <b class="error"><?= session()->getFlashdata('pesan') ?></b>
            <br><br>
        <?php endif ?>

        <form action="<?= base_url('/login') ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" required>
                <span class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eye-icon"></i>
                </span>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="bottom-text">
            <a href="<?= base_url('/'); ?>" class="text-sm text-gray-500">← Kembali ke Halaman Utama</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>