<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open('reg/add');
?>
<label for="Login">�����</label>
<input type="text" name="login" value="<?php echo set_value('login'); ?>" placeholder = "������� ��� �����"/>
<?php echo form_error('login'); ?></br>

<label for="FIO">���</label>
<input type="text" name="fio" value="<?php echo set_value('fio'); ?>" placeholder = "������� ���� ���"/>
<?php echo form_error('fio'); ?></br>

<label for="Email">E-mail</label>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder = "������� ��� E-Mail"/>
<?php echo form_error('email'); ?></br>

<div><input type="submit" value="������������������" /></div>
</form>