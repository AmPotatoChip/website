<?php /* Smarty version 2.6.11, created on 2010-12-01 15:37:37
         compiled from admin/create_bulkmail_message.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/create_bulkmail_message.tpl', 1, false),array('modifier', 'stripslashes', 'admin/create_bulkmail_message.tpl', 43, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'bulkmail_message','field' => 'from_name','criteria' => 'notEmpty','assign' => 'error_from_name','message' => 'From Name can not be empty','transform' => 'trim'), $this);?>


<?php echo smarty_function_validate(array('form' => 'bulkmail_message','field' => 'from_email','criteria' => 'isEmail','assign' => 'error_from_email','message' => 'From Email has to be a valid email address','transform' => 'trim'), $this);?>


<?php echo smarty_function_validate(array('form' => 'bulkmail_message','field' => 'subject','criteria' => 'notEmpty','assign' => 'error_subject','message' => 'Subject can not be empty'), $this);?>


<?php echo smarty_function_validate(array('form' => 'bulkmail_message','field' => 'message_text','criteria' => 'notEmpty','assign' => 'error_message_text','message' => 'The message can not be empty','transform' => 'trim'), $this);?>


<h2>Bulk Mail Message</h2>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<table border="0" cellpadding="3" cellspacing="0" id="tabulated" width="760">
<thead>
<tr>
<td class="tab_off" width="160" onClick="document.location.href='bulkmail.php?type=bmc'"><img src="/images/icons/folder_16.gif" border="0" /> Bulkmail Categories</td>
<td class="tab_on" width="150" onClick="document.location.href='bulkmail.php?type=bmm'"><img src="/images/icons/doc_16.gif" border="0" /> Bulkmail Messages</td>
<td class="tab_off" width="150" onClick="document.location.href='bulkmail.php?type=mtg'"><img src="/images/icons/clients_16.gif" border="0" />  E-mail Test Groups</td> 
<td class="tab_off" width="130" onClick="document.location.href='bulkmail.php?type=mail'"><img src="/images/icons/mail_16.gif" border="0" /> Send a Bulk Mail</td> 
<td class="tab_off" width="130" onClick="document.location.href='bulkmail.php?type=batch'"><img src="/images/icons/folder_config_16.gif" border="0" /> Mail Batch</td> 
<td class="tab_off">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td colspan="6" style="border-left:1px solid #000000;border-right:1px solid #000000;border-bottom:1px solid #000000;">

<form name="bulkmail_message" method="POST" action="create_bulkmail_message.php" enctype="multipart/form-data">
<table border="0" cellpadding="3" cellspacing="0" id="form" width="100%">
<tbody>

<?php if ($this->_tpl_vars['error_from_name']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_from_name']; ?>
</td>
</tr>
<?php endif; ?>


<tr>
<td id="right">From Name:</td>
<td><input type="text" name="from_name" size="40" maxlength="100" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['from_name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></td>
</tr>

<?php if ($this->_tpl_vars['error_from_email']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_from_email']; ?>
</td>
</tr>
<?php endif; ?>

<tr>
<td id="right">From Email:</td>
<td><input type="text" name="from_email" size="40" maxlength="255" value="<?php echo $this->_tpl_vars['from_email']; ?>
"></td>
</tr>
<tr>
<td id="right">To Name:</td>
<td><input type="text" name="to_name" size="40" maxlength="100" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['to_name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></td>
</tr>

<?php if ($this->_tpl_vars['error_subject']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_subject']; ?>
</td>
</tr>
<?php endif; ?>

<tr>
<td id="right">Subject:</td>
<td><input type="text" name="subject" size="70" maxlength="120" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['subject'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></td>
</tr>

<?php if ($this->_tpl_vars['error_message_text']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_message_text']; ?>
</td>
</tr>
<?php endif; ?>

<tr>
<td id="right" valign="top">Message:</td>
<td>
<textarea id="message_text" name="message_text"><?php echo ((is_array($_tmp=$this->_tpl_vars['message_text'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
</td>
</tr>

<?php if ($this->_tpl_vars['attachment1'] != ''): ?>
<tr>
	<td id="right">Attachment 1:</td>
	<td><a href="<?php echo @URL; ?>
bulkmail/attachment_archive/<?php echo $this->_tpl_vars['attachment1']; ?>
" target="_blank"><?php echo $this->_tpl_vars['attachment1_name']; ?>
</a>
	&nbsp;-&nbsp;<a href="remove_attachment.php?type=attachment1&message_id=<?php echo $this->_tpl_vars['message_id']; ?>
" class="link">Remove<a/>
	</td>
</tr>
<?php else: ?>
<tr>
<td id="right">Attachment 1:</td>
<td><input type="file" name="attachment1" size="80"></td>
</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['attachment2'] != ''): ?>
<tr>
<td id="right">Attachment 2:</td>
<td><a href="<?php echo @URL; ?>
bulkmail/attachment_archive/<?php echo $this->_tpl_vars['attachment2']; ?>
" target="_blank"><?php echo $this->_tpl_vars['attachment2_name']; ?>
</a>
&nbsp;-&nbsp;<a href="remove_attachment.php?type=attachment2&message_id=<?php echo $this->_tpl_vars['message_id']; ?>
" class="link">Remove<a/>
</td>
</tr>
<?php else: ?>
<tr>
<td id="right">Attachment 2:</td>
<td><input type="file" name="attachment2" size="80"></td>
</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['attachment3'] != ''): ?>
<tr>
<td id="right">Attachment 3:</td>
<td><a href="<?php echo @URL; ?>
bulkmail/attachment_archive/<?php echo $this->_tpl_vars['attachment3']; ?>
" target="_blank"><?php echo $this->_tpl_vars['attachment3_name']; ?>
</a>
&nbsp;-&nbsp;<a href="remove_attachment.php?type=attachment3&message_id=<?php echo $this->_tpl_vars['message_id']; ?>
" class="link">Remove<a/>
</td>
</tr>
<?php else: ?>
<tr>
<td id="right">Attachment 3:</td>
<td><input type="file" name="attachment3" size="80"></td>
</tr>
<?php endif; ?>


</tbody>
<tfoot>
<tr>
<td colspan="2" align="right">
<?php if ($this->_tpl_vars['update']): ?>
<input type="submit" name="submit" value="Update Message">
<?php else: ?>
<input type="submit" name="submit" value="Add Message">
<?php endif; ?>
</td>
</tr>
</tfoot>


</table>
<?php if ($this->_tpl_vars['update']): ?>
<input type="hidden" name="message_id" value="<?php echo $this->_tpl_vars['message_id']; ?>
">
<?php endif; ?>
</form>

</td>
</tr>
</tbody>
</table>




<script type="text/javascript">
        var oFCKeditor = new FCKeditor( 'message_text' ) ;
        oFCKeditor.BasePath = "fckeditor/" ;
        oFCKeditor.EditorAreaCSS = "/stylesheet.css";
        oFCKeditor.Width = '100%';
        oFCKeditor.Height = '500';
        oFCKeditor.ReplaceTextarea() ;
</script>