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

<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#org" data-toggle="tab">ТСТ</a></li>
  <li><a href="#paddress" data-toggle="tab">Почтовый адрес <?php echo form_error('Home_Address_TCT'); ?></a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="org">
    <div class="control-group">
    <label class="control-label" for="Name_TCT">Название ТСТ</label>
    <div class="controls">
      <input type="text" name="Name_TCT" value="<?php echo set_value('Name_TCT'); ?>" >
      <?php echo form_error('Name_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Mode_TCT">Режим работы</label>
    <div class="controls">
      <textarea name="Mode_TCT" cols="40" rows="3" wrap="soft | hard"><?php echo set_value('Mode_TCT', 'Будни:'.PHP_EOL.'Суббота:'.PHP_EOL.'Воскресенье:'); ?></textarea>
      <?php echo form_error('Mode_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Phone_TCT">Телефон</label>
    <div class="controls">
      <input type="text" name="Phone_TCT" value="<?php echo set_value('Phone_TCT'); ?>" >
      <?php echo form_error('Phone_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Kind_Activity">Вид деятельности</label>
    <div class="controls">
      <input type="text" name="Kind_Activity" value="<?php echo set_value('Kind_Activity'); ?>" >
      <?php echo form_error('Kind_Activity'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Contact_Name_TCT">Контактное лицо(ФИО)</label>
    <div class="controls">
      <input type="text" name="Contact_Name_TCT" value="<?php echo set_value('Contact_Name_TCT'); ?>" >
      <?php echo form_error('Contact_Name_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Position_Contact_TCT">Должность</label>
    <div class="controls">
      <input type="text" name="Position_Contact_TCT" value="<?php echo set_value('Position_Contact_TCT'); ?>" >
      <?php echo form_error('Position_Contact_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Num_Merchant_TCT">Номер мерчанта</label>
    <div class="controls">
      <input type="text" name="Num_Merchant_TCT" value="<?php echo set_value('Num_Merchant_TCT'); ?>" >
      <?php echo form_error('Num_Merchant_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Type_Kategoria_TCT">Категория ТСТ</label>
    <div class="controls">
      <?php echo $ID_Type_Kategoria_TCT; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Type_MCC_TCT">МСС</label>
    <div class="controls">
      <?php echo $ID_Type_MCC_TCT; ?>
    </div>
  </div>
  <label class="checkbox">
    <input type="checkbox" name="Repair_TCT" value="1" <?php echo set_checkbox('Repair_TCT', '1'); ?> /> ТСТ в ремонте
  </label>
  <div class="control-group">
    <label class="control-label" for="Type_Status_Tct">Статус</label>
    <div class="controls">
      <?php echo $ID_Type_Status_TCT; ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Visit_MPR_TCT">Дата посещения МПР</label>
    <div class="controls">
      <input type="date" name="Date_Visit_MPR_TCT" value="<?php echo set_value('Date_Visit_MPR_TCT'); ?>" >
      <?php echo form_error('Date_Visit_MPR_TCT'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Date_Implementation_Potok_TCT">Дата внедрения потока</label>
    <div class="controls">
      <input type="date" name="Date_Implementation_Potok_TCT" value="<?php echo set_value('Date_Implementation_Potok_TCT'); ?>" >
      <?php echo form_error('Date_Implementation_Potok_TCT'); ?>
    </div>
  </div>
  </div>

  <div class="tab-pane" id="paddress">
    <div class="control-group">
    <label class="control-label" for="Post_region">Регион</label>
    <div class="controls">
      <div class="controls_Post_region"><?PHP echo $Post_region; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_area">Район</label>
    <div class="controls">
      <div class="controls_Post_area"><?PHP echo $Post_area; ?></div>
   </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_city">Город</label>
    <div class="controls">
      <div class="controls_Post_city"><?PHP echo $Post_city; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_city_area">Внутригородской район</label>
    <div class="controls">
      <div class="controls_Post_city_area"><?PHP echo $Post_city_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_locality">Населенный пункт</label>
    <div class="controls">
      <div class="controls_Post_locality"><?PHP echo $Post_locality; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_street">Улица</label>
    <div class="controls">
      <div class="controls_Post_street"><?PHP echo $Post_street; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_add_area">Доп. территория</label>
    <div class="controls">
      <div class="controls_Post_add_area"><?PHP echo $Post_add_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Post_street_add_area">Улица на доп. территории</label>
    <div class="controls">
      <div class="controls_Post_street_add_area"><?PHP echo $Post_street_add_area; ?></div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="Home_Address_TCT">Дом/квартира/номер офиса</label>
    <div class="controls">
      <input type="text" name="Home_Address_TCT" value="<?PHP echo set_value('Home_Address_TCT'); ?>">
    </div>
  </div>
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