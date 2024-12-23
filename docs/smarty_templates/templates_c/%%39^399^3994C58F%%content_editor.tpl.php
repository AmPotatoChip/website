<?php /* Smarty version 2.6.11, created on 2018-02-13 13:30:45
         compiled from admin/content_editor.tpl */ ?>
<h2>Content Editor</h2>
<div style="font-size:20px;margin:5 5 25 5px;">
Page Category: <i style="color:#CC0000;"><?php echo $this->_tpl_vars['category_name']; ?>
</i>
</div>
<p id="link">
<a href="content_editor.php?catid=<?php echo $_GET['catid']; ?>
&type=editor"><img src="/images/icons/doc_add_16.gif" border="0" /> Create a New Article</a>
</p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<table border="0" cellpadding="3" cellspacing="0" id="tabulated">
<thead>
	<tr>
		<td onClick="contentEditorNav('<?php echo $_GET['catid']; ?>
','live');" width="120" <?php if ($_GET['type'] == 'live'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?>><img src="/images/icons/doc_16.gif" border="0" /> Live Articles</td>
		<td onClick="contentEditorNav('<?php echo $_GET['catid']; ?>
','archive');" width="120" <?php if ($_GET['type'] == 'archive'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?>><img src="/images/icons/doc_save_16.gif" border="0" /> Article Archive</td>
		<td onClick="contentEditorNav('<?php echo $_GET['catid']; ?>
','editor');" width="120" <?php if ($_GET['type'] == 'editor'): ?>class="tab_on"<?php else: ?>class="tab_off"<?php endif; ?>><img src="/images/icons/doc_edit_16.gif" border="0" /> Content Editor</td>
		<td class="tab_off">&nbsp;</td>
	</tr>
</thead>
<tbody>
<tr>
<td colspan="4" style="border-left:1px solid #000000;border-right:1px solid #000000;border-bottom:1px solid #000000;">

<?php if ($_GET['type'] == live):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/live_articles.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if ($_GET['type'] == archive):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/archived_articles.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

<?php if ($_GET['type'] == editor):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/editor_tab.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?>

</td>
</tr>
</tbody>
</table>