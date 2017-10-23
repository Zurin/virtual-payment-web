<?php
require APPPATH . '/libraries/REST_Controller.php';
date_default_timezone_set('Asia/Jakarta');

class API extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data mahasiswa
    function index_get() {
      echo "Halo";
    }

    function login_post() {
        $username = $this->post('username');
        $password = $this->post('password');
        $this->db->where('username', $username);
        $this->db->where('password', sha1($password));
        $result = $this->db->get('tb_user');
        $hasil = $result->result();
        if ($result->num_rows() == 1) {
            $data['data']= array(
              'id_user' => $hasil[0]->id_user,
              'username' => $hasil[0]->username,
              'password' => $hasil[0]->password,
              'nama' => $hasil[0]->nama,
              'email' => $hasil[0]->email,
              'no_hp' => $hasil[0]->no_hp,
              'deposit' => $hasil[0]->deposit,
              'level' => $hasil[0]->level
            );
            $data['status']=200;
            $data['message']='Login sukses';
            $this->response($data, 200);
        } else {
          $data['status']=502;
          $data['message']='Login gagal';
          $this->response($data, 200);
        }
    }

    function register_post(){
      $nama = $this->post('nama');
      $username = $this->post('username');
      $password1 = $this->post('password1');
      $password2 = $this->post('password2');
      $no_hp = $this->post('no_hp');
      $email = $this->post('email');
      $add_user = array(
          'username' => $username,
          'password' => sha1($password1),
          'nama' => $nama,
          'email' => $email,
          'no_hp' => $no_hp,
          'deposit' => 0,
          'level' => 'member'
        );
        $this->db->where('username', $username);
  			$query = $this->db->get('tb_user');
  			if($query->num_rows() == 1)
  			{
  					$konflik = 1;
  			} else{
  					$konflik = 0;
  			}
      if ( ($konflik==0) && ($password1 == $password2) ) {
        $insert = $this->db->insert('tb_user', $add_user);
        $data['status']=200;
        $data['message']='Registrasi sukses';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Gagal, password tidak cocok atau username sudah digunakan';
        $this->response($data, 200);
      }
    }

    function user_deposit_get(){
      $id_user = $this->get('id_user');
      if ($id_user == '') {
        $data['status']=502;
        $data['message']='Gagal, id_user belum ditentukan';
        $this->response($data, 200);
      } else {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tb_user');
        $result = $query->result();
        if ($result) {
          $data['data'] = array('deposit' => $result[0]->deposit);
          $data['status']=200;
          $data['message']='Get data deposit user sukses';
          $this->response($data, 200);
        } else {
          $data['status']=502;
          $data['message']='Gagal, id_user tidak ditemukan';
          $this->response($data, 200);
        }
      }
    }

    function voucher_available_get(){
      $id_kategori = $this->get('id_kategori');
      if ($id_kategori=='') {
        $data['status']=502;
        $data['message']='id_kategori belum di set';
        $this->response($data, 200);
      }
      else {
        $query = $this->db->query("SELECT vc.*, kat.* FROM tb_voucher vc
    															INNER JOIN tb_kategori_voucher kat on kat.id_kategori = vc.id_kategori
    															WHERE vc.id_user IS NULL AND vc.status='valid' AND vc.id_kategori=$id_kategori");
        $voucher = $query->result();
        if ($voucher) {
          $data['data']=$voucher;
          $data['status']=200;
          $data['message']='Sukses mengambil data';
          $this->response($data, 200);
        } else {
          $data['status']=502;
          $data['message']='Tidak ada voucher tersedia';
          $this->response($data, 200);
        }
      }
    }

    function voucher_category_get(){
      $query = $this->db->get('tb_kategori_voucher');
      $kategori = $query->result();
      if ($kategori) {
        $data['data']=$kategori;
        $data['status']=200;
        $data['message']='sukses';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Voucher kategori tidak ditemukan';
        $this->response($data, 200);
      }
    }

    function userVoucher_get(){
      $id_user = $this->get('id_user');
      $query = $this->db->query("SELECT vc.*, kat.nama_kategori FROM tb_voucher vc
                                INNER JOIN tb_kategori_voucher kat on vc.id_kategori = kat.id_kategori
                                WHERE vc.id_user = $id_user");
      $result = $query->result();
      if ($result) {
        $data['data'] = $result;
        $data['status']=200;
        $data['message']='sukses';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='User tidak mempunyai voucher';
        $this->response($data, 200);
      }

    }

    function withdraw_post(){
      $id_user = $this->post('id_user');
      $jumlah_wd = $this->post('jumlah_wd');
      $this->db->where('id_user', $id_user);
      $bank = $this->db->get('tb_bank_user');
      if ($bank->num_rows()==1) {
        $this->db->where('id_user', $id_user);
        $member = $this->db->get('tb_user')->result();
        $deposit = $member[0]->deposit;
        if ($jumlah_wd>$deposit) {
          $data['status']=503;
          $data['message']='Maaf deposit Anda tidak cukup';
          $this->response($data, 200);
        } else {
          $add_wd = array(
              'id_user' => $id_user,
              'jumlah_wd' => $jumlah_wd,
              'status' => 'pending'
            );
          $this->db->insert('tb_req_wd', $add_wd);
          $data['status']=200;
          $data['message']='Sukses, data withdraw Anda telah dikirim ke Admin';
          $this->response($data, 200);
        }
      } else {
        $data['status']=502;
        $data['message']='Gagal, user belum mengisi informasi bank';
        $this->response($data, 200);
      }
    }

    function withdraw_get(){
      $id_user = $this->get('id_user');
      if ($id_user=='') {
        $data['status']=502;
        $data['message']='id_user belum di set';
        $this->response($data, 200);
      }
      else {
        $query = $this->db->query("SELECT wd.*, bank.nama_bank, bank.no_rekening, bank.atas_nama, bank.cabang
                                  FROM tb_req_wd wd
    															INNER JOIN tb_bank_user bank on bank.id_user = wd.id_user
    															WHERE wd.id_user = $id_user");
    		$wd = $query->result();
        if ($wd) {
          $data['data']=$wd;
          $data['status']=200;
          $data['message']='Sukses';
          $this->response($data, 200);
        } else {
          $data['status']=502;
          $data['message']='Tidak ada data withdraw yang ditemukan';
          $this->response($data, 200);
        }
      }
    }

    function topup_post(){
      $id_user = $this->post('id_user');
      $pengirim = $this->post('pengirim');
      $jumlah_topup = $this->post('jumlah_topup');
      $rek_tujuan = $this->post('rek_tujuan');
      $tipe = $this->post('tipe');

      if ($tipe == '1') {
        $add_topup = array(
            'id_user' => $id_user,
            'pengirim' => $pengirim,
            'jumlah_topup' => $jumlah_topup,
            'rek_tujuan' => $rek_tujuan,
            'bukti' => '',
            'tipe' => '1',
            'status' => 'confirmed'
          );
        $this->db->insert('tb_req_topup', $add_topup);
        $this->db->where('id_user', $id_user);
        $member = $this->db->get('tb_user')->result();
        $update_depo = $member[0]->deposit + $jumlah_topup;
        $this->db->set('deposit', $update_depo);
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user');
        $data['status']=200;
        $data['message']='Deposit telah di tambahkan via top up';
        $this->response($data, 200);
      } else if ($tipe == '0'){
        $errors= array();
        $file_name = $_FILES['bukti']['name'];
        $file_size =$_FILES['bukti']['size'];
        $file_tmp =$_FILES['bukti']['tmp_name'];
        $file_type=$_FILES['bukti']['type'];


        if($file_size > 2097152){
          $data['status']=502;
          $data['message']='Ukuran file harus kurang dari 2MB';
          $this->response($data, 200);
        }

        if(empty($errors)==true){
          $move = move_uploaded_file($file_tmp,"assets/asset/bukti/".$file_name);
          if ($move) {
            $add_topup = array(
                'id_user' => $id_user,
                'pengirim' => $pengirim,
                'jumlah_topup' => $jumlah_topup,
                'rek_tujuan' => $rek_tujuan,
                'bukti' => $file_name,
                'tipe' => '0',
                'status' => 'pending'
              );
            $this->db->insert('tb_req_topup', $add_topup);
            $data['status']=200;
            $data['message']='Data top up telah di kirim ke Admin';
            $this->response($data, 200);
          }else{
            $data['status']=502;
            $data['message']='Gagal upload file';
            $this->response($data, 200);
          }
        }
      }

    }

    function topup_get(){
      $id_user = $this->get('id_user');
      $this->db->where('id_user', $id_user);
      $topup = $this->db->get('tb_req_topup')->result();
      if ($topup) {
        $data['data'] = $topup;
        $data['status']=200;
        $data['message']='Sukses mengambil data';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Tidak ada data yang ditemukan';
        $this->response($data, 200);
      }
    }

    function bank_get(){
      $id_user = $this->get('id_user');
      $this->db->where('id_user', $id_user);
      $bank = $this->db->get('tb_bank_user')->result();
      if ($bank) {
        $data['data'] = array('id_user' => $bank[0]->id_user,
                              'nama_bank' => $bank[0]->nama_bank,
                              'no_rekening' => $bank[0]->no_rekening,
                              'atas_nama' => $bank[0]->atas_nama,
                              'cabang' => $bank[0]->cabang
                              );
        $data['status']=200;
        $data['message']='Bank data berhasil di ambil dari pengguna';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Tidak ada data ditemukan';
        $this->response($data, 200);
      }
    }

    function bank_post(){
      $id_user = $this->post('id_user');
      $nama_bank = $this->post('nama_bank');
      $no_rekening = $this->post('no_rekening');
      $atas_nama = $this->post('atas_nama');
      $cabang = $this->post('cabang');
      $this->db->where('id_user', $id_user);
      $query = $this->db->get('tb_bank_user');
      $bank = $query->result();
      if ($query->num_rows()==1) {
        if ($bank[0]->disabled == 1) {
          $data['status']=502;
          $data['message']='Gagal, tidak dapat mengedit data bank lebih dari 1 kali';
          $this->response($data, 200);
        } else {
          $update_bank = array('nama_bank' => $nama_bank,
                               'no_rekening' => $no_rekening,
                               'atas_nama' => $atas_nama,
                               'cabang' => $cabang,
                               'disabled' => 1
                              );
          $this->db->where('id_user', $id_user);
          $this->db->update('tb_bank_user', $update_bank);
          $data['status']=200;
          $data['message']='Informasi bank berhasil diedit';
          $this->response($data, 200);
        }
      } else {
        $add_bank = array('id_user' => $id_user,
                          'nama_bank' => $nama_bank,
                          'no_rekening' => $no_rekening,
                          'atas_nama' => $atas_nama,
                          'cabang' => $cabang,
                          'disabled' => '0'
                          );
        $this->db->insert('tb_bank_user', $add_bank);
        $data['status']=200;
        $data['message']='Informasi bank berhasil ditambahkan';
        $this->response($data, 200);
      }
    }

    function transfer_get(){
      $this->db->where('nama_deskripsi', 'deskripsi mobile');
      $deskripsi = $this->db->get('tb_deskripsi')->result();
      $bank = $this->db->get('tb_bank')->result();
      if ($deskripsi) {
        $data['deskripsi'] = $deskripsi[0]->isi;
        $data['bank'] = $bank;
        $data['status']=200;
        $data['message']='Data berhasil di ambil';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Tidak ada data yang di temukan';
        $this->response($data, 200);
      }
    }

    function buy_voucher_post()
    {
      $id_user = $this->post('id_user');
      $kode_voucher = $this->post('kode_voucher');
      $this->db->where('id_user', $id_user);
      $query1 = $this->db->get('tb_user');
      $this->db->where('kode_voucher', $kode_voucher);
      $query2 = $this->db->get('tb_voucher');
      $user = $query1->result();
      $voucher = $query2->result();
      if (($query1->num_rows()==1)&&($query2->num_rows()==1)&&($user[0]->deposit > $voucher[0]->nominal)) {
        $update_depo = $user[0]->deposit - $voucher[0]->nominal;
        $this->db->set('id_user', $user[0]->id_user);
        $this->db->set('tanggal', date('Y-m-d h:i:sa'));
        $this->db->where('kode_voucher', $kode_voucher);
        $this->db->update('tb_voucher');
        $this->db->set('deposit', $update_depo);
        $this->db->where('id_user', $user[0]->id_user);
        $this->db->update('tb_user');
        $add_transaksi = array('id_user' => $id_user,
                               'jenis_transaksi' => 'Pembelian Voucher',
                               'nominal' => $voucher[0]->nominal,
                               'tgl_transaksi' => date("Y-m-d")
                              );
        $this->db->insert('tb_history_transaksi', $add_transaksi);
        $data['status']=200;
        $data['message']='Voucher berhasil di beli';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Gagal, voucher tidak ada atau deposit Anda tidak mencukupi untuk pembelian';
        $this->response($data, 200);
      }
    }

    function using_voucher_post(){
      $kode_vc = $this->post('kode_voucher');
      $id_kategori = $this->post('id_kategori');
      $where = "id_user IS NOT NULL AND status='valid' AND kode_voucher='$kode_vc' AND id_kategori='$id_kategori'";
      $this->db->where($where);
      $result = $this->db->get('tb_voucher');
      $hasil = $result->result();
      if ($result->num_rows()==1) {
        $data['data']= array(
          'kode_voucher' => $hasil[0]->kode_voucher,
          'nominal' => $hasil[0]->nominal
        );
        $this->db->set('status', 'invalid');
        $this->db->where('kode_voucher', $kode_vc);
        $this->db->update('tb_voucher');
        $data['status']=200;
        $data['message']='Sukses menggunakan voucher';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Gagal, voucher tidak di temukan atau sudah invalid';
        $this->response($data, 200);
      }
    }

    function profile_get() {
        $id_user = $this->get('id_user');
        if ($id_user == '') {
          $data['status']=502;
          $data['message']='Gagal, id_user belum di set';
          $this->response($data, 200);
        } else {
            $this->db->where('id_user', $id_user);
            $user = $this->db->get('tb_user')->result();
            $data['data'] = array('id_user' => $user[0]->id_user,
                                  'username' => $user[0]->username,
                                  'password' => $user[0]->password,
                                  'nama' => $user[0]->nama,
                                  'email' => $user[0]->email,
                                  'no_hp' => $user[0]->no_hp,
                                  'avatar' => base_url()."assets/asset/profile/".$user[0]->avatar
                                 );
            $data['status']=200;
            $data['message']='Pengambilan data user berhasil';
            $this->response($data, 200);
        }

    }

    function profile_post(){
      $id_user = $this->post('id_user');
      $nama = $this->post('nama');
      $email = $this->post('email');
      $no_hp = $this->post('no_hp');
      $password1 = $this->post('password1');
      $password2 = $this->post('password2');
      $this->db->where('id_user', $id_user);
      $member = $this->db->get('tb_user')->result();
        if ($password1 != $password2) {
          $data['status']=502;
          $data['message']='Gagal, password baru tidak cocok';
          $this->response($data, 200);
        } else {
          if (isset($_FILES['avatar'])) {
            $errors= array();
      			$file_name = $_FILES['avatar']['name'];
      			$file_size =$_FILES['avatar']['size'];
      			$file_tmp =$_FILES['avatar']['tmp_name'];
      			$file_type=$_FILES['avatar']['type'];

      			if($file_size > 2097152){
              $data['status']=502;
              $data['message']='File gambar harus kurang dari 2mb';
              $this->response($data, 200);
      				$errors[] = "filesize";
      			}

      			if(empty($errors)==true){
      				$move = move_uploaded_file($file_tmp,"assets/asset/profile/".$file_name);
      				if ($move) {
                if ($password1 == '') {
                  $update_profile = array('nama' => $nama,
                                          'email' => $email,
                                          'no_hp' => $no_hp,
                                          'avatar' => $file_name
                                         );
                } else {
                  $update_profile = array('nama' => $nama,
                                          'email' => $email,
                                          'no_hp' => $no_hp,
                                          'password' => sha1($password1),
                                          'avatar' => $file_name
                                         );
                }
                $this->db->where('id_user', $id_user);
                $this->db->update('tb_user', $update_profile);
                $data['status']=200;
                $data['message']='Profil berhasil diperbaharui';
                $this->response($data, 200);
      				}else{
                $data['status']=502;
                $data['message']='Gagal upload file';
                $this->response($data, 200);
      				}
          }
        } else {
          if ($password1 == '') {
            $update_profile = array('nama' => $nama,
                                    'email' => $email,
                                    'no_hp' => $no_hp
                                   );
          } else {
            $update_profile = array('nama' => $nama,
                                    'email' => $email,
                                    'no_hp' => $no_hp,
                                    'password' => sha1($password1)
                                   );
          }
          $this->db->where('id_user', $id_user);
          $this->db->update('tb_user', $update_profile);
          $data['status']=200;
          $data['message']='Profil telah diperbaharui';
          $this->response($data, 200);
        }

      }
    }

    function history_transaksi_get(){
      $id_user = $this->get('id_user');
      $this->db->where('id_user', $id_user);
      $transaksi = $this->db->get('tb_history_transaksi')->result();
      if ($transaksi) {
        //$data['data'] = $transaksi;
        $e = array();
        $i = 0;
        foreach ($transaksi as $key => $value) {
          if ($value->jenis_transaksi == "Pembelian Voucher" || $value->jenis_transaksi == "Withdraw") {
            $data['id_transaksi'] = $value->id_transaksi;
            $data['id_user'] = $value->id_user;
            $data['jenis_transaksi'] = $value->jenis_transaksi;
            $data['nominal'] = $value->nominal;
            $data['tgl_transaksi'] = $value->tgl_transaksi;
            $data['kategori'] = "Kredit";
          } else {
            $data['id_transaksi'] = $value->id_transaksi;
            $data['id_user'] = $value->id_user;
            $data['jenis_transaksi'] = $value->jenis_transaksi;
            $data['nominal'] = $value->nominal;
            $data['tgl_transaksi'] = $value->tgl_transaksi;
            $data['kategori'] = "Debet";
          }
          $e[$i]=$data;
          $i++;
        }
        $datas['data'] = $e;
        $datas['status']=200;
        $datas['message']='Data transaksi berhasil di ambil';
        $this->response($datas, 200);
      } else {
        $datas['status']=502;
        $datas['message']='Data tidak di temukan';
        $this->response($datas, 200);
      }

    }

    function using_withdraw_post(){
      $username = $this->post('username');
      $password = $this->post('password');
      $jumlah_wd = $this->post('jumlah_wd');
      $this->db->where('username', $username);
      $this->db->where('password', sha1($password));
      $query = $this->db->get('tb_user');
      $result = $query->result();
      if ($query->num_rows()==1) {
        $id_user = $result[0]->id_user;
        $deposit = $result[0]->deposit;
        $update_depo = $deposit+$jumlah_wd;
        $this->db->set('deposit', $update_depo);
        $this->db->where('id_user', $id_user);
        $this->db->update('tb_user');

        $add_transaksi = array('id_user' => $id_user,
                               'jenis_transaksi' => 'Withdraw 3rd Apps',
                               'nominal' => $jumlah_wd,
                               'tgl_transaksi' => date("Y-m-d")
                              );
        $this->db->insert('tb_history_transaksi', $add_transaksi);
        $data['status']=200;
        $data['message']='Withdraw berhasil';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Gagal, data user invalid';
        $this->response($data, 200);
      }
    }

}
