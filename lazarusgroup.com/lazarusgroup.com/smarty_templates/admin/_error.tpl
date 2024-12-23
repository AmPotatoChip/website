!{if $smarty.get.msg}
	!{assign_adv var='error_text' value="`$smarty.get.msg`"}
	!{assign_adv var='error' value=true}
!{/if}


!{if $error}
!{if !$error_text}
	!{assign_adv var='error_text' value='Some required information was not completed or invalid.<br/>Please enter all the required information.<br/>Fields with errors are marked below.'}
!{/if}
<p>
<table border="0" cellpadding="0" cellspacing="0" id="error">
	<thead>
		<tr>
			<td>User Message</td>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td>!{$error_text|stripslashes}</td>
		</tr>
	</tbody>
</table>
</p>

!{/if}