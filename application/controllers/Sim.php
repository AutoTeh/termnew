<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sim extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

 	public function __construct()
    {
    	parent::__construct();
        $this->Account->is_auth();
        $this->Selectbd->Tabel = 'SIM';
        $this->load->model($this->Selectbd->Tabel.'_model', $this->Selectbd->Tabel);
    }

	public function index()
	{
		$this->config->set_item('base_url', site_url($this->uri->uri_string()).'/Page', 'pagin');
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" width="100%" class="TF2" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->query('', '', 1)),
        			   'Page' 			=> 'table',
        			   'Title' 			=> 'Sim'
        			   );

		$this->load->view('main', $data);
	}

	public function FilterID()
	{

	    if ($this->form_validation->run('FilterID') == TRUE)
	    {
            $this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
	    	$ID = 'SIM_'.$this->Selectbd->Search;

			$this->table->set_template(array('table_open'  => '<table id="'.$ID.'" cellspacing="0" width="100%" class="TF2" >'));
			$data['Table'] = $this->Gen_table->Out($this->Selectbd->query('FilterID'));

  			$this->load->view('table', $data);

        } Else {
        	$this->load->view('err');
        }
	}

	public function FilterArr()
	{
			$query = $this->Selectbd->query('FilterArr', $this->input->post('id'));
			foreach ($query->result_array() as $row)
			{
				$Temparr[] = $row[$this->Selectbd->ColTabel[$this->input->post('id')]];
			}
           echo form_multiselect('select', $Temparr);

	}

	public function Filter($Page = 1)
	{
 		   echo $this->Gen_table->Out($this->Selectbd->query('Filter', '', $this->form_validation->valid_page($Page)), FALSE);
	}

	public function add()
	{
		if ($this->Account->is_auth_and_group(12))
	    {
		    if ($this->form_validation->run('Sim') == TRUE)
		    {

	  			$data = array (	'backpage' 	=> 'sim/add',
		        			   	'Title'  => 'SIM-карта успешно добавлена');
	            $this->SIM->add();

	  			$this->load->view('formsuccess', $data);

	        } Else {
	        	$data = array (	'UrlPage' 	=> 'sim/add',
	        					'ID_Type_Operator_SIM' 	=>  form_dropdown('ID_Type_Operator_SIM', $this->Valid->db_out_array('ID_Type_Operator_SIM as ID, Name_Type_Operator_SIM as Name', 'type_operator_sim'), set_value('ID_Type_Operator_SIM')),
		        			   	'Title'  	=> 'Добавление SIM-карты');

	        	$this->load->view('simadd', $data);
	        }
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
		if ($this->Account->is_auth_and_group(13) && $this->form_validation->integer($id))
	    {
	     		$this->db->select('SN_Num_SIM, ID_Type_Operator_SIM');
	        	$this->db->from('sim');
	        	$this->db->where('ID_SIM', $id);
	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$data['UrlPage'] = 'sim/edit/'.$id.'/1';
			       	$data['Title'] = 'Изменение SIM-карты';

		            if (!$FlagNext)
		            {

				       	$data['ID_Type_Operator_SIM'] = form_dropdown('ID_Type_Operator_SIM', $this->Valid->db_out_array('ID_Type_Operator_SIM as ID, Name_Type_Operator_SIM as Name', 'type_operator_sim'), $data['ID_Type_Operator_SIM']);
			        	$this->load->view('simedit', $data);

		            } else {
					    if ($this->form_validation->run('Sim') == TRUE)
					    {

				  			$data = array (	'backpage' 	=> 'sim/edit/'.$id,
					        			   	'Title'  	=> 'SIM-карта успешно изменена');
				            $this->SIM->edit($id);
				  			$this->load->view('formsuccess', $data);
				        } else {

					       	$data['ID_Type_Operator_SIM'] = form_dropdown('ID_Type_Operator_SIM', $this->Valid->db_out_array('ID_Type_Operator_SIM as ID, Name_Type_Operator_SIM as Name', 'type_operator_sim'), set_value('ID_Type_Operator_SIM'));
				        	$this->load->view('simadd', $data);
				        }
		            }

	        	}
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}

	public function View()
	{
		if ($this->form_validation->integer($this->input->post('id')))
	    {
	     		$this->db->select('SN_Num_SIM, Name_Type_Operator_SIM');
	        	$this->db->from('sim');
				$this->db->join('Type_Operator_SIM', 'Type_Operator_SIM.ID_Type_Operator_SIM = SIM.ID_Type_Operator_SIM', 'left');
	        	$this->db->where('ID_SIM', $this->input->post('id'));

	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$this->load->view('simview', $data);
	        	}
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}
}