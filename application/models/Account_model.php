<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function reg()
 	{
		$data = array(
        'Login_Users' 		=> $this->input->post('login'),
        'Pass_Users' 		=> do_hash($this->input->post('pass')),
        'FIO_Users' 		=> $this->input->post('fio'),
        'ID_Type_Position' 	=> $this->input->post('ID_Type_Position'),
        'E_Mail_Users' 		=> $this->input->post('e_mail'),
        'ID_Group' 			=> 0
		);

		$this->db->insert('users', $data);

		$this->db->select('ID_Users');
		$this->db->where('Login_Users', $this->input->post('login'));
		$query = $this->db->get('users');

		if ($query->num_rows() > 0)
		{
		        $row = $query->row();

		$data = array(
		        array(
		                'Name_Template_Fields' => 'Организации',
		                'Data_Template_Fields' => '72, 13, 14, 15, 16, 17, 20, 19, 18, 70, 12',
		                'ID_Users' => $row->ID_Users,
		                'ID_Table' => '2'
		        ),
		        array(
		                'Name_Template_Fields' => 'Договоры',
		                'Data_Template_Fields' => '2, 3, 13, 6, 7, 9, 10, 5, 4, 8, 69, 11, 1',
		                'ID_Users' => $row->ID_Users,
		                'ID_Table' => '1'
		        ),
		        array(
		                'Name_Template_Fields' => 'ТСТ',
		                'Data_Template_Fields' => '24, 28, 29, 27, 71, 30, 32, 31, 68, 26, 73, 25, 76, 77, 79, 23',
		                'ID_Users' => $row->ID_Users,
		                'ID_Table' => '3'
		        ),
		        array(
		                'Name_Template_Fields' => 'TID',
		                'Data_Template_Fields' => '53, 54, 55, 74, 75, 78, 81, 52',
		                'ID_Users' => $row->ID_Users,
		                'ID_Table' => '4'
		        ),
		        array(
		                'Name_Template_Fields' => 'Терминалы',
		                'Data_Template_Fields' => '57, 58, 59, 60, 61, 80, 56',
		                'ID_Users' => $row->ID_Users,
		                'ID_Table' => '5'
		        ),
		        array(
		                'Name_Template_Fields' => 'Пин-пады',
		                'Data_Template_Fields' => '63, 64, 62',
		                'ID_Users' => $row->ID_Users,
		                'ID_Table' => '6'
		        ),
		        array(
		                'Name_Template_Fields' => 'Sim-карты',
		                'Data_Template_Fields' => '66, 67, 65',
		                'ID_Users' => $row->ID_Users,
		                'ID_Table' => '7'
		        )
		);

		$this->db->insert_batch('template_fields', $data);
		}

 	}

 	public function edit($id = '')
 	{
		$data = array(
        'Login_Users' 		=> $this->input->post('login'),
        'FIO_Users' 		=> $this->input->post('fio'),
        'ID_Type_Position' 	=> $this->input->post('ID_Type_Position'),
        'E_Mail_Users' 		=> $this->input->post('E_Mail')
		);

        if ($this->input->post('pass'))  $data['Pass_Users'] = do_hash($this->input->post('pass'));

        $this->db->where('id', $id);
		$this->db->update('users', $data);
 	}

 	public function auth()
 	{
		$this->db->select('ID_Users, Login_Users, FIO_Users, Role_Group');
		$this->db->join('Group', 'Group.ID_Group = users.ID_Group');
		$this->db->from('users');
		$this->db->where('Login_Users', $this->input->post('login'));
		$this->db->where('Pass_Users', do_hash($this->input->post('pass')));
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$row = $query->row();

			$newdata = array(
					'ID_Users'  => $row->ID_Users,
			        'Login'  	=> $row->Login_Users,
			        'FIO'     	=> $row->FIO_Users,
			        'ID_Group'  => $row->Role_Group,
			        'logged_in' => TRUE
			);

			$this->session->set_userdata($newdata);

			return TRUE;
		}   return FALSE;
 	}

 	public function is_auth()
 	{
		 if ($this->session->logged_in)
		 {		 	return TRUE;
		 }
		 	Else
		 {		 	redirect('/', 'refresh');		 	return FALSE;
	     }
 	}

 	public function is_auth_and_group($Num)
 	{
		if ($this->session->ID_Group[$Num])
		{			return TRUE;
		}
		Else
		{
			return FALSE;
		}
 	}
}
