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
            <a href="<?= base_url('user/add')?>" class="btn btn-success btn-md" style="margin-bottom: 10px;">
                <i class="fa fa-user-plus"></i> Add Users
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-lg-responsive text-center table-striped">
                <thead class="bg-primary">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($row->result() as $row):?>
                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $row->username?></td>
                        <td><?= $row->name?></td>
                        <td><?= $row->address?></td>
                        <td><?= $row->level == 1 ? "Admin" : "Kasir"?></td>
                        <td>
                            <a href="<?= base_url('user/update/'.$row->user_id)?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>    |
                            <form action="<?= base_url('user/delete')?>" method="post" class="inline">
                                <input type="hidden" name="user_id" value="<?= $row->user_id?>">
                                <button type="submit" name="submit" onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini?')" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->