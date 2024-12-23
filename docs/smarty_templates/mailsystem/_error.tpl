!{if $error_message}
<br/>
<table border="0" cellpadding="3" cellspacing="0" align="center" class="error_message">
<tr>
<td align="center">!{$error_text|stripslashes}</td>
</tr>
</table>
<br/>
!{/if}


!{if $user_message}
<br/>
<table border="0" cellpadding="3" cellspacing="0" align="center" class="user_message">
<tr>
<td align="center">!{$user_text|stripslashes}</td>
</tr>
</table>	
<br/>
!{/if}