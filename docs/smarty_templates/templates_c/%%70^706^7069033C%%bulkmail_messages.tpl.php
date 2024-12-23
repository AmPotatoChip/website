<?php /* Smarty version 2.6.11, created on 2010-12-01 15:38:16
         compiled from admin/bulkmail_messages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/bulkmail_messages.tpl', 20, false),array('modifier', 'stripslashes', 'admin/bulkmail_messages.tpl', 21, false),array('modifier', 'date_format', 'admin/bulkmail_messages.tpl', 23, false),)), $this); ?>
<br />
<p>
<a href="create_bulkmail_message.php" class="link"style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/doc_add_16.gif" border="0" /> Create a new mail message</a>
</p>
<table border="0" cellspacing="0" cellpadding="3" id="form" width="100%">
<thead>
<tr>
<td>Subject</td>

<td width="140">Author</td>
<td width="100">Created</td>
<td width="30" align="center">Preview</td>
<td width="30" align="center">Edit</td>
<td width="30" align="center">Delete</td>
</tr>
</thead>
<tbody>
<?php if ($this->_tpl_vars['bulkmessages']):  unset($this->_sections['bm']);
$this->_sections['bm']['name'] = 'bm';
$this->_sections['bm']['loop'] = is_array($_loop=($this->_tpl_vars['bulkmessages'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['bm']['show'] = true;
$this->_sections['bm']['max'] = $this->_sections['bm']['loop'];
$this->_sections['bm']['step'] = 1;
$this->_sections['bm']['start'] = $this->_sections['bm']['step'] > 0 ? 0 : $this->_sections['bm']['loop']-1;
if ($this->_sections['bm']['show']) {
    $this->_sections['bm']['total'] = $this->_sections['bm']['loop'];
    if ($this->_sections['bm']['total'] == 0)
        $this->_sections['bm']['show'] = false;
} else
    $this->_sections['bm']['total'] = 0;
if ($this->_sections['bm']['show']):

            for ($this->_sections['bm']['index'] = $this->_sections['bm']['start'], $this->_sections['bm']['iteration'] = 1;
                 $this->_sections['bm']['iteration'] <= $this->_sections['bm']['total'];
                 $this->_sections['bm']['index'] += $this->_sections['bm']['step'], $this->_sections['bm']['iteration']++):
$this->_sections['bm']['rownum'] = $this->_sections['bm']['iteration'];
$this->_sections['bm']['index_prev'] = $this->_sections['bm']['index'] - $this->_sections['bm']['step'];
$this->_sections['bm']['index_next'] = $this->_sections['bm']['index'] + $this->_sections['bm']['step'];
$this->_sections['bm']['first']      = ($this->_sections['bm']['iteration'] == 1);
$this->_sections['bm']['last']       = ($this->_sections['bm']['iteration'] == $this->_sections['bm']['total']);
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFCDF,#FFFFFF"), $this);?>
">
<td><?php echo ((is_array($_tmp=$this->_tpl_vars['bulkmessages'][$this->_sections['bm']['index']]->subject)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
<td width="140"><?php echo ((is_array($_tmp=$this->_tpl_vars['bulkmessages'][$this->_sections['bm']['index']]->author)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
<td width="100"><?php echo ((is_array($_tmp=$this->_tpl_vars['bulkmessages'][$this->_sections['bm']['index']]->created)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
<td align="center"><a href="preview_message.php?message_id=<?php echo $this->_tpl_vars['bulkmessages'][$this->_sections['bm']['index']]->id; ?>
" class="link"><img src="/images/icons/doc_prev_16.gif" border="0" /></a></td>
<td align="center"><a href="create_bulkmail_message.php?message_id=<?php echo $this->_tpl_vars['bulkmessages'][$this->_sections['bm']['index']]->id; ?>
" class="link"><img src="/images/icons/doc_edit_16.gif" border="0" /></a></td>
<td align="center"><a href="delete_bulkmail_message.php?message_id=<?php echo $this->_tpl_vars['bulkmessages'][$this->_sections['bm']['index']]->id; ?>
" class="link" onClick="return confirm('Are you sure you would like to delete this message?');"><img src="/images/icons/doc_close_16.gif" border="0" /></a></td>
</tr>
<?php endfor; endif;  else: ?>
<tr>
	<td colspan="5" id="red" align="center">You currently do not have any bulk mail messages</td>
</tr>
<?php endif; ?>
</tbody>
</table>