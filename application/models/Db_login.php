<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_login extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();

	}

    public function login_member(){
        // Menghindari injectsi hacking
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
				$passcrypt = sha1($password);
				// pengambilan query (indentify iD)
        $this->db->where('username', $username);
        $this->db->where('password', $passcrypt);
      	$this->db->where('level', 'member');
        // mengirimkan hasil query ke user
        $query = $this->db->get('tb_user');
        //print_r($query->num_rows());
        // Cek apakah user tersebut ada??
        if($query->num_rows() == 1)
        {
            //Jika user ada maka buat sessi
            $row = $query->row();
            $data = array(
										'id_user' => $row->id_user,
                    'username' => $row->username,
                    'nama' => $row->nama,
										'deposit' => $row->deposit,
                    'validated' => true
                    );
            $this->session->set_userdata("login", $data);
            //print_r($a);
            return true;
        } else{
        // Jika tidak maka data tidak ditemukan
        return false;
        }
    }

		public function login_admin(){
				// Menghindari injectsi hacking
				$username = $this->security->xss_clean($this->input->post('username'));
				$password = $this->security->xss_clean($this->input->post('password'));
				$passcrypt = sha1($password);
				// pengambilan query (indentify iD)
				$this->db->where('username', $username);
				$this->db->where('password', $passcrypt);
				$this->db->where('level', 'admin');
				// mengirimkan hasil query ke user
				$query = $this->db->get('tb_user');
				//print_r($query->num_rows());
				// Cek apakah user tersebut ada??
				if($query->num_rows() == 1)
				{
						//Jika user ada maka buat sessi
						$row = $query->row();
						$data = array(
										'id_user' => $row->id_user,
										'username' => $row->username,
										'nama' => $row->nama,
										'validated' => true
										);
						$this->session->set_userdata("admin", $data);
						//print_r($a);
						return true;
				} else{
				// Jika tidak maka data tidak ditemukan
				return false;
				}
		}

}

/* End of file login.php */
/* Location: ./application/models/login.php */
