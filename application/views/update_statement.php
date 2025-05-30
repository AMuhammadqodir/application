<?php
    $roles = array('admin', 'conseliary', 'rtalim', 'rkadrho', 'dekan', 'rector');
    if (!in_array($this->session->userdata('userstatus'), $roles)): ?>
    <p>Ворид шудан ба шахсони дигар қатъиян манъ аст!</p>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ислоҳи баёнот</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css-4.5.2/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css-5.15.3/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap-icons.css'); ?>">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
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
        }

        .container {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #343a40;
        }

        .form-control {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            color: #495057;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-footer {
            display: flex;
            justify-content: flex-end;
        }

        .text-danger {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <button class="back-btn" type="button" onclick="javascript:history.back()">
        <i class="fas fa-undo"></i> Ба қафо
    </button>

    <div class="container">
        <h1>Ислоҳи маълумотҳои истифодабарандаи</h1>

        <?= validation_errors(); ?>

        <form method="post" action="<?php 
            $userstatus = $this->session->userdata('userstatus');
            $controller = '';
            if ($userstatus == 'conseliary') {
                $controller = 'conseliary';
            } elseif ($userstatus == 'rtalim') {
                $controller = 'r_talim';
            } elseif ($userstatus == 'rkadrho') {
                $controller = 'r_kadrho';
            } elseif ($userstatus == 'rector') {
                $controller = 'rector';
            } elseif ($userstatus == 'dekan') {
                $controller = 'dekan';
            }
            echo base_url($controller.'/update_statement/' . $statements->id); ?>">
            <div class="form-group">
                <label class="form-label">Ба кӣ:</label>
                <select name="receiver" class="form-control" required>
                    <option value="" disabled selected>Ба номи кӣ</option>
                    <option value="Ректор">Ректор</option>
                    <option value="Декан">Декан</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Аз номи:</label>
                <?php if (isset($statements)): ?>
                <input type="text" class="form-control" style="margin-bottom: 10px;" name="sender_login" value="<?= $statements->sender_login; ?>" readonly>
                <input type="text" class="form-control" name="sender_name" value="<?= $statements->sender_name; ?>" readonly>
                <?php else: ?>
                    <p>Malumot topilmadi</p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">Факултети:</label>
                <select name="faculty" class="form-control" required>
                    <option value="Био.химия">Био.химия</option>
                    <option value="Геоэкология">Геоэкология</option>
                    <option value="З.хориҷӣ">З.хориҷӣ</option>
                    <option value="З.шарқ">З.шарқ</option>
                    <option value="Математика">Математика</option>
                    <option value="Иқтисодӣ">Иқтисодӣ</option>
                    <option value="Таҳ.ибтидоӣ">Таҳ.ибтидоӣ</option>
                    <option value="Санъат">Санъат</option>
                    <option value="Тарб.ҷисмонӣ">Тарб.ҷисмонӣ</option>
                    <option value="Таър.ҳуқуқ">Таър.ҳуқуқ</option>
                    <option value="Телеком">Телеком</option>
                    <option value="Физ.тех">Физ.тех</option>
                    <option value="Фил.рус">Фил.рус</option>
                    <option value="Фил.тоҷик">Фил.тоҷик</option>
                    <option value="Фил.ӯзбек">Фил.ӯзбек</option>
                    <option value="ШҒҶРасулов">ШҒҶРасулов</option>
                    <option value="Психология">Психология</option>
                </select>
            </div>

            <div class="form-group">
                <label for="guruh">Гурӯҳи</label>
                <input type="text" class="form-control" id="guruh" name="guruh" value="<?= set_value('guruh', $statements->guruh); ?>" >
                <?= form_error('guruh', '<div class="text-danger">', '</div>'); ?>
            </div>

            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= set_value('phone', $statements->phone); ?>" >
                <?= form_error('phone', '<div class="text-danger">', '</div>'); ?>
            </div>

            <div class="form-group">
                <label for="statement_text">Матн</label>
                <textarea class="form-control" id="statement_text" name="statement_text" ><?= set_value('statement_text', $statements->statement_text); ?></textarea>
                <?= form_error('statement_text', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary">Сабти ислоҳ</button>
            </div>
        </form>
    </div>

    <script src="<?= base_url('assets/bootstrap-5.3.0/js/jquery/jquery-3.6.0.min.js'); ?>"></script>
    <script src="<?= base_url('assets/ajax/pooper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/bootstrap-5.3.0/js/js-4.5.2/bootstrap.min.js'); ?>"></script>
</body>
</html>
<?php endif; ?>
