<?php $roles = array('admin');
    if (!in_array($this->session->userdata('userstatus'), $roles)): ?>
    <p>Ба шахсони бегона қатъиян манъ аст!</p>
<?php else: ?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?= base_url('assets/adminlte-3.2/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">

    <style>
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
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto" >
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" style="display: flex;">
                        <?php if ($admin->pictures): ?>
                            <img style="border-radius: 30%; margin-top: -5px;" 
                            src="<?= base_url($admin->pictures); ?>" 
                            alt="Profil rasm" class="nav-user-photo" width="40" height="40">
                        <?php else: ?>
                            <img style="border-radius: 30%; margin-top: -5px;" 
                            src="<?= base_url('assets/uploads/67ed22a17d2dd.jpg'); ?>" 
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
                        <a href="<?= base_url('admin/profile') ?>" class="nav-link <?= ($this->uri->segment(2) == 'profile') ? 'active' : '' ?>" data-load="content">
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

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?= base_url('admin') ?>" class="brand-link" style="text-decoration: none;">
                <span class="brand-text font-weight-light">Admin Panel</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <li class="nav-item">
                            <a href="<?= base_url('admin') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Панели идоракунӣ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/users_list') ?>" class="nav-link <?= ($this->uri->segment(2) == 'users_list') ? 'active' : '' ?>" data-load="content">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Рӯйхати истифодабарандагон</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/register') ?>" class="nav-link <?= ($this->uri->segment(2) == 'register') ? 'active' : '' ?>" data-load="content">
                                <i class="nav-icon fas fa-add"></i>
                                <p>Истифодабарандаи нав</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/application') ?>" class="nav-link <?= ($this->uri->segment(2) == 'application') ? 'active' : '' ?>" data-load="content">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Рӯйхати аризаҳо</p>
                            </a>
                        </li>
                        <li class="nav-tem">
                            <a href="<?= base_url('admin/submit') ?>" class="nav-link <?= ($this->uri->segment(2) == 'submit') ? 'active' : '' ?>" data-load="content">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Аризаи нав</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/statement') ?>" class="nav-link <?= ($this->uri->segment(2) == 'statement') ? 'active' : '' ?>" data-load="content">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Рӯйхати Баёнотҳо</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/submit_statement') ?>" class="nav-link <?= ($this->uri->segment(2) == 'submit_statement') ? 'active' : '' ?>" data-load="content">
                                <i class="nav-icon fas fa-plus"></i>
                                <p>Баёноти нав</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('auth/logout') ?>" class="nav-link">
                                <i class="fas fa-sign-out-alt"></i> Баромад
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid" id="main-content">
                    <?= $content ?>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>© <?= date('Y') ?> Admin Panel.</strong> All rights reserved.
        </footer>
    </div>

    <script src="<?= base_url('assets/bootstrap-5.3.0/js/jquery/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bootstrap-5.3.0/js/js-4.5.2/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/adminlte-3.2/js/adminlte.min.js'); ?>"></script>

    <script>
        $(document).ready(function() {
            $('[data-widget="pushmenu"]').off('click');

            $('a[data-load="content"]').on('click', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $('#main-content').load(url);
            });
        });
    </script>
</body>
</html>
<?php endif; ?>
