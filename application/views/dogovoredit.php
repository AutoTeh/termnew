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
  <div class="control-group ">
    <label class="control-label" for="Num_Dogovor">Номер договора</label>
    <div class="controls">
      <input  type="text" name="Num_Dogovor" value="<?php echo $Num_Dogovor; ?>" >
      <?php echo form_error('Num_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Dogovor">Дата договора</label>
    <div class="controls">
      <input type="date" name="Date_Dogovor" value="<?php echo $Date_Dogovor; ?>" >
      <?php echo form_error('Date_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Diskont_Dogovor">Дисконт</label>
    <div class="controls">
      <input type="text" name="Diskont_Dogovor" value="<?php echo $Diskont_Dogovor; ?>" >
      <?php echo form_error('Diskont_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Diskont_Dogovor">Дата дисконта</label>
    <div class="controls">
      <input type="date" name="Date_Diskont_Dogovor" value="<?php echo $Date_Diskont_Dogovor; ?>" >
      <?php echo form_error('Date_Diskont_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Internat_Card_Dogovor">Международные карты</label>
    <div class="controls">
      <input type="text" name="Internat_Card_Dogovor" value="<?php echo $Internat_Card_Dogovor; ?>" >
      <?php echo form_error('Internat_Card_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Debet_Card_Dogovor">Дебетовые</label>
    <div class="controls">
      <input type="text" name="Debet_Card_Dogovor" value="<?php echo $Debet_Card_Dogovor; ?>" >
      <?php echo form_error('Debet_Card_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Type_Operator_SIM">Статус спасибо</label>
    <div class="controls">
      <?php echo $ID_Type_Thank_Status; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Thank_Dogovor">Спасибо</label>
    <div class="controls">
      <input type="text" name="Thank_Dogovor" value="<?php echo $Thank_Dogovor; ?>" >
      <?php echo form_error('Thank_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Money_Movement_Dogovor">Оборот</label>
    <div class="controls">
      <input type="text" name="Money_Movement_Dogovor" value="<?php echo $Money_Movement_Dogovor; ?>" >
      <?php echo form_error('Money_Movement_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Money_Income_Dogovor">Доход</label>
    <div class="controls">
      <input type="text" name="Money_Income_Dogovor" value="<?php echo $Money_Income_Dogovor; ?>" >
      <?php echo form_error('Money_Income_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Dissolution_Dogovor">Дата расторжения</label>
    <div class="controls">
      <input type="date" name="Date_Dissolution_Dogovor" value="<?php echo $Date_Dissolution_Dogovor; ?>" >
      <?php echo form_error('Date_Dissolution_Dogovor'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Comm_Dissolution_Dogovor">Комментарий</label>
    <div class="controls">
      <textarea name="Comm_Dissolution_Dogovor" cols="40" rows="3" wrap="soft | hard"><?php echo $Comm_Dissolution_Dogovor; ?></textarea>
      <?php echo form_error('Comm_Dissolution_Dogovor'); ?>
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