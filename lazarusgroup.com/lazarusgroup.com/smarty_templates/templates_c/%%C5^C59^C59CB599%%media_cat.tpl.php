<?php /* Smarty version 2.6.11, created on 2011-10-26 09:55:07
         compiled from admin/media_cat.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucwords', 'admin/media_cat.tpl', 1, false),array('modifier', 'strtoupper', 'admin/media_cat.tpl', 11, false),array('function', 'assign_adv', 'admin/media_cat.tpl', 6, false),array('function', 'cycle', 'admin/media_cat.tpl', 48, false),)), $this); ?>
<h2><?php echo ucwords($_GET['cat']); ?>
</h2>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/media_categories.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<p><a href="media_library.php" class="link" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/image_add_16.gif" border="0" /> Add New Media</a></p>


<?php echo smarty_function_assign_adv(array('var' => 'search_array','value' => "array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9','0','all')"), $this);?>


<p>
<span style="font-size:12px;font-weight:bold;">Search By Name:</span><br/>
<?php unset($this->_sections['q']);
$this->_sections['q']['name'] = 'q';
$this->_sections['q']['loop'] = is_array($_loop=$this->_tpl_vars['search_array']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['q']['show'] = true;
$this->_sections['q']['max'] = $this->_sections['q']['loop'];
$this->_sections['q']['step'] = 1;
$this->_sections['q']['start'] = $this->_sections['q']['step'] > 0 ? 0 : $this->_sections['q']['loop']-1;
if ($this->_sections['q']['show']) {
    $this->_sections['q']['total'] = $this->_sections['q']['loop'];
    if ($this->_sections['q']['total'] == 0)
        $this->_sections['q']['show'] = false;
} else
    $this->_sections['q']['total'] = 0;
if ($this->_sections['q']['show']):

            for ($this->_sections['q']['index'] = $this->_sections['q']['start'], $this->_sections['q']['iteration'] = 1;
                 $this->_sections['q']['iteration'] <= $this->_sections['q']['total'];
                 $this->_sections['q']['index'] += $this->_sections['q']['step'], $this->_sections['q']['iteration']++):
$this->_sections['q']['rownum'] = $this->_sections['q']['iteration'];
$this->_sections['q']['index_prev'] = $this->_sections['q']['index'] - $this->_sections['q']['step'];
$this->_sections['q']['index_next'] = $this->_sections['q']['index'] + $this->_sections['q']['step'];
$this->_sections['q']['first']      = ($this->_sections['q']['iteration'] == 1);
$this->_sections['q']['last']       = ($this->_sections['q']['iteration'] == $this->_sections['q']['total']);
?>
<a href="media_cat.php?cat=<?php echo $_GET['cat']; ?>
&q=<?php echo strtoupper($this->_tpl_vars['search_array'][$this->_sections['q']['index']]); ?>
" <?php if ($_GET['q'] == strtoupper($this->_tpl_vars['search_array'][$this->_sections['q']['index']])): ?>class="link_visit"<?php else: ?>class="link"<?php endif; ?>><?php echo strtoupper($this->_tpl_vars['search_array'][$this->_sections['q']['index']]); ?>
</a>&nbsp;
<?php endfor; endif; ?>
</p>

<form name="media_search_by_id" method="POST" action="media_cat.php?cat=<?php echo $_GET['cat']; ?>
">
<p style="font-size:12px;">
<b>Search By :</b>
<select name="search_by">
<option value="media_id" <?php if ($this->_tpl_vars['search_by'] == 'media_id'): ?>selected<?php endif; ?>/>Media ID
<option value="keyword" <?php if ($this->_tpl_vars['search_by'] == 'keyword'): ?>selected<?php endif; ?>/>Keyword
</select>
<input type="text" name="query" value="<?php echo $this->_tpl_vars['query']; ?>
" size="80">
<input type="submit" name="submit" value="Search">
</p>
</form>


<table border="0" cellpadding="3" cellspacing="0" id="meddisplay" width="100%">
	<thead>
		<tr>
			<td colspan="9">Media Library</td>
		</tr>
		<tr>
			<td width="100"  font-size="2">Media ID</td>
		<?php if ($_GET['cat'] == 'images'): ?><td width="50">&nbsp;</td><?php endif; ?>
			<td>Name</td>
			<td>Caption</td>
			<td width="130">File Name</td>
			<td width="130">Added</td>
			
			<td width="90" align="center">More Info</td>
			<td align="center" width="50">Edit</td>
			<td width="60" style="padding:0 20 0 0;">Delete</td>
		</tr>
	</thead>
	<tbody id="media_content" style="overflow-y:auto;overflow-x:hidden;height:575px;">
		<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=$this->_tpl_vars['catcontent']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<td><?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->id; ?>
</td>
			<?php if ($_GET['cat'] == 'images'): ?><td width="50"><img src="image_thumbs.php?file=<?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->file_name; ?>
" width="50"></td><?php endif; ?>
			<td><?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->name; ?>
</td>
			<td><?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->caption; ?>
</td>
			<td width="130"><?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->file_name; ?>
</td>
			<td width="130"><?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->created; ?>
</td>
			<td width="100" align="center"><a href="javascript:;" class="link" onClick="hideunhide('info_<?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->id; ?>
');"><img src="/images/icons/image_info_16.gif" border="0" /></a></td>
			<td width="50" align="center"><a href="media_lib_update.php?mid=<?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->id; ?>
"><img src="/images/icons/image_edit_16.gif" border="0" /></a></td>
			<td align="center" style="padding:0 20 0 0;"><a href="delete_media.php?id=<?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->id; ?>
" class="link" onClick="return confirm('Are you sure you would like to delete this media vault entry.');"><img src="/images/icons/image_close_16.gif" border="0" /></a></td>
		</tr>
		<tr class="more_info" id="info_<?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->id; ?>
" style="display:none;">
			<td colspan="8">
			<b>Description:</b> <?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->description; ?>
<br/>
			<b>Editor Code:</b> <input type="text" value="{MEDIA <?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->id; ?>
}"><br/>
			<b>URL:</b> <a href="<?php echo @URL; ?>
media_vault/<?php echo $_GET['cat']; ?>
/<?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->file_name; ?>
" class="red" target="_blank"><?php echo @URL; ?>
media_vault/<?php echo $_GET['cat']; ?>
/<?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->file_name; ?>
</a><br/>
			<?php if ($this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->dim): ?>
			<b>Image Dimension:</b> <?php echo $this->_tpl_vars['catcontent'][$this->_sections['item']['index']]->dim; ?>

			<?php endif; ?>
			</td>
		</tr>
		<?php endfor; endif; ?>
	</tbody>
</table>