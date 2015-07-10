<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tct extends CI_Controller {

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
        $this->Selectbd->Tabel = 'TCT';
        $this->load->model($this->Selectbd->Tabel.'_model', $this->Selectbd->Tabel);
    }

	public function index()
	{
		$this->config->set_item('base_url', site_url($this->uri->uri_string()).'/Page', 'pagin');
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" width="100%" class="TF2" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->query('', '', 1)),
        			   'Page' 			=> 'table',
        			   'Title' 			=> 'TCT'
        			   );


		$this->load->view('main', $data);
	}

	public function FilterID()
	{

	    if ($this->form_validation->run('FilterID') == TRUE)
	    {
            $this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
	    	$ID = 'TCT_'.$this->Selectbd->Search;

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
		if ($this->Account->is_auth_and_group(4))
	    {
		    if ($this->form_validation->run('TCT') == TRUE)
		    {

	  			$data = array (	'backpage' 	=> 'tct/add',
		        			  	'Title'  	=> 'ТСТ успешно добавлена');
	            $this->TCT->add($this->form_validation->ID_addressP);

	  			$this->load->view('formsuccess', $data);

	        } Else {
	        	$data = array ('Title'  				=> 'Добавление ТСТ',
	           				   'UrlPage' 				=> 'tct/add',
							   'ID_Type_MCC_TCT' 		=>  form_dropdown('ID_Type_MCC_TCT', $this->Valid->db_out_array('ID_Type_MCC_TCT as ID, CONCAT(Kod_Type_MCC_TCT, ":", Name_Type_MCC_TCT) as Name', 'type_mcc_tct'), set_value('ID_Type_MCC_TCT')),
							   'ID_Type_Status_TCT' 	=>  form_dropdown('ID_Type_Status_TCT', $this->Valid->db_out_array('ID_Type_Status_TCT as ID, Name_Type_Status_TCT as Name', 'Type_Status_TCT'), set_value('ID_Type_Status_TCT')),
							   'ID_Type_Kategoria_TCT' 	=>  form_dropdown('ID_Type_Kategoria_TCT', $this->Valid->db_out_array('ID_Type_Kategoria_TCT as ID, Name_Type_Kategoria_TCT as Name', 'type_kategoria_tct'), set_value('ID_Type_Kategoria_TCT')));

	            $data = $data + $this->Address->edit($this->form_validation->ID_addressP, 'Post');
	        	$this->load->view('tctadd', $data);
	        }
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
		if ($this->Account->is_auth_and_group(5) && $this->form_validation->integer($id))
	    {
	            $this->db->select('Name_TCT, Phone_TCT, Contact_Name_TCT,
	            				   Num_Merchant_TCT, ID_Type_MCC_TCT,
	            				   ID_Type_Kategoria_TCT, Mode_TCT,
	            				   ID_Address_TCT, Home_Address_TCT,
	            				   Kind_Activity, Position_Contact_TCT,
	            				   Date_Visit_MPR_TCT, Date_Implementation_Potok_TCT,
	            				   ID_Type_Status_TCT, Repair_TCT');
	        	$this->db->from('tct');
	        	$this->db->where('ID_TCT', $id);
	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
				    $data['Title'] = 'Изменение ТСТ';
				    $data['UrlPage'] = 'tct/edit/'.$id.'/1';

		            if (!$FlagNext)
		            {
						$data['ID_Type_MCC_TCT'] =  form_dropdown('ID_Type_MCC_TCT', $this->Valid->db_out_array('ID_Type_MCC_TCT as ID, CONCAT(Kod_Type_MCC_TCT, ":", Name_Type_MCC_TCT) as Name', 'type_mcc_tct'), $data['ID_Type_MCC_TCT']);
						$data['ID_Type_Kategoria_TCT'] =  form_dropdown('ID_Type_Kategoria_TCT', $this->Valid->db_out_array('ID_Type_Kategoria_TCT as ID, Name_Type_Kategoria_TCT as Name', 'type_kategoria_tct'), $data['ID_Type_Kategoria_TCT']);
		  				$data['ID_Type_Status_TCT'] = form_dropdown('ID_Type_Status_Tct', $this->Valid->db_out_array('ID_Type_Status_TCT as ID, Name_Type_Status_TCT as Name', 'Type_Status_TCT'), $data['ID_Type_Status_TCT']);

		                $data = $data + $this->Address->edit($data['ID_Address_TCT'], 'Post');
		            	$this->load->view('tctedit', $data);
		            }
		            else
		            {

					    if ($this->form_validation->run('TCT') == TRUE)
					    {
				  			$data = array ('backpage' 	=> 'tct/edit/'.$id,
					        			   'Title'  	=> 'В ТСТ успешно внесены изменения');
				            $this->TCT->edit($id, $this->form_validation->ID_addressP);
				  			$this->load->view('formsuccess', $data);

				        } else {
							$data['ID_Type_MCC_TCT'] =  form_dropdown('ID_Type_MCC_TCT', $this->Valid->db_out_array('ID_Type_MCC_TCT as ID, CONCAT(Kod_Type_MCC_TCT, ":", Name_Type_MCC_TCT) as Name', 'type_mcc_tct'), set_value('ID_Type_MCC_TCT'));
							$data['ID_Type_Kategoria_TCT'] =  form_dropdown('ID_Type_Kategoria_TCT', $this->Valid->db_out_array('ID_Type_Kategoria_TCT as ID, Name_Type_Kategoria_TCT as Name', 'type_kategoria_tct'), set_value('ID_Type_Kategoria_TCT'));
	                        $data['ID_Type_Status_TCT'] = form_dropdown('ID_Type_Status_Tct', $this->Valid->db_out_array('ID_Type_Status_TCT as ID, Name_Type_Status_TCT as Name', 'Type_Status_TCT'), set_value('ID_Type_Status_TCT'));

					        $data = $data + $this->Address->edit($this->form_validation->ID_addressP, 'Post');
				        	$this->load->view('tctadd', $data);
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
	            $this->db->select('Name_TCT, Phone_TCT, Contact_Name_TCT,
	            				   Num_Merchant_TCT, Name_Type_MCC_TCT,
	            				   Name_Type_Kategoria_TCT, Mode_TCT,
	            				   Get_City(`ID_Address_TCT`, 2, Home_Address_TCT) as AdrP,
	            				   Kind_Activity, Position_Contact_TCT,
	            				   Date_Visit_MPR_TCT, Date_Implementation_Potok_TCT,
	            				   Name_Type_Status_TCT', FALSE);

	            $this->db->join('Type_Kategoria_TCT', 'Type_Kategoria_TCT.ID_Type_Kategoria_TCT = TCT.ID_Type_Kategoria_TCT', 'left');
	        	$this->db->join('Type_Status_TCT', 'Type_Status_TCT.ID_Type_Status_TCT = TCT.ID_Type_Status_TCT', 'left');
				$this->db->join('Type_MCC_TCT', 'Type_MCC_TCT.ID_Type_MCC_TCT = TCT.ID_Type_MCC_TCT', 'left');
	        	$this->db->from('tct');
	        	$this->db->where('ID_TCT', $this->input->post('id'));

	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$this->load->view('tctview', $data);
	        	}
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}
}
