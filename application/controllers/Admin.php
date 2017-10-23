<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$this->load->helper('string');
		$this->load->helper('url');
		$this->load->model('db_model');
    $this->load->model('db_admin');
		$this->load->model('db_login');
	}

	 public function index(){
 		//$category = $this->db_model->get_data('tb_category');
 		$data['judul']="Admin Panel";
 		$data['jmlMember'] = $this->db_admin->count_data_where('tb_user', 'level', 'member');
    $data['jmlVoucher'] = $this->db_admin->count_voucher();
    $data['jmlVoucherAda'] = $this->db_admin->count_voucher_ada();
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
		$admin = $this->session->userdata('admin');
		$id_user = $admin['id_user'];
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$admin = $this->db_model->get_where_simple('tb_user', 'username', 'admin');
			$data['dpst'] = $admin[0]->deposit;
			$this->template->render('admin',$data);
		}
 	}

  public function pending(){
    $data['judul']="Admin Panel";
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_data_top_up_peding();
			$data['tampil'] = $tampil;
			$this->template->render('pending',$data);
    }
  }

	public function pending_wd(){
    $data['judul']="Admin Panel";
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$potongan = $this->db_admin->get_data('tb_potongan');
			$data['potongan'] = $potongan[0]->potongan;
      $tampil = $this->db_admin->get_data_wd_pending();
			$data['tampil'] = $tampil;
			$this->template->render('pending_withdraw',$data);
    }
  }

	public function konfirmasi_wd(){
    $data['judul']="Admin Panel";
    $id_member = $this->uri->segment(3);
    $id_wd = $this->uri->segment(4);
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_data_wd_pending_user($id_wd);
			$user_info = $this->db_admin->get_where('tb_user', 'id_user', $id_member);
			$deposit = $user_info[0]->deposit;
			$jumlah_wd = $tampil[0]->jumlah_wd;
			if ($jumlah_wd>$deposit) {
				$data['link'] = "#";
			} else {
				$potongan = $this->db_admin->get_data('tb_potongan');
				$data['potongan'] = $potongan[0]->potongan;
				$data['member'] = $id_member;
	      $data['wd'] = $id_wd;
	 			$data['atas_nama'] = $tampil[0]->atas_nama;
				$data['no_rek'] = $tampil[0]->no_rekening;
	      $data['jumlah_wd'] = $jumlah_wd;
				$data['bank'] = $tampil[0]->nama_bank;
	      $data['cabang'] = $tampil[0]->cabang;
				$data['link'] = base_url()."admin/konfirmasi_wd_proses/".$tampil[0]->id_user."/".$tampil[0]->id_wd;
				$this->template->render('konfirmasi_wd',$data);
			}
    }
  }

	public function konfirmasi_wd_proses(){
		$data['judul']="Admin Panel";
		$id_member = $this->uri->segment(3);
		$id_wd = $this->uri->segment(4);
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$wd = $this->db_admin->get_where('tb_req_wd', 'id_wd', $id_wd);
			$member = $this->db_admin->get_where('tb_user', 'id_user', $id_member);
			$admin = $this->db_admin->get_where('tb_user', 'username', 'admin');
			$potongan = $this->db_admin->get_data('tb_potongan');
			$nom_potongan = $potongan[0]->potongan;
			$potongan_wd = ($nom_potongan/100)*$wd[0]->jumlah_wd;
			$update_depo = ($member[0]->deposit) - ($wd[0]->jumlah_wd);
			$update_depo_admin = $admin[0]->deposit + $potongan_wd;
			$this->db_admin->update_single_data('tb_req_wd', 'status', 'confirmed', 'id_wd', $id_wd);
			$this->db_admin->update_single_data('tb_user', 'deposit', $update_depo, 'id_user', $id_member);
			$this->db_admin->update_single_data('tb_user', 'deposit', $update_depo_admin, 'username', 'admin');
			$this->db_admin->insert_transaksi($id_member, 'Withdraw', $wd[0]->jumlah_wd);
			$this->session->set_flashdata('konfirmasi', 'Konfirmasi withdraw berhasil');
			redirect('admin/pending_wd');
		}
  }

	public function tolak_wd(){
    $data['judul']="Admin Panel";
    $id_member = $this->uri->segment(3);
    $id_wd = $this->uri->segment(4);
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_data_wd_pending_user($id_wd);
				$data['member'] = $id_member;
	      $data['wd'] = $id_wd;
	 			$data['atas_nama'] = $tampil[0]->atas_nama;
				$data['no_rek'] = $tampil[0]->no_rekening;
	      $data['jumlah_wd'] = $tampil[0]->jumlah_wd;
				$data['bank'] = $tampil[0]->nama_bank;
	      $data['cabang'] = $tampil[0]->cabang;
				$this->template->render('tolak_wd',$data);
    }
  }

	public function tolak_wd_proses(){
		$data['judul']="Admin Panel";
		$id_member = $this->uri->segment(3);
		$id_wd = $this->uri->segment(4);
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$this->db_admin->update_single_data('tb_req_wd', 'status', 'refused', 'id_wd', $id_wd);
			$this->session->set_flashdata('tolak', 'Withdraw telah di tolak!');
			redirect('admin/pending_wd');
		}
  }

  public function konfirmasi_topUp(){
    $data['judul']="Admin Panel";
    $id_member = $this->uri->segment(3);
    $id_topup = $this->uri->segment(4);
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_where('tb_req_topup', 'id_topup', $id_topup);
      $data['member'] = $id_member;
      $data['topup'] = $id_topup;
 			$data['pengirim'] = $tampil[0]->pengirim;
      $data['jumlah'] = $tampil[0]->jumlah_topup;
      $data['tujuan'] = $tampil[0]->rek_tujuan;
      $data['bukti'] = $tampil[0]->bukti;
			$this->template->render('konfirmasi_topup',$data);
    }
  }

  public function konfirmasi_proses(){
		$data['judul']="Admin Panel";
		$id_member = $this->uri->segment(3);
		$id_topup = $this->uri->segment(4);
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$topup = $this->db_admin->get_where('tb_req_topup', 'id_topup', $id_topup);
			$member = $this->db_admin->get_where('tb_user', 'id_user', $id_member);
			$update_depo = ($member[0]->deposit) + ($topup[0]->jumlah_topup);
			$this->db_admin->update_single_data('tb_req_topup', 'status', 'confirmed', 'id_topup', $id_topup);
			$this->db_admin->update_single_data('tb_user', 'deposit', $update_depo, 'id_user', $id_member);
			$this->db_admin->insert_transaksi($id_member, 'Top Up', $topup[0]->jumlah_topup);
			$this->session->set_flashdata('konfirmasi', 'Konfirmasi top up berhasil');
			redirect('admin/pending');
		}
  }

	public function tolak_topUp(){
		$data['judul']="Admin Panel";
		$id_member = $this->uri->segment(3);
		$id_topup = $this->uri->segment(4);
		$data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$tampil = $this->db_admin->get_where('tb_req_topup', 'id_topup', $id_topup);
			$data['member'] = $id_member;
			$data['topup'] = $id_topup;
			$data['pengirim'] = $tampil[0]->pengirim;
			$data['jumlah'] = $tampil[0]->jumlah_topup;
			$data['tujuan'] = $tampil[0]->rek_tujuan;
			$data['bukti'] = $tampil[0]->bukti;
			$this->template->render('tolak_topup',$data);
		}
	}

	public function tolak_proses(){
		$data['judul']="Admin Panel";
		$id_member = $this->uri->segment(3);
		$id_topup = $this->uri->segment(4);
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$this->db_admin->update_single_data('tb_req_topup', 'status', 'refused', 'id_topup', $id_topup);
			$this->session->set_flashdata('tolak', 'Top up telah ditolak');
			redirect('admin/pending');
		}
  }

	public function kategori_hapus(){
    $data['judul']="Admin Panel";
    $kode = $this->uri->segment(3);
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_where('tb_kategori_voucher', 'id_kategori', $kode);
      $data['kode'] = $kode;
 			$data['kategori'] = $tampil[0]->nama_kategori;
			$this->template->render('hapus_kategori',$data);
    }
  }

	public function hapus_kat_proses(){
		$data['judul']="Admin Panel";
		$kode = $this->uri->segment(3);
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$this->db_admin->delete_data('tb_kategori_voucher', 'id_kategori', $kode);
			$this->session->set_flashdata('kategori_error', 'Kategori berhasil di hapus');
			redirect('admin/kategori_voucher');
		}
  }

	public function kategori_edit(){
    $data['judul']="Admin Panel";
    $kode = $this->uri->segment(3);
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_where('tb_kategori_voucher', 'id_kategori', $kode);
      $data['kode'] = $kode;
 			$data['kategori'] = $tampil[0]->nama_kategori;
			$data['icon'] = $tampil[0]->icon;
			$this->template->render('edit_kategori',$data);
    }
  }

	public function edit_kat_proses(){
		$data['judul']="Admin Panel";
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$kode_kat = $this->input->post('kode_kat');
			$nama_kat = $this->input->post('nama_kat');

			if (isset($_FILES['icon'])) {
				$errors= array();
				$file_name = $_FILES['icon']['name'];
				$file_size =$_FILES['icon']['size'];
				$file_tmp =$_FILES['icon']['tmp_name'];
				$file_type=$_FILES['icon']['type'];
				$file_ext=strtolower(end(explode('.',$_FILES['icon']['name'])));

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
					$move = move_uploaded_file($file_tmp,"assets/asset/kategori/".$file_name);
					if ($move) {
						$this->db_admin->update_kategori($kode_kat, $nama_kat, $file_name);
						$this->session->set_flashdata('kategori','Kategori berhasil diperbaharui');
					}else{
						$this->session->set_flashdata('kategori_error','Edit kategori gagal. '.base_url().'assets/asset/image/');
					}
				}
			}

			$this->db_admin->update_single_data('tb_kategori_voucher', 'nama_kategori', $nama_kat, 'id_kategori', $kode_kat);
			$this->session->set_flashdata('kategori','Kategori berhasil diperbaharui');

			redirect('admin/kategori_voucher');
		}
  }

	public function kategori_voucher(){
		//$category = $this->db_model->get_data('tb_category');
 		$data['judul']="Admin Panel";
		$data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
		$admin = $this->session->userdata('admin');
		$id_user = $admin['id_user'];
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$data['kategori'] = $this->db_admin->get_data('tb_kategori_voucher');
			$this->template->render('kategori',$data);
		}
	}

	public function kategori_proses(){
			$admin=$this->session->userdata('admin');
			if ($admin==null)
				$this->load->view('adminLogin');
			else{
				$kode = $this->input->post('kode_kategori');
				$kategori = $this->input->post('kategori');
				$konflik = $this->db_admin->cek_kategori($kode);
				if ($konflik==true)
					$this->session->set_flashdata('kategori_error', 'Kode kategori sudah ada! Harap isi dengan nilai lain');
				else {
					$errors= array();
					$file_name = $_FILES['icon']['name'];
					$file_size =$_FILES['icon']['size'];
					$file_tmp =$_FILES['icon']['tmp_name'];
					$file_type=$_FILES['icon']['type'];
					$file_ext=strtolower(end(explode('.',$_FILES['icon']['name'])));

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
						$move = move_uploaded_file($file_tmp,"assets/asset/kategori/".$file_name);
						if ($move) {
							$this->db_admin->insert_kategori($kode, $kategori, $file_name);
							$this->session->set_flashdata('kategori','Penambahan kategori berhasil');
						}else{
							$this->session->set_flashdata('kategori_error','Tambah kategori gagal. '.base_url().'assets/asset/image/');
						}
					}

				}
				redirect('admin/kategori_voucher');
			}
	}

	public function tambah_voucher(){
		//$category = $this->db_model->get_data('tb_category');
 		$data['judul']="Admin Panel";
		$data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
		$admin = $this->session->userdata('admin');
		$id_user = $admin['id_user'];
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$data['kategori'] = $this->db_admin->get_data('tb_kategori_voucher');
			$this->template->render('voucher_add',$data);
		}
	}

	public function add_voucher(){
			$admin=$this->session->userdata('admin');
			if ($admin==null)
				$this->load->view('adminLogin');
			else{
				$kategori = $this->input->post('kategori');
				$nominal = $this->input->post('nominal');
				$jumlah = $this->input->post('jumlah');

				for ($i=0; $i < $jumlah ; $i++) {
					do {
						$kode = random_string('alnum', 16);
						$konflik = $this->db_admin->cek_kategori($kode);
					} while($konflik==true);
					$this->db_admin->insert_voucher($kode, $kategori, $nominal);
				}
				$this->session->set_flashdata('voucher','Penambahan voucher berhasil');
				redirect('admin/tambah_voucher');
			}
	}

	public function voucher_data(){
		//$category = $this->db_model->get_data('tb_category');
 		$data['judul']="Admin Panel";
		$data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
		$admin = $this->session->userdata('admin');
		$id_user = $admin['id_user'];
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$data['richie'] = $this->db_admin->get_data_voucher('rchi');
			$data['olshop'] = $this->db_admin->get_data_voucher('olsp');
			$data['jml_rchi'] = $this->db_admin->count_data_voucher_kat('tb_voucher', 'id_kategori', 'rchi');
			$data['jml_olshop'] = $this->db_admin->count_data_voucher_kat('tb_voucher', 'id_kategori', 'olsp');
			$data['jml_sold_rchi'] = $this->db_admin->count_data_voucher_kat_sold('tb_voucher', 'id_kategori', 'rchi');
			$data['jml_sold_olshop'] = $this->db_admin->count_data_voucher_kat_sold('tb_voucher', 'id_kategori', 'olsp');
			$data['terjual'] = $this->db_admin->get_data_voucher_sold();
			$this->template->render('data_voucher',$data);
		}
	}

	public function member(){
		//$category = $this->->get_data('tb_category');
 		$data['judul']="Admin Panel";
		$data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
		$admin = $this->session->userdata('admin');
		$id_user = $admin['id_user'];
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$data['member'] = $this->db_admin->get_where('tb_user', 'level', 'member');
			$this->template->render('member',$data);
		}
	}

	public function setting(){
    $data['judul']="Admin Panel";
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$potongan = $this->db_admin->get_data('tb_potongan');
			$data['id_potongan'] = $potongan[0]->id_potongan;
			$data['potongan'] = $potongan[0]->potongan;
			$data['deskripsi'] = $this->db_admin->get_data('tb_deskripsi');
			$data['bank'] = $this->db_admin->get_data('tb_bank');
			$this->template->render('pengaturan',$data);
    }
  }

	public function potongan_proses(){
		$data['judul']="Admin Panel";
		$id_potongan = $this->input->post('id_potongan') ;
		$potongan = $this->input->post('potongan');
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$this->db_admin->update_single_data('tb_potongan', 'potongan', $potongan, 'id_potongan', $id_potongan);
			$this->session->set_flashdata('config', 'Persentase potongan telah diperbaharui');
			redirect('admin/setting');
		}
  }

	public function deskripsi_edit(){
    $data['judul']="Admin Panel";
    $id_deskripsi = $this->uri->segment(3);
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_where('tb_deskripsi', 'id_', $id_deskripsi);
      $data['id_deskripsi'] = $id_deskripsi;
 			$data['keterangan'] = $tampil[0]->nama_deskripsi;
			$data['isi'] = $tampil[0]->isi;
			$this->template->render('edit_deskripsi',$data);
    }
  }

	public function edit_des_proses(){
		$data['judul']="Admin Panel";
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$id_deskripsi = $this->input->post('id_deskripsi');
			$isi = $this->input->post('isi');
			$this->db_admin->update_single_data('tb_deskripsi', 'isi', $isi, 'id_', $id_deskripsi);
			$this->session->set_flashdata('config','Deskripsi berhasil diperbaharui');
			redirect('admin/setting');
		}
  }

	public function bank_tambah(){
		$data['judul']="Admin Panel";
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$nama_bank = $this->input->post('nama_bank');
			$no_rekening = $this->input->post('no_rekening');
			$atas_nama = $this->input->post('atas_nama');
			$tambah = $this->db_admin->insert_bank($nama_bank, $no_rekening, $atas_nama);
			if ($tambah == true) {
				$this->session->set_flashdata('config','Data bank berhasil di tambahkan');
			} else {
				$this->session->set_flashdata('config_error','Data bank gagal ditambahkan');
			}
			redirect('admin/setting');
		}
  }

	public function bank_hapus(){
    $data['judul']="Admin Panel";
    $id_bank = $this->uri->segment(3);
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_where('tb_bank', 'id_bank', $id_bank);
      $data['id_bank'] = $tampil[0]->id_bank;
 			$data['nama_bank'] = $tampil[0]->nama_bank;
			$data['no_rekening'] = $tampil[0]->no_rekening;
			$data['atas_nama'] = $tampil[0]->atas_nama;
			$this->template->render('hapus_bank',$data);
    }
  }

	public function hapus_bank_proses(){
		$data['judul']="Admin Panel";
		$id_bank = $this->uri->segment(3);
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$this->db_admin->delete_data('tb_bank', 'id_bank', $id_bank);
			$this->session->set_flashdata('config_error', 'Data bank berhasil di hapus');
			redirect('admin/setting');
		}
  }

	public function bank_edit(){
    $data['judul']="Admin Panel";
    $id_bank = $this->uri->segment(3);
    $data['jmlTopUpPending'] = $this->db_admin->count_data_where('tb_req_topup', 'status', 'pending');
		$data['jmlWdPending'] = $this->db_admin->count_data_where('tb_req_wd', 'status', 'pending');
    $admin = $this->session->userdata('admin');
    if ($admin==null)
			$this->load->view('adminLogin');
		else {
      $tampil = $this->db_admin->get_where('tb_bank', 'id_bank', $id_bank);
      $data['id_bank'] = $tampil[0]->id_bank;
 			$data['nama_bank'] = $tampil[0]->nama_bank;
			$data['no_rekening'] = $tampil[0]->no_rekening;
			$data['atas_nama'] = $tampil[0]->atas_nama;
			$this->template->render('edit_bank',$data);
    }
  }

	public function edit_bank_proses(){
		$data['judul']="Admin Panel";
		$admin = $this->session->userdata('admin');
		if ($admin==null)
			$this->load->view('adminLogin');
		else {
			$id_bank = $this->input->post('id_bank');
			$nama_bank = $this->input->post('nama_bank');
			$no_rekening = $this->input->post('no_rekening');
			$atas_nama = $this->input->post('atas_nama');
			$update = $this->db_admin->update_bank($id_bank, $nama_bank, $no_rekening, $atas_nama);
			if ($update == true) {
				$this->session->set_flashdata('config','Data bank berhasil diperbaharui');
			} else {
				$this->session->set_flashdata('config_error','Data bank gagal diperbaharui');
			}
			redirect('admin/setting');
		}
  }

  public function login(){
		$data['judul']="Admin Panel";
		if ($this->session->userdata('admin')==null)
			$this->load->view('adminLogin');
		else
			$this->template->render('admin',$data);
	}

  public function login_proses()
	{
        $result = $this->db_login->login_admin();
        //print_r($result);
        if($result==false){
						$this->session->set_flashdata('error','Username atau password salah ');
            redirect('admin/login');
        }else
            redirect('admin/index');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}

}
