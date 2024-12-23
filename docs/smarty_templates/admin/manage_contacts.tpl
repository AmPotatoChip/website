!{validate form="search" field="query" criteria="notEmpty" message="Search field can not be empty" assign="error_query"}
!{validate form="search" field="by" criteria="notEmpty" message="Search By can not be empty" assign="error_by"}

<h2>Manage Contacts</h2>
!{include file="admin/_error.tpl"}
!{if $error_query}<li style="font-size:12px;color:#CC0000;">!{$error_query}</li>!{/if}
!{if $error_by}<li style="font-size:12px;color:#CC0000;">!{$error_by}</li>!{/if}

<form name="search" method="POST" action="manage_contacts.php">
<input type="text" name="query" value="!{$query|stripslashes}" size="40">
<select name="by">
	<option value=''>Please select</option>
	<option value=''></option>
	
	<option value="fname" !{if $by eq 'fname'}selected!{/if}>First Name</option>
	<option value="lname" !{if $by eq 'lname'}selected!{/if}>Last Name</option>
	<option value="company" !{if $by eq 'company'}selected!{/if}>Company Name</option>
	<option value="address" !{if $by eq 'address'}selected!{/if}>Address</option>
	<option value="city" !{if $by eq 'city'}selected!{/if}>City</option>
	<option value="state" !{if $by eq 'state'}selected!{/if}>State</option>
	<option value="zip" !{if $by eq 'zip'}selected!{/if}>Postal Code</option>
	<option value="email" !{if $by eq 'email'}selected!{/if}>email</option>
	<option value="phone" !{if $by eq 'phone'}selected!{/if}>phone</option>
	
</select>
<input type="submit" name="submit" value="Search">
<input type="hidden" name="form_name" value="search">
</form>

!{assign_adv var='keys' value="range(a,z)"}

<div id="keys">
!{section name="x" loop=$keys}
<a href="manage_contacts.php?query=!{$keys[x]|@ucwords}" !{if $smarty.get.query eq $keys[x]|@ucwords}style="background-color:#FFFFFF;border:1px solid #000000;color:#000000;"!{/if}>!{$keys[x]|@ucwords}</a>
!{/section}
|
<a href="manage_contacts.php?query=ALL" !{if $smarty.get.query eq 'ALL'}style="background-color:#FFFFFF;border:1px solid #000000;color:#000000;"!{/if}>ALL</a>
</div>

!{if $search_result}
!{include file="admin/contact_search_result.tpl"}
!{/if}
<p><a class="link" href="add_contact.php" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/contact_add_16.gif" border="0" />  Add a new contact</a></p>
