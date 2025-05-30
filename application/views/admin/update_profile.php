<div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <h1>Profilni tahrirlash</h1>
                    
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-info">
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/update_profile') ?>" method="POST">
                        <div class="form-group">
                            <label for="username">Foydalanuvchi nomi</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $admin->username; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefon raqami</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $admin->phone; ?>" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Saqlash</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>