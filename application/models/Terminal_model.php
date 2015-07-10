<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terminal_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function add()
 	{
		$data = array(
        'ID_Type_Terminal' 		=> $this->input->post('ID_Type_Terminal'),
        'SN_Num_Terminal' 		=> $this->input->post('SN_Num_Terminal'),
        'Inv_Num_Terminal' 		=> $this->input->post('Inv_Num_Terminal'),
        'Price_Terminal' 		=> $this->input->post('Price_Terminal'),
        'ID_Type_Status_Terminal' 		=> $this->input->post('ID_Type_Status_Terminal'),
        'Date_Terminal' 		=> $this->Valid->valid_post_date('Date_Terminal')
		);

		$this->db->insert('terminal', $data);
 	}

 	public function edit($id = '')
 	{
		$data = array(
        'ID_Type_Terminal' 		=> $this->input->post('ID_Type_Terminal'),
        'SN_Num_Terminal' 		=> $this->input->post('SN_Num_Terminal'),
        'Inv_Num_Terminal' 		=> $this->input->post('Inv_Num_Terminal'),
        'Price_Terminal' 		=> $this->input->post('Price_Terminal'),
        'ID_Type_Status_Terminal' 		=> $this->input->post('ID_Type_Status_Terminal'),
        'Date_Terminal' 		=> $this->Valid->valid_post_date('Date_Terminal')
		);
		$this->db->where('ID_Terminal', $id);
		$this->db->update('terminal', $data);
 	}
}
