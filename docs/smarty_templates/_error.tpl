!{if $error}

	!{if !$error_text}
	!{assign_adv var='error_text' value='Some required information was not completed or invalid. <br>Please enter all the required information. <br>Fields with errors are marked below.'}

	!{/if}
		<p class="error">!{$error_text|stripslashes}</p>
!{/if}