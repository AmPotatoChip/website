<?php /* Smarty version 2.6.11, created on 2011-04-25 16:46:43
         compiled from email_signup.tpl */ ?>
<div id="email_signup">
<form name="email_signup" id="email_signup" method="POST" action="email_signup.php">
	<label>Get the latest news sent to your inbox:</label>
	<input class="input_text" type="text" name="email" size="25" value="example@email.com">
		<?php if ($_GET['em']): ?>
			<?php if ($_GET['em'] == '1'): ?>
				<br><span>Thank you! I will keep in touch.</span>
			<?php endif; ?>
			<?php if ($_GET['em'] == '2'): ?>
				<br><span>Invalid Email / No Blanks</span>
			<?php endif; ?>
			<?php if ($_GET['em'] == '3'): ?>
				<br><span>You are already in the system.</span>
			<?php endif; ?>
		<?php endif; ?>

	<input class="submit_button" type="submit" name="submit" value="Keep Me Informed!">
</form></div>