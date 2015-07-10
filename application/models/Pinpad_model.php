<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinpad_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function add()
 	{
		$data = array(
		'ID_Type_PinPad' 		=> $this->input->post('ID_Type_PinPad'),
        'SN_Num_PinPad' 		=> $this->input->post('SN_Num_PinPad')
        );

		$this->db->insert('pinpad', $data);
 	}

 	public function edit($id = '')
 	{
		$data = array(
		'ID_Type_PinPad' 		=> $this->input->post('ID_Type_PinPad'),
        'SN_Num_PinPad' 		=> $this->input->post('SN_Num_PinPad')
        );
		$this->db->where('ID_PinOad', $id);
		$this->db->update('pinpad', $data);

 	}
}
