<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="http://aion.sytes.net/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="http://aion.sytes.net/js/bootstrap.min.js"></script>
	<script src="http://aion.sytes.net/js/script.js"></script>
	<title><?PHP echo $Title ;?></title>
</head>
<body>
<?PHP
echo form_open($UrlPage, array('class' => 'form-horizontal'));
?>
  <div class="control-group">
    <label class="control-label" for="Num_TID">TID</label>
    <div class="controls">
      <input type="text" name="Num_TID" value="<?php echo set_value('Num_TID'); ?>" >
      <?php echo form_error('Num_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Kod_TID">Код активации</label>
    <div class="controls">
      <input type="text" name="Kod_TID" value="<?php echo set_value('Kod_TID'); ?>" >
      <?php echo form_error('Kod_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Sending_Request_TID">Дата подачи заявки</label>
    <div class="controls">
      <input type="date" name="Date_Sending_Request_TID" value="<?php echo set_value('Date_Sending_Request_TID'); ?>" >
      <?php echo form_error('Date_Sending_Request_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Installation_Terminal_TID">Дата установки терминала</label>
    <div class="controls">
      <input type="date" name="Date_Installation_Terminal_TID" value="<?php echo set_value('Date_Installation_Terminal_TID'); ?>" >
      <?php echo form_error('Date_Installation_Terminal_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Type_Status_Tct">Статус</label>
    <div class="controls">
      <?php echo $ID_Type_Status_TID; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Dismantling_TID">Дата демонтажа</label>
    <div class="controls">
      <input type="date" name="Date_Dismantling_TID" value="<?php echo set_value('Date_Dismantling_TID'); ?>" >
      <?php echo form_error('Date_Dismantling_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Reg_CA_TID">Дата регистрации ЦА</label>
    <div class="controls">
      <input type="date" name="Date_Reg_CA_TID" value="<?php echo set_value('Date_Reg_CA_TID'); ?>" >
      <?php echo form_error('Date_Reg_CA_TID'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Сохранить</button>
    </div>
  </div>
</form>
</body>
</html>