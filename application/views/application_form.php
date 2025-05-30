<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ариза супоридан</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/application/application_form.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/Font-Awesome-6.0.0/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap-5.3.0/css/bootstrap-icons.css'); ?>">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
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
    </style>
</head>
<body>
    <button class="back-btn" type="button" onclick="javascript:history.back()">
        <i class="fas fa-undo"></i> Ба қафо
    </button>
    <div class="container">
        <h2 class="text-center">Ариза супоридан</h2>
        <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <form action="<?php echo site_url('application/submit'); ?>" method="POST">
            <div class="mb-4">
                <label class="form-label">Ба кӣ:</label>
                <select name="receiver" class="form-select" required>
                    <option value="Декан">Декан</option>
                </select>
            </div>
            <div class="mb-3">
            <label class="form-label">Аз номи:</label>
            <?php if ($admin): ?>
                <input type="text" class="form-control" style="margin-bottom: 10px;" name="sender_login" value="<?= $admin->login; ?>" readonly>
                <input type="text" class="form-control" name="sender_name" value="<?= $admin->username; ?>" readonly>
            <?php else: ?>
                <p>Маълумотҳо ёфт нашуд!</p>
            <?php endif; ?>

            </div>
            <div class="mb-4">
                <label class="form-label">Факултети:</label>
                <select name="faculty" class="form-select" >
                    <option value=""></option>
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
            <div class="mb-4">
                <label class="form-label">Гурӯҳи:</label>
                <input type="text" name="guruh" class="form-control">
            </div>

            <div class="mb-4">
                <label class="form-label">Телефон:</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="mb-4" >
                <label class="form-label">Барои:</label>
                <select name="app_for" class="form-select" id="reasonSelect">
                    <option value=""></option>
                    <option value="Босабабкунии ғойиб">Босабабкунии ғойиб</option>
                    <option value="Хонадоршавӣ">Хонадоршавӣ</option>
                    <option value="Маросими дафн">Маросими дафн</option>
                    <option value="Беморӣ">Беморӣ</option>
                </select>

                <div id="message" style="margin-top: 10px; color: red; font-weight: bold;"></div>
            </div>

            <div class="mb-4">
                <label class="form-label">Матн:</label>
                <textarea name="application_text" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Фиристодан</button>
        </form>
    </div>
    

    <script>
        const reasonSelect = document.getElementById('reasonSelect');
        const messageDiv = document.getElementById('message');

        reasonSelect.addEventListener('change', function() {
            if (this.value === 'Босабабкунии ғойиб') {
                messageDiv.textContent = "Агар маълумотнома барои зиёда аз 10 рӯз бошад, аризаро ба номи ректор нависед!";
            } else {
                messageDiv.textContent = "";
            }
        });
    </script>
    <script src="<?= base_url('assets/bootstrap-5.3.0/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
