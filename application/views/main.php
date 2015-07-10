<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="http://aion.sytes.net/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="http://aion.sytes.net/css/filtergrid.css" rel="stylesheet" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="http://aion.sytes.net/js/bootstrap.min.js"></script>
		<script src="http://aion.sytes.net/js/tooltip.js"></script>
	<script src="http://aion.sytes.net/js/popover.js"></script>
	<script src="http://aion.sytes.net/js/TableFilter/tablefilter.js"></script>
	<script src="http://aion.sytes.net/js/script.js"></script>
	<title><?PHP echo $Title ;?></title>
</head>
<body>
<div class="navbar">
  <div class="navbar-inner">
    <div class="container">

      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="brand" href="/">АС Эквайринг</a>
       <ul class="nav ">
		  <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		      Таблицы
		      <b class="caret"></b>
		    </a>
		    <ul class="dropdown-menu">
		    <li><a href="/dogovor"> Договоры</a></li>
		    <li><a href="/org"> Организации</a></li>
		    <li><a href="/tct"> ТСТ</a></li>
		    <li><a href="/tid"> TID</a></li>
		    <li><a href="/terminal"> Терминалы</a></li>
		    <li><a href="/pinpad"> Пинпады</a></li>
		    <li><a href="/sim"> SIM-карты</a></li>
		    </ul>
		  </li>
		</ul>

      <!-- Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse">

      </div>
<?php if ($this->session->logged_in) { ?>
       <ul class="nav pull-right">
		  <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		       <?php echo $this->session->FIO;  ?>
		      <b class="caret"></b>
		    </a>
		    <ul class="dropdown-menu">
		    <li><a href="/auth/exit_logged">Выход</a></li>
		    </ul>
		  </li>
		</ul>
<?php } else { ?>
       <ul class="nav pull-right">
		  <li class="dropdown">
		    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		       Вход
		      <b class="caret"></b>
		    </a>
		    <ul class="dropdown-menu">
		    <?php $this->load->view('auth');  ?>
		    </ul>
		  </li>
		</ul>
<?php } ?>
    </div>
  </div>
</div>

<div class="container-fluid">
<div class="row-fluid">
<div class="span12">
<span id="load">
	<?PHP
		$this->load->view($Page);

		echo $this->benchmark->elapsed_time().'<br>';
		echo $this->benchmark->memory_usage();
	?>
</div>
</div>
</div>

<div class="modal hide" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Просмотр</h3>
  </div>
  <div class="modal-body"></div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Закрыть</button>
  </div>
</div>
</body>
</html>