<?php /* Smarty version 2.6.11, created on 2011-09-20 21:33:27
         compiled from admin/bulkmail.tpl */ ?>
<h2>Bulk Mail</h2>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table border="0" cellpadding="3" cellspacing="0" id="tabulated" width="760">
<thead>
<tr>
<td <?php if ($_GET['type'] == 'bmc'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?> width="160" onClick="document.location.href='bulkmail.php?type=bmc'"><img src="/images/icons/folder_16.gif" border="0" /> Bulk Mail Categories</td>
<td <?php if ($_GET['type'] == 'bmm'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?> width="150" onClick="document.location.href='bulkmail.php?type=bmm'"><img src="/images/icons/doc_16.gif" border="0" /> Bulkmail Messages</td>
<td <?php if ($_GET['type'] == 'mtg'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?> width="150" onClick="document.location.href='bulkmail.php?type=mtg'"><img src="/images/icons/clients_16.gif" border="0" /> E-mail Test Groups</td> 
<td <?php if ($_GET['type'] == 'mail'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?> width="130" onClick="document.location.href='bulkmail.php?type=mail'"><img src="/images/icons/mail_16.gif" border="0" /> Send a Bulk Mail</td> 
<td <?php if ($_GET['type'] == 'batch'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?> width="130" onClick="document.location.href='bulkmail.php?type=batch'"><img src="/images/icons/folder_config_16.gif" border="0" /> Mail Batch</td> 
<td class="tab_off">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td colspan="6" style="border-left:1px solid #000000;border-right:1px solid #000000;border-bottom:1px solid #000000;">
<?php if ($_GET['type'] == 'bmc'):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/bulkmail_categories.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if ($_GET['type'] == 'bmm'):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/bulkmail_messages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
<br />
<p>
<?php if ($_GET['type'] == 'mail'): ?>
<a href="bulkmail.php?type=mail&do=test" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/mail_ok_16.gif" border="0" />Send a test mail</a>
<a href="bulkmail.php?type=mail&do=live" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/mail_next_16.gif" border="0" />Send a live mail</a>
</p>
<p>
<?php if ($_GET['do'] == 'test'):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/mail_bulkmail.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if ($_GET['do'] == 'live'):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/live_bulkmail_sendout.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>
</p>
<?php endif; ?>

<?php if ($_GET['type'] == 'mtg'):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/mail_test_groups.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if ($_GET['type'] == 'batch'):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/mail_batch.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if (! $_GET['type']): ?>
<div>
<ul style="font-size: 12px;">
<li>Bulk Mail Categories - <i>The Categories of Mailing(s) to which the Customer May Subscribe</i></li>
<li>Bulk Mail Messagse - <i>Create the Content of the Message to be Sen</i>t</li>
<li>Email Test Groups - <i>Create a Test Group that Can Check your Mail before it is Sent</i></li>
<li>Send a Bulk Mail - <i>Send a Test Mail OR Send Your Completed Message</i></li>
<li>Mail Batch - <i>A report of Mail Sent and Being Processed</i></li>
</ul>
</div>
<?php endif; ?>
</td>
</tr>
</tbody>
</table>