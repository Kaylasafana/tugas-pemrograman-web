<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="panel panel-default">
        <div class="panel-body">

            <h3>Settings Akun</h3>
            <hr>

            <div class="row">

                <!-- DATA AKUN -->
                <div class="col-md-6">

                    <h4>Data Akun</h4>

                    <table class="table table-bordered">

                        <tr>
                            <th>Nama</th>
                            <td><?= $admin['nama_admin']; ?></td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <td><?= $admin['username_admin']; ?></td>
                        </tr>

                        <tr>
                            <th>Level</th>
                            <td><?= $admin['akses_level']; ?></td>
                        </tr>

                    </table>

                </div>

                <!-- GANTI PASSWORD -->
                <div class="col-md-6">

                    <h4>Ganti Password</h4>

                    <form action="<?= base_url('admin/update-password'); ?>" method="post">

                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary">Update Password</button>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>