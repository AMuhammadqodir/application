<?php if ($this->session->userdata('userstatus') !== 'rector'): ?>
    <p>Ворид шудан ба шахсони дигар қатъиян манъ аст!</p>
<?php else: ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($this->session->userdata('user_id')) {echo $this->session->userdata('userstatus');}?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/profile/profile.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap-4.0.0.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css-5.15.3/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav ml-auto" >
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" style="display: flex;">
                        <?php if ($admin->pictures): ?>
                            <img style="border-radius: 30%; margin-top: -5px;" 
                            src="<?= base_url($admin->pictures); ?>" 
                            alt="Profil rasm" class="nav-user-photo" width="40" height="40">
                        <?php else: ?>
                            <img style="border-radius: 30%; margin-top: -5px;" 
                            src="<?= base_url('assets/uploads/user-def.png'); ?>" 
                            alt="Profil rasm" class="nav-user-photo" width="40" height="40">
                        <?php endif; ?>
                        <div>
                            <p style="margin-bottom: -10px;margin-left: 10px;">Хуш омадед,</p>
                            <span class="ml-2"><?= $this->session->userdata('username'); ?></span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="tel:<?= $this->session->userdata('phone'); ?>">
                        <i class="fas fa-phone mr-2 text-success"></i> <?= $this->session->userdata('phone'); ?>
                    </a>

                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('rector/profile')?>" class="nav-link" data-load="content">
                            <i class="fas fa-user mr-2"></i> Маълумоти шахсӣ
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Баромад
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <a href="<?= base_url('rector/application') ?>" class="btn btn-primary mb-3" style="margin-top: 40px;">Рӯйхати аризаҳо</a>
        <a href="<?= base_url('rector/statement') ?>" class="btn btn-primary mb-3" style="margin-top: 40px;">Рӯйхати баёнотҳо</a>
        <h3>
        <?php
            if ($admin_info) {
                echo "Мақоми шумо: <b style='color: #555;'>". $admin_info->department_name . "</p></b>";
            }
        ?>
        </h3>
        <a class="btn btn-danger logout-btn" href="<?php echo site_url('auth/logout'); ?>">
            <i class="fas fa-sign-out-alt"></i> Баромад
        </a>
    </div>
    <script src="<?= base_url('assets/bootstrap-5.3.0/js/jquery/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bootstrap-5.3.0/js/js-4.5.2/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte-3.2/js/adminlte.min.js'); ?>"></script>
</body>
</html>

<?php endif; ?>