<?php /* Smarty version 2.6.11, created on 2011-10-26 09:50:56
         compiled from admin/media_lib_update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/media_lib_update.tpl', 1, false),array('modifier', 'stripslashes', 'admin/media_lib_update.tpl', 29, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'media_update','field' => 'name','criteria' => 'notEmpty','assign' => 'error_name','message' => 'Name is required'), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/media_categories.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['media_category'] == 'images'): ?>
<p style="font-size:12px;">Current Picture:<br/>
<img style="border:1px solid #272E4F;" height="200" src="<?php echo @URL; ?>
media_vault/<?php echo $this->_tpl_vars['media_category']; ?>
/<?php echo $this->_tpl_vars['file_name']; ?>
"></p>
<?php endif; ?>

<form name="media_update" method="POST" action="" enctype="multipart/form-data">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
	<tr>
		<td colspan="2">Update Media Form</td>
	</tr>
</thead>
<tbody>
<tr>
<td colspan="2" id="info_text">Allowed File Types: jpg, gif, tif, mov, mp3, ogg, doc, pdf, wmv, mpg, mpeg, m4a</td>
</tr>
<?php if ($this->_tpl_vars['error_name']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_name']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right" valign="top"><span id="red">*</span> Name:</td>
	<td><input type="text" name="name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="46"><br/>
	<span style="font-size:10px;">Staff use only</span>
	</td>
</tr>
<tr>
	<td id="right" valign="top">Caption:</td>
	<td><input type="text" name="caption" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['caption'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="46"><br/>
	<span style="font-size:10px;">Caption will display with picture on site.</span>
	</td>
</tr>
<tr>
	<td id="right" valign="top">Description:</td>
	<td><textarea name="description" cols="43" rows="3"><?php echo ((is_array($_tmp=$this->_tpl_vars['description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
</tr>
<?php if ($this->_tpl_vars['error_data']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_data']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">File:</td>
	<td><input type="file" name="data" size="44"><br/>
	
	</td>
</tr>
</tbody>
<tfoot>
	<tr>
		<td align="right" colspan="2"><input type="submit" name="submit" value="Update Media">
		<input type="hidden" name="media_id" value="<?php echo $_GET['mid']; ?>
">
		<input type="hidden" name="media_category" value="<?php echo $this->_tpl_vars['media_category']; ?>
">
		<input type="hidden" name="file_name" value="<?php echo $this->_tpl_vars['file_name']; ?>
">
		</td>
	</tr>	
</tfoot>
</table>
</form>
