<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terminal extends CI_Controller {

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
        $this->Selectbd->Tabel = 'Terminal';
        $this->load->model($this->Selectbd->Tabel.'_model', $this->Selectbd->Tabel);
    }

	public function index()
	{
		$this->config->set_item('base_url', site_url($this->uri->uri_string()).'/Page', 'pagin');
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" width="100%" class="TF2" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->query('', '', 1)),
        			   'Page' 			=> 'table',
        			   'Title' 			=> 'Терминалы'
        			   );

		$this->load->view('main', $data);
	}

	public function FilterID()
	{

	    if ($this->form_validation->run('FilterID') == TRUE)
	    {
            $this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
	    	$ID = 'Terminal_'.$this->Selectbd->Search;

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
		if ($this->Account->is_auth_and_group(8))
	    {
		    if ($this->form_validation->run('Terminal') == TRUE)
		    {

	  			$data = array (	'backpage' 	=> 'terminal/add',
		        			   	'Title'  => 'Терминал успешно добавлен');
	            $this->Terminal->add();

	  			$this->load->view('formsuccess', $data);

	        } Else {
	        	$data = array (	'UrlPage' 			=> 'terminal/add',
	        					'ID_Type_Terminal' 	=>  form_dropdown('ID_Type_Terminal', $this->Valid->db_out_array('ID_Type_Terminal as ID, Name_Type_Terminal as Name', 'type_terminal'), set_value('ID_Type_Terminal')),
		        			   	'ID_Type_Status_Terminal' 	=>  form_dropdown('ID_Type_Status_Terminal', $this->Valid->db_out_array('ID_Type_Status_Terminal as ID, Name_Type_Status_Terminal as Name', 'Type_Status_Terminal'), set_value('ID_Type_Status_Terminal')),
		        			   	'Title'  			=> 'Добавление нового терминала.');

	        	$this->load->view('terminaladd', $data);
	        }
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
		if ($this->Account->is_auth_and_group(9) && $this->form_validation->integer($id))
	    {
	     		$this->db->select('ID_Type_Terminal, SN_Num_Terminal, Inv_Num_Terminal,
	            				   Price_Terminal, Date_Terminal, ID_Type_Status_Terminal');
	        	$this->db->from('terminal');
	        	$this->db->where('ID_Terminal', $id);
	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$data['UrlPage'] = 'terminal/edit/'.$id.'/1';
				    $data['Title'] = 'Изменение Терминала';

		            if (!$FlagNext)
		            {
				       	$data['ID_Type_Terminal'] = form_dropdown('ID_Type_Terminal', $this->Valid->db_out_array('ID_Type_Terminal as ID, Name_Type_Terminal as Name', 'type_terminal'), $data['ID_Type_Terminal']);
			        	$data['ID_Type_Status_Terminal'] = form_dropdown('ID_Type_Status_Terminal', $this->Valid->db_out_array('ID_Type_Status_Terminal as ID, Name_Type_Status_Terminal as Name', 'Type_Status_Terminal'), $data['ID_Type_Status_Terminal']);
			        	$this->load->view('terminaledit', $data);

		            } else {

					    if ($this->form_validation->run('Terminal') == TRUE)
					    {
				  			$data = array (	'backpage' 	=> 'terminal/edit/'.$id,
					        			   	'Title'  	=> 'Терминал успешно изменен');
				            $this->Terminal->edit($id);
				  			$this->load->view('formsuccess', $data);

				        } else {

			                $data['ID_Type_Terminal'] = form_dropdown('ID_Type_Terminal', $this->Valid->db_out_array('ID_Type_Terminal as ID, Name_Type_Terminal as Name', 'type_terminal'), set_value('ID_Type_Terminal'));
			                $data['ID_Type_Status_Terminal'] = form_dropdown('ID_Type_Status_Terminal', $this->Valid->db_out_array('ID_Type_Status_Terminal as ID, Name_Type_Status_Terminal as Name', 'Type_Status_Terminal'), set_value('ID_Type_Status_Terminal'));
				        	$this->load->view('terminaladd', $data);
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
	            $this->db->select('Name_Type_Terminal, SN_Num_Terminal, Inv_Num_Terminal,
	            				   Price_Terminal, Date_Terminal, Name_Type_Status_Terminal');

	            $this->db->join('Type_Status_Terminal', 'Type_Status_Terminal.ID_Type_Status_Terminal = Terminal.ID_Type_Status_Terminal', 'left');
	        	$this->db->join('Type_Terminal', 'Type_Terminal.Id_Type_Terminal = Terminal.Id_Type_Terminal', 'left');
	        	$this->db->from('terminal');
	        	$this->db->where('ID_Terminal', $this->input->post('id'));

	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$this->load->view('terminalview', $data);
	        	}
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}
}