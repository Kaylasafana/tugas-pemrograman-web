<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Edit Anggota</h3><hr/>
                    <form action="<?= base_url('admin/update-anggota');?>" method="post">
                        <div class="form-group col-md-6">
                            <label>Nama Anggota</label>
                            <input type="text" class="form-control" name="nama_anggota" value="<?= $data_anggota['nama_anggota'];?>" required>
                        </div><div style="clear:both;"></div>
                        
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="L" <?= ($data_anggota['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-Laki</option>
                                <option value="P" <?= ($data_anggota['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div><div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>No Telepon</label>
                            <input type="text" class="form-control" name="no_telp" value="<?= $data_anggota['no_telp'];?>" required>
                        </div><div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="<?= $data_anggota['email'];?>" required>
                        </div><div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" required><?= $data_anggota['alamat'];?></textarea>
                        </div><div style="clear:both;"></div>

                        <div class="form-group col-md-6">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= base_url('admin/master-data-anggota');?>" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>