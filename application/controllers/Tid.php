<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tid extends CI_Controller {

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
        $this->Selectbd->Tabel = 'TID';
        $this->load->model($this->Selectbd->Tabel.'_model', $this->Selectbd->Tabel);
    }

	public function index()
	{
		$this->config->set_item('base_url', site_url($this->uri->uri_string()).'/Page', 'pagin');
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" width="100%" class="TF2" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->query('', '', 1)),
        			   'Page' 			=> 'table',
        			   'Title' 			=> 'TID'
        			   );

		$this->load->view('main', $data);
	}

	public function FilterID()
	{

	    if ($this->form_validation->run('FilterID') == TRUE)
	    {
            $this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
	    	$ID = 'TID_'.$this->Selectbd->Search;

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
		if ($this->Account->is_auth_and_group(6))
	    {
		    if ($this->form_validation->run('TID') == TRUE)
		    {

	  			$data = array (	'backpage' 	=> 'tid/add',
		        			   	'Title'  	=> 'TID успешно добавлен');
	            $this->TID->add();

	  			$this->load->view('formsuccess', $data);

	        } Else {
	        	$data = array (	'UrlPage' 	=> 'tid/add',
		        			   	'Title'  	=> 'TID.');
                $data['ID_Type_Status_TID'] = form_dropdown('ID_Type_Status_TID', $this->Valid->db_out_array('ID_Type_Status_TID as ID, Name_Type_Status_TID as Name', 'Type_Status_TID'), set_value('ID_Type_Status_TID'));
	        	$this->load->view('tidadd', $data);
	        }
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
		if ($this->Account->is_auth_and_group(7) && $this->form_validation->integer($id))
	    {
	     		$this->db->select('Num_TID, Kod_TID, Date_Reg_CA_TID,
	     						   Date_Sending_Request_TID, Date_Installation_Terminal_TID,
	     						   Date_Dismantling_TID, ID_Type_Status_TID');

	        	$this->db->from('tid');
	        	$this->db->where('ID_TID', $id);
	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$data['UrlPage'] = 'tid/edit/'.$id.'/1';
				    $data['Title'] = 'Изменение TID';

		            if (!$FlagNext)
		            {
		            	$data['ID_Type_Status_TID'] = form_dropdown('ID_Type_Status_TID', $this->Valid->db_out_array('ID_Type_Status_TID as ID, Name_Type_Status_TID as Name', 'Type_Status_TID'), $data['ID_Type_Status_TID']);
			        	$this->load->view('tidedit', $data);

		            } else {

					    if ($this->form_validation->run('TID') == TRUE)
					    {

				  			$data = array (	'backpage' 	=> 'tid/edit/'.$id,
					        			   	'Title'  	=> 'TID успешно изменен');
				            $this->TID->edit($id);
				  			$this->load->view('formsuccess', $data);
				        } else {
                          	$data['ID_Type_Status_TID'] = form_dropdown('ID_Type_Status_TID', $this->Valid->db_out_array('ID_Type_Status_TID as ID, Name_Type_Status_TID as Name', 'Type_Status_TID'), set_value('ID_Type_Status_TID'));
				        	$this->load->view('tidadd', $data);
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
	     		$this->db->select('Num_TID, Kod_TID, Date_Reg_CA_TID,
	     						   Date_Sending_Request_TID, Date_Installation_Terminal_TID,
	     						   Date_Dismantling_TID, Name_Type_Status_TID');

                $this->db->join('Type_Status_TID', 'Type_Status_TID.ID_Type_Status_TID = TID.ID_Type_Status_TID', 'left');
	        	$this->db->from('tid');
	        	$this->db->where('ID_TID', $this->input->post('id'));

	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$this->load->view('tidview', $data);
	        	}
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}
}