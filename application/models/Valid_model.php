<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valid_model extends CI_Model {

	public function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

 	public function valid_post_date($name)
 	{
		return (!$this->input->post($name)) ? NULL : $this->input->post($name);
 	}

	public function db_out_array($Head, $Table, $Where = '')
	{
		$this->db->select($Head, FALSE);
		if (!$Where == '') $this->db->where($Where);
		$query = $this->db->get($Table);
        $TempArray[] = '';
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
