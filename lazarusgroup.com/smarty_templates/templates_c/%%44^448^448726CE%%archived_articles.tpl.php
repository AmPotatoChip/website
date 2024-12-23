<?php /* Smarty version 2.6.11, created on 2018-02-13 13:30:43
         compiled from admin/archived_articles.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'admin/archived_articles.tpl', 19, false),array('modifier', 'date_format', 'admin/archived_articles.tpl', 23, false),array('function', 'cycle', 'admin/archived_articles.tpl', 21, false),)), $this); ?>
<table cellpadding="3" cellspacing="0" border="0" id="display" width="900">
		<thead>
			<tr>
				<td colspan="11">Article Archive</td>
			</tr>
			<tr>
				<td width="40">ID</td>
				<td width="50">Created</td>
				<td width="70">Last Mod</td>
				<td width="50">Dateline</td>
				<td>Headline</td>
				<td align="center" width="70">View</td>
				<td align="center" width="70">Edit</td>
				<td align="center" width="70">Delete</td>
				<td align="left" width="70">Status</td>
			</tr>
		</thead>
		<tbody style="overflow-y:auto;overflow-x:hidden;height:400px;">
			<?php $this->assign('total_article_count', count($this->_tpl_vars['content'])); ?>
			<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=($this->_tpl_vars['content'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<td><?php echo $this->_tpl_vars['content'][$this->_sections['item']['index']]->id; ?>
</td>
					<td width="50" style="color:#9F9F9F;"><?php echo ((is_array($_tmp=$this->_tpl_vars['content'][$this->_sections['item']['index']]->created)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</td>
					<td width="70" style="color:#9F9F9F;"><?php echo ((is_array($_tmp=$this->_tpl_vars['content'][$this->_sections['item']['index']]->last_mod)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</td>
					<td width="50"><?php echo ((is_array($_tmp=$this->_tpl_vars['content'][$this->_sections['item']['index']]->dateline)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")); ?>
</td>
					
					
					<td><?php echo $this->_tpl_vars['content'][$this->_sections['item']['index']]->headline; ?>
</td>
					<td align="center"><a href="javascript:;" onClick="viewArticle('<?php echo $this->_tpl_vars['content'][$this->_sections['item']['index']]->id; ?>
');"><img src="/images/icons/doc_prev_16.gif" border="0" /></a></td>
					<td align="center"><a href="?catid=<?php echo $_GET['catid']; ?>
&article_id=<?php echo $this->_tpl_vars['content'][$this->_sections['item']['index']]->id; ?>
&type=editor"><img src="/images/icons/doc_edit_16.gif" border="0" /></a></td>
					<td align="center"><a href="delete_article.php?article_id=<?php echo $this->_tpl_vars['content'][$this->_sections['item']['index']]->id; ?>
&catid=<?php echo $_GET['catid']; ?>
" onClick="return confirm('Are you sure you would like to delete this article?');"><img src="/images/icons/doc_close_16.gif" border="0" /></a></td>
					<td style="padding:0 25 0 0;">
					<select name="article_status" onChange="articleStatusChange(this,'<?php echo $this->_tpl_vars['content'][$this->_sections['item']['index']]->id; ?>
');">
						<option value="archived" <?php if ($this->_tpl_vars['content'][$this->_sections['item']['index']]->article_status == 'archived'): ?>selected<?php endif; ?>>Archived</option>
						<option value="off" <?php if ($this->_tpl_vars['content'][$this->_sections['item']['index']]->article_status == 'off'): ?>selected<?php endif; ?>>Off</option>
						<option value="live" <?php if ($this->_tpl_vars['content'][$this->_sections['item']['index']]->article_status == 'live'): ?>selected<?php endif; ?>>Live</option>
					</select>
					</td>
				</tr>
			<?php endfor; endif; ?>
		</tbody>
		
	</table>