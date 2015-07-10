<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Org_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function add($id_j = '', $id_p = '')
 	{
		$data = array(
        'Name_Org' 						=> $this->input->post('Name_Org'),
        'INN_Org' 						=> $this->input->post('INN_Org'),
        'ID_Post_Address_Org' 			=> $id_p,
        'Home_Post_Address_Org' 		=> $this->input->post('Home_Post_Address_Org'),
        'ID_Juristical_Address_Org' 	=> $id_j,
        'Home_Juristical_Address_Org'	=> $this->input->post('Home_Juristical_Address_Org'),
        'FIO_Boss_Org' 					=> $this->input->post('FIO_Boss_Org'),
        'ID_Users' 						=> $this->input->post('ID_Users'),
        'ID_Type_Org' 					=> $this->input->post('ID_Type_Org'),
        'E_Mail_Org' 					=> $this->input->post('E_Mail_Org'),
        'Phone_Boss_Org' 				=> $this->input->post('Phone_Boss_Org'),
        'ID_Type_Rank_Org' 				=> $this->input->post('ID_Type_Rank_Org')
		);

		$this->db->insert('org', $data);
 	}

 	public function edit($id = '', $id_j = '', $id_p = '')
 	{
		$data = array(
        'Name_Org' 						=> $this->input->post('Name_Org'),
        'INN_Org' 						=> $this->input->post('INN_Org'),
        'ID_Post_Address_Org' 			=> $id_p,
        'Home_Post_Address_Org' 		=> $this->input->post('Home_Post_Address_Org'),
        'ID_Juristical_Address_Org' 	=> $id_j,
        'Home_Juristical_Address_Org'	=> $this->input->post('Home_Juristical_Address_Org'),
        'FIO_Boss_Org' 					=> $this->input->post('FIO_Boss_Org'),
        'ID_Users' 						=> $this->input->post('ID_Users'),
        'ID_Type_Org' 					=> $this->input->post('ID_Type_Org'),
        'E_Mail_Org' 					=> $this->input->post('E_Mail_Org'),
        'Phone_Boss_Org' 				=> $this->input->post('Phone_Boss_Org'),
        'ID_Type_Rank_Org' 				=> $this->input->post('ID_Type_Rank_Org')
		);

		$this->db->where('ID_Org', $id);
		$this->db->update('org', $data);
 	}
}
