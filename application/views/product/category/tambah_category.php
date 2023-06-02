<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom: 40px;">
    <h1 class="pull-left">
    <?= $title?>
    </h1>
    <a href="<?= base_url('category')?>" class="btn btn-github btn-md pull-right">
        <i class="fa fa-reply-all"></i> Back
    </a>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body" style="margin-top: 20px;">
            <form action="<?= base_url('category/processAdd')?>" method="post">
                <div class="form-group <?= form_error('name') ? "has-error" : null?>">
                    <label for="name">Nama :</label>
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Masukan Nama Category" value="<?= set_value('name')?>">
                    <span class="text-red"><?= form_error('name')?></span>
                </div>
                <button class="btn btn-success btn-md" type="submit" name="submit">
                    <i class="fa fa-check-circle-o"></i> Save
                </button>
                <button class="btn btn-warning btn-md" type="reset" name="reset">
                    <i class="fa fa-refresh"></i> Reset
                </button>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->