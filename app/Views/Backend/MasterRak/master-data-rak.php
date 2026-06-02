<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Master Data Rak</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Master Data Rak</h3><hr/>
                    <a href="<?= base_url('admin/input-data-rak');?>"><button class="btn btn-primary">Input Data Rak</button></a><br><br>
                    <table data-toggle="table" data-search="true" data-pagination="true">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Rak</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($data_rak as $data) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nama_rak']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit-data-rak/'.sha1($data['id_rak']));?>"><button class="btn btn-success">Edit</button></a>
                                    <a href="#" onclick="doDeleteRak('<?= sha1($data['id_rak']);?>')"><button class="btn btn-danger">Hapus</button></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function doDeleteRak(id) {
    if(confirm('Hapus data ini?')) { window.location.href = '<?= base_url('admin/hapus-data-rak/');?>' + id; }
}
</script>