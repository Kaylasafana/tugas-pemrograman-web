<?php

namespace App\Controllers;

use App\Models\M_Admin;
use App\Models\M_Kategori;
use App\Models\M_Rak;
use App\Models\M_Anggota;

class Admin extends BaseController
{
    public function login()
    {
        return view('Backend/Login/login');
    }

        public function dashboard()
    {
        if(session()->get('ses_id')=="" or session()->get('ses_user')=="" or session()->get('ses_level')==""){ 
            session()->setFlashdata('error','Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        }
        else{
            return view('Backend/Template/header')
                 . view('Backend/Template/sidebar')
                 . view('Backend/Login/dashboard_admin')
                 . view('Backend/Template/footer');
        }
    }
    
    public function autentikasi(){
        $modelAdmin = new M_Admin; // proses inisiasi model 
        $username = $this->request->getPost('username'); 
        $password = $this->request->getPost('password');
        
        $cekUsername = $modelAdmin->getDataAdmin(['username_admin' => $username, 'is_delete_admin' => '0'])->getNumRows(); 
        if($cekUsername == 0){
            session()->setFlashdata('error', 'Username Tidak Ditemukan!');
            ?>
            <script>
                history.go(-1);
            </script> 
            <?php

        }
        else{

            $dataUser = $modelAdmin->getDataAdmin(['username_admin' => $username, 'is_delete_admin' => '0'])->getRowArray();
            $passwordUser = $dataUser ['password_admin']; 

            $verifikasiPassword = password_verify($password, $passwordUser); 

            if(!$verifikasiPassword){
                session()->setFlashdata('error', 'Password Tidak Sesuai!');
                ?>
                <script>
                    history.go(-1);
                </script>
                <?php
            }
            else{
                $dataSession = [
                    'ses_id' => $dataUser['id_admin'], 
                    'ses_user' => $dataUser['nama_admin'], 
                    'ses_level' => $dataUser['akses_level']
                ];

                session()->set($dataSession);

                session()->setFlashdata('success', 'Login Berhasil!');
                ?>
                <script>
                    document.location = "<?= base_url('admin/dashboard-admin'); ?>";
                </script>
                <?php
            }
                }
                }

    
    public function logout()
    {
        session()->remove('ses_id'); session()->remove('ses_user'); session()->remove('ses_level');
        session()->setFlashdata('info','Anda telah keluar dari sistem!');
        ?>
        <script>
            document.location = "<?= base_url('admin/login-admin');?>";
        </script>
        <?php
    }

    
    public function input_data_admin()
    {
     if (
        session()->get('ses_id') == "" or
        session()->get('ses_user') == "" or
        session()->get('ses_level') == ""
    ) {
        session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
        ?>
        <script>
            document.location = "<?= base_url('admin/login-admin'); ?>";
        </script>
        <?php
    }
    else{
        return view('Backend/Template/header')
              . view('Backend/Template/sidebar')
              . view('Backend/MasterAdmin/input-admin')
              . view('Backend/Template/footer');
        }
    }

    
    public function simpan_data_admin()
    {
        if (session()->get('ses_id')=="" or 
        session()->get('ses_user')=="" or 
        session()->get('ses_level')=="")
        { session()->setFlashdata('error','Silakan login terlebih dahulu!');
        ?>
        <script>
            document.location="<?= base_url('admin/login-admin'); ?>";
        </script>
        <?php
    }
    else{
        $modelAdmin = new M_Admin; // inisiasi

        $nama = $this->request->getPost('nama');
        $username = $this->request->getPost('username'); 
        $level = $this->request->getPost('level');

        $cekUname = $modelAdmin->getDataAdmin(['username_admin' => $username])->getNumRows();
            if($cekUname > 0){
                session()->setFlashdata('error', 'Username sudah digunakan!!');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php
            }
    
    else{
        $hasil = $modelAdmin->autoNumber()->getRowArray();
        if(!$hasil){
            $id = "ADM001";
        }
        else{
            $kode = $hasil['id_admin'];
            $noUrut = (int) substr($kode, -3);
            $noUrut++;
            $id = "ADM".sprintf("%03s", $noUrut);
        }

        $datasimpan = [
            'id_admin' => $id,
            'nama_admin' => $nama,
            'username_admin' => $username,
            'password_admin' => password_hash('pass_admin', PASSWORD_DEFAULT),
            'akses_level' => $level,
            'is_delete_admin' => '0',
            'created_at' => date('Y-m-d H:i:s'), 
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $modelAdmin->saveDataAdmin($datasimpan);
        session()->setFlashdata('success', 'Data Admin Berhasil Ditambahkan!!');
        ?>
        <script>
             document.location = "<?= base_url('admin/master-data-admin'); ?>";
        </script>
        <?php
     }
    }
   }


    public function master_data_admin()
    {
        if (
            session()->get('ses_id') == "" or
            session()->get('ses_user') == "" or
            session()->get('ses_level') == ""
        ) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
        }
        else{
            $modelAdmin = new M_Admin(); // inisiasi model

            $uri = service('uri');
            $pages = $uri->getSegment(2);

            $dataUser = $modelAdmin->getDataAdmin([
                'is_delete_admin' => '0',
                'akses_level !='  => '1'
            ])->getResultArray();

            $data['pages'] = $pages;
            $data['data_user'] = $dataUser;

            return view('Backend/Template/header', $data)
                . view('Backend/Template/sidebar', $data)
                . view('Backend/MasterAdmin/master-data-admin', $data)
                . view('Backend/Template/footer', $data);
        }
    }


    public function edit_data_admin()
    {
        $uri = service('uri');
        $idEdit = $uri->getSegment(3);

        $modelAdmin = new M_Admin();

        // Ambil data admin berdasarkan ID (yang sudah di-sha1)
        $dataAdmin = $modelAdmin->getDataAdmin(['sha1(id_admin)' => $idEdit])->getRowArray();

       // Simpan ID ke session
        session()->set(['idUpdate' => $dataAdmin['id_admin']]);

        $page = $uri->getSegment(2);

        $data = [
            'page'        => $page,
            'web_title'   => 'Edit Data Admin',
            'data_admin'  => $dataAdmin // mengirim array data admin ke view
        ];

        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAdmin/edit-admin', $data);
        echo view('Backend/Template/footer', $data);
    }

    
    public function update_admin()
    {
        $modelAdmin = new M_Admin();

        $idUpdate = session()->get('idUpdate');
        $nama     = $this->request->getPost('nama');
        $level    = $this->request->getPost('level');
        $password = $this->request->getPost('password');

        if ($nama == "" || $level == "") {

            session()->setFlashdata('error', 'Isian tidak boleh kosong!!');
            ?>
            <script>
                history.go(-1);
            </script>
            <?php

        } else {

            // data dasar yang selalu diupdate
            $dataUpdate = [
                'nama_admin'  => $nama,
                'akses_level' => $level,
                'updated_at'  => date("Y-m-d H:i:s")
            ];

            // kalau password diisi, baru update password
            if ($password != "") {
                $dataUpdate['password_admin'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $whereUpdate = ['id_admin' => $idUpdate];

            $modelAdmin->updateDataAdmin($dataUpdate, $whereUpdate);

            session()->remove('idUpdate');
            session()->setFlashdata('success', 'Data Admin Berhasil Diperbaharui!');
            ?>
            <script>
                document.location = "<?= base_url('admin/master-data-admin'); ?>";
            </script>
            <?php
        }
    }


    public function hapus_data_admin()
    {
        $modelAdmin = new M_Admin();

        $uri = service('uri');
        $idHapus = $uri->getSegment(3);

        // hapus langsung dari database
        $modelAdmin->delete($idHapus);

        session()->setFlashdata('success', 'Data Admin Berhasil Dihapus!');

            ?>
            <script>
            document.location = "<?= base_url('admin/master-data-admin'); ?>";
            </script>
            <?php

            // return redirect()->to(base_url('admin/master-data-admin'));
        }   


    public function profile()
    {
            if (
                session()->get('ses_id') == "" ||
                session()->get('ses_user') == "" ||
                session()->get('ses_level') == ""
            ) {
                session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
                ?>
                <script>
                    document.location = "<?= base_url('admin/login-admin'); ?>";
                </script>
                <?php
                return;
            }

            $modelAdmin = new M_Admin();

            $id = session()->get('ses_id');

            $data['admin'] = $modelAdmin
                ->getDataAdmin(['id_admin' => $id])
                ->getRowArray();

            return view('Backend/Template/header', $data)
                . view('Backend/Template/sidebar', $data)
                . view('Backend/profile', $data)
                . view('Backend/Template/footer', $data);
    }


    public function settings()
    {
        if (
            session()->get('ses_id') == "" ||
            session()->get('ses_user') == "" ||
            session()->get('ses_level') == ""
        ) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu!');
            ?>
            <script>
                document.location = "<?= base_url('admin/login-admin'); ?>";
            </script>
            <?php
            return;
        }

        $modelAdmin = new M_Admin();

        $id = session()->get('ses_id');

        $data['admin'] = $modelAdmin
            ->getDataAdmin(['id_admin' => $id])
            ->getRowArray();

        return view('Backend/Template/header', $data)
            . view('Backend/Template/sidebar', $data)
            . view('Backend/setting', $data)
            . view('Backend/Template/footer', $data);
    }

    
    public function update_password()
    {
        $modelAdmin = new M_Admin();

        $id = session()->get('ses_id');
        $password = $this->request->getPost('password');

        if ($password == "") {
            session()->setFlashdata('error', 'Password tidak boleh kosong!');
            return redirect()->back();
        }

        $dataUpdate = [
            'password_admin' => password_hash($password, PASSWORD_DEFAULT),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $modelAdmin->updateDataAdmin($dataUpdate, ['id_admin' => $id]);

        session()->setFlashdata('success', 'Password berhasil diupdate!');
        return redirect()->to(base_url('admin/settings'));
    }

    // ================= CRUD KATEGORI =================
    public function master_data_kategori(){
        $model = new M_Kategori;
        $data['page'] = service('uri')->getSegment(2);
        $data['data_kategori'] = $model->getDataKategori(['is_delete_kategori' => '0'])->getResultArray();
        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterKategori/master-data-kategori', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function input_data_kategori(){
        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/MasterKategori/input-kategori');
        echo view('Backend/Template/footer');
    }

    public function simpan_kategori(){
        $model = new M_Kategori;
        $nama = $this->request->getPost('nama_kategori');
        $hasil = $model->autoNumber()->getRowArray();
        
        if(!$hasil) { $id = "KAT001"; } 
        else {
            $kode = $hasil['id_kategori'];
            $noUrut = (int) substr($kode, -3);
            $noUrut++;
            $id = "KAT".sprintf("%03s", $noUrut);
        }

        $dataSimpan = [
            'id_kategori' => $id,
            'nama_kategori' => $nama,
            'is_delete_kategori' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $model->saveDataKategori($dataSimpan);
        session()->setFlashdata('success', 'Data Kategori Berhasil Ditambahkan!');
        return redirect()->to(base_url('admin/master-data-kategori'));
    }

    public function edit_data_kategori(){
        $idEdit = service('uri')->getSegment(3);
        $model = new M_Kategori;
        $data['data_kategori'] = $model->getDataKategori(['sha1(id_kategori)' => $idEdit])->getRowArray();
        session()->set(['idUpdate' => $data['data_kategori']['id_kategori']]);
        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterKategori/edit-kategori', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_kategori(){
        $model = new M_Kategori;
        $dataUpdate = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $model->updateDataKategori($dataUpdate, ['id_kategori' => session()->get('idUpdate')]);
        session()->remove('idUpdate');
        session()->setFlashdata('success', 'Data Kategori Berhasil Diupdate!');
        return redirect()->to(base_url('admin/master-data-kategori'));
    }

    public function hapus_data_kategori(){
        $model = new M_Kategori;
        $idHapus = service('uri')->getSegment(3);
        $model->updateDataKategori(['is_delete_kategori' => '1', 'updated_at' => date('Y-m-d H:i:s')], ['sha1(id_kategori)' => $idHapus]);
        session()->setFlashdata('success', 'Data Kategori Berhasil Dihapus!');
        return redirect()->to(base_url('admin/master-data-kategori'));
    }

    // ================= CRUD RAK =================
    public function master_data_rak(){
        $model = new M_Rak;
        $data['page'] = service('uri')->getSegment(2);
        $data['data_rak'] = $model->getDataRak(['is_delete_rak' => '0'])->getResultArray();
        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterRak/master-data-rak', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function input_data_rak(){
        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/MasterRak/input-rak');
        echo view('Backend/Template/footer');
    }

    public function simpan_rak(){
        $model = new M_Rak;
        $nama = $this->request->getPost('nama_rak');
        $hasil = $model->autoNumber()->getRowArray();
        
        if(!$hasil) { $id = "RAK001"; } 
        else {
            $kode = $hasil['id_rak'];
            $noUrut = (int) substr($kode, -3);
            $noUrut++;
            $id = "RAK".sprintf("%03s", $noUrut);
        }

        $dataSimpan = [
            'id_rak' => $id,
            'nama_rak' => $nama,
            'is_delete_rak' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $model->saveDataRak($dataSimpan);
        session()->setFlashdata('success', 'Data Rak Berhasil Ditambahkan!');
        return redirect()->to(base_url('admin/master-data-rak'));
    }

    public function edit_data_rak(){
        $idEdit = service('uri')->getSegment(3);
        $model = new M_Rak;
        $data['data_rak'] = $model->getDataRak(['sha1(id_rak)' => $idEdit])->getRowArray();
        session()->set(['idUpdate' => $data['data_rak']['id_rak']]);
        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterRak/edit-rak', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_rak(){
        $model = new M_Rak;
        $dataUpdate = [
            'nama_rak' => $this->request->getPost('nama_rak'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $model->updateDataRak($dataUpdate, ['id_rak' => session()->get('idUpdate')]);
        session()->remove('idUpdate');
        session()->setFlashdata('success', 'Data Rak Berhasil Diupdate!');
        return redirect()->to(base_url('admin/master-data-rak'));
    }

    public function hapus_data_rak(){
        $model = new M_Rak;
        $idHapus = service('uri')->getSegment(3);
        $model->updateDataRak(['is_delete_rak' => '1', 'updated_at' => date('Y-m-d H:i:s')], ['sha1(id_rak)' => $idHapus]);
        session()->setFlashdata('success', 'Data Rak Berhasil Dihapus!');
        return redirect()->to(base_url('admin/master-data-rak'));
    }

    // ================= CRUD ANGGOTA =================
    public function master_data_anggota(){
        $model = new M_Anggota;
        $data['page'] = service('uri')->getSegment(2);
        $data['data_anggota'] = $model->getDataAnggota(['is_delete_anggota' => '0'])->getResultArray();
        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAnggota/master-data-anggota', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function input_data_anggota(){
        echo view('Backend/Template/header');
        echo view('Backend/Template/sidebar');
        echo view('Backend/MasterAnggota/input-anggota');
        echo view('Backend/Template/footer');
    }

    public function simpan_anggota(){
        $model = new M_Anggota;
        $hasil = $model->autoNumber()->getRowArray();
        
        if(!$hasil) { $id = "AGT001"; } 
        else {
            $kode = $hasil['id_anggota'];
            $noUrut = (int) substr($kode, -3);
            $noUrut++;
            $id = "AGT".sprintf("%03s", $noUrut);
        }

        $dataSimpan = [
            'id_anggota' => $id,
            'nama_anggota' => $this->request->getPost('nama_anggota'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'password_anggota' => password_hash('12345', PASSWORD_DEFAULT), // Default Password
            'is_delete_anggota' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $model->saveDataAnggota($dataSimpan);
        session()->setFlashdata('success', 'Data Anggota Berhasil Ditambahkan!');
        return redirect()->to(base_url('admin/master-data-anggota'));
    }

    public function edit_data_anggota(){
        $idEdit = service('uri')->getSegment(3);
        $model = new M_Anggota;
        $data['data_anggota'] = $model->getDataAnggota(['sha1(id_anggota)' => $idEdit])->getRowArray();
        session()->set(['idUpdate' => $data['data_anggota']['id_anggota']]);
        echo view('Backend/Template/header', $data);
        echo view('Backend/Template/sidebar', $data);
        echo view('Backend/MasterAnggota/edit-anggota', $data);
        echo view('Backend/Template/footer', $data);
    }

    public function update_anggota(){
        $model = new M_Anggota;
        $dataUpdate = [
            'nama_anggota' => $this->request->getPost('nama_anggota'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'no_telp' => $this->request->getPost('no_telp'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $model->updateDataAnggota($dataUpdate, ['id_anggota' => session()->get('idUpdate')]);
        session()->remove('idUpdate');
        session()->setFlashdata('success', 'Data Anggota Berhasil Diupdate!');
        return redirect()->to(base_url('admin/master-data-anggota'));
    }

    public function hapus_data_anggota(){
        $model = new M_Anggota;
        $idHapus = service('uri')->getSegment(3);
        $model->updateDataAnggota(['is_delete_anggota' => '1', 'updated_at' => date('Y-m-d H:i:s')], ['sha1(id_anggota)' => $idHapus]);
        session()->setFlashdata('success', 'Data Anggota Berhasil Dihapus!');
        return redirect()->to(base_url('admin/master-data-anggota'));
    }

}