<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">Master Data Anggota</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Master Data Anggota</h3><hr/>
                    <a href="<?= base_url('admin/input-data-anggota');?>"><button class="btn btn-primary">Input Data Anggota</button></a><br><br>
                    <table data-toggle="table" data-search="true" data-pagination="true">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anggota</th>
                                <th>L/P</th>
                                <th>No Telp</th>
                                <th>Email</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($data_anggota as $data) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nama_anggota']; ?></td>
                                <td><?= $data['jenis_kelamin']; ?></td>
                                <td><?= $data['no_telp']; ?></td>
                                <td><?= $data['email']; ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit-data-anggota/'.sha1($data['id_anggota']));?>"><button class="btn btn-success">Edit</button></a>
                                    <a href="#" onclick="doDeleteAnggota('<?= sha1($data['id_anggota']);?>')"><button class="btn btn-danger">Hapus</button></a>
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
function doDeleteAnggota(id) {
    if(confirm('Hapus data ini?')) { window.location.href = '<?= base_url('admin/hapus-data-anggota/');?>' + id; }
}
</script>