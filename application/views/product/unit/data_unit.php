<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?= $title?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <a href="<?= base_url('unit/add')?>" class="btn btn-success btn-md" style="margin-bottom: 10px;">
                <i class="fa fa-plus"></i> Add Unit
            </a>
        </div>
        <div class="card-body">
        <?= $this->session->flashdata('pesan');?>
            <table class="table table-bordered table-responsive-lg text-center table-striped" id="table">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Name unit</th>
                        <th>Cereated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($row->result() as $row):?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $row->name?></td>
                        <td><?= $row->created?></td>
                        <td>
                            <a href="<?= base_url('unit/update/'.$row->unit_id)?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>    |
                            <a href="<?= base_url('unit/delete/'.$row->unit_id)?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->