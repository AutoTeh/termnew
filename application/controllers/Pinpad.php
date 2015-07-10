<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinpad extends CI_Controller {

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
        $this->Selectbd->Tabel = 'Pinpad';
        $this->load->model($this->Selectbd->Tabel.'_model', $this->Selectbd->Tabel);
    }

	public function index()
	{
		$this->config->set_item('base_url', site_url($this->uri->uri_string()).'/Page', 'pagin');
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" width="100%" class="TF2" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->query('', '', 1)),
        			   'Page' 			=> 'table',
        			   'Title' 			=> 'Pinpad'
        			   );

		$this->load->view('main', $data);
	}

	public function FilterID()
	{

	    if ($this->form_validation->run('FilterID') == TRUE)
	    {
            $this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
	    	$ID = 'Pinpad_'.$this->Selectbd->Search;

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
		if ($this->Account->is_auth_and_group(10))
	    {

		    if ($this->form_validation->run('Pinpad') == TRUE)
		    {

	  			$data = array (	'backpage' 	=> 'pinpad/add',
		        			   	'Title'  	=> 'pinpad успешно добавлен');
	            $this->Pinpad->add();
	  			$this->load->view('formsuccess', $data);

	        } Else {
	        	$data = array (	'UrlPage' 			=> 'pinpad/add',
	        					'ID_Type_PinPad' 	=>  form_dropdown('ID_Type_PinPad', $this->Valid->db_out_array('ID_Type_PinPad as ID, Name_Type_PinPad as Name', 'type_pinpad'), set_value('ID_Type_PinPad')),
		        			   	'Title'  			=> 'Добавление pinpad');

	        	$this->load->view('pinpadadd', $data);
	        }
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
		if ($this->Account->is_auth_and_group(11) && $this->form_validation->integer($id))
	    {
	     		$this->db->select('ID_Type_PinPad, SN_Num_PinPad');
	        	$this->db->from('pinpad');
	        	$this->db->where('ID_PinPad', $id);
	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$data['UrlPage'] = 'pinpad/edit/'.$id.'/1';
				    $data['Title'] = 'Изменение pinpad';

		            if (!$FlagNext)
		            {
				       	$data['ID_Type_PinPad'] = form_dropdown('ID_Type_PinPad', $this->Valid->db_out_array('ID_Type_PinPad as ID, Name_Type_PinPad as Name', 'type_pinpad'), $data['ID_Type_PinPad']);
			        	$this->load->view('pinpadedit', $data);

		            } else {

					    if ($this->form_validation->run('Pinpad') == TRUE)
					    {

				  			$data = array (	'backpage' 	=> 'pinpad/edit/'.$id,
					        			   	'Title'  	=> 'pinpad успешно изменен');
				            $this->Pinpad->edit($id);
				  			$this->load->view('formsuccess', $data);

				        } else {
					       	$data['ID_Type_PinPad'] = form_dropdown('ID_Type_PinPad', $this->Valid->db_out_array('ID_Type_PinPad as ID, Name_Type_PinPad as Name', 'type_pinpad'), set_value('ID_Type_PinPad'));
				        	$this->load->view('pinpadadd', $data);
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
	     		$this->db->select('Name_Type_PinPad, SN_Num_PinPad');
	        	$this->db->from('pinpad');
				$this->db->join('Type_Pinpad', 'Type_Pinpad.ID_Type_Pinpad = Pinpad.ID_Type_Pinpad', 'left');
	        	$this->db->where('ID_PinPad', $this->input->post('id'));

	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$this->load->view('pinpadview', $data);
	        	}
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}
}
