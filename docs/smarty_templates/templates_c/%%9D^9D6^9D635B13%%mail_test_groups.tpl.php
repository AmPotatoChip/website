<?php /* Smarty version 2.6.11, created on 2009-10-15 11:13:27
         compiled from admin/mail_test_groups.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/mail_test_groups.tpl', 1, false),array('function', 'cycle', 'admin/mail_test_groups.tpl', 19, false),array('modifier', 'stripslashes', 'admin/mail_test_groups.tpl', 20, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'test_group','field' => 'group_name','criteria' => 'notEmpty','assign' => 'error_group_name','message' => 'Group Name is required and can not be empty'), $this);?>

<?php echo smarty_function_validate(array('form' => 'test_group','field' => 'emails','criteria' => 'notEmpty','assign' => 'error_emails','message' => 'You have to have at least one email in the test group'), $this);?>

<br />
<p>
<a href="javascript:;" class="link" onclick="hideunhide('test_group_form');" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/clients_add_16.gif" border="0" />Create a new test group</a></p>
<p>
<table border="0" cellpadding="3" cellspacing="0" id="form" width="100%">
<thead>
<tr>
<td>Name of Group</td>
<td width="120" align="right">Number of emails</td>
<td width="50" align="center">Emails</td>
<td width="50" align="center">Edit</td>
<td width="50" align="center">Delete</td>
</tr>
</thead>
<tbody>
<?php unset($this->_sections['group']);
$this->_sections['group']['name'] = 'group';
$this->_sections['group']['loop'] = is_array($_loop=($this->_tpl_vars['testgroups'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['group']['show'] = true;
$this->_sections['group']['max'] = $this->_sections['group']['loop'];
$this->_sections['group']['step'] = 1;
$this->_sections['group']['start'] = $this->_sections['group']['step'] > 0 ? 0 : $this->_sections['group']['loop']-1;
if ($this->_sections['group']['show']) {
    $this->_sections['group']['total'] = $this->_sections['group']['loop'];
    if ($this->_sections['group']['total'] == 0)
        $this->_sections['group']['show'] = false;
} else
    $this->_sections['group']['total'] = 0;
if ($this->_sections['group']['show']):

            for ($this->_sections['group']['index'] = $this->_sections['group']['start'], $this->_sections['group']['iteration'] = 1;
                 $this->_sections['group']['iteration'] <= $this->_sections['group']['total'];
                 $this->_sections['group']['index'] += $this->_sections['group']['step'], $this->_sections['group']['iteration']++):
$this->_sections['group']['rownum'] = $this->_sections['group']['iteration'];
$this->_sections['group']['index_prev'] = $this->_sections['group']['index'] - $this->_sections['group']['step'];
$this->_sections['group']['index_next'] = $this->_sections['group']['index'] + $this->_sections['group']['step'];
$this->_sections['group']['first']      = ($this->_sections['group']['iteration'] == 1);
$this->_sections['group']['last']       = ($this->_sections['group']['iteration'] == $this->_sections['group']['total']);
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFCDF,#FFFFFF"), $this);?>
">
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['testgroups'][$this->_sections['group']['index']]->name)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
<td width="120" align="right"><?php echo $this->_tpl_vars['testgroups'][$this->_sections['group']['index']]->email_count; ?>
</td>
<td width="50" align="center"><a href="javascript:;" class="link" onClick="alert('<?php echo $this->_tpl_vars['testgroups'][$this->_sections['group']['index']]->emails; ?>
');">show</a></td>
<td width="50" align="center"><a href="bulkmail.php?type=mtg&group_id=<?php echo $this->_tpl_vars['testgroups'][$this->_sections['group']['index']]->id; ?>
" class="link"><img src="/images/icons/clients_edit_16.gif" border="0"></a></td>
<td width="50" align="center"><a href="delete_testgroup.php?group_id=<?php echo $this->_tpl_vars['testgroups'][$this->_sections['group']['index']]->id; ?>
" class="link" onClick="return confirm('Are you sure you would like to delete this test group?');"><img src="/images/icons/clients_close_16.gif" border="0"></a></td>
</tr>
<?php endfor; endif; ?>


</tbody>
</table>
</p>

<div id="test_group_form" style="display:none">
<form name="test_group" method="POST" action="bulkmail.php?type=mtg">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<?php if ($this->_tpl_vars['error_group_name']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_group_name']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
<td id="right">Group Name:</td>
<td><input type="text" name="group_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['group_name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40"></td>
</tr>
<?php if ($this->_tpl_vars['error_emails']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_emails']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
<td id="right" valign="top">Emails:</td>
<td><textarea cols="60" rows="4" name="emails"><?php echo ((is_array($_tmp=$this->_tpl_vars['emails'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
</tr>
<tfoot>
<tr>
<td colspan="2" align="right">
<?php if ($this->_tpl_vars['group_id']): ?>
<input type="submit" value="Update test group">
<?php else: ?>
<input type="submit" value="Add new test group">
<?php endif; ?>
</td>
</tr>
</tfoot>
</table>
<input type="hidden" name="group_id" value="<?php echo $this->_tpl_vars['group_id']; ?>
">
<input type="hidden" name="form_name" value="test_group">
</form>
</p>

<?php if ($this->_tpl_vars['show_form']): ?>
<script language="javascript">
onload = hideunhide('test_group_form');
</script>
<?php endif; ?>