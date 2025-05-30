<?php
$status = array('admin', 'rector', 'rtalim', 'rkadrho', 'conseliary', 'dekan');
if (!in_array($this->session->userdata('userstatus'), $status)): ?>
    <p>Ворид шудан ба шахсони дигар қатъиян манъ аст!</p>
    <?php else: ?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рӯйхати баёнотҳо</title>
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
        <button class="back-btn" type="button" onclick="javascript:history.back()">
            <i class="fas fa-undo"></i> Ба қафо
        </button>
        <h2 class="text-center mb-4">Рӯйхати баёнотҳо</h2>
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
                    <th>Барои</th>
                    <th class="matn">Матн</th>
                    <th>Сана</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statements as $stat): ?>
                <tr class="container-td">
                    <td><?php echo $stat->id; ?></td>
                    <td><?php echo ucfirst($stat->receiver); ?></td>
                    <td><?php echo ucfirst($stat->sender_login); ?></td>
                    <td><?php echo ucfirst($stat->sender_name); ?></td>
                    <td><?php echo ucfirst($stat->faculty); ?></td>
                    <td><?php echo $stat->guruh; ?></td>
                    <td><?php echo $stat->phone; ?></td>
                    <td><?php echo $stat->stat_for; ?></td>
                    <td class="matn" style="width: 450px;"><?php echo $stat->statement_text; ?></td>
                    <td><?= date('d.m.Y H:i:s', strtotime($stat->created_at)); ?></td>
                    <td>
                        <a href="<?php
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
                            echo base_url($controller . '/delete_statement/'. $stat->id) ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Оё хориҷ кардан мехоҳед?')">
                            <i class="fas fa-trash"></i> Хориҷ
                        </a>
                        <a href="<?php
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
                            echo base_url($controller . '/update_statement/'. $stat->id) ?>" class="btn btn-warning btn-sm" style="margin-top: 10px;">
                            <i class="fas fa-edit"></i> Ислоҳ
                        </a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
   
    <script src="<?= base_url('assets/bootstrap-5.3.0/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
<?php endif; ?>