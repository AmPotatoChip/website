<?php /* Smarty version 2.6.11, created on 2009-10-15 11:13:41
         compiled from admin/mail_bulkmail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/mail_bulkmail.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'test_message','field' => 'template','criteria' => 'notEmpty','assign' => 'error_test_message','message' => 'You have to select a template'), $this);?>

<?php echo smarty_function_validate(array('form' => 'test_message','field' => 'message_id','criteria' => 'notEmpty','assign' => 'error_message_id','message' => 'You have to select a message'), $this);?>

<?php echo smarty_function_validate(array('form' => 'test_message','field' => 'test_email_group','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_test_email_group','message' => 'You have to select a group to send email to'), $this);?>


<form name="test_message" method="POST" action="bulkmail.php?type=mail&do=test">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="2">Send Test Message</td>
</tr>
</thead>
<tbody>
<?php if ($this->_tpl_vars['error_test_message']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_test_message']; ?>
</td>
</tr>
<?php endif; ?>

<tr>
<td id="right">Select a template:</td>
<td>
<select name="template">
<option value="" />Please select
<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=($this->_tpl_vars['templates'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $this->_tpl_vars['templates'][$this->_sections['item']['index']]; ?>
" <?php if ($this->_tpl_vars['template'] == $this->_tpl_vars['templates'][$this->_sections['item']['index']]): ?>selected<?php endif; ?>/><?php echo $this->_tpl_vars['templates'][$this->_sections['item']['index']]; ?>

<?php endfor; endif; ?>
</select>
</td>
</tr>
<?php if ($this->_tpl_vars['error_message_id']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_message_id']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
<td id="right">Select a message:</td>
<td>
<select name="message_id">
<option value="" />Please select
<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['bulkmessages'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
<option value="<?php echo $this->_tpl_vars['bulkmessages'][$this->_sections['x']['index']]->id; ?>
" <?php if ($this->_tpl_vars['message_id'] == $this->_tpl_vars['bulkmessages'][$this->_sections['x']['index']]->id): ?>selected<?php endif; ?>/><?php echo $this->_tpl_vars['bulkmessages'][$this->_sections['x']['index']]->subject; ?>

<?php endfor; endif; ?>
</select>
</td>
</tr>
<?php if ($this->_tpl_vars['error_test_email_group']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_test_email_group']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
<td id="right" valign="top">Test E-mail group:</td>
<td>
<select name="test_email_group">
<option value="" />Please select a group
<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['testgroups'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
<option value="<?php echo $this->_tpl_vars['testgroups'][$this->_sections['x']['index']]->id; ?>
" <?php if ($this->_tpl_vars['test_email_group'] == $this->_tpl_vars['testgroups'][$this->_sections['x']['index']]->id): ?>selected<?php endif; ?>/><?php echo $this->_tpl_vars['testgroups'][$this->_sections['x']['index']]->name; ?>

<?php endfor; endif; ?>
</select>
</td>
</tr>
</tbody>
<tfoot>
<tr>
<td colspan="2" align="right"><input type="submit" name="submit" value="Send Test Message"></td>
</tr>
</tfoot>
</table>
<input type="hidden" name="form_name" value="test_message">
</form>