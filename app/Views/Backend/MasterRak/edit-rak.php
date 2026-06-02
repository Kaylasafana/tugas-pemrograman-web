<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Rak</h3><hr/>
                    <form action="<?= base_url('admin/update-rak');?>" method="post">
                        <div class="form-group col-md-6">
                            <label>Nama Rak</label>
                            <input type="text" class="form-control" name="nama_rak" value="<?= $data_rak['nama_rak'];?>" required>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('admin/master-data-rak');?>" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>