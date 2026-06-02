<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Master Data Kategori</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Master Data Kategori</h3><hr/>
                    <a href="<?= base_url('admin/input-data-kategori');?>"><button class="btn btn-primary">Input Data</button></a><br><br>
                    <table data-toggle="table" data-search="true" data-pagination="true">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($data_kategori as $data) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nama_kategori']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit-data-kategori/'.sha1($data['id_kategori']));?>"><button class="btn btn-success">Edit</button></a>
                                    <a href="#" onclick="doDelete('<?= sha1($data['id_kategori']);?>')"><button class="btn btn-danger">Hapus</button></a>
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
function doDelete(id) {
    if(confirm('Hapus data ini?')) { window.location.href = '<?= base_url('admin/hapus-data-kategori/');?>' + id; }
}
</script>