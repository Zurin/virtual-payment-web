<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Db_model extends CI_Model {



	public $variable;



	public function __construct()
	{
		parent::__construct();


	}
	// ----------------METHOD CEK-------------------------
	public function cek_member($username){
			$this->db->where('username', $username);
			// mengirimkan hasil query ke user
			$query = $this->db->get('tb_user');
			// Cek apakah user tersebut ada??
			if($query->num_rows() == 1)
			{
					//Jika user ada
					return true;
			} else{
					// Jika tidak maka data tidak ditemukan
					return false;
			}
	}

	// ----------------METHOD INSERT-------------------------
	public function insert_member($username, $password, $nama, $email, $no_hp)
	{
		$passcrypt = sha1($password);
		$this->db->set('username', $username);
		$this->db->set('password', $passcrypt);
		$this->db->set('nama', $nama);
		$this->db->set('email', $email);
		$this->db->set('no_hp', $no_hp);
		$this->db->set('deposit', '0');
		$this->db->set('level', 'member');

		$this->db->insert('tb_user');
	}

	public function insert_bank($id_user, $nama_bank, $no_rek, $atas_nama, $cabang)
	{
		$this->db->set('id_user', $id_user);
		$this->db->set('nama_bank', $nama_bank);
		$this->db->set('no_rekening', $no_rek);
		$this->db->set('atas_nama', $atas_nama);
		$this->db->set('cabang', $cabang);
		$this->db->set('disabled', 0);

		$this->db->insert('tb_bank_user');
		return true;
	}

	public function insert_topup($member, $pengirim, $jumlah, $tujuan, $file_name)
	{
		$this->db->set('id_user',$member);
		$this->db->set('pengirim',$pengirim);
		$this->db->set('jumlah_topup',$jumlah);
		$this->db->set('rek_tujuan',$tujuan);
		$this->db->set('bukti',$file_name);
		$this->db->set('tipe','0');
		$this->db->set('status','pending');

		$this->db->insert('tb_req_topup');
	}

	public function insert_wd($id_user, $jumlah_wd)
	{
		$this->db->set('id_user',$id_user);
		$this->db->set('jumlah_wd',$jumlah_wd);
		$this->db->set('status','pending');

		$this->db->insert('tb_req_wd');
		return true;
	}

	public function insert_transaksi($id_user, $jenis, $nominal)
	{
		$this->db->set('id_user',$id_user);
		$this->db->set('jenis_transaksi',$jenis);
		$this->db->set('nominal',$nominal);
		$this->db->set('tgl_transaksi', date("Y-m-d"));

		$this->db->insert('tb_history_transaksi');
		return true;
	}

	// ----------------METHOD GET-------------------------
	public function get_data($table){
		$this->db->from($table);
		$query=$this->db->get();

		return $query->result();
	}

	//--------------------METHOD GET WHERE --------------------

	public function get_where($table, $field1, $field2, $isi1, $isi2){
		$this->db->where($field1,$isi1);
		$this->db->where($field2,$isi2);
		$this->db->from($table);
		$query=$this->db->get();

		return $query->result();
	}

	public function get_where_simple($table, $field, $isi){
		$this->db->where($field,$isi);
		$this->db->from($table);
		$query=$this->db->get();

		return $query->result();
	}

	public function get_data_voucher($kategori){
		$query = $this->db->query("SELECT vc.*, kat.* FROM tb_voucher vc
															INNER JOIN tb_kategori_voucher kat on kat.id_kategori = vc.id_kategori
															WHERE vc.id_user IS NULL AND vc.status='valid' AND vc.id_kategori='$kategori'");
		return $query->result();
	}

	public function get_data_voucher_user_all($id_user){
		$query = $this->db->query("SELECT vc.*, kat.* FROM tb_voucher vc
															INNER JOIN tb_kategori_voucher kat on kat.id_kategori = vc.id_kategori
															WHERE vc.id_user = $id_user");
		return $query->result();
	}

	public function get_data_voucher_user($id_user){
		$query = $this->db->query("SELECT vc.*, kat.* FROM tb_voucher vc
															INNER JOIN tb_kategori_voucher kat on kat.id_kategori = vc.id_kategori
															WHERE vc.id_user = $id_user AND vc.status='valid'");
		return $query->result();
	}

	public function get_data_voucher_user_invalid($id_user){
		$query = $this->db->query("SELECT vc.*, kat.* FROM tb_voucher vc
															INNER JOIN tb_kategori_voucher kat on kat.id_kategori = vc.id_kategori
															WHERE vc.id_user = $id_user AND vc.status='invalid'");
		return $query->result();
	}

	public function get_voucher_order($kd_vc){
		$query = $this->db->query("SELECT vc.*, kat.* FROM tb_voucher vc
															INNER JOIN tb_kategori_voucher kat on kat.id_kategori = vc.id_kategori
															WHERE vc.kode_voucher = '$kd_vc'");
		return $query->result();
	}

	public function get_data_wd($id_user){
		$query = $this->db->query("SELECT wd.*, bank.* FROM tb_req_wd wd
															INNER JOIN tb_bank_user bank on bank.id_user = wd.id_user
															WHERE wd.id_user = $id_user");
		return $query->result();
	}

	public function get_data_wd_pending($id_user){
		$query = $this->db->query("SELECT wd.*, bank.* FROM tb_req_wd wd
															INNER JOIN tb_bank_user bank on bank.id_user = wd.id_user
															WHERE wd.id_user = $id_user AND wd.status='pending'");
		return $query->result();
	}

	public function get_transaksi_income($id_user){
		$where="id_user=$id_user AND (jenis_transaksi='Top Up' OR jenis_transaksi='Withdraw 3rd Apps')";
		$this->db->where($where);
		$this->db->from('tb_history_transaksi');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_transaksi_voucher($id_user){
		$this->db->where('jenis_transaksi', 'Pembelian Voucher');
		$this->db->where('id_user', $id_user);
		$this->db->from('tb_history_transaksi');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_transaksi_wd($id_user){
		$this->db->where('jenis_transaksi', 'Withdraw');
		$this->db->where('id_user', $id_user);
		$this->db->from('tb_history_transaksi');
		$query = $this->db->get();

		return $query->result();
	}

	// ----------------METHOD COUNT-------------------------
	public function count_notif($table, $field1, $field2, $isi1, $isi2){
	$this->db->where($field1, $isi1);
	$this->db->where($field2, $isi2);
	$this->db->from($table);

	return $this->db->count_all_results();
	}

	public function count_data_voucher_kat($table, $field, $isi){
    $this->db->where($field,$isi);
		$this->db->where('id_user is NULL');
    $this->db->from($table);

    return $this->db->count_all_results();
  }

	// ----------------METHOD UPDATE-------------------------
	public function update_single_data($table, $field_update, $isi_update, $field_where, $isi_where){
		$this->db->set($field_update, $isi_update);
		$this->db->where($field_where, $isi_where);
		$this->db->update($table);
	}

	public function update_voucher_user($id_user, $kode_voucher){
		$this->db->where('kode_voucher', $kode_voucher);
		$this->db->update('tb_voucher', $id_user);
	}

	public function update_bank($id_user, $nama_bank, $no_rek, $atas_nama, $cabang)
	{
		$this->db->set('nama_bank', $nama_bank);
		$this->db->set('no_rekening', $no_rek);
		$this->db->set('atas_nama', $atas_nama);
		$this->db->set('cabang', $cabang);
		$this->db->set('disabled', 1);
		$this->db->where('id_user', $id_user);

		$this->db->update('tb_bank_user');
		return true;
	}

	public function update_profile_basic($id_user, $nama, $email, $no_hp){
		$update_data = array('nama' => $nama,
												 'email' => $email,
												 'no_hp' => $no_hp
												);
		$this->db->where('id_user', $id_user);
		$this->db->update('tb_user', $update_data);
		return true;
	}

}

/* End of file db_model.php */

/* Location: ./application/models/db_model.php */
