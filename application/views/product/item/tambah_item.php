<!-- Content Header (Page header) -->
<section class="content-header" style="margin-bottom: 40px;">
    <h1 class="pull-left">
    <?= $title?>
    </h1>
    <a href="<?= base_url('item')?>" class="btn btn-github btn-md pull-right">
        <i class="fa fa-reply-all"></i> Back
    </a>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body">
            <form action="<?= base_url('item/processAdd')?>" method="post" style="margin: 30px 0 30px 0;">
                <div class="form-group <?= form_error('barcode') ? "has-error" : null?>">
                    <label for="barcode">Barcode :</label>
                    <input type="text" name="barcode" id="barcode" value="<?= set_value('barcode')?>" autocomplete="off" class="form-control" placeholder="Masukan Barcode">
                    <span class="text-red"><?= form_error('barcode')?></span>
                </div>
                <div class="form-group <?= form_error('name') ? "has-error" : null?>">
                    <label for="name">Name Item :</label>
                    <input type="text" name="name" id="name" value="<?= set_value('name')?>" autocomplete="off" class="form-control" placeholder="Masukan Name">
                    <span class="text-red"><?= form_error('name')?></span>
                </div>
                <div class="form-group <?= form_error('category') ? "has-error" : null?>">
                    <label for="category">Category :</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">--Pilih--</option>
                        <?php foreach($category->result() as $category):?>
                            <option value="<?= $category->category_id?>"><?= $category->name?></option>
                        <?php endforeach;?>
                    </select>
                    <span class="text-red"><?= form_error('category')?></span>
                </div>
                <div class="form-group <?= form_error('unit') ? "has-error" : null?>">
                    <label for="unit">Unit :</label>
                    <select name="unit" id="unit" class="form-control">
                        <option value="">--Pilih--</option>
                        <?php foreach($unit->result() as $unit):?>
                            <option value="<?= $unit->unit_id?>"><?= $unit->name?></option>
                        <?php endforeach;?>
                    </select>
                    <span class="text-red"><?= form_error('unit')?></span>
                </div>
                <div class="form-group <?= form_error('price') ? "has-error" : null?>">
                    <label for="price">Price :</label>
                    <input type="text" name="price" id="price" value="<?= set_value('price')?>" autocomplete="off" class="form-control" placeholder="Masukan Price">
                    <span class="text-red"><?= form_error('price')?></span>
                </div>
                <div class="form-group <?= form_error('stock') ? "has-error" : null?>">
                    <label for="stock">Stock :</label>
                    <input type="text" name="stock" id="stock" value="<?= set_value('stock')?>" autocomplete="off" class="form-control" placeholder="Masukan Stock">
                    <span class="text-red"><?= form_error('stock')?></span>
                </div>
                <button class="btn btn-success btn-md" type="submit" name="submit">
                    <i class="fa fa-check-circle-o"> Save</i>
                </button>
                <button class="btn btn-warning btn-md" type="reset" name="reset">
                    <i class="fa fa-refresh"> Reset</i>
                </button>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->