<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
	{
		parent::__construct();
		//$this->validation();
		$this->load->library('pagination');
		$this->load->database();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('db_model');
		$this->load->model('db_login');
	}

	 public function index(){
 		//$category = $this->db_model->get_data('tb_category');
 		$data['judul']="Virtual Payment";
 		$data['halaman']="beranda";
 		//$data['category'] = $category;
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcValid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'valid');
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['vcValid'] = $vcValid;
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else {
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
			$data['dpst'] = $member[0]->deposit;
			$this->template->render('index',$data);
		}
 	}

	public function topup(){
		$data['judul']="Virtual Payment";
		$data['halaman']="topup";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$deskripsi = $this->db_model->get_where_simple('tb_deskripsi', 'nama_deskripsi', 'deskripsi web');
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
			$data['bank'] = $this->db_model->get_data('tb_bank');
			$data['deskripsi'] = $deskripsi[0]->isi;
 			$this->template->render('topup',$data);
	}

	public function req_wd(){
		$data['judul']="Virtual Payment";
		$data['halaman']="wd";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$potongan = $this->db_model->get_data('tb_potongan');
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
			$data['potongan'] = $potongan[0]->potongan;
 			$this->template->render('withdraw',$data);
	}

	public function proses_wd(){
			$user=$this->session->userdata('login');
			if ($this->session->userdata('login')==null)
				$this->load->view('login');
			else{
				$id_user = $user['id_user'];
				$jumlah_wd = $this->input->post('jumlah_wd');
				$this->db->where('id_user', $id_user);
				$query = $this->db->get('tb_bank_user');
				$deposit = $this->db_model->get_where_simple('tb_user','id_user',$id_user);
				$num_dp = $deposit[0]->deposit;
				if ($query->num_rows()==0) {
					$this->session->set_flashdata('wd_error', 'Harap isi informasi bank terlebih dahulu');
				} else if ($jumlah_wd>$num_dp) {
					$this->session->set_flashdata('wd_error', 'Deposit Anda tidak cukup untuk melakukan jumlah withdraw yang Anda masukkan');
				} else {
					$tambah = $this->db_model->insert_wd($id_user, $jumlah_wd);
					if ($tambah == true) {
						$this->session->set_flashdata('wd', 'Request withdraw berhasil, data Anda akan diproses oleh Admin');
					} else {
						$this->session->set_flashdata('wd_error', 'Request withdraw gagal!');
					}
				}
				redirect('home/req_wd');
			}
	}

	public function pending_wd(){
		$data['judul']="Virtual Payment";
        $data['halaman']="pending_wd";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else{
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
			$tampil = $this->db_model->get_data_wd_pending($id_user);
			$data['tampil'] = $tampil;
			$this->template->render('pendingWD',$data);
		}
	}

	public function voucher(){
		$data['judul']="Virtual Payment";
        $data['halaman']="voucher";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else {
			$voucher_user = $this->db_model->get_data_voucher_user($id_user);
			$voucher_user_invalid = $this->db_model->get_data_voucher_user_invalid($id_user);
			$data['voucher_invalid'] = $voucher_user_invalid;
			$data['richie'] = $this->db_model->get_data_voucher('rchi');
			$data['olshop'] = $this->db_model->get_data_voucher('olsp');
			$data['voucher_user'] = $voucher_user;
			$data['jml_rchi'] = $this->db_model->count_data_voucher_kat('tb_voucher', 'id_kategori', 'rchi');
			$data['jml_olshop'] = $this->db_model->count_data_voucher_kat('tb_voucher', 'id_kategori', 'olsp');
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
 			$this->template->render('voucher',$data);
		}
	}

	public function history_pembelian(){
		$data['judul']="Virtual Payment";
        $data['halaman']="beli";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else {
			$data['income'] = $this->db_model->get_transaksi_income($id_user);
			$data['voucher'] = $this->db_model->get_transaksi_voucher($id_user);
			$data['wd'] = $this->db_model->get_transaksi_wd($id_user);
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
 			$this->template->render('history_beli',$data);
		}
	}

	public function buy_voucher(){
		$data['judul']="Virtual Payment";
        $data['halaman']="beli_voucher";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else {
			$kd_vc = $this->uri->segment(3);
			$vc = $this->db_model->get_voucher_order($kd_vc);
			$data['kode_voucher'] = $vc[0]->kode_voucher;
			$data['nama_kategori'] = $vc[0]->nama_kategori;
			$data['nominal'] = $vc[0]->nominal;
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
 			$this->template->render('buyVoucher',$data);
		}
	}

	public function proses_voucher(){
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		if ($user==null)
			$this->load->view('login');
		else {
			$kd_vc = $this->uri->segment(3);
			$deposit = $this->db_model->get_where_simple('tb_user','id_user',$id_user);
			$harga = $this->db_model->get_where_simple('tb_voucher','kode_voucher',$kd_vc);
			$num_dp = $deposit[0]->deposit;
			$num_harga = $harga[0]->nominal;
			if (($harga[0]->id_user)!=NULL) {
				$this->session->set_flashdata('voucher_error',"Voucher sudah terbeli user lain");
			} else if ($num_harga>$num_dp) {
				$this->session->set_flashdata('voucher_error','Deposit tidak cukup untuk membeli voucher');
			}
			else {
				$depo =  $num_dp - $num_harga;
				$this->db_model->update_single_data('tb_user', 'deposit', $depo, 'id_user', $id_user);
				$this->db_model->update_single_data('tb_voucher', 'id_user', $id_user, 'kode_voucher', $kd_vc);
				$this->db_model->update_single_data('tb_voucher', 'tanggal', date("Y-m-d h:i:sa"), 'kode_voucher', $kd_vc);
				$this->db_model->insert_transaksi($id_user, 'Pembelian Voucher', $num_harga);
				$this->session->set_flashdata('voucher', 'Pembelian voucher berhasil');
			}
		}
		redirect('home/voucher');
	}

	public function topup_proses(){
			$user=$this->session->userdata('login');
			$id_user=$user['id_user'];
			if ($this->session->userdata('login')==null)
				$this->load->view('login');
			else{
				$member = $user['id_user'];
				$pengirim = $this->input->post('pengirim');
				$jumlah = $this->input->post('jumlah');
				$tujuan = $this->input->post('tujuan');
				// $this->db_model->insert_order($nama,$id, $member, $alamat, $deskripsi, $tipe_bayar, $pengiriman);
				// $this->session->set_flashdata('order','Order berhasil silahkan cek menu Order. ');
      				$errors= array();
      				$file_name = $_FILES['bukti']['name'];
      				$file_size =$_FILES['bukti']['size'];
      				$file_tmp =$_FILES['bukti']['tmp_name'];
      				$file_type=$_FILES['bukti']['type'];
      				$file_ext=strtolower(end(explode('.',$_FILES['bukti']['name'])));

      				$expensions= array("jpeg","jpg","png");

      				if(in_array($file_ext,$expensions)=== false){
         				$this->session->set_flashdata('topup_error','Extension not allowed, please choose a JPEG or PNG file. ');
         				$errors[] = "extention";
      				}

      				if($file_size > 2097152){
         				$this->session->set_flashdata('topup_error','File size must less than 2 MB. ');
         				$errors[] = "filesize";
      				}

      				if(empty($errors)==true){
         				$move = move_uploaded_file($file_tmp,"assets/asset/bukti/".$file_name);
								if ($move) {
        			 		$this->db_model->insert_topup($member, $pengirim, $jumlah, $tujuan, $file_name);
									$this->session->set_flashdata('topup','Top up berhasil silahkan cek menu Notifikasi. Data Anda akan dicek oleh Admin untuk dikonfirmasi');
        	 			}else{
        	 				$this->session->set_flashdata('topup_error','Top up gagal. '.base_url().'assets/asset/image/');
									redirect('home/topup');
        	 			}
      				}
				redirect('home/topup');
			}
	}

	public function pending_top_up(){
		$data['judul']="Virtual Payment";
        $data['halaman']="pending_topup";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else{
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
			$tampil = $this->db_model->get_where('tb_req_topup', $field_id, $field_status, $id_user, $status);
			$data['tampil'] = $tampil;
			$this->template->render('pendingTopUp',$data);
		}
	}

	public function info_bank(){
		$data['judul']="Virtual Payment";
        $data['halaman']="bank";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else{
			$member = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$data['avatar'] = $member[0]->avatar;
			$data['nama'] = $member[0]->nama;
			$tampil = $this->db_model->get_where_simple('tb_bank_user', 'id_user', $id_user);
			$this->db->where('id_user', $id_user);
			$query = $this->db->get('tb_bank_user');
			if ($query->num_rows() == 1) {
				$data['nama_bank'] = $tampil[0]->nama_bank;
				$data['no_rekening'] = $tampil[0]->no_rekening;
				$data['atas_nama'] = $tampil[0]->atas_nama;
				$data['cabang'] = $tampil[0]->cabang;
				$data['link'] = "home/edit_bank";
				$data['tombol'] = "Simpan";
				if ($tampil[0]->disabled==1) {
					$data['edit'] = "disabled='disabled'";
				} else {
					$data['edit'] = "";
				}
			} else {
				$data['nama_bank'] = "";
				$data['no_rekening'] = "";
				$data['atas_nama'] = "";
				$data['cabang'] = "";
				$data['edit'] = "";
				$data['link'] = "home/tambah_bank";
				$data['tombol'] = "Kirim";
			}
			$this->template->render('bank',$data);
		}
	}

	public function tambah_bank(){
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		if ($user==null)
			$this->load->view('login');
		else {
			$nama_bank = $this->input->post('nama_bank');
			$no_rek = $this->input->post('no_rekening');
			$atas_nama = $this->input->post('atas_nama');
			$cabang = $this->input->post('cabang');
			$tambah = $this->db_model->insert_bank($id_user, $nama_bank, $no_rek, $atas_nama, $cabang);
			if ($tambah==true) {
				$this->session->set_flashdata('bank', 'Penambahan informasi bank berhasil');
			} else {
				$this->session->set_flashdata('bank_error', 'Penambahan informasi bank gagal!');
			}
		}
		redirect('home/info_bank');
	}

	public function edit_bank(){
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		if ($user==null)
			$this->load->view('login');
		else {
			$nama_bank = $this->input->post('nama_bank');
			$no_rek = $this->input->post('no_rekening');
			$atas_nama = $this->input->post('atas_nama');
			$cabang = $this->input->post('cabang');
			$tambah = $this->db_model->update_bank($id_user, $nama_bank, $no_rek, $atas_nama, $cabang);
			if ($tambah==true) {
				$this->session->set_flashdata('bank', 'Pengubahan informasi bank berhasil, Anda tidak dapat lagi mengubah informasi bank!');
			} else {
				$this->session->set_flashdata('bank_error', 'Pengubahan informasi bank gagal');
			}
		}
		redirect('home/info_bank');
	}

	public function profile(){
		$data['judul']="Virtual Payment";
        $data['halaman']="profile";
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		$field_id = 'id_user';
		$field_status = 'status';
		$status = 'pending';
		$jmlTopUp = $this->db_model->count_notif('tb_req_topup', $field_id, $field_status, $id_user, $status);
		$vcInvalid = $this->db_model->count_notif('tb_voucher', $field_id, $field_status, $id_user,'invalid');
		$data['jmlWd'] = $this->db_model->count_notif('tb_req_wd', $field_id, $field_status, $id_user, $status);
		$data['invalid'] = $vcInvalid;
		$data['jmlTopUp'] = $jmlTopUp;
		if ($user==null)
			$this->load->view('login');
		else{
			$tampil = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			$this->db->where('id_user', $id_user);
			$data['nama'] = $tampil[0]->nama;
			$data['email'] = $tampil[0]->email;
			$data['no_hp'] = $tampil[0]->no_hp;
			$data['avatar'] = $tampil[0]->avatar;
			$this->template->render('profile',$data);
		}
	}

	public function proses_profile(){
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		if ($user==null)
			$this->load->view('login');
		else {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$no_hp = $this->input->post('no_hp');
			$update = $this->db_model->update_profile_basic($id_user, $nama, $email, $no_hp);
			if ($update==true) {
				$this->session->set_flashdata('profile', 'Basic info berhasil diubah');
			} else {
				$this->session->set_flashdata('profile_error', 'Pengubahan basic info gagal');
			}
		}
		redirect('home/profile');
	}

	public function proses_password(){
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		if ($user==null)
			$this->load->view('login');
		else {
			$password1 = $this->input->post('password1');
			$password2 = $this->input->post('password2');
			$konf_password = $this->input->post('konf_password');
			$db_pass = $this->db_model->get_where_simple('tb_user', 'id_user', $id_user);
			if ((sha1($password1)) != ($db_pass[0]->password)) {
				$this->session->set_flashdata('profile_error', 'Password salah!');
			} else {
				if ($password2 != $konf_password) {
					$this->session->set_flashdata('profile_error', 'Password baru tidak cocok');
				} else {
					$update = $this->db_model->update_single_data('tb_user', 'password', sha1($password2), 'id_user', $id_user);
					$this->session->set_flashdata('profile', 'Password berhasil diubah');
				}
			}
		}
		redirect('home/profile');
	}

	public function proses_avatar(){
		$user = $this->session->userdata('login');
		$id_user = $user['id_user'];
		if ($user==null)
			$this->load->view('login');
		else {
			$errors= array();
			$file_name = $_FILES['avatar']['name'];
			$file_size =$_FILES['avatar']['size'];
			$file_tmp =$_FILES['avatar']['tmp_name'];
			$file_type=$_FILES['avatar']['type'];
			$file_ext=strtolower(end(explode('.',$file_name)));

			$expensions= array("jpeg","jpg","png");

			if(in_array($file_ext,$expensions)=== false){
				$this->session->set_flashdata('profile_error','Extension not allowed, please choose a JPEG or PNG file. ');
				$errors[] = "extention";
			}

			if($file_size > 2097152){
				$this->session->set_flashdata('profile_error','File size must less than 2 MB. ');
				$errors[] = "filesize";
			}

			if(empty($errors)==true){
				$move = move_uploaded_file($file_tmp,"assets/asset/profile/".$file_name);
				if ($move) {
					$this->db_model->update_single_data('tb_user', 'avatar', $file_name, 'id_user', $id_user);
					$this->session->set_flashdata('profile','Avatar berhasil diubah');
				}else{
					$this->session->set_flashdata('profile_error','Upload gagal. '.base_url().'assets/asset/profile/');
				}
			}
		}
		redirect('home/profile');
	}

	public function login(){
		$data['judul']="Virtual Payment";
		if ($this->session->userdata('login')==null)
			$this->load->view('login');
		else
			$this->template->render('index',$data);
	}

	public function proses_login()
	{
        $result = $this->db_login->login_member();
        //print_r($result);
        if($result==false){
						$this->session->set_flashdata('error','Username atau password salah ');
            redirect('home/login');
        }else
            redirect('home/index');
	}

	public function proses_daftar()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$nama = $this->input->post('nama');
		$konfpass = $this->input->post('konfpass');
		$email = $this->input->post('email');
		$no_hp = $this->input->post('no_hp');

		$konflik = $this->db_model->cek_member($username);
		if ($konflik==true) {
			$this->session->set_flashdata('error','Username sudah ada');
		} else {
			if ($password != $konfpass) {
				$this->session->set_flashdata('error', 'Password tidak cocok');
			} else {
				$result = $this->db_model->insert_member($username, $password, $nama, $email, $no_hp);
				if ($result==false)
					$this->session->set_flashdata('error','Pendaftaran Berhasil, silakan login');
				else
					$this->session->set_flashdata('error','Pendaftaran Berhasil');
			}
		}
		redirect('home/login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home/login');
	}

}
