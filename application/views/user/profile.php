<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($this->session->userdata('user_id')) {echo $this->session->userdata('userstatus');}?></title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css-4.0.0/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css-5.15.3/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/profile/profile.css'); ?>">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .prof-img {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            background-color: #f4f4f4;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .prof-img img {
            width: 250px;
            height: 250px;
            border-radius: 10px;
        }

        .profile-img {
            width: 200px;
            height: 200px; 
            border-radius: 10%;
            object-fit: cover;
            border: 4px solid #ffffff;
        }
        .back-btn {
            width: 120px;
            height: auto;
            position: fixed;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            font-size: 14px;
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

        .logout-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            font-size: 14px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php if ($admin && $admin_info): ?>
            <div id="viewProfile" class="row align-items-center">
            <button class="back-btn" type="button" onclick="javascript:history.back()">
                <i class="fas fa-undo"></i> Ба қафо
            </button>
                <div class="col-md-6 mb-3 prof-info">    
                    <h3>Маълумоти шахсӣ</h3>
                    <p><strong>Статус:</strong> <?= $admin_info->department_name; ?></p>
                    <p><strong>Логин:</strong> <?= $admin->login; ?></p>
                    <p><strong>ФИО:</strong> <?= $admin->username; ?></p>
                    <p><strong>Телефон:</strong> <?= $admin->phone; ?></p>
                    <button class="btn btn-primary" onclick="showEditForm()"><i class="fas fa-edit"></i>Ислоҳ</button>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="prof-img">
                        <img src="<?= base_url($admin->pictures); ?>" alt="Profil rasm" class="profile-img">
                    </div>
                </div>
                
            </div>
        <?php else: ?>
            <p>Маълумотҳо ёфт нашуд!</p>
        <?php endif; ?>

        <div id="editProfile" style="display: none;">
            <h2>Ислоҳи маълумотҳо</h2>
            <form method="post" action="<?= base_url('admin/update_profile'); ?>" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $admin->id; ?>">
                <div class="form-group">
                    <label>Логин</label>
                    <input type="text" class="form-control" name="login" value="<?= $admin->login; ?>">
                </div>
                <div class="form-group">
                    <label>ФИО</label>
                    <input type="text" class="form-control" name="username" value="<?= $admin->username; ?>">
                </div>
                <div class="form-group">
                    <label>Телефон</label>
                    <input type="text" class="form-control" name="phone" value="<?= $admin->phone; ?>">
                </div>
                <div class="form-group">
                    <label>Сурат</label>
                    <input type="file" class="form-control" name="pictures">
                </div>
                <button type="submit" class="btn btn-success">Сабт</button>
                <button type="button" class="btn btn-secondary" onclick="showViewMode()">Бекоркунӣ</button>
            </form>
        </div>
    </div>

    <script>
        function showEditForm() {
            document.getElementById('viewProfile').style.display = 'none';
            document.getElementById('editProfile').style.display = 'block';
        }

        function showViewMode() {
            document.getElementById('viewProfile').style.display = 'block';
            document.getElementById('editProfile').style.display = 'none';
        }
    </script>
</body>