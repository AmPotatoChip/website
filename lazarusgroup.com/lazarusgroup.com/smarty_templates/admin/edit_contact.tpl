<script language="javascript">
function toggleForms(tdID,ownObj){
	var current = document.getElementById(tdID).style.display;
	switch(current){
		case 'none':
			document.getElementById(tdID).style.display='';
			ownObj.innerHTML='hide';
		break;
		default:
			document.getElementById(tdID).style.display='none';
			ownObj.innerHTML='show';
		break;	
	}	
}
</script>

<h2>Edit Contact Information</h2>

!{include file="admin/_error.tpl"}
<table border="0" cellpadding="3" cellspacing="0" id="display" width="740">
<thead>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td><div class="adminheader">Contact Business and Name</div>
!{if $info.main->company_name}<h3>!{$info.main->company_name}</h3>!{/if}
<h3>!{$info.main->fname|stripslashes} !{if $info.main->mname}!{$info.main->mname} !{/if}!{$info.main->lname|stripslashes}</h3>
Newsletter: 
!{if $info.main->newsletter eq 'Y'}Yes!{/if}
!{if $info.main->newsletter eq 'N'}No!{/if}
<br /><br />
<a href="edit_address_main.php?contact_id=!{$smarty.get.contact_id}" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/clients_edit_16.gif" border="0" />  Edit Business and/or Name Above</a>
<br /><br />

</td>
</tr>
<tr>
	<td><div class="adminheader">Mailing Address(es)</div><br />
	<a href="edit_address.php?contact_id=!{$smarty.get.contact_id}" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/home_16.gif" border="0" /> Add New Address</a><br /><br />
	
!{if $info.address}

!{html_table_adv loop=$info.address table_attr="border=0 cellpadding=3 cellspacing=0" cols=3}
!{assign_adv var="address_info" value="[[address_info]]"}
<table border="0" cellpadding="3" cellspacing="0" id="address">
<thead>
<tr>
	<td>!{$address_info|stripslashes}</td>
</tr>
</thead>
<tbody>
<tr>
	<td>[[address]]<br/>
[[city]], [[state]] [[postal_code]]<br/>
</td>
</tr>
</tbody>
<tfoot>
<tr>
	<td><a href="edit_address.php?address_id=[[id]]&contact_id=!{$smarty.get.contact_id}" class="link"><img src="/images/icons/home_edit_16.gif" border="0" /> Edit Address</a> | <a href="delete_address.php?address_id=[[id]]&contact_id=!{$smarty.get.contact_id}" class="link" onClick="return confirm('Are you sure you would like to delete this address?');"><img src="/images/icons/home_close_16.gif" border="0" /> Delete Address</a>
	</td>
</tr>
</tfoot>
</table>

!{/html_table_adv}

!{/if}

<br />

	</td>
</tr>

<tr>
<td><div class="adminheader">Email Address(es)</div><br />
<a href="edit_email.php?contact_id=!{$smarty.get.contact_id}" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/mail_add_16.gif" border="0" /> Add New Email</a><br /><br />
!{if $info.emails}
!{html_table_adv loop=$info.emails cols=1 table_attr="border=0 cellpadding=3 cellspacing=0"}
!{assign_adv var='email_type' value="[[email_type]]"}
<div style="border: 1px #000 solid; padding: 6px; margin: 4px;">
<b>[[email_type]]</b><br />
Send an email to: <a href="mailto:[[email]]">[[email]]</a><br /><br />
<a href="edit_email.php?email_id=[[id]]&contact_id=!{$smarty.get.contact_id}" class="link"><img src="/images/icons/mail_edit_16.gif" border="0" /> Edit Email</a>
&nbsp;|&nbsp;
<a href="delete_email.php?email_id=[[id]]&contact_id=!{$smarty.get.contact_id}" onClick="return confirm('Are you sure you would like to delete this email address?');" class="link"><img src="/images/icons/mail_close_16.gif" border="0" /> Delete Email</a></div>
!{/html_table_adv}
!{/if}
<br />

</td>
</tr>

<tr>
<td><div class="adminheader">Phone Number(s)</div><br />
<a href="edit_phone.php?contact_id=!{$smarty.get.contact_id}" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/phone_add_16.gif" border="0" /> Add New Phone Number</a><br /><br />
!{if $info.phone}
!{html_table_adv loop=$info.phone cols=1 table_attr="border=0 cellpadding=3 cellspacing=3"}
<div style="border: 1px #000 solid; padding: 6px; margin: 4px;"><b>[[phone_type]]</b><br />
[[phone]]<br /><br />
<img src="/images/icons/phone_edit_16.gif" border="0" /><a href="edit_phone.php?phone_id=[[id]]&contact_id=!{$smarty.get.contact_id}" class="link">Edit Phone</a>
&nbsp;|&nbsp;
<img src="/images/icons/phone_close_16.gif" border="0" /><a href="delete_phone.php?phone_id=[[id]]&contact_id=!{$smarty.get.contact_id}" class="link" onClick="return confirm('Are you sure you would like to delete this phone number?');">Delete Phone</a></div>
!{/html_table_adv}
!{/if}
</td>
</tr>
<tr>
<td>
<div class="adminheader">Notes</div><br />
!{if $info.notes}

<div id="pagination_nav">
Notes !{$paginate.first} - !{$paginate.last} out of !{$paginate.total} displayed.<br/>
!{paginate_prev} !{paginate_middle} !{paginate_next}
</div>

<table border="0" cellpadding="3" cellspacing="0" width="100%" id="note">
!{section name="n" loop=$info.notes}
	<tr>
		<td class="header">!{$info.notes[n]->created}</td>
	</tr>
	<tr>
		<td class="note">!{$info.notes[n]->note}</td>
	</tr>
!{/section}
</table>


!{/if}

<br />
<a href="add_note.php?contact_id=!{$smarty.get.contact_id}" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/notes_add_16.gif" border="0" /> Add a note</a><br /><br />
</td>
</tr>
!{if $info.forms}
<tr>
<td>
<div style="background-color:#272E4F;padding:1 2 1 2;font-size:12px;font-weight:bold;color:#FFFFFF;">
Form Posts
</div>
</td>
</tr>
!{section name="f" loop=$info.forms}
<tr bgcolor="!{cycle values="#FFFFDF,#FFFFFF"}">
<td> <div style="float:right;"><a href="javascript:;" onClick="toggleForms('form_!{$smarty.section.f.index}',this)">show</a> - <a href="delete_form_post.php?form_id=!{$info.forms[f].id}" onClick="return confirm('Are you sure you would like to delete this form?');">delete</a></div> Form Submitted: !{$info.forms[f].created|date_format} !{$info.forms[f].created|date_format:"%I:%M %p"}</td>
</tr>
<tr>
<td id="form_!{$smarty.section.f.index}" style="display:none;background-color:#FFCFCF;">
	!{foreach from=$info.forms[f].form_data item=value key=label}
		<b>!{$label|stripslashes}:</b> !{$value|stripslashes}<br/>
	!{/foreach}
</td>
</tr>
!{/section}

!{/if}
</tbody>
</table>

!{if $bulkmail_categories}
<br/>
<form name="category_connection" method="POST" action="edit_contact.php?contact_id=!{$smarty.get.contact_id}">
<table border="0" cellpadding="3" cellspacing="0" id="form" width="500">
<thead>
<tr>
<td colspan="2">Bulk Mail Category</td>
</tr>
</thead>
<tbody>
!{section name="item" loop=$bulkmail_categories}
	<tr bgcolor="!{cycle values="#FFFFFF,#FFFFDF"}">
		<td width="20"><input !{if in_array($bulkmail_categories[item]->id,$cconn)}checked!{/if} type="checkbox" name="catergories[]" id="!{$bulkmail_categories[item]->id}" value="!{$bulkmail_categories[item]->id}"></td>
		<td><label for="!{$bulkmail_categories[item]->id}">!{$bulkmail_categories[item]->category}</label></td>
	</tr>
!{/section}
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right"><input type="submit" name="submit" value="Update"></td>
</tr>
</tfoot>
</table>
<input type="hidden" name="contact_id" value="!{$smarty.get.contact_id}">
</form>
!{/if}