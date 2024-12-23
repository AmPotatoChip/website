<?php /* Smarty version 2.6.11, created on 2010-06-22 10:26:08
         compiled from admin/edit_contact.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'stripslashes', 'admin/edit_contact.tpl', 30, false),array('modifier', 'date_format', 'admin/edit_contact.tpl', 149, false),array('block', 'html_table_adv', 'admin/edit_contact.tpl', 46, false),array('function', 'assign_adv', 'admin/edit_contact.tpl', 47, false),array('function', 'paginate_prev', 'admin/edit_contact.tpl', 118, false),array('function', 'paginate_middle', 'admin/edit_contact.tpl', 118, false),array('function', 'paginate_next', 'admin/edit_contact.tpl', 118, false),array('function', 'cycle', 'admin/edit_contact.tpl', 148, false),)), $this); ?>
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

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="3" cellspacing="0" id="display" width="740">
<thead>
<tr>
	<td colspan="2">&nbsp;</td>
</tr>
</thead>
<tbody>
<tr>
<td><div class="adminheader">Contact Business and Name</div>
<?php if ($this->_tpl_vars['info']['main']->company_name): ?><h3><?php echo $this->_tpl_vars['info']['main']->company_name; ?>
</h3><?php endif; ?>
<h3><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['main']->fname)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 <?php if ($this->_tpl_vars['info']['main']->mname):  echo $this->_tpl_vars['info']['main']->mname; ?>
 <?php endif;  echo ((is_array($_tmp=$this->_tpl_vars['info']['main']->lname)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</h3>
Newsletter: 
<?php if ($this->_tpl_vars['info']['main']->newsletter == 'Y'): ?>Yes<?php endif;  if ($this->_tpl_vars['info']['main']->newsletter == 'N'): ?>No<?php endif; ?>
<br /><br />
<a href="edit_address_main.php?contact_id=<?php echo $_GET['contact_id']; ?>
" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/clients_edit_16.gif" border="0" />  Edit Business and/or Name Above</a>
<br /><br />

</td>
</tr>
<tr>
	<td><div class="adminheader">Mailing Address(es)</div><br />
	<a href="edit_address.php?contact_id=<?php echo $_GET['contact_id']; ?>
" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/home_16.gif" border="0" /> Add New Address</a><br /><br />
	
<?php if ($this->_tpl_vars['info']['address']): ?>

<?php $this->_tag_stack[] = array('html_table_adv', array('loop' => $this->_tpl_vars['info']['address'],'table_attr' => "border=0 cellpadding=3 cellspacing=0",'cols' => 3)); smarty_block_html_table_adv($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start();  echo smarty_function_assign_adv(array('var' => 'address_info','value' => "[[address_info]]"), $this);?>

<table border="0" cellpadding="3" cellspacing="0" id="address">
<thead>
<tr>
	<td><?php echo ((is_array($_tmp=$this->_tpl_vars['address_info'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
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
	<td><a href="edit_address.php?address_id=[[id]]&contact_id=<?php echo $_GET['contact_id']; ?>
" class="link"><img src="/images/icons/home_edit_16.gif" border="0" /> Edit Address</a> | <a href="delete_address.php?address_id=[[id]]&contact_id=<?php echo $_GET['contact_id']; ?>
" class="link" onClick="return confirm('Are you sure you would like to delete this address?');"><img src="/images/icons/home_close_16.gif" border="0" /> Delete Address</a>
	</td>
</tr>
</tfoot>
</table>

<?php $_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_html_table_adv($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack); ?>

<?php endif; ?>

<br />

	</td>
</tr>

<tr>
<td><div class="adminheader">Email Address(es)</div><br />
<a href="edit_email.php?contact_id=<?php echo $_GET['contact_id']; ?>
" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/mail_add_16.gif" border="0" /> Add New Email</a><br /><br />
<?php if ($this->_tpl_vars['info']['emails']):  $this->_tag_stack[] = array('html_table_adv', array('loop' => $this->_tpl_vars['info']['emails'],'cols' => 1,'table_attr' => "border=0 cellpadding=3 cellspacing=0")); smarty_block_html_table_adv($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start();  echo smarty_function_assign_adv(array('var' => 'email_type','value' => "[[email_type]]"), $this);?>

<div style="border: 1px #000 solid; padding: 6px; margin: 4px;">
<b>[[email_type]]</b><br />
Send an email to: <a href="mailto:[[email]]">[[email]]</a><br /><br />
<a href="edit_email.php?email_id=[[id]]&contact_id=<?php echo $_GET['contact_id']; ?>
" class="link"><img src="/images/icons/mail_edit_16.gif" border="0" /> Edit Email</a>
&nbsp;|&nbsp;
<a href="delete_email.php?email_id=[[id]]&contact_id=<?php echo $_GET['contact_id']; ?>
" onClick="return confirm('Are you sure you would like to delete this email address?');" class="link"><img src="/images/icons/mail_close_16.gif" border="0" /> Delete Email</a></div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_html_table_adv($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  endif; ?>
<br />

</td>
</tr>

<tr>
<td><div class="adminheader">Phone Number(s)</div><br />
<a href="edit_phone.php?contact_id=<?php echo $_GET['contact_id']; ?>
" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/phone_add_16.gif" border="0" /> Add New Phone Number</a><br /><br />
<?php if ($this->_tpl_vars['info']['phone']):  $this->_tag_stack[] = array('html_table_adv', array('loop' => $this->_tpl_vars['info']['phone'],'cols' => 1,'table_attr' => "border=0 cellpadding=3 cellspacing=3")); smarty_block_html_table_adv($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat=true);while ($_block_repeat) { ob_start(); ?>
<div style="border: 1px #000 solid; padding: 6px; margin: 4px;"><b>[[phone_type]]</b><br />
[[phone]]<br /><br />
<img src="/images/icons/phone_edit_16.gif" border="0" /><a href="edit_phone.php?phone_id=[[id]]&contact_id=<?php echo $_GET['contact_id']; ?>
" class="link">Edit Phone</a>
&nbsp;|&nbsp;
<img src="/images/icons/phone_close_16.gif" border="0" /><a href="delete_phone.php?phone_id=[[id]]&contact_id=<?php echo $_GET['contact_id']; ?>
" class="link" onClick="return confirm('Are you sure you would like to delete this phone number?');">Delete Phone</a></div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); echo smarty_block_html_table_adv($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat=false); }  array_pop($this->_tag_stack);  endif; ?>
</td>
</tr>
<tr>
<td>
<div class="adminheader">Notes</div><br />
<?php if ($this->_tpl_vars['info']['notes']): ?>

<div id="pagination_nav">
Notes <?php echo $this->_tpl_vars['paginate']['first']; ?>
 - <?php echo $this->_tpl_vars['paginate']['last']; ?>
 out of <?php echo $this->_tpl_vars['paginate']['total']; ?>
 displayed.<br/>
<?php echo smarty_function_paginate_prev(array(), $this);?>
 <?php echo smarty_function_paginate_middle(array(), $this);?>
 <?php echo smarty_function_paginate_next(array(), $this);?>

</div>

<table border="0" cellpadding="3" cellspacing="0" width="100%" id="note">
<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['info']['notes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
	<tr>
		<td class="header"><?php echo $this->_tpl_vars['info']['notes'][$this->_sections['n']['index']]->created; ?>
</td>
	</tr>
	<tr>
		<td class="note"><?php echo $this->_tpl_vars['info']['notes'][$this->_sections['n']['index']]->note; ?>
</td>
	</tr>
<?php endfor; endif; ?>
</table>


<?php endif; ?>

<br />
<a href="add_note.php?contact_id=<?php echo $_GET['contact_id']; ?>
" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/notes_add_16.gif" border="0" /> Add a note</a><br /><br />
</td>
</tr>
<?php if ($this->_tpl_vars['info']['forms']): ?>
<tr>
<td>
<div style="background-color:#272E4F;padding:1 2 1 2;font-size:12px;font-weight:bold;color:#FFFFFF;">
Form Posts
</div>
</td>
</tr>
<?php unset($this->_sections['f']);
$this->_sections['f']['name'] = 'f';
$this->_sections['f']['loop'] = is_array($_loop=$this->_tpl_vars['info']['forms']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['f']['show'] = true;
$this->_sections['f']['max'] = $this->_sections['f']['loop'];
$this->_sections['f']['step'] = 1;
$this->_sections['f']['start'] = $this->_sections['f']['step'] > 0 ? 0 : $this->_sections['f']['loop']-1;
if ($this->_sections['f']['show']) {
    $this->_sections['f']['total'] = $this->_sections['f']['loop'];
    if ($this->_sections['f']['total'] == 0)
        $this->_sections['f']['show'] = false;
} else
    $this->_sections['f']['total'] = 0;
if ($this->_sections['f']['show']):

            for ($this->_sections['f']['index'] = $this->_sections['f']['start'], $this->_sections['f']['iteration'] = 1;
                 $this->_sections['f']['iteration'] <= $this->_sections['f']['total'];
                 $this->_sections['f']['index'] += $this->_sections['f']['step'], $this->_sections['f']['iteration']++):
$this->_sections['f']['rownum'] = $this->_sections['f']['iteration'];
$this->_sections['f']['index_prev'] = $this->_sections['f']['index'] - $this->_sections['f']['step'];
$this->_sections['f']['index_next'] = $this->_sections['f']['index'] + $this->_sections['f']['step'];
$this->_sections['f']['first']      = ($this->_sections['f']['iteration'] == 1);
$this->_sections['f']['last']       = ($this->_sections['f']['iteration'] == $this->_sections['f']['total']);
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFDF,#FFFFFF"), $this);?>
">
<td> <div style="float:right;"><a href="javascript:;" onClick="toggleForms('form_<?php echo $this->_sections['f']['index']; ?>
',this)">show</a> - <a href="delete_form_post.php?form_id=<?php echo $this->_tpl_vars['info']['forms'][$this->_sections['f']['index']]['id']; ?>
" onClick="return confirm('Are you sure you would like to delete this form?');">delete</a></div> Form Submitted: <?php echo ((is_array($_tmp=$this->_tpl_vars['info']['forms'][$this->_sections['f']['index']]['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['info']['forms'][$this->_sections['f']['index']]['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
</td>
</tr>
<tr>
<td id="form_<?php echo $this->_sections['f']['index']; ?>
" style="display:none;background-color:#FFCFCF;">
	<?php $_from = $this->_tpl_vars['info']['forms'][$this->_sections['f']['index']]['form_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['value']):
?>
		<b><?php echo ((is_array($_tmp=$this->_tpl_vars['label'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
:</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
<br/>
	<?php endforeach; endif; unset($_from); ?>
</td>
</tr>
<?php endfor; endif; ?>

<?php endif; ?>
</tbody>
</table>

<?php if ($this->_tpl_vars['bulkmail_categories']): ?>
<br/>
<form name="category_connection" method="POST" action="edit_contact.php?contact_id=<?php echo $_GET['contact_id']; ?>
">
<table border="0" cellpadding="3" cellspacing="0" id="form" width="500">
<thead>
<tr>
<td colspan="2">Bulk Mail Category</td>
</tr>
</thead>
<tbody>
<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=$this->_tpl_vars['bulkmail_categories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['item']['show'] = true;
$this->_sections['item']['max'] = $this->_sections['item']['loop'];
$this->_sections['item']['step'] = 1;
$this->_sections['item']['start'] = $this->_sections['item']['step'] > 0 ? 0 : $this->_sections['item']['loop']-1;
if ($this->_sections['item']['show']) {
    $this->_sections['item']['total'] = $this->_sections['item']['loop'];
    if ($this->_sections['item']['total'] == 0)
        $this->_sections['item']['show'] = false;
} else
    $this->_sections['item']['total'] = 0;
if ($this->_sections['item']['show']):

            for ($this->_sections['item']['index'] = $this->_sections['item']['start'], $this->_sections['item']['iteration'] = 1;
                 $this->_sections['item']['iteration'] <= $this->_sections['item']['total'];
                 $this->_sections['item']['index'] += $this->_sections['item']['step'], $this->_sections['item']['iteration']++):
$this->_sections['item']['rownum'] = $this->_sections['item']['iteration'];
$this->_sections['item']['index_prev'] = $this->_sections['item']['index'] - $this->_sections['item']['step'];
$this->_sections['item']['index_next'] = $this->_sections['item']['index'] + $this->_sections['item']['step'];
$this->_sections['item']['first']      = ($this->_sections['item']['iteration'] == 1);
$this->_sections['item']['last']       = ($this->_sections['item']['iteration'] == $this->_sections['item']['total']);
?>
	<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#FFFFDF"), $this);?>
">
		<td width="20"><input <?php if (in_array ( $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->id , $this->_tpl_vars['cconn'] )): ?>checked<?php endif; ?> type="checkbox" name="catergories[]" id="<?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->id; ?>
" value="<?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->id; ?>
"></td>
		<td><label for="<?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->id; ?>
"><?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->category; ?>
</label></td>
	</tr>
<?php endfor; endif; ?>
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right"><input type="submit" name="submit" value="Update"></td>
</tr>
</tfoot>
</table>
<input type="hidden" name="contact_id" value="<?php echo $_GET['contact_id']; ?>
">
</form>
<?php endif; ?>