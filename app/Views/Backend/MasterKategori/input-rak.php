<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Input Kategori</h3><hr/>
                    <form action="<?= base_url('admin/simpan-kategori');?>" method="post">
                        <div class="form-group col-md-6">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" name="nama_kategori" required>
                        </div>
                        <div style="clear:both;"></div>
                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('admin/master-data-kategori');?>" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>