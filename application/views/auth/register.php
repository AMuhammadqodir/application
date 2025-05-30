<?php if ($this->session->userdata('userstatus') !== 'admin'): ?>
    <p>Фақат админ метавонад сабти ном кунад.</p>
<?php else: ?>
<!DOCTYPE html>
<html lang="tg">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сабти ном</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css-4.5.2/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css-5.15.3/all.min.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
    <button class="back-btn" type="button" onclick="javascript:history.back()">
        <i class="bi bi-arrow-left"></i> Ба қафо
    </button>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Сабти маълумот: </h5>
                        <form method="post" action="<?= base_url('admin/register') ?>">
                            <div class="form-group">
                                    <label for="login"> Логин</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="login" name="login" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="username">ФИО</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Телефон</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Парол</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm">Тасдиқи парол</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-shield-lock-fill"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-primary btn-block">Сабт</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php endif; ?>
