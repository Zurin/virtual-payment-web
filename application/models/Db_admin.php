<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Db_admin extends CI_Model {



	public $variable;



	public function __construct()
	{
		parent::__construct();


	}

	// ----------------METHOD CEK-------------------------
	public function cek_kategori($kode){
			$this->db->where('id_kategori', $kode);
			// mengirimkan hasil query ke user
			$query = $this->db->get('tb_kategori_voucher');
			// Cek apakah user tersebut ada??
			if($query->num_rows() == 1)
			{
					//Jika user ada
					return true;
			} else {
					// Jika tidak maka data tidak ditemukan
					return false;
			}
	}

	public function cek_kode_voucher($kode){
			$this->db->where('kode_voucher', $kode);
			// mengirimkan hasil query ke user
			$query = $this->db->get('tb_voucher');
			// Cek apakah user tersebut ada??
			if($query->num_rows() == 1)
			{
					//Jika user ada
					return true;
			} else {
					// Jika tidak maka data tidak ditemukan
					return false;
			}
	}

	// ----------------METHOD INSERT-------------------------
	public function insert_kategori($kode, $kategori, $icon)
	{
		$this->db->set('id_kategori', strtolower($kode));
		$this->db->set('nama_kategori', ucwords($kategori));
		$this->db->set('icon', $icon);

		$this->db->insert('tb_kategori_voucher');
	}

	public function insert_voucher($kode, $kategori, $nominal)
	{
		$this->db->set('kode_voucher',$kode);
		$this->db->set('nominal',$nominal);
		$this->db->set('id_user',NULL);
		$this->db->set('id_kategori',$kategori);
		$this->db->set('status','valid');

		$this->db->insert('tb_voucher');
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

	public function insert_bank($nama_bank, $no_rekening, $atas_nama)
	{
		$this->db->set('nama_bank', $nama_bank);
		$this->db->set('no_rekening', $no_rekening);
		$this->db->set('atas_nama', $atas_nama);

		$this->db->insert('tb_bank');
		return true;
	}

	// ----------------METHOD GET-------------------------
	public function get_data($table){
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

	public function get_data_voucher_sold(){
		$query = $this->db->query("SELECT vc.*, kat.*, usr.* FROM tb_voucher vc
															INNER JOIN tb_kategori_voucher kat on kat.id_kategori = vc.id_kategori
															INNER JOIN tb_user usr on usr.id_user = vc.id_user
															WHERE vc.id_user IS NOT NULL ORDER  BY tanggal DESC");
		return $query->result();
	}

	public function get_data_wd_pending(){
		$query = $this->db->query("SELECT wd.*, bank.* FROM tb_req_wd wd
															INNER JOIN tb_bank_user bank on bank.id_user = wd.id_user
															WHERE wd.status='pending'");
		return $query->result();
	}

	public function get_data_wd_pending_user($id_wd){
		$query = $this->db->query("SELECT wd.*, bank.* FROM tb_req_wd wd
															INNER JOIN tb_bank_user bank on bank.id_user = wd.id_user
															WHERE wd.status='pending' AND wd.id_wd=$id_wd");
		return $query->result();
	}

	public function get_data_top_up_peding(){
		$query = $this->db->query("SELECT * FROM tb_req_topup
															WHERE status='pending' ORDER BY id_topup DESC");
		return $query->result();
	}

	//--------------------METHOD GET WHERE --------------------
	public function get_where($table, $field, $isi){
		$this->db->where($field,$isi);
		$this->db->from($table);
		$query=$this->db->get();

		return $query->result();
	}

	public function get_where_order($table, $field1, $isi1, $field2, $isi2, $field3){
		$this->db->where($field1, $isi1);
		$this->db->where($field2, $isi2);
		$this->db->order_by($field3, 'desc');
		$this->db->from($table);
		$query=$this->db->get();

		return $query->result;
	}


	// ----------------METHOD COUNT-------------------------
  public function count_data($table){
    $this->db->from($table);

    return $this->db->count_all_results();
  }

  public function count_data_where($table, $field, $isi){
    $this->db->where($field,$isi);
    $this->db->from($table);

    return $this->db->count_all_results();
  }

	public function count_data_voucher_kat($table, $field, $isi){
    $this->db->where($field,$isi);
		$this->db->where('id_user is NULL');
    $this->db->from($table);

    return $this->db->count_all_results();
  }

	public function count_data_voucher_kat_sold($table, $field, $isi){
    $this->db->where($field,$isi);
		$this->db->where('id_user is NOT NULL');
    $this->db->from($table);

    return $this->db->count_all_results();
  }


  public function count_voucher(){
    $where = "id_user is  NOT NULL";
    $this->db->where($where);
    $this->db->from('tb_voucher');

    return $this->db->count_all_results();
  }

  public function count_voucher_ada(){
    $where = "id_user is NULL";
    $this->db->where($where);
    $this->db->from('tb_voucher');

    return $this->db->count_all_results();
  }

  public function count_notif($table, $field1, $field2, $isi1, $isi2){
	$this->db->where($field1, $isi1);
	$this->db->where($field2, $isi2);
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

	public function update_kategori($id_kategori, $kategori, $icon){
		$update_kat = array('nama_kategori' => $kategori,
												'icon' => $icon
											 );
		$this->db->where('id_kategori', $id_kategori);
		$this->db->update('tb_kategori_voucher', $update_kat);
	}

	public function update_bank($id_bank, $nama_bank, $no_rekening, $atas_nama){
		$update_bank = array('nama_bank' => $nama_bank,
												 'no_rekening' => $no_rekening,
												 'atas_nama' => $atas_nama
												);
		$this->db->where('id_bank', $id_bank);
		$this->db->update('tb_bank', $update_bank);
		return true;
	}

	// ----------------METHOD DELETE-------------------------
	public function delete_data($table, $isi, $field)
	{
  		$this->db->where($isi, $field);
  		$this->db->delete($table);
	}

}

/* End of file db_admin.php */

/* Location: ./application/models/db_model.php */
