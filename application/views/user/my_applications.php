<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рӯйхати аризаҳо</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap-icons.css'); ?>">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        #tab1{
            width: 1400px;
            margin-left: -50px;
        }
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
            color: white;
        }
        .undo-btn{
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
        .undo-btn:hover {
            background-color: #0056b3;
        }
        .matn{
            width: 100px;
            margin-right: -50px;
            margin-left: -50px;
        }
        .btn-sms{
            background-color:rgb(190, 191, 192);
            color: black;
        }
        .btn-sms:hover{
            background-color: #0056b3;
            color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container" id="viewProfile">
        <button class="undo-btn" type="button" onclick="javascript:history.back()" style="margin-left: -100px;margin-right: 100px;">
            <i class="fas fa-undo"></i> Ба қафо
        </button>
        <button class="btn btn-primary" onclick="showPendingForm()">Аризаҳои нав</button>
        <button class="btn btn-primary" onclick="showApprovedForm()">Аризаҳои тасдиқ шуда</button>
        <button class="btn btn-primary" onclick="showRejectedForm()">Аризаҳои радшуда</button>
        <h2 class="text-center mb-4">Рӯйхати аризаҳо</h2>
        <table id="tab1" class="table table-bordered table-striped">
            <thead class="table-dark" style="text-align: center;">
                <tr>
                    <th>ID</th>
                    <th>Ба номи кӣ</th>
                    <th>Логин</th>
                    <th>ФИО</th>
                    <th>Факултети</th>
                    <th>Гурӯҳи</th>
                    <th>Телефон</th>
                    <th>Сабаби ариза</th>
                    <th class="matn">Матн</th>
                    <th>Ҳолати ариза</th>
                    <th>Сана</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                <tr class="container-td">
                    <td><?php echo $app->id; ?></td>
                    <td><?php echo ucfirst($app->receiver); ?></td>
                    <td><?php echo $app->sender_login; ?></td>
                    <td><?php echo ucfirst($app->sender_name); ?></td>
                    <td><?php echo ucfirst($app->faculty); ?></td>
                    <td><?php echo $app->guruh; ?></td>
                    <td><?php echo $app->phone; ?></td>
                    <td class="matn" style="width: 450px;"><?php echo $app->application_text; ?></td>
                    <td>
                        <?php if ($app->status == 'pending'): ?>
                            <span class="badge bg-danger text-light">Дар тафтиш</span>
                        <?php elseif ($app->status == 'approved'): ?>
                            <span class="badge bg-success">Тасдиқ шуда</span>
                        <?php else: ?>
                            <span class="badge bg-dark text-light">Рад карда шуда</span>
                        <?php endif; ?>
                    </td>
                    <td><?= date('d.m.Y H:i:s', strtotime($app->created_at)); ?></td>
                    <td>
                        <a href="<?php echo site_url('application/delete_application/'. $app->id) ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Оё хориҷ кардан мехоҳед?')">
                            <i class="fas fa-trash"></i> Хориҷ
                        </a>
                        <a href="<?= base_url('admin/update_application/' . $app->id) ?>" class="btn btn-warning btn-sm" style="margin-top: 10px;">
                            <i class="fas fa-edit"></i> Ислоҳ
                        </a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div id="pendingApp" style="display: none; width: 80%; margin-left: 200px;margin-top: 20px;">
        <button class="undo-btn" type="button" onclick="showViewMode()">
            <i class="fas fa-undo"></i> Ба қафо
        </button>
        <h2 class="text-center mb-4">Рӯйхати аризаҳо</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark" style="text-align: center;">
                <tr>
                    <th>ID</th>
                    <th>Ба номи кӣ</th>
                    <th>Логин</th>
                    <th>ФИО</th>
                    <th>Факултети</th>
                    <th>Гурӯҳи</th>
                    <th>Телефон</th>
                    <th class="matn">Матн</th>
                    <th>Ҳолати ариза</th>
                    <th>Сана</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): 
                    if ($app->status == 'pending'): ?>
                        <tr class="container-td">
                            <td><?php echo $app->id; ?></td>
                            <td><?php echo ucfirst($app->receiver); ?></td>
                            <td><?php echo $app->sender_login; ?></td>
                            <td><?php echo ucfirst($app->sender_name); ?></td>
                            <td><?php echo ucfirst($app->faculty); ?></td>
                            <td><?php echo $app->guruh; ?></td>
                            <td><?php echo $app->phone; ?></td>
                            <td class="matn" style="width: 450px;"><?php echo $app->application_text; ?></td>
                            <td>
                            <?php if ($app->status == 'pending'): ?>
                            <span class="badge bg-danger text-light">Дар тафтиш</span>
                            <?php elseif ($app->status == 'approved'): ?>
                                <span class="badge bg-success">Тасдиқ шуда</span>
                                <?php else: ?>
                                    <span class="badge bg-dark text-light">Рад карда шуда</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d.m.Y H:i:s', strtotime($app->created_at)); ?></td>
                            <td>
                                <a href="<?php echo site_url('application/delete_application/'. $app->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Оё хориҷ кардан мехоҳед?')">
                                    <i class="fas fa-trash"></i> Хориҷ
                                </a>
                                <a href="<?= base_url('admin/update_application/' . $app->id) ?>" class="btn btn-warning btn-sm" style="margin-top: 10px;">
                                    <i class="fas fa-edit"></i> Ислоҳ
                                </a>

                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="approvedApp" style="display: none; width: 80%; margin-left: 200px;margin-top: 20px;">
        <button class="undo-btn" type="button" onclick="showViewMode()">
            <i class="fas fa-undo"></i> Ба қафо
        </button>
        <h2 class="text-center mb-4">Рӯйхати аризаҳо</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark" style="text-align: center;">
                <tr>
                    <th>ID</th>
                    <th>Ба номи кӣ</th>
                    <th>Логин</th>
                    <th>ФИО</th>
                    <th>Факултети</th>
                    <th>Гурӯҳи</th>
                    <th>Телефон</th>
                    <th class="matn">Матн</th>
                    <th>Ҳолати ариза</th>
                    <th>Сана</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): 
                    if ($app->status == 'approved'): ?>
                        <tr class="container-td">
                            <td><?php echo $app->id; ?></td>
                            <td><?php echo ucfirst($app->receiver); ?></td>
                            <td><?php echo $app->sender_login; ?></td>
                            <td><?php echo ucfirst($app->sender_name); ?></td>
                            <td><?php echo ucfirst($app->faculty); ?></td>
                            <td><?php echo $app->guruh; ?></td>
                            <td><?php echo $app->phone; ?></td>
                            <td class="matn" style="width: 450px;"><?php echo $app->application_text; ?></td>
                            <td>
                            <?php if ($app->status == 'pending'): ?>
                            <span class="badge bg-danger text-light">Дар тафтиш</span>
                            <?php elseif ($app->status == 'approved'): ?>
                                <span class="badge bg-success">Тасдиқ шуда</span>
                                <?php else: ?>
                                    <span class="badge bg-dark text-light">Рад карда шуда</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d.m.Y H:i:s', strtotime($app->created_at)); ?></td>
                            <td>
                                <a href="<?php echo site_url('application/delete_application/'. $app->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Оё хориҷ кардан мехоҳед?')">
                                    <i class="fas fa-trash"></i> Хориҷ
                                </a>
                                <a href="<?= base_url('admin/update_application/' . $app->id) ?>" class="btn btn-warning btn-sm" style="margin-top: 10px;">
                                    <i class="fas fa-edit"></i> Ислоҳ
                                </a>

                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="rejectedApp" style="display: none; width: 80%; margin-left: 80px;padding-top: 20px; width: 90%;">
        <button class="undo-btn" type="button" onclick="showViewMode()">
            <i class="fas fa-undo"></i> Ба қафо
        </button>
        <h2 class="text-center mb-4">Рӯйхати аризаҳо</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark" style="text-align: center;">
                <tr>
                    <th>ID</th>
                    <th>Ба номи кӣ</th>
                    <th>Логин</th>
                    <th>ФИО</th>
                    <th>Факултети</th>
                    <th>Гурӯҳи</th>
                    <th>Телефон</th>
                    <th>Сабаби ариза</th>
                    <th class="matn">Матн</th>
                    <th>Ҳолати ариза</th>
                    <th>Сана</th>
                    <th></th
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): 
                    if ($app->status == 'rejected'): ?>
                        <tr class="container-td">
                            <td><?php echo $app->id; ?></td>
                            <td><?php echo ucfirst($app->receiver); ?></td>
                            <td><?php echo $app->sender_login; ?></td>
                            <td><?php echo ucfirst($app->sender_name); ?></td>
                            <td><?php echo ucfirst($app->faculty); ?></td>
                            <td><?php echo $app->guruh; ?></td>
                            <td><?php echo $app->phone; ?></td>
                            <td><?php echo $app->app_for; ?></td>
                            <td class="matn" style="width: 450px;"><?php echo $app->application_text; ?></td>
                            <td>
                            <?php if ($app->status == 'pending'): ?>
                            <span class="badge bg-danger text-light">Дар тафтиш</span>
                            <?php elseif ($app->status == 'approved'): ?>
                                <span class="badge bg-success">Тасдиқ шуда</span>
                            <?php elseif ($app->status == 'rejected'): ?>
                                <span class="badge bg-dark text-light">Рад карда шуда</span>
                            <?php endif; ?>
                            </td>
                            <td><?= date('d.m.Y H:i:s', strtotime($app->created_at)); ?></td>
                            <td>
                                <a href="<?php echo site_url('application/delete_application/'. $app->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Оё хориҷ кардан мехоҳед?')">
                                    <i class="fas fa-trash"></i> Хориҷ
                                </a>
                                <a href="<?= base_url('admin/update_application/' . $app->id) ?>" class="btn btn-warning btn-sm" style="margin-top: 10px;">
                                    <i class="fas fa-edit"></i> Ислоҳ
                                </a>

                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<script>
    function showPendingForm() {
        document.getElementById('viewProfile').style.display = 'none';
        document.getElementById('pendingApp').style.display = 'block'; 
        document.getElementById('approvedApp').style.display = 'none';
    }

    function showApprovedForm() {
        document.getElementById('viewProfile').style.display = 'none';
        document.getElementById('pendingApp').style.display = 'none'; 
        document.getElementById('approvedApp').style.display = 'block';
    }

    function showRejectedForm() {
        document.getElementById('viewProfile').style.display = 'none';
        document.getElementById('pendingApp').style.display = 'none'; 
        document.getElementById('approvedApp').style.display = 'none';
        document.getElementById('rejectedApp').style.display = 'block';
    }

    function showViewMode() {
        document.getElementById('viewProfile').style.display = 'block';
        document.getElementById('pendingApp').style.display = 'none';
        document.getElementById('approvedApp').style.display = 'none';
        document.getElementById('rejectedApp').style.display = 'none';
    }
</script>


    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/bootstrap-5.3.0/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>