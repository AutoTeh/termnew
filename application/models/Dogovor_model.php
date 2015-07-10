<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dogovor_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function add()
 	{
		$data = array(
        'Num_Dogovor' 				=> $this->input->post('Num_Dogovor'),
        'Date_Dogovor' 				=> $this->Valid->valid_post_date('Date_Dogovor'),
        'Diskont_Dogovor' 			=> $this->input->post('Diskont_Dogovor'),
        'Date_Diskont_Dogovor' 		=> $this->Valid->valid_post_date('Date_Diskont_Dogovor'),
        'Internat_Card_Dogovor' 	=> $this->input->post('Internat_Card_Dogovor'),
        'Debet_Card_Dogovor' 		=> $this->input->post('Debet_Card_Dogovor'),
        'Thank_Dogovor' 			=> $this->input->post('Thank_Dogovor'),
        'Money_Movement_Dogovor' 	=> $this->input->post('Money_Movement_Dogovor'),
        'Money_Income_Dogovor' 		=> $this->input->post('Money_Income_Dogovor'),
        'Date_Dissolution_Dogovor' 	=> $this->Valid->valid_post_date('Date_Dissolution_Dogovor'),
        'ID_Type_Thank_Status' 		=> $this->input->post('ID_Type_Thank_Status'),
        'Comm_Dissolution_Dogovor' 	=> $this->input->post('Comm_Dissolution_Dogovor')
		);

		$this->db->insert('dogovor', $data);
 	}


 	public function edit($id = '')
 	{
		$data = array(
        'Num_Dogovor' 				=> $this->input->post('Num_Dogovor'),
        'Date_Dogovor' 				=> $this->Valid->valid_post_date('Date_Dogovor'),
        'Diskont_Dogovor' 			=> $this->input->post('Diskont_Dogovor'),
        'Date_Diskont_Dogovor' 		=> $this->Valid->valid_post_date('Date_Diskont_Dogovor'),
        'Internat_Card_Dogovor' 	=> $this->input->post('Internat_Card_Dogovor'),
        'Debet_Card_Dogovor' 		=> $this->input->post('Debet_Card_Dogovor'),
        'Thank_Dogovor' 			=> $this->input->post('Thank_Dogovor'),
        'Money_Movement_Dogovor' 	=> $this->input->post('Money_Movement_Dogovor'),
        'Money_Income_Dogovor' 		=> $this->input->post('Money_Income_Dogovor'),
        'Date_Dissolution_Dogovor' 	=> $this->Valid->valid_post_date('Date_Dissolution_Dogovor'),
        'ID_Type_Thank_Status' 		=> $this->input->post('ID_Type_Thank_Status'),
        'Comm_Dissolution_Dogovor' 	=> $this->input->post('Comm_Dissolution_Dogovor')
		);

        $this->db->where('ID_Dogovor', $id);
		$this->db->update('dogovor', $data);
 	}

}
