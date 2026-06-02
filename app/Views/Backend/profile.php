<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">

                    <h3>Profile Akun</h3>
                    <hr>

                    <div class="row">

                        <!-- KIRI: AVATAR -->
                        <div class="col-md-4 text-center">

                            <div style="padding:25px; border:1px solid #eee; border-radius:12px; background:#fafafa;">

                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($admin['nama_admin']); ?>&background=0D8ABC&color=fff&size=120" 
                                     class="img-circle"
                                     width="120"
                                     height="120"
                                     style="margin-bottom:15px;">

                                <h4 style="margin-bottom:5px;">
                                    <?= $admin['nama_admin']; ?>
                                </h4>

                                <p style="color:#777;">
                                    <?php 
                                        if($admin['akses_level'] == '1'){
                                            echo "Super Admin";
                                        } else {
                                            echo "Admin";
                                        }
                                    ?>
                                </p>

                            </div>

                        </div>

                        <!-- KANAN: DETAIL RAPI -->
                        <div class="col-md-8">

                            <div style="padding:25px; border:1px solid #eee; border-radius:12px; background:#fafafa;">

                                <h4 style="margin-bottom:20px; border-bottom:1px solid #ddd; padding-bottom:10px;">
                                    Detail Informasi
                                </h4>

                                <div class="row" style="margin-bottom:12px;">
                                    <div class="col-sm-4"><b>ID Admin</b></div>
                                    <div class="col-sm-8">: <?= $admin['id_admin']; ?></div>
                                </div>

                                <div class="row" style="margin-bottom:12px;">
                                    <div class="col-sm-4"><b>Nama</b></div>
                                    <div class="col-sm-8">: <?= $admin['nama_admin']; ?></div>
                                </div>

                                <div class="row" style="margin-bottom:12px;">
                                    <div class="col-sm-4"><b>Username</b></div>
                                    <div class="col-sm-8">: <?= $admin['username_admin']; ?></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4"><b>Level</b></div>
                                    <div class="col-sm-8">
                                        : 
                                        <?php 
                                            if($admin['akses_level'] == '1'){
                                                echo "<span style='color:green;font-weight:bold;'>Super Admin</span>";
                                            } else {
                                                echo "<span style='color:blue;font-weight:bold;'>Admin</span>";
                                            }
                                        ?>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</div>