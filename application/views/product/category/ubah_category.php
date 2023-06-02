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
            <form action="" method="post">
                <div class="form-group <?= form_error('name') ? "has-error" : null?>">
                    <input type="hidden" name="category_id" id="category_id" value="<?= $category->category_id?>">
                    <label for="name">Name : </label>
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="<?= set_value('name',$category->name)?>">
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