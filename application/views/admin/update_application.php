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
    <title>Ислоҳи ариза</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/application/update_application.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css-4.5.2/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css-5.15.3/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap-icons.css'); ?>">
</head>
<body>
    <button class="back-btn" type="button" onclick="javascript:history.back()">
        <i class="fas fa-undo"></i> Ба қафо
    </button>

    <div class="container">
        <h1>Ислоҳи маълумотҳои истифодабарандаи</h1>

        <?= validation_errors(); ?>

        <form method="post" action="<?= base_url('admin/update_application/' . $application->id) ?>">
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
                <?php if (isset($application)): ?>
                <input type="text" class="form-control" style="margin-bottom: 10px;" name="sender_login" value="<?= $application->sender_login; ?>" readonly>
                <input type="text" class="form-control" name="sender_name" value="<?= $application->sender_name; ?>" readonly>
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
                <input type="text" class="form-control" id="guruh" name="guruh" value="<?= set_value('guruh', $application->guruh); ?>" >
                <?= form_error('guruh', '<div class="text-danger">', '</div>'); ?>
            </div>

            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= set_value('phone', $application->phone); ?>" >
                <?= form_error('phone', '<div class="text-danger">', '</div>'); ?>
            </div>

            <div class="form-group">
                <label for="application_text">Матн</label>
                <textarea class="form-control" id="application_text" name="application_text" ><?= set_value('application_text', $application->application_text); ?></textarea>
                <?= form_error('application_text', '<div class="text-danger">', '</div>'); ?>
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
