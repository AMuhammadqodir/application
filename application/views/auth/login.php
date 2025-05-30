<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css-4.5.2/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css-5.15.3/all.min.css'); ?>">
    <style>
        body {
            background: linear-gradient(45deg,rgb(179, 179, 180),rgb(224, 233, 248));
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-left: 300px;
        }
        .card-title {
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 500;
            text-align: center;
        }
        .form-group label {
            font-size: 14px;
            font-weight: 500;
        }
        .btn-primary {
            background-color: #2575fc;
            border-color: #2575fc;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary:hover {
            background-color: #1e65d4;
            border-color: #1e65d4;
            transform: scale(1.05);
        }
        .input-group-text {
            background-color: #f1f1f1;
        }
        .input-group input {
            border-radius: 10px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .input-group-prepend {
            border-radius: 10px 0 0 10px;
        }
        .input-group-append button {
            border-radius: 0 10px 10px 0;
        }
        .alert-dismissible .close {
            padding: 1rem;
        }
        .bi-eye, .bi-eye-slash {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                
                <form action="<?php echo site_url('auth/login'); ?>" method="POST">
                    <div class="form-group">
                        <label for="email">Логин</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            </div>
                            <input type="text" class="form-control" id="login" name="login" required placeholder="Your Login">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Парол</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            </div>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Your Password">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("toggleIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            }
        }
    </script>
</body>
</html>
