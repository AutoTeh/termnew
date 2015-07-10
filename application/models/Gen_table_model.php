<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gen_table_model extends CI_Model {
    protected $TableArray = array();
    protected $Tabel;
    protected $SizeWindow;
    public $CountCol;

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	public function Out($query, $TrueHead = TRUE)
	{
			$this->CountCol = count($this->Selectbd->Description_Fields);
			$this->Tabel = $this->Selectbd->Tabel;
			if ($query->num_rows() > 0 && !$this->Tabel == '')
        	{
         		switch ($this->Tabel) {
					case 'Dogovor':
						$this->SizeWindow = array('width'=> 467, 'height'=> 690 + 32, 'class' => 'btn btn-primary btn-mini');
						break;
					case 'Org':
						$this->SizeWindow = array('width'=> 491, 'height'=> 598 + 32, 'class' => 'btn btn-primary btn-mini');
						break;
					case 'TCT':
						$this->SizeWindow = array('width'=> 467, 'height'=> 918 + 32, 'class' => 'btn btn-primary btn-mini');
						break;
					case 'TID':
						$this->SizeWindow = array('width'=> 491, 'height'=> 420 + 32, 'class' => 'btn btn-primary btn-mini');
						break;
					case 'Terminal':
						$this->SizeWindow = array('width'=> 491, 'height'=> 353 + 32, 'class' => 'btn btn-primary btn-mini');
						break;
					case 'Pinpad':
						$this->SizeWindow = array('width'=> 491, 'height'=> 150 + 32, 'class' => 'btn btn-primary btn-mini');
						break;
					case 'SIM':
						$this->SizeWindow = array('width'=> 453, 'height'=> 150 + 32, 'class' => 'btn btn-primary btn-mini');
						break;
				}

                if ($TrueHead){ $this->_gen_head($query); } Else { $this->table->set_template(array('table_open' => '',  'table_close' => '')); }
                $this->_get_inf();
                $ColorRow = array('error', 'warning', '');
                $this->pagination->initialize($this->config->item('pagin'));
        		$this->table->add_row(array('data' => $this->pagination->create_links(), 'bgcolor' => '#D0D0D0', 'colspan' => $this->CountCol));
				foreach ($query->result_array() as $row)
				{
					foreach ($row as $key => $value)
					{
                        if (array_key_exists($key, $this->Selectbd->Description_Fields) || $key == 'ID_'.$this->Tabel)
                        {
	                    	switch ($key) {
							    case 'ID_'.$this->Tabel:
							        $TempArray[] = $this->_gen_button($value);
							        $ID_Table = $value;
							        break;
							    default:
							        $TempArray[] = $value;
							}
						}

					}

						$this->table->add_row($TempArray, $ColorRow[$row['colorrow']]);
						$TempArray = '';
						$this->table->add_row(array('data' => '<center><div id="FilterTabel" class="'.$this->Tabel.'_'.$ID_Table.'"></div></center>', 'bgcolor' => '#D0D0D0', 'colspan' => $this->CountCol));

				}
            } Else  {

            	if ($this->Selectbd->Search == '')
            		$this->table->add_row(array('data' => 'Нет данных для вывода', 'colspan' => $this->CountCol));
            }

            Return $this->table->generate('');
	}

	function _gen_head($query = '')
	{		if (!$query == '')
		{			$row = $query->list_fields();

			foreach ($row as $value)
			{
				if (array_key_exists($value, $this->Selectbd->Description_Fields))
				{
					$HeadID = array_search($value, $this->Selectbd->ColTabel);
					if ($this->Selectbd->Search == '')
					{
						$TempArrayHead[] = array('data' 	=> $this->Selectbd->Sc_Description_Fields[$value].'<div class="dropdown"><a href="#" class="btn btn-mini dropdown-toggle" data-toggle="dropdown"><b class="caret"></b></a><ul class="dropdown-menu"><Form onsubmit="return get_Flt('."'".$this->Tabel."'".');"><input type="text" class="input-medium search-query" id="Flt" name="'.$HeadID.'" ><br><div id="Select_'.$HeadID.'"></div></Form></ul></div>',
											 	 'title' 	=> $this->Selectbd->Description_Fields[$value]);
					} Else {						$TempArrayHead[] = array('data' 	=> $this->Selectbd->Sc_Description_Fields[$value],
											 	 'title' 	=> $this->Selectbd->Description_Fields[$value]);
					}
		        }

			}
            if ($this->Selectbd->Search == '')
            {
            	$TempArrayHead[] = '';
            } Else {            	$TempArrayHead[] = '<div class="btn-group"><a class="btn btn-primary" title="Обновить" href="#"
            					onclick="'."ReceiveTabelFilterID(".$this->input->post('search').", '".$this->Tabel."', '".$this->input->post('searchtable')."', '".$this->input->post('searchfild')."');return false".'">
            					<i class="icon-refresh"></i></a><a class="btn btn-danger" title="Закрыть" href="#"
            					onclick="'."clean('".$this->input->post('searchtable').'_'.$this->Selectbd->Search."');return false".'">
            					<i class="icon-remove"></i></a></div>';
				$this->table->set_template(array('table_open' => '<table class=" TF2" >'));
			}

			$this->table->set_heading($TempArrayHead);
		}
	}

	function _gen_button($id)
	{

		$Out  = '<div class="btn-group ">'.anchor_popup('/'.$this->Tabel.'/edit/'.$id, '<i class="icon-pencil icon-white"></i>', $this->SizeWindow).'<a class="btn btn-primary btn-mini" href="#" onclick="'."get_View(".$id.", '".$this->Tabel."');return false".'"><i class="icon-info-sign icon-white"></i></a><a class="btn btn-primary btn-mini dropdown-toggle " data-toggle="dropdown" href="#"><span class="caret "></span></a><ul class="dropdown-menu pull-right">';
        $Out .= '<li class="dropdown-submenu pull-left"><a tabindex="-1" href="#">Показать</a><ul class="dropdown-menu">';

		foreach ($this->TableArray as $key => $row)
		{
			if ($key != $this->Tabel)
			{
				$Out .= '<li><a href="#" onclick="'."ReceiveTabelFilterID(".$id.", '".$key."', '".$this->Tabel."', 'ID_".$this->Tabel."');return false".'">'.$row.'</a></li>';
			}
		}

  		$Out .= '</ul></li><li class="divider"></li><li class="dropdown-submenu pull-left"><a tabindex="-1" href="#">Привязка</a><ul class="dropdown-menu">';

    	switch ($this->Tabel) {
		  case 'Dogovor':
			  $Out .= '<li><a href="#"> К Организация</a></li>';
			  break;
		  case 'Org':
			  $Out .= '<li><a href="#"> К Договор</a></li><li><a href="#"> К ТСТ</a></li>';
			  break;
		  case 'TCT':
			  $Out .= '<li><a href="#"> К Организация</a></li><li><a href="#"> К TID</a></li>';
			  break;
		  case 'TID':
			  $Out .= '<li><a href="#"> К ТСТ</a></li><li><a href="#"> К Терминалу</a></li><li><a href="#"> К Пинпаду</a></li><li><a href="#"> К SIM-Карте</a></li>';
			  break;
		  case 'Terminal':
			  $Out .= '<li><a href="#"> К TID</a></li>';
			  break;
		  case 'Pinpad':
			  $Out .= '<li><a href="#"> К TID</a></li>';
			  break;
		  case 'SIM':
			  $Out .= '<li><a href="#"> К TID</a></li>';
			  break;
		}

		return $Out."</ul></li></ul></div>";
	}

	function _get_inf()
	{
		$this->db->select('Name_Table, Description_Table');
		$query = $this->db->get('table');

        if ($query->num_rows() > 0)
        {
			foreach ($query->result_array() as $row)
			{				$this->TableArray[$row['Name_Table']] = $row['Description_Table'];
			}
		}
	}
}
