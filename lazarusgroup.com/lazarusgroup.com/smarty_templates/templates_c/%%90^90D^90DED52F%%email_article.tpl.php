<?php /* Smarty version 2.6.11, created on 2011-05-12 00:14:09
         compiled from email_article.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'email_article.tpl', 1, false),array('modifier', 'stripslashes', 'email_article.tpl', 15, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'email_friend','field' => 'from_name','criteria' => 'notEmpty','assign' => 'error_from_name','message' => 'Your name is required'), $this);?>

<?php echo smarty_function_validate(array('form' => 'email_friend','field' => 'from_email','criteria' => 'isEmail','assign' => 'error_from_email','message' => 'Your email is required'), $this);?>


<h2>Email This Article to a Friend:</h2>

	<p class="error"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></p>

	<?php if ($this->_tpl_vars['hideform'] != true): ?>

	<form name="email_friend" method="POST" action="">
		<fieldset>
			<ul>
				<li>
					<label for="from_name">Your Name:<em></em></label>
					<input type="text" name="from_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['from_name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40">
					<?php if ($this->_tpl_vars['error_from_name']): ?><span class="error"><?php echo $this->_tpl_vars['error_from_name']; ?>
</span><?php endif; ?>
				</li>
				
				<li>
					<label for="from_email">Your Email:<em></em></label>
					<input type="text" name="from_email" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['from_email'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40">
					<?php if ($this->_tpl_vars['error_from_name']): ?><span class="error"><?php echo $this->_tpl_vars['error_from_email']; ?>
</span><?php endif; ?>
				</li>
				<li>
					<label>Send the Article to these email addresses:<br>
					Please Separate Each Email Address with a Comma, i.e. one@test.com, two@test.com</label>

					<textarea name="rcpt"><?php echo ((is_array($_tmp=$this->_tpl_vars['rcpt'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
				</li>
				<li>
					<input class="submit" type="submit" name="submit" value="Send">
				<li>
			</ul>
				
			<input type="hidden" name="article_id" value="<?php echo $_GET['article_id']; ?>
">
		
		</fieldset>
	</form>
	<?php endif; ?>