<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom: 40px;">
    <h1 class="pull-left">
    <?= $title?>
    </h1>
    <a href="<?= base_url('unit')?>" class="btn btn-github btn-md pull-right">
        <i class="fa fa-reply-all"></i> Back
    </a>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body" style="margin-top: 20px;">
            <form action="<?= base_url('unit/processAdd')?>" method="post">
                <div class="form-group has-feedback <?= form_error('name') ? "has-error" : "null" ?>">
                    <label for="name">Name Unit :</label>
                    <input type="text" name="name" id="name" value="<?= set_value('name')?>" class="form-control" autocomplete="off" placeholder="Masukan Name Unit">
                    <span class="text-red"><?= form_error('name')?></span>
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