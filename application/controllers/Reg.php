<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg extends CI_Controller {

 	public function __construct()
    {
    	parent::__construct();
    }

	public function index()
	{
		$data['Title'] = "Регистрация";
        $data['Page'] = 'reg';
        $data['ID_Type_Position'] =  form_dropdown('ID_Type_Position', $this->db_out_array('ID_Type_Position as ID, Name_Type_Position as Name', 'Type_Position'), set_value('ID_Type_Position'));

				$this->form_validation->set_rules('login', 'Логин', 'required|min_length[5]|max_length[12]|is_unique[users.Login_Users]');
				$this->form_validation->set_rules('e_mail', 'E-Mail', 'required|valid_email|is_unique[users.E_Mail_Users]');
				$this->form_validation->set_rules('pass', 'Пароль', 'required');
		        $this->form_validation->set_rules('fio', 'ФИО', 'required');

	        if ($this->form_validation->run() == TRUE)
	        {
	        	$this->Account->reg();
	        	$data['backpage'] = 'reg/add';
	        	$data['Page'] = 'formsuccess';

	        }

		$this->load->view('main', $data);
	}


	public function add()
	{
		$data['Title'] = "Регистрация";
        $data['Page'] = 'reg';

				$this->form_validation->set_rules('login', 'Логин', 'required|min_length[5]|max_length[12]|is_unique[users.Login]');
				$this->form_validation->set_rules('e_mail', 'E-Mail', 'required|valid_email|is_unique[users.E_Mail_Users]');
				$this->form_validation->set_rules('pass', 'Пароль', 'required');
		        $this->form_validation->set_rules('fio', 'ФИО', 'required');

	        if ($this->form_validation->run() == TRUE)
	        {
	        	$this->Account->reg();
	        	$data['backpage'] = 'reg/add';
	        	$data['Page'] = 'formsuccess';

	        }

		$this->load->view('main', $data);
	}

	public function edit($id = '')
	{

		if ($id = '') redirect('/', 'refresh');

		$data['Title'] = "Регистрация";
        $data['Page'] = 'reg';
        $data['ID_U'] = $id;

				$this->form_validation->set_rules('Login', 'Логин', 'required');
				$this->form_validation->set_rules('E_Mail', 'E-Mail', 'required');
		        $this->form_validation->set_rules('FIO', 'ФИО', 'required');

	        if ($this->form_validation->run() == TRUE)
	        {
	        	$this->Account->reg();
	        	$data['backpage'] = 'reg';
	        	$data['page'] = 'formsuccess';

	        }

		$this->load->view('main', $data);
	}

	function db_out_array($Head, $Table, $Where = '')
	{
		$this->db->select($Head);
		if (!$Where == '') $this->db->where($Where);
		$query = $this->db->get($Table);

		if ($query->num_rows() > 0)
	    {
	   	    foreach ($query->result_array() as $row)
			{
			        $TempArray[$row['ID']] = $row['Name'];
			}
			return $TempArray;
	    }
	}

}
