<?php if ($this->session->userdata('userstatus') !== 'admin'): ?>
    <p>Ворид шудан ба шахсони дигар қатъиян манъ аст!</p>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($this->session->userdata('user_id')) {echo $this->session->userdata('userstatus');}?></title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css-4.0.0/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css-5.15.3/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">

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
        <h1 class="mt-5">Рӯйхати истифодабарандагон</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Логин</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Парол</th>
                    <th>Статус</th>
                    <th>Санаи сабт</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($users); $i++): ?>
                <?php $user = $users[$i]; ?>
                <?php $st = $status[$i]; ?>
                    <tr>
                        <td><?= $user->id; ?></td>
                        <td><?= $user->login; ?></td>
                        <td><?= $user->username; ?></td>
                        <td><?= $user->phone; ?></td>
                        <td><?= $user->password; ?></td>
                        <td><?= $st->department_name; ?></td>
                        <td><?= date('d.m.Y H:i:s', strtotime($user->created_at)); ?></td>
                        <td><!-- Update Icon -->
                            <a href="<?= base_url('admin/update_user/' . $user->id) ?>" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Ислоҳ
                            </a>
                                
                            <!-- Delete Icon -->
                            <a href="<?= base_url('admin/delete_user/' . $user->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Оё хориҷ кардан мехоҳед?')">
                                <i class="fas fa-trash"></i> Хориҷ
                            </a>
                        </td>

                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <h3>
        <?php
            if ($admin_info) {
                echo "Мақоми шумо: <b style='color: #555;'>". $admin_info->department_name . "</p></b>";
            }
        ?>

        </h3>
    </div>
</body>
</html>
<?php endif; ?>