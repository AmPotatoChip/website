<?php /* Smarty version 2.6.11, created on 2018-02-13 13:29:47
         compiled from admin/website_content_pages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/website_content_pages.tpl', 12, false),)), $this); ?>
<table border="0" cellpadding="3" cellspacing="0" id="display" width="100%">
<thead>
	<tr>
	<td>Name</td>
	<td>Description</td>
	<td width="60" align="center">Edit</td>	
	<td width="60" align="center">Content</td>
	</tr>
</thead>
<tbody style="overflow-y:auto;overflow-x:hidden;height:400px;">
	<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=($this->_tpl_vars['cat'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#DFE5FF"), $this);?>
">
	<td><?php echo $this->_tpl_vars['cat'][$this->_sections['item']['index']]->name; ?>
</td>
	<td><?php echo $this->_tpl_vars['cat'][$this->_sections['item']['index']]->description; ?>
</td>
	<td align="center"><a href="?catid=<?php echo $this->_tpl_vars['cat'][$this->_sections['item']['index']]->id; ?>
&type=category"><img src="/images/icons/doc_config_16.gif" border="0"></a></td>
	<td align="center"><a href="content_editor.php?catid=<?php echo $this->_tpl_vars['cat'][$this->_sections['item']['index']]->id; ?>
&type=live"><img src="/images/icons/doc_edit_16.gif" border="0"></a></td>
	</tr>
	<?php endfor; endif; ?>
</tbody>
</table>