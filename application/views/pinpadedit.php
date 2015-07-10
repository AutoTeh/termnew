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
    <label class="control-label" for="Type_PinPad">Модель пин-пада</label>
    <div class="controls">
      <?php echo $ID_Type_PinPad; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="SN_Num_PinPad">Серийный номер</label>
    <div class="controls">
      <input type="text" name="SN_Num_PinPad" value="<?php echo $SN_Num_PinPad; ?>" >
      <?php echo form_error('SN_Num_PinPad'); ?>
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