<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($this->session->userdata('user_id')) {echo $this->session->userdata('userstatus');}?></title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css-5.15.3/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/profile/profile.css'); ?>">
</head>
<body>
    <div class="container mt-5">
        <?php if ($admin && $admin_info): ?>
            <div id="viewProfile" class="row align-items-center">
            <button class="back-btn" type="button" onclick="javascript:history.back()">
                <i class="fas fa-undo"></i> Ба қафо
            </button>
                <div class="col-md-4 prof-info ms-5">    
                    <span class="fw-bold fs-4 text-dark">Маълумоти шахсӣ</span>
                    <p><strong>Статус:</strong> <?= $admin_info->department_name; ?></p>
                    <p><strong>Логин:</strong> <?= $admin->login; ?></p>
                    <p><strong>ФИО:</strong> <?= $admin->username; ?></p>
                    <p><strong>Телефон:</strong> <?= $admin->phone; ?></p>
                    <button class="btn btn-primary" onclick="showEditForm()"><i class="fas fa-edit"></i>Ислоҳ</button>
                </div>
                <div class="col-md-2 d-flex justify-content-center">
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
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Сабт</button>
                    <button type="button" class="btn btn-secondary" onclick="showViewMode()">Бекоркунӣ</button>
                </div>
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