!{validate form="email_friend" field="from_name" criteria="notEmpty" assign="error_from_name" message="Your name is required"}
!{validate form="email_friend" field="from_email" criteria="isEmail" assign="error_from_email" message="Your email is required"}

<h2>Email This Article to a Friend:</h2>

	<p class="error">!{include file="_error.tpl"}</p>

	!{if $hideform neq true}

	<form name="email_friend" method="POST" action="">
		<fieldset>
			<ul>
				<li>
					<label for="from_name">Your Name:<em></em></label>
					<input type="text" name="from_name" value="!{$from_name|stripslashes}" size="40">
					!{if $error_from_name}<span class="error">!{$error_from_name}</span>!{/if}
				</li>
				
				<li>
					<label for="from_email">Your Email:<em></em></label>
					<input type="text" name="from_email" value="!{$from_email|stripslashes}" size="40">
					!{if $error_from_name}<span class="error">!{$error_from_email}</span>!{/if}
				</li>
				<li>
					<label>Send the Article to these email addresses:<br>
					Please Separate Each Email Address with a Comma, i.e. one@test.com, two@test.com</label>

					<textarea name="rcpt">!{$rcpt|stripslashes}</textarea>
				</li>
				<li>
					<input class="submit" type="submit" name="submit" value="Send">
				<li>
			</ul>
				
			<input type="hidden" name="article_id" value="!{$smarty.get.article_id}">
		
		</fieldset>
	</form>
	!{/if}
