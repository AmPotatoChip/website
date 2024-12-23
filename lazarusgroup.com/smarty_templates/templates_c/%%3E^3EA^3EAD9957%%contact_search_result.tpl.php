<?php /* Smarty version 2.6.11, created on 2010-06-22 10:26:06
         compiled from admin/contact_search_result.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'admin/contact_search_result.tpl', 4, false),array('modifier', 'stripslashes', 'admin/contact_search_result.tpl', 18, false),array('function', 'cycle', 'admin/contact_search_result.tpl', 17, false),)), $this); ?>
<table border="0" cellpadding="3" cellspacing="0" id="display" width="740">
<thead>
	<tr>
		<td colspan="5">Results: <?php echo count($this->_tpl_vars['search_result']); ?>
</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>Email</td>
		<td>Phone</td>
		<td align="center" width="50">Edit</td>
		<td align="center" width="50">Delete</td>
	</tr>
</thead>

<tbody style="overflow-y:auto;overflow-x:hidden;height:400px;">
<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=($this->_tpl_vars['search_result'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFCDF,#FFFFFF"), $this);?>
">
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['search_result'][$this->_sections['item']['index']]->fname)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['search_result'][$this->_sections['item']['index']]->lname)) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
		<td><a href="mailto:<?php echo $this->_tpl_vars['search_result'][$this->_sections['item']['index']]->email; ?>
"><?php echo $this->_tpl_vars['search_result'][$this->_sections['item']['index']]->email; ?>
</a></td>
		<td><?php echo $this->_tpl_vars['search_result'][$this->_sections['item']['index']]->phone; ?>
</td>
		<td align="center"><a href="edit_contact.php?contact_id=<?php echo $this->_tpl_vars['search_result'][$this->_sections['item']['index']]->id; ?>
"><img src="/images/icons/contact_edit_16.gif" border="0" /></a></td>
		<td align="center"><a href="delete_contact.php?contact_id=<?php echo $this->_tpl_vars['search_result'][$this->_sections['item']['index']]->id; ?>
" onClick="return confirm('Are you sure you would like to delete this contact?');"><img src="/images/icons/contact_close_16.gif" border="0" /></a></td>
	</tr>
<?php endfor; endif; ?>	
</tbody>

</table>