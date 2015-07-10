<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['pagin']['base_url'] = '';
$config['pagin']['total_rows'] = 0;
$config['pagin']['per_page'] = 40;
$config['pagin']['uri_segment'] = 3;

$config['pagin']['num_links'] = 3;
$config['pagin']['use_page_numbers'] = TRUE;
$config['pagin']['page_query_string'] = FALSE;

$config['pagin']['full_tag_open'] = '<div class="pagination"><ul>';
$config['pagin']['full_tag_close'] = '</ul></div>';

$config['pagin']['first_link'] = 'Первая';
$config['pagin']['first_tag_open'] = '<li>';
$config['pagin']['first_tag_close'] = '</li>';

$config['pagin']['last_link'] = 'Последняя';
$config['pagin']['last_tag_open'] = '<li>';
$config['pagin']['last_tag_close'] = '</li>';

$config['pagin']['next_link'] = '&gt;';
$config['pagin']['next_tag_open'] = '<li>';
$config['pagin']['next_tag_close'] = '</li>';

$config['pagin']['prev_link'] = '&lt;';
$config['pagin']['prev_tag_open'] = '<li>';
$config['pagin']['prev_tag_close'] = '</li>';

$config['pagin']['cur_tag_open'] = '<li class="active"><a href="#">';
$config['pagin']['cur_tag_close'] = '</a></li>';

$config['pagin']['num_tag_open'] = '<li>';
$config['pagin']['num_tag_close'] = '</li>';