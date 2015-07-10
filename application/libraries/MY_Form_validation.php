<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Form Validation Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Validation
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/form_validation.html
 */
class MY_Form_validation extends CI_Form_validation {

	Public $ID_addressP;

	public function valid_post_date($name)
 	{
		return (!$this->input->post($name)) ? NULL : $this->input->post($name);
 	}

	public function valid_date($data)
	{
	  if ( preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $data, $razdeli) )
	  	if (checkdate($razdeli[2], $razdeli[3], $razdeli[1]))
	  		return true;

	  $this->set_message('valid_date', 'Передано не верное имя {field}.');
	  return false;
	}

	public function valid_address_p($value)
	{
		$this->ID_addressP = '';
        $Count = 0;
		foreach ($this->CI->input->post('Post') as $key => $val)
		{
			if (!$val == 0)
			{
				$this->ID_addressP = $val;
				$Count = $key;
			}
		}

		if ($this->ID_addressP == '' || $Count < 4)
		{
			$this->set_message('valid_address_p', 'Ошибка');
			Return FALSE;
		}
		else
		{
			Return TRUE;
		}
	}

 	function valid_fild($value)
	{
		if (!$this->CI->db->field_exists($value, str_replace("ID_", "", $value)))
		{
			$this->set_message('valid_fild', 'Передано не верное имя {field}.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

 	public function valid_address_j($value)
	{
		$this->ID_addressJ = '';
        $Count = 0;
		foreach ($this->CI->input->post('Juristical') as $key => $val)
		{
			if (!$val == 0)
			{
				$this->ID_addressJ = $val;
				$Count = $key;
			}
		}

		if ($this->ID_addressJ == '' || $Count < 4)
		{       $this->set_message('valid_address_j', 'Ошибка');
			Return FALSE;
		}
		else
		{
			Return TRUE;
		}
	}

 	public function valid_page($value)
	{
		return ($this->is_natural_no_zero($value)) ? $value : 1;
	}
}
