<div id="email_signup">
<form name="email_signup" id="email_signup" method="POST" action="email_signup.php">
	<label>Get the latest news sent to your inbox:</label>
	<input class="input_text" type="text" name="email" size="25" value="example@email.com">
		!{if $smarty.get.em}
			!{if $smarty.get.em eq '1'}
				<br><span>Thank you! I will keep in touch.</span>
			!{/if}
			!{if $smarty.get.em eq '2'}
				<br><span>Invalid Email / No Blanks</span>
			!{/if}
			!{if $smarty.get.em eq '3'}
				<br><span>You are already in the system.</span>
			!{/if}
		!{/if}

	<input class="submit_button" type="submit" name="submit" value="Keep Me Informed!">
</form></div>