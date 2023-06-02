<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom: 40px;">
    <h1 class="pull-left">
    <?= $title?>
    </h1>
    <a href="<?= base_url('user')?>" class="btn btn-github btn-md pull-right">
        <i class="fa fa-reply-all"></i> Back
    </a>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body" style="margin-top: 20px;">
            <form action="" method="post">
                <div class="form-group has-feedback <?= form_error('username') ? "has-error" : "null" ?>">
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username" value="<?= set_value('username')?>" class="form-control" autocomplete="off" placeholder="Masukan Username Anda">
                    <span class="text-red"><?= form_error('username')?></span>
                </div>
                <div class="form-group <?= form_error('name') ? "has-error" : "null" ?>">
                    <label for="name">Name :</label>
                    <input type="text" name="name" id="name" value="<?= set_value('name')?>" class="form-control" autocomplete="off" placeholder="Masukan Name Anda">
                    <span class="text-red"><?= form_error('name')?></span>
                </div>
                <div class="form-group <?= form_error('password') ? "has-error" : "null" ?>">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" value="<?= set_value('password')?>" class="form-control" autocomplete="off" placeholder="Masukan Password Anda">
                    <span class="text-red"><?= form_error('password')?></span>
                </div>
                <div class="form-group <?= form_error('password2') ? "has-error" : "null" ?>">
                    <label for="password2">Konfirmasi Password :</label>
                    <input type="password" name="password2" id="password2" value="<?= set_value('password2')?>" class="form-control" autocomplete="off" placeholder="Konfirmasi Password Anda">
                    <span class="text-red"><?= form_error('password2')?></span>
                </div>
                <div class="form-group <?= form_error('level') ? "has-error" : "null" ?>">
                    <label for="level">Status :</label>
                    <select name="level" id="level" class="form-control">
                        <option value="">--Pilih--</option>
                        <option value="1" <?= set_value('level') == 1 ? "selected" : "null" ?>>Admin</option>
                        <option value="2" <?= set_value('level') == 2 ? "selected" : "null" ?>>Kasir</option>
                    </select>
                    <span class="text-red"><?= form_error('level')?></span>
                </div>
                <div class="form-group <?= form_error('address') ? "has-error" : "null" ?>">
                    <label for="address">Address :</label>
                    <textarea name="address" id="address" class="form-control" placeholder="Masukan Address Anda"><?= set_value('address')?></textarea>
                    <span class="text-red"><?= form_error('address')?></span>
                </div>
                <button type="submit" name="submit" class="btn btn-success btn-md">
                    <i class="fa fa-check-circle"></i> Save
                </button>
                <button type="reset" name="reset" class="btn btn-warning btn-md">
                    <i class="fa fa-undo"></i> Reset
                </button>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->