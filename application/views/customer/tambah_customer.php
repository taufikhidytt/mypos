<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom: 40px;">
    <h1 class="pull-left">
    <?= $title?>
    </h1>
    <a href="<?= base_url('customer')?>" class="btn btn-github btn-md pull-right">
        <i class="fa fa-reply-all"></i> Back
    </a>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body" style="margin-top: 20px;">
            <form action="<?= base_url('customer/processAdd')?>" method="post">
                <div class="form-group has-feedback <?= form_error('name') ? "has-error" : "null" ?>">
                    <label for="name">Name Customer :</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name')?>" autocomplete="off" placeholder="Masukan Name Customer">
                    <span class="text-red"><?= form_error('name')?></span>
                </div>
                <div class="form-group <?= form_error('gender') ? "has-error" : null?>">
                    <label for="gender">Jenis Kelamin :</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="">--Pilih--</option>
                        <option value="Pria"<?= set_value('gender') == "Pria" ? "selected" : null?>>Pria</option>
                        <option value="Perempuan" <?= set_value('gender') == "Perempuan" ? "selected" : null?>>Perempuan</option>
                    </select>
                    <span class="text-red"><?= form_error('gender')?></span>
                </div>
                <div class="form-group <?= form_error('phone') ? "has-error" : null?>">
                    <label for="phone">Telpon :</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="<?= set_value('phone')?>" autocomplete="off" placeholder="Masukan No Telpon Customer">
                    <span class="text-red"><?= form_error('phone')?></span>
                </div>
                <div class="form-group <?= form_error('address') ? "has-error" : null?>">
                    <label for="address">Address :</label>
                    <textarea name="address" id="address" class="form-control" autocomplete="off" placeholder="Masukan Address Customer"><?= set_value('address')?></textarea>
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