<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Org extends CI_Controller {

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
        $this->Selectbd->Tabel = 'Org';
        $this->load->model($this->Selectbd->Tabel.'_model', $this->Selectbd->Tabel);
    }

	public function index()
	{
		$this->config->set_item('base_url', site_url($this->uri->uri_string()).'/Page', 'pagin');
		$this->table->set_template(array ( 'table_open'  => '<table id="head" cellspacing="0" width="100%" class="TF2" >' ));

  		$data = array ('Table' 			=> $this->Gen_table->Out($this->Selectbd->query('', '', 1)),
			   		   'Page' 			=> 'table',
        			   'Title' 			=> 'Организации'
        			   );

		$this->load->view('main', $data);
	}

	public function FilterID()
	{

	    if ($this->form_validation->run('FilterID') == TRUE)
	    {
     		$this->Selectbd->SearchFild = $this->input->post('searchfild');
			$this->Selectbd->Search = $this->input->post('search');
			$ID = 'Org_'.$this->Selectbd->Search;

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
		if ($this->Account->is_auth_and_group(2))
	    {

		    if ($this->form_validation->run('Org') == TRUE)
		    {

	  			$data = array (	'backpage' 	=> 'org/add',
		        			  	'Title'  	=> 'Организация успешно добавлена');
	            $this->Org->add($this->form_validation->ID_addressJ, $this->form_validation->ID_addressP);

	  			$this->load->view('formsuccess', $data);

	        } Else {
	        	$data = array ('Title'  			=> 'Добавление нового договора.',
	           				   'UrlPage' 			=> 'org/add',
	           				   'ID_Users' 			=>  form_dropdown('ID_Users', $this->Valid->db_out_array('ID_Users as ID, FIO_Users as Name', 'Users', array('ID_Type_Position' => 2)), set_value('ID_Users'), 'class="span4"'),
							   'ID_Type_Org' 		=>  form_dropdown('ID_Type_Org', $this->Valid->db_out_array('ID_Type_Org as ID, Name_Type_Org as Name', 'type_org'), set_value('ID_Type_Org'), 'class="span4"'),
							   'ID_Type_Rank_Org' 	=>  form_dropdown('ID_Type_Rank_Org', $this->Valid->db_out_array('ID_Type_Rank_Org as ID, Name_Type_Rank_Org as Name', 'type_rank_org'), set_value('ID_Type_Rank_Org'), 'class="span4"'));
		        $data = $data + $this->Address->edit($this->form_validation->ID_addressJ, 'Juristical');
	            $data = $data + $this->Address->edit($this->form_validation->ID_addressP, 'Post');
	        	$this->load->view('orgadd', $data);
	        }
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}

	public function Edit($id = '', $FlagNext = FALSE)
	{
		if ($this->Account->is_auth_and_group(3) && $this->form_validation->integer($id))
	    {
	            $this->db->select('Name_Org, INN_Org, FIO_Boss_Org,
	            				   E_Mail_Org, ID_Post_Address_Org,
	            				   Home_Post_Address_Org, ID_Juristical_Address_Org,
	            				   Home_Juristical_Address_Org, ID_Type_Org,
	            				   ID_Type_Rank_Org, Phone_Boss_Org, ID_Users');
	        	$this->db->from('org');
	        	$this->db->where('ID_Org', $id);
	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
				    $data['Title'] = 'Изменение организации';
				    $data['UrlPage'] = 'org/edit/'.$id.'/1';

		            if (!$FlagNext)
		            {

						$data['ID_Type_Org'] =  form_dropdown('ID_Type_Org', $this->Valid->db_out_array('ID_Type_Org as ID, Name_Type_Org as Name', 'type_org'), $data['ID_Type_Org'], 'class="span4"');
						$data['ID_Type_Rank_Org'] =  form_dropdown('ID_Type_Rank_Org', $this->Valid->db_out_array('ID_Type_Rank_Org as ID, Name_Type_Rank_Org as Name', 'type_rank_org'), $data['ID_Type_Rank_Org'], 'class="span4"');
						$data['ID_Users'] =  form_dropdown('ID_Users', $this->Valid->db_out_array('ID_Users as ID, FIO_Users as Name', 'Users', array('ID_Type_Position' => 2)), $data['ID_Users'], 'class="span4"');

		                $data = $data + $this->Address->edit($data['ID_Juristical_Address_Org'], 'Juristical');
		                $data = $data + $this->Address->edit($data['ID_Post_Address_Org'], 'Post');
		            	$this->load->view('orgedit', $data);

		            } else {
					    if ($this->form_validation->run('Org') == TRUE)
					    {
				  			$data = array ('backpage' 	=> 'org/edit/'.$id,
					        			   'Title'  	=> 'В организацию успешно внесены изменения');
				            $this->Org->edit($id, $this->form_validation->ID_addressJ, $this->form_validation->ID_addressP);
				  			$this->load->view('formsuccess', $data);

				        } else {

							$data['ID_Type_Org'] =  form_dropdown('ID_Type_Org', $this->Valid->db_out_array('ID_Type_Org as ID, Name_Type_Org as Name', 'type_org'), set_value('ID_Type_Org'), 'class="span4"');
							$data['ID_Type_Rank_Org'] =  form_dropdown('ID_Type_Rank_Org', $this->Valid->db_out_array('ID_Type_Rank_Org as ID, Name_Type_Rank_Org as Name', 'type_rank_org'), set_value('ID_Type_Rank_Org'), 'class="span4"');
							$data['ID_Users'] =  form_dropdown('ID_Users', $this->Valid->db_out_array('ID_Users as ID, FIO_Users as Name', 'Users', array('ID_Type_Position' => 2)), set_value('ID_Users'), 'class="span4"');
			                $data = $data + $this->Address->edit($this->form_validation->ID_addressJ, 'Juristical');
			                $data = $data + $this->Address->edit($this->form_validation->ID_addressP, 'Post');
				        	$this->load->view('orgadd', $data);
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
	            $this->db->select("CONCAT(Name_Type_Org, ' ', Name_Org) as Name, INN_Org, FIO_Boss_Org,
	            				   E_Mail_Org, Get_City(`ID_Post_Address_Org`, 2, Home_Post_Address_Org) as AdrP,
	            				   Get_City(`ID_Juristical_Address_Org`, 2, Home_Juristical_Address_Org) as AdrJ,
	            				   Name_Type_Rank_Org, Phone_Boss_Org, FIO_Users", FALSE);
	            $this->db->join('Type_Rank_Org', 'Type_Rank_Org.ID_Type_Rank_Org = Org.ID_Type_Rank_Org', 'left');
	        	$this->db->join('Type_Org', 'Type_Org.ID_Type_Org = Org.ID_Type_Org', 'left');
				$this->db->join('Users', 'Users.ID_Users = Org.ID_Users', 'left');
	        	$this->db->from('org');
	        	$this->db->where('ID_Org', $this->input->post('id'));

	        	$query = $this->db->get();

	        	if ($query->num_rows() > 0)
	        	{
					$data = $query->row_array();
					$this->load->view('orgview', $data);
	        	}
     	} else {
	     	Echo 'Доступ запрещен';
	    }
	}
}
