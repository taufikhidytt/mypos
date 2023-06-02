<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom: 40px;">
    <h1 class="pull-left">
    <?= $title?>
    </h1>
    <a href="<?= base_url('supplier')?>" class="btn btn-github btn-md pull-right">
        <i class="fa fa-reply-all"></i> Back
    </a>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body" style="margin-top: 20px;">
            <form action="" method="post">
                <div class="form-group has-feedback <?= form_error('name') ? "has-error" : "null" ?>">
                    <input type="hidden" name="supplier_id" id="supplier_id" value="<?= $supplier->supplier_id?>">
                    <label for="name">Name Supplier :</label>
                    <input type="text" name="name" id="name" value="<?= set_value('name', $supplier->name)?>" class="form-control" autocomplete="off" placeholder="Masukan Name Supplier">
                    <span class="text-red"><?= form_error('name')?></span>
                </div>
                <div class="form-group <?= form_error('phone') ? "has-error" : null?>">
                    <label for="phone">Phone Supplier :</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="<?= set_value('phone', $supplier->phone)?>" autocomplete="off" placeholder="Masukan Nomor Phone Supplier">
                    <span class="text-red"><?= form_error('phone')?></span>
                </div>
                <div class="form-group <?= form_error('address') ? "has-error" : null?>">
                    <label for="address">Address :</label>
                    <textarea name="address" id="address" class="form-control" autocomplete="off" placeholder="Masukan Address Supplier"><?= set_value('address', $supplier->address)?></textarea>
                    <span class="text-red"><?= form_error('address')?></span>
                </div>
                <div class="form-group <?= form_error('description') ? "has-error" : null?>">
                    <label for="description">Description :</label>
                    <textarea name="description" id="description" class="form-control" autocomplete="off" placeholder="Masukan Description Supplier"><?= set_value('description', $supplier->description)?></textarea>
                    <span class="text-red"><?= form_error('description')?></span>
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