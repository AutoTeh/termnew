<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tid_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function add()
 	{
		$data = array(
        'Num_TID' 		 				 => $this->input->post('Num_TID'),
        'Kod_TID' 		 				 => $this->input->post('Kod_TID'),
        'Date_Sending_Request_TID' 		 => $this->Valid->valid_post_date('Date_Sending_Request_TID'),
        'Date_Installation_Terminal_TID' => $this->Valid->valid_post_date('Date_Installation_Terminal_TID'),
  		'Date_Dismantling_TID' 			 => $this->Valid->valid_post_date('Date_Dismantling_TID'),
  		'ID_Type_Status_TID' 			 => $this->Valid->valid_post_date('ID_Type_Status_TID'),
        'Date_Reg_CA_TID'				 => $this->Valid->valid_post_date('Date_Reg_CA_TID')
        );

		$this->db->insert('tid', $data);
 	}

 	public function edit($id = '')
 	{
		$data = array(
        'Num_TID' 		  				 => $this->input->post('Num_TID'),
        'Kod_TID' 		  				 => $this->input->post('Kod_TID'),
        'Date_Sending_Request_TID'		 => $this->Valid->valid_post_date('Date_Sending_Request_TID'),
        'Date_Installation_Terminal_TID' => $this->Valid->valid_post_date('Date_Installation_Terminal_TID'),
  		'Date_Dismantling_TID' 			 => $this->Valid->valid_post_date('Date_Dismantling_TID'),
		'ID_Type_Status_TID' 			 => $this->Valid->valid_post_date('ID_Type_Status_TID'),
        'Date_Reg_CA_TID'				 => $this->Valid->valid_post_date('Date_Reg_CA_TID')
        );

		$this->db->where('ID_TID', $id);
		$this->db->update('tid', $data);
 	}

}
