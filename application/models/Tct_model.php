<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tct_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function add($id_p = '')
 	{
		$data = array(
        'Name_TCT' 							=> $this->input->post('Name_TCT'),
        'ID_Type_MCC_TCT' 					=> $this->input->post('ID_Type_MCC_TCT'),
        'Phone_TCT' 						=> $this->input->post('Phone_TCT'),
        'Contact_Name_TCT' 					=> $this->input->post('Contact_Name_TCT'),
        'Num_Merchant_TCT' 					=> $this->input->post('Num_Merchant_TCT'),
        'ID_Address_TCT'					=> $id_p,
        'ID_Type_Kategoria_TCT' 			=> $this->input->post('ID_Type_Kategoria_TCT'),
        'Mode_TCT' 							=> $this->input->post('Mode_TCT'),
        'Home_Address_TCT' 					=> $this->input->post('Home_Address_TCT'),
        'Date_Visit_MPR_TCT' 				=> $this->Valid->valid_post_date('Date_Visit_MPR_TCT'),
        'Date_Implementation_Potok_TCT' 	=> $this->Valid->valid_post_date('Date_Implementation_Potok_TCT'),
        'ID_Type_Status_Tct' 				=> $this->input->post('ID_Type_Status_Tct'),
        'Repair_TCT' 						=> $this->input->post('Repair_TCT'),
        'Position_Contact_TCT' 				=> $this->input->post('Position_Contact_TCT')
		);

		$this->db->insert('tct', $data);
 	}

 	public function edit($id = '', $id_p = '')
 	{
		$data = array(
        'Name_TCT' 							=> $this->input->post('Name_TCT'),
        'ID_Type_MCC_TCT' 					=> $this->input->post('ID_Type_MCC_TCT'),
        'Phone_TCT' 						=> $this->input->post('Phone_TCT'),
        'Contact_Name_TCT' 					=> $this->input->post('Contact_Name_TCT'),
        'Num_Merchant_TCT' 					=> $this->input->post('Num_Merchant_TCT'),
        'ID_Address_TCT'					=> $id_p,
        'ID_Type_Kategoria_TCT' 			=> $this->input->post('ID_Type_Kategoria_TCT'),
        'Mode_TCT' 							=> $this->input->post('Mode_TCT'),
        'Home_Address_TCT' 					=> $this->input->post('Home_Address_TCT'),
        'Date_Visit_MPR_TCT' 			 	=> $this->Valid->valid_post_date('Date_Visit_MPR_TCT'),
        'Date_Implementation_Potok_TCT'  	=> $this->Valid->valid_post_date('Date_Implementation_Potok_TCT'),
        'ID_Type_Status_Tct' 				=> $this->input->post('ID_Type_Status_Tct'),
        'Repair_TCT' 						=> $this->input->post('Repair_TCT'),
        'Position_Contact_TCT' 				=> $this->input->post('Position_Contact_TCT')
		);

		$this->db->where('ID_TCT', $id);
		$this->db->update('tct', $data);
 	}
}
