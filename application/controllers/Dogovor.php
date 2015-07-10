<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dogovor extends CI_Controller {

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
        $this->Selectbd->Tabel = 'Dogovor';
        $this->load->model($this->Selectbd->Tabel.'_model', $this->Selectbd->Tabel);
    }

	public function index()
	{
		$this->config->set_item('base_url', site_url($this->uri->uri_string()).'/Page', 'pagin');
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" width="100%" class="TF2" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->query('', '', 1)),
        			   'Page' 			=> 'table',
        			   'Title' 			=> 'Договоры'
        			   );

		$this->load->view('main', $data);
	}

	public function FilterID()
	{

	    if ($this->form_validation->run('FilterID') == TRUE)
	    {
	        $this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
	    	$ID = 'Dogovor_'.$this->Selectbd->Search;

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
		if ($this->Account->is_auth_and_group(0))
	    {

		    if ($this->form_validation->run('Dogovor') == TRUE)
		    {

	  			$data = array (	'backpage' 	=> 'dogovor/add',
		        			   	'Title'  => 'Договор успешно добавлен');
	            $this->Dogovor->add();

	  			$this->load->view('formsuccess', $data);

	        } Else {	        	$data = array (	'UrlPage' 	=> 'dogovor/add',
		        			   	'Title'  	=> 'Добавление нового договора.',
	                            'ID_Type_Thank_Status' =>  form_dropdown('ID_Type_Thank_Status', $this->Valid->db_out_array('ID_Type_Thank_Status as ID, Name_Type_Thank_Status as Name', 'type_thank_status'), set_value('ID_Type_Thank_Status')));

	        	$this->load->view('dogovoradd', $data);
	        }
	    } else {
	    	Echo 'Доступ запрещен';
	    }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
	    if ($this->Account->is_auth_and_group(1) && $this->form_validation->integer($id))
	    {
	     		$this->db->select('Num_Dogovor, Date_Dogovor, Diskont_Dogovor,
	            				   Date_Diskont_Dogovor, Internat_Card_Dogovor,
	            				   Debet_Card_Dogovor, Thank_Dogovor,
	            				   Money_Movement_Dogovor, Money_Income_Dogovor,
	            				   Date_Dissolution_Dogovor, Comm_Dissolution_Dogovor,
	            				   ID_Type_Thank_Status');
	        	$this->db->from('dogovor');
	        	$this->db->where('ID_Dogovor', $id);
	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
                    $data['UrlPage'] = 'dogovor/edit/'.$id.'/1';
                    $data['Title'] = 'Изменение договора';
		            if (!$FlagNext)
		            {
		            	$data['ID_Type_Thank_Status'] =  form_dropdown('ID_Type_Thank_Status', $this->Valid->db_out_array('ID_Type_Thank_Status as ID, Name_Type_Thank_Status as Name', 'type_thank_status'), $data['ID_Type_Thank_Status']);
			        	$this->load->view('dogovoredit', $data);

		            } else {
					    if ($this->form_validation->run('Dogovor') == TRUE)
					    {
				  			$data = array (	'backpage' 	=> 'dogovor/edit/'.$id,
					        			   	'Title'  	=> 'Договор успешно изменен');
				            $this->Dogovor->edit($id);

				  			$this->load->view('formsuccess', $data);
				        } else {							$data['ID_Type_Thank_Status'] =  form_dropdown('ID_Type_Thank_Status', $this->Valid->db_out_array('ID_Type_Thank_Status as ID, Name_Type_Thank_Status as Name', 'type_thank_status'), set_value('ID_Type_Thank_Status'));
				        	$this->load->view('dogovoradd', $data);
				        }
		            }
	            }
	     } else {	     	Echo 'Доступ запрещен';
	     }

	}

	public function View()
	{
		if ($this->form_validation->integer($this->input->post('id')))
	    {
	     		$this->db->select('Num_Dogovor, Date_Dogovor, Diskont_Dogovor,
	            				   Date_Diskont_Dogovor, Internat_Card_Dogovor,
	            				   Debet_Card_Dogovor, Thank_Dogovor,
	            				   Money_Movement_Dogovor, Money_Income_Dogovor,
	            				   Date_Dissolution_Dogovor, Comm_Dissolution_Dogovor,
	            				   Name_Type_Thank_Status');


                $this->db->join('Type_Thank_Status', 'Type_Thank_Status.ID_Type_Thank_Status = Dogovor.ID_Type_Thank_Status', 'left');
	        	$this->db->from('dogovor');
	        	$this->db->where('ID_Dogovor', $this->input->post('id'));

	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$this->load->view('dogovorview', $data);
	        	}
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}
}
