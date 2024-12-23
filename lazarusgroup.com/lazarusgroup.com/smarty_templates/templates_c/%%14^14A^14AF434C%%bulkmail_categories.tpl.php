<?php /* Smarty version 2.6.11, created on 2010-03-23 19:37:41
         compiled from admin/bulkmail_categories.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/bulkmail_categories.tpl', 1, false),array('modifier', 'stripslashes', 'admin/bulkmail_categories.tpl', 50, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'category','field' => 'category_name','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_category','message' => 'Category Name is required'), $this);?>

<?php echo smarty_function_validate(array('form' => 'category','field' => 'display','criteria' => 'notEmpty','assign' => 'error_display','message' => 'Display Category is required'), $this);?>

<br />
<p>
<a href="javascript:;" class="link" onClick="hideunhide('category_form');" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/folder_add_16.gif" border="0" /> Add a new category</a>
</p>
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
<tr>
<td colspan="4">Bulk Mail Categories</td>
</tr>
<tr>
	<td width="250">Category Name</td>
	<td width="100">Display</td>
	<td width="60" align="center">Edit</td>
	<td width="60" align="center">Delete</td>
</tr>
</thead>
<tbody>
<?php if ($this->_tpl_vars['bulkmail_categories']):  unset($this->_sections['item']);
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
<tr>
	<td><?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->category; ?>
</td>
	<td><?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->display; ?>
</td>
	<td align="center"><a href="bulkmail.php?type=bmc&edit=<?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->id; ?>
" class="link"><img src="/images/icons/mail_edit_16.gif" border="0" /></a></td>
	<td align="center"><a href="delete_bulkmail_category.php?category_id=<?php echo $this->_tpl_vars['bulkmail_categories'][$this->_sections['item']['index']]->id; ?>
" class="link" onClick="return confirm('Are you sure you would like to delete this category?\nThis will remove the contacts out of this category as well.');"><img src="/images/icons/mail_close_16.gif" border="0" /></a></td>
</tr>
<?php endfor; endif;  else: ?>
<tr>
<td colspan="3" id="red">You currently do not have any categories</td>
</tr>
<?php endif; ?>
</tbody>
</table>


<div id="category_form" style="display:none;">
<br/>
<form name="category" method="POST" action="bulkmail.php?type=bmc">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<tbody>
<?php if ($this->_tpl_vars['error_category']): ?>
<tr>
<td colspan="2" id="red"><?php echo $this->_tpl_vars['error_category']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
<td id="right">Category Name:</td>
<td><input type="text" name="category_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['category_name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40" maxlength="80"></td>
</tr>
<?php if ($this->_tpl_vars['error_display']): ?>
<tr>
<td colspan="2" id="red"><?php echo $this->_tpl_vars['error_display']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
<td id="right">Display Category:</td>
<td><input type="radio" name="display" value="es" <?php if ($this->_tpl_vars['display'] == 'yes'): ?>checked<?php endif; ?>>Yes<input type="radio" name="display" value="no" <?php if ($this->_tpl_vars['display'] == 'no'): ?>checked<?php endif; ?>>No
</tr>

<tr>
<td colspan="2" align="right">
<?php if ($this->_tpl_vars['update']): ?>
<input type="submit" name="submit" value="Update Category">
<?php else: ?>
<input type="submit" name="submit" value="Add Category">
<?php endif; ?>
</td>
</tr>

</tbody>
</table>
<input type="hidden" name="form_name" value="category">
<?php if ($this->_tpl_vars['update']): ?>
<input type="hidden" name="update" value="<?php echo $this->_tpl_vars['update']; ?>
">
<?php endif; ?>
</form>
</div>

<?php if ($this->_tpl_vars['show_form']): ?>
<script language="javascript">
onload = hideunhide('category_form');
</script>
<?php endif; ?>