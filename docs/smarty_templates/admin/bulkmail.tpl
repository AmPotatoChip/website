<h2>Bulk Mail</h2>
!{include file="admin/_error.tpl"}

<table border="0" cellpadding="3" cellspacing="0" id="tabulated" width="760">
<thead>
<tr>
<td !{if $smarty.get.type eq 'bmc'}class="tab_on"!{else}class="tab_off"!{/if} width="160" onClick="document.location.href='bulkmail.php?type=bmc'"><img src="/images/icons/folder_16.gif" border="0" /> Bulk Mail Categories</td>
<td !{if $smarty.get.type eq 'bmm'}class="tab_on"!{else}class="tab_off"!{/if} width="150" onClick="document.location.href='bulkmail.php?type=bmm'"><img src="/images/icons/doc_16.gif" border="0" /> Bulkmail Messages</td>
<td !{if $smarty.get.type eq 'mtg'}class="tab_on"!{else}class="tab_off"!{/if} width="150" onClick="document.location.href='bulkmail.php?type=mtg'"><img src="/images/icons/clients_16.gif" border="0" /> E-mail Test Groups</td> 
<td !{if $smarty.get.type eq 'mail'}class="tab_on"!{else}class="tab_off"!{/if} width="130" onClick="document.location.href='bulkmail.php?type=mail'"><img src="/images/icons/mail_16.gif" border="0" /> Send a Bulk Mail</td> 
<td !{if $smarty.get.type eq 'batch'}class="tab_on"!{else}class="tab_off"!{/if} width="130" onClick="document.location.href='bulkmail.php?type=batch'"><img src="/images/icons/folder_config_16.gif" border="0" /> Mail Batch</td> 
<td class="tab_off">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td colspan="6" style="border-left:1px solid #000000;border-right:1px solid #000000;border-bottom:1px solid #000000;">
!{if $smarty.get.type eq 'bmc'}
!{include file="admin/bulkmail_categories.tpl"}
!{/if}

!{if $smarty.get.type eq 'bmm'}
!{include file="admin/bulkmail_messages.tpl"}
!{/if}
<br />
<p>
!{if $smarty.get.type eq 'mail'}
<a href="bulkmail.php?type=mail&do=test" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/mail_ok_16.gif" border="0" />Send a test mail</a>
<a href="bulkmail.php?type=mail&do=live" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/mail_next_16.gif" border="0" />Send a live mail</a>
</p>
<p>
!{if $smarty.get.do eq 'test'}
!{include file="admin/mail_bulkmail.tpl"}
!{/if}

!{if $smarty.get.do eq 'live'}
!{include file="admin/live_bulkmail_sendout.tpl"}
!{/if}
</p>
!{/if}

!{if $smarty.get.type eq 'mtg'}
!{include file="admin/mail_test_groups.tpl"}
!{/if}

!{if $smarty.get.type eq 'batch'}
!{include file="admin/mail_batch.tpl"}
!{/if}

!{if !$smarty.get.type}
<div>
<ul style="font-size: 12px;">
<li>Bulk Mail Categories - <i>The Categories of Mailing(s) to which the Customer May Subscribe</i></li>
<li>Bulk Mail Messagse - <i>Create the Content of the Message to be Sen</i>t</li>
<li>Email Test Groups - <i>Create a Test Group that Can Check your Mail before it is Sent</i></li>
<li>Send a Bulk Mail - <i>Send a Test Mail OR Send Your Completed Message</i></li>
<li>Mail Batch - <i>A report of Mail Sent and Being Processed</i></li>
</ul>
</div>
!{/if}
</td>
</tr>
</tbody>
</table>