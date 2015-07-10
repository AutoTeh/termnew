<?PHP
defined('BASEPATH') OR exit('No direct script access allowed');
echo form_open('auth', array('class' => 'form-inline'));
?>  <center>
  <div class="control-group">

    <div class="controls">
      <input type="text" class="span2" name="login" placeholder="Логин">
      <?php echo form_error('login'); ?></br>
    </div>
  </div>
  <div class="control-group">

    <div class="controls">
      <input type="password" class="span2" name="pass" placeholder="Пароль">
      <?php echo form_error('pass'); ?></br>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Войти</button>
    </div>
  </div> </center>
</form>
