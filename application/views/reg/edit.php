<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form method="post" action="../reg/edit/<?PHP echo $ID_U ?>" class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="login">�����</label>
    <div class="controls">
      <input type="text" id="login" placeholder="�����" value="<?php echo set_value('login'); ?>" >
      <?php echo form_error('login'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pass">������</label>
    <div class="controls">
      <input type="password" id="pass" placeholder="������" value="<?php echo set_value('pass'); ?>" >
      <?php echo form_error('pass'); ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="fio">���</label>
    <div class="controls">
      <input type="text" id="fio" placeholder="���" value="<?php echo set_value('fio'); ?>">
      <?php echo form_error('fio'); ?></br>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="e_mail">E-mail</label>
    <div class="controls">
      <input type="text" id="e_mail" placeholder="E-mail" "<?php echo set_value('e_mail'); ?>">
      <?php echo form_error('e_mail'); ?>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">������������������</button>
    </div>
  </div>
</form>