<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selectbd_model extends CI_Model {

    	public $Description_Fields = array();
    	public $Sc_Description_Fields = array();
        public $SearchFild = '';
        public $Search = '';
        public $HeadTableAdd;
        public $Tabel;
        public $ColTabel;
        public $join = array();

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function search_ID()
        {
	        		$this->db->select($this->Tabel.'.ID_'.$this->Tabel);
	        		$this->db->from('Dogovor');
					$this->db->join('Org', 'Org.ID_Dogovor = Dogovor.ID_Dogovor', 'left');
	                $this->db->join('TCT', 'TCT.ID_Org = Org.ID_Org', 'left');
	                $this->db->join('TID', 'TID.ID_TCT = TCT.ID_TCT', 'left');
	                $this->db->join('Terminal', 'Terminal.ID_Terminal = TID.ID_Terminal', 'left');
	                $this->db->join('Pinpad', 'Pinpad.ID_Pinpad = TID.ID_Pinpad', 'left');
	                $this->db->join('Sim', 'Sim.ID_Sim = TID.ID_Sim', 'left');
	                $this->db->where(str_replace("ID_", "", $this->SearchFild).'.'.$this->SearchFild, $this->Search);

	                $query = $this->db->get();

	                if ($query->num_rows() > 0)
	                {
		                foreach ($query->result_array() as $row)
						{
								$TempArr[] = $row['ID_'.$this->Tabel];
						}

					} Else $TempArr = 'NULL';

                    return $TempArr;
        }

        function query($TypeQuery = '', $HeadFild = '', $Page = 1)
        {
    			switch ($TypeQuery) {
					case 'FilterID':
	        			$Head = $this->_Head_String();
                    	$this->db->where_in($this->Tabel.'.ID_'.$this->Tabel, $this->search_ID());
						break;
					case 'Filter':
           				$Head = $this->_Head_String();
	           			$this->_querying_where();
						break;
					case 'FilterArr':
           				$Head = $this->_Head_String($HeadFild);
	           			$this->_querying_where();
	           			$this->db->group_by($Head);
						break;
					default:
						$Head = $this->_Head_String();
						break;
				}

                 switch ($this->Tabel) {
					case 'Dogovor':
                        $this->db->join('Type_Thank_Status', 'Type_Thank_Status.ID_Type_Thank_Status = Dogovor.ID_Type_Thank_Status', 'left');
                        $this->db->join('Org', 'Org.ID_Dogovor = Dogovor.ID_Dogovor', 'left');
                        $Head .= ', Get_ColorRow_Dogovor(`Date_Dissolution_Dogovor` , `ID_Org`) as colorrow';
						break;
					case 'Org':
   						$this->db->join('Type_Rank_Org', 'Type_Rank_Org.ID_Type_Rank_Org = Org.ID_Type_Rank_Org', 'left');
   						$this->db->join('Type_Org', 'Type_Org.ID_Type_Org = Org.ID_Type_Org', 'left');
   						$this->db->join('Users', 'Users.ID_Users = Org.ID_Users', 'left');
   						$Head .= ', Get_ColorRow_Org(`ID_Dogovor` , `ID_Org`) as colorrow';
						break;
					case 'TCT':
                        $this->db->join('Type_Kategoria_TCT', 'Type_Kategoria_TCT.ID_Type_Kategoria_TCT = TCT.ID_Type_Kategoria_TCT', 'left');
                        $this->db->join('Type_Status_TCT', 'Type_Status_TCT.ID_Type_Status_TCT = TCT.ID_Type_Status_TCT', 'left');
                        $this->db->join('Type_MCC_TCT', 'Type_MCC_TCT.ID_Type_MCC_TCT = TCT.ID_Type_MCC_TCT', 'left');
                        $Head .= ', Get_ColorRow_TCT(`ID_TCT`,`ID_Org`,`TCT`.`ID_Type_Status_TCT`) as colorrow';
						break;
					case 'TID':
                        $this->db->join('Type_Status_TID', 'Type_Status_TID.ID_Type_Status_TID = TID.ID_Type_Status_TID', 'left');
                        $Head .= ', Get_ColorRow_TID(`TID`.`ID_TID`,`ID_TCT`, `ID_Terminal`) as colorrow';
						break;
					case 'Terminal':
                        $this->db->join('Type_Terminal', 'Type_Terminal.Id_Type_Terminal = Terminal.Id_Type_Terminal', 'left');
                        $this->db->join('Type_Status_Terminal', 'Type_Status_Terminal.ID_Type_Status_Terminal = Terminal.ID_Type_Status_Terminal', 'left');
                        $Head .= ', Get_ColorRow_Terminal(`Terminal`.`ID_Terminal`,`Terminal`.`ID_Type_Status_Terminal`) as colorrow';
						break;
					case 'Pinpad':
                        $this->db->join('Type_Pinpad', 'Type_Pinpad.ID_Type_Pinpad = Pinpad.ID_Type_Pinpad', 'left');
                        $Head .= ', Get_ColorRow_Pinpad(`Pinpad`.`ID_Pinpad`,`ID_Status_Pinpad`) as colorrow';
						break;
					case 'SIM':
                        $this->db->join('Type_Operator_SIM', 'Type_Operator_SIM.ID_Type_Operator_SIM = SIM.ID_Type_Operator_SIM', 'left');
                        $Head .= ', Get_ColorRow_SIM(`SIM`.`ID_SIM`,`ID_Status_SIM`) as colorrow';
						break;
				}
                $this->db->select($Head, FALSE);

                if ($TypeQuery == '' || $TypeQuery == 'Filter') {
						$this->config->set_item('total_rows', $this->db->count_all_results($this->Tabel, FALSE), 'pagin');
						$this->db->limit($this->config->item('per_page','pagin'), ($Page - 1) * $this->config->item('per_page','pagin'));
                } else $this->db->from($this->Tabel);

	            return $this->db->get();
        }

        function _querying($WhereOrIN = FALSE)
        {
                $Head = $this->_Head_String();
	        	if ($WhereOrIN)
	        	{
                    $this->db->where_in($this->Tabel.'.ID_'.$this->Tabel, $this->search_ID());
           		}

           		$this->db->select($Head.$this->HeadTableAdd, FALSE);
        		$this->db->from($this->Tabel);

				foreach ($this->join as $row)
				{					$this->db->join($row[0], $row[1], $row[2]);
				}

	            return $this->db->get();
        }

        function _querying_where()
        {
			if (is_array($this->input->post('Flt')))
			{
				foreach ($this->input->post('Flt') as $NameFiled => $val)
				{
					 $this->db->like($this->ColTabel[$NameFiled], $val);
                }

                Return TRUE;
			}

			Return FALSE;
        }

     /*
        function _querying_where()
        {
			if (!is_array($this->input->post('Flt')))
			{
				foreach ($this->input->post('Flt') as $NameFiled => $val)
				{
					$TempArrAnd = array();
	        		$TempArrOr 	= array();
	                $this->db->group_start();					$TempArrAnd = explode('&&', $val);
                    $NameFiled = $this->ColTabel[$NameFiled];

					foreach ($TempArrAnd as $key => $val)
					{
						if (strripos($val, '||'))
						{							$TempArrOr = explode('||', $Where) + $TempArrOr;
							$TempArrAnd[$key] = $TempArrOr[0];
							unset($TempArrOr[0]);
						}
	                    $val = Trim($TempArrAnd[$key]);

						if (strripos($val, '<') === 0)
						{
							$this->_Where_Add($val, 2, $NameFiled.' <');
						}
							elseif (strripos($val, '>') === 0)
						{
							$this->_Where_Add($val, 2, $NameFiled.' >');
						}
							elseif (strripos($val, '!=') === 0)
						{
							$this->_Where_Add($val, 2, $NameFiled.' !=');
						}
							else
						{
							$this->_Where_Add($val, 0, $NameFiled);
						}
					}

					foreach ($TempArrOr as $val)
					{
	                    $val = Trim($val);

						if (strripos($val, '<') === 0)
						{
							$this->_Where_Add($val, 2, $NameFiled.' <');
						}
							elseif (strripos($val, '>') === 0)
						{
							$this->_Where_Add($val, 2, $NameFiled.' >');
						}
							elseif (strripos($val, '!=') === 0)
						{
							$this->_Where_Add($val, 2, $NameFiled.' !=');
						}
							else
						{
							$this->_Where_Add($val, 0, $NameFiled);
						}
					}

	                $this->db->group_end();
                }

                Return TRUE;
			}

			Return FALSE;
        }

        function _Where_Add($val = '', $Count, $NameFiled)
        {
			$val = Trim(substr($val, $Count));

			if (!$this->form_validation->required($val))
			{
				if ($this->form_validation->numeric($val))
				{
					$this->db->where($NameFiled, $val);
				} else {
					$this->db->like($NameFiled, trim(str_replace('?', '_', str_replace('*', '%', $val)), '%'));
				}
			}
        }
       */
        function _Head_String($ID_Fields = '')
        {
			if (!$this->Tabel == '')
			{
				$Flag = FALSE;
                if ($ID_Fields == '')
                {
		            $this->db->select('Data_Template_Fields');
		            $this->db->from('template_fields');
		            $this->db->join('table', 'table.ID_Table = template_fields.ID_Table');
		            $this->db->where('ID_Users', $this->session->ID_Users);
	                $this->db->where('Name_Table', $this->Tabel);
					$query = $this->db->get();
					$Flag = ($query->num_rows() > 0) ? TRUE : FALSE;
    			}

        		if ($Flag or !$ID_Fields == '')
        		{
					if ($ID_Fields == '')
					{
	                    $row = $query->row_array();
		                $ColumnArray = explode(', ', $row['Data_Template_Fields']);
	                } else {
	                	$ColumnArray = $ID_Fields;
	                }

					$this->db->select('ID_Fields_Table, Name_Fields_Table, Description_Fields_Table, Sc_Description_Fields_Table');
		            $this->db->from('Fields_Table');
		            $this->db->where_in('ID_Fields_Table', $ColumnArray);
                    $query = $this->db->get();

					$Out = '';

					foreach ($query->result_array() as $row)
					{
                        $this->ColTabel[$row['ID_Fields_Table']] = $row['Name_Fields_Table'];
                        $this->Description_Fields[$row['Name_Fields_Table']] = $row['Description_Fields_Table'];
                        $this->Sc_Description_Fields[$row['Name_Fields_Table']] = $row['Sc_Description_Fields_Table'];
					}
					if ($ID_Fields == '')
					{
						foreach ($ColumnArray as $value)
						{
	                        $Out .= $this->ColTabel[$value].', ';
						}
	                } else {
	                		$Out .= $this->ColTabel[$ColumnArray].', ';
	                }


                    $this->db->reset_query();
					Return reduce_multiples($Out, ", ", TRUE);
				}
			}
        }
}
