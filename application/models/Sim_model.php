<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sim_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function add()
 	{
		$data = array(
        'SN_Num_SIM' 				=> $this->input->post('SN_Num_SIM'),
        'ID_Type_Operator_SIM' 		=> $this->input->post('ID_Type_Operator_SIM')
        );

		$this->db->insert('sim', $data);
 	}

 	public function edit($id = '')
 	{
		$data = array(
        'SN_Num_SIM' 				=> $this->input->post('SN_Num_SIM'),
        'ID_Type_Operator_SIM' 		=> $this->input->post('ID_Type_Operator_SIM')
        );
		$this->db->where('ID_SIM', $id);
		$this->db->update('sim', $data);
 	}

}
