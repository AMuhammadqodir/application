<?php if ($this->session->userdata('userstatus') !== 'admin'): ?>
    <p>Ворид шудан ба шахсони дигар қатъиян манъ аст!</p>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ислоҳи маълумотҳои истифодабарандагон</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css-4.0.0/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap-icons.css'); ?>">
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
        <i class="fas fa-undo"></i> Ба қафо
    </button>
        <h1 class="mt-5">Ислоҳи маълумотҳои истифодабаранда</h1>
        
        <?= validation_errors(); ?>

        <form method="post" action="<?= base_url('admin/update_user/' . $user->id) ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" class="form-control" id="login" name="login" value="<?= set_value('login', $user->login); ?>" required>
            </div>
            <div class="form-group">
                <label for="username">ФИО</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username', $user->username); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Парол</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="pictures" class="form-label">Сурат</label>
                <input type="file" class="form-control" name="pictures" id="pictures">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Сақлаш
            </button>
        </form>
    </div>
</body>
</html>
<?php endif; ?>
