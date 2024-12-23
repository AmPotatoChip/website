<?php /* Smarty version 2.6.11, created on 2018-02-13 13:29:46
         compiled from admin/website_content_category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/website_content_category.tpl', 1, false),array('function', 'present_image_display_by_media_id', 'admin/website_content_category.tpl', 121, false),array('modifier', 'stripslashes', 'admin/website_content_category.tpl', 30, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'category','field' => 'name','criteria' => 'notEmpty','assign' => 'error_name','message' => "Name can not be empty."), $this);?>

<?php echo smarty_function_validate(array('form' => 'category','field' => 'set_headline','criteria' => 'notEmpty','assign' => 'error_set_headline','message' => "Headline can not be empty."), $this);?>

<?php echo smarty_function_validate(array('form' => 'category','field' => 'set_subhead','criteria' => 'notEmpty','assign' => 'error_set_subhead','message' => "Subhead can not be empty."), $this);?>

<?php echo smarty_function_validate(array('form' => 'category','field' => 'set_exerpt','criteria' => 'notEmpty','assign' => 'error_set_exerpt','message' => "Exerpt can not be empty."), $this);?>

<?php echo smarty_function_validate(array('form' => 'category','field' => 'set_byline','criteria' => 'notEmpty','assign' => 'error_set_byline','message' => "Byline can not be empty."), $this);?>

<?php echo smarty_function_validate(array('form' => 'category','field' => 'set_dateline','criteria' => 'notEmpty','assign' => 'error_set_dateline','message' => "Dateline can not be empty."), $this);?>

<?php echo smarty_function_validate(array('form' => 'category','field' => 'no_articles','criteria' => 'notEmpty','assign' => 'error_no_articles','message' => "Number of articles to display can not be empty."), $this);?>


<form name="category" method="post" action="">
<table border="0" cellpadding="3" cellspacing="0" id="form" width="100%">
<thead>
<tr>
<td colspan="2">Content Category Form</td>
</tr>
</thead>

<tbody>
<?php if ($this->_tpl_vars['error_name']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_name']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Name:</td>
	<td><input type="text" name="name" value="<?php echo $this->_tpl_vars['name']; ?>
" size="40" maxlength="120"></td>
</tr>
<tr>
	<td id="right" valign="top">Description:</td>
	<td><textarea name="description" cols="37" rows="3"><?php echo ((is_array($_tmp=$this->_tpl_vars['description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
</tr>
<?php if ($this->_tpl_vars['error_set_headline']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_set_headline']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Headline:</td>
	<td><input type="radio" name="set_headline" value="true" <?php if ($this->_tpl_vars['set_headline'] == 'true'): ?>checked<?php endif; ?>>Yes<input type="radio" name="set_headline" value="false"  <?php if ($this->_tpl_vars['set_headline'] == 'false'): ?>checked<?php endif; ?>>No</td>
</tr>
<?php if ($this->_tpl_vars['error_set_subhead']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_set_subhead']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Subhead:</td>
	<td><input type="radio" name="set_subhead" value="true" <?php if ($this->_tpl_vars['set_subhead'] == 'true'): ?>checked<?php endif; ?>>Yes<input type="radio" name="set_subhead" value="false" <?php if ($this->_tpl_vars['set_subhead'] == 'false'): ?>checked<?php endif; ?>>No</td>
</tr>
<?php if ($this->_tpl_vars['error_set_exerpt']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_set_exerpt']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Exerpt:</td>
	<td><input type="radio" name="set_exerpt" value="true" <?php if ($this->_tpl_vars['set_exerpt'] == 'true'): ?>checked<?php endif; ?>>Yes<input type="radio" name="set_exerpt" value="false" <?php if ($this->_tpl_vars['set_exerpt'] == 'false'): ?>checked<?php endif; ?>>No</td>
</tr>
<?php if ($this->_tpl_vars['error_set_byline']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_set_byline']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Byline:</td>
	<td><input type="radio" name="set_byline" value="true" <?php if ($this->_tpl_vars['set_byline'] == 'true'): ?>checked<?php endif; ?>>Yes<input type="radio" name="set_byline" value="false" <?php if ($this->_tpl_vars['set_byline'] == 'false'): ?>checked<?php endif; ?>>No</td>
</tr>
<?php if ($this->_tpl_vars['error_set_dateline']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_set_dateline']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Dateline:</td>
	<td><input type="radio" name="set_dateline" value="true" <?php if ($this->_tpl_vars['set_dateline'] == 'true'): ?>checked<?php endif; ?>>Yes<input type="radio" name="set_dateline" value="false" <?php if ($this->_tpl_vars['set_dateline'] == 'false'): ?>checked<?php endif; ?>>No</td>
</tr>
<?php if ($this->_tpl_vars['error_no_articles']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_no_articles']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Number of articles to display:</td>
	<td><input type="text" name="no_articles" size="3" maxlength="2" value="<?php echo $this->_tpl_vars['no_articles']; ?>
"></td>
</tr>
<?php if ($this->_tpl_vars['error_navlevel']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_navlevel']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Nav Level:</td>
	<td><input type="text" name="navlevel" size="12" maxlength="11" value="<?php echo $this->_tpl_vars['navlevel']; ?>
"></td>
</tr>
<?php if ($this->_tpl_vars['error_position']): ?>
<tr>
	<td>&nbsp;</td>
	<td id="red"><?php echo $this->_tpl_vars['error_position']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td id="right">Position:</td>
	<td><input type="text" name="position" size="5" maxlength="5" value="<?php echo $this->_tpl_vars['position']; ?>
"></td>
</tr>
<?php if (! $this->_tpl_vars['header_media_id']): ?>
<tr>
<td id="right">Header Media ID:</td>
<td><input type="text" name="header_media_id" size="10" value="<?php echo $this->_tpl_vars['header_media_id']; ?>
"></td>
</tr>
<?php else: ?>
<tr>
<td colspan="2" align="center">
<a href="content.php?type=removeheader&catid=<?php echo $_GET['catid']; ?>
" class="link">Remove Header</a><br/>
<img src="<?php echo smarty_function_present_image_display_by_media_id(array('value' => $this->_tpl_vars['header_media_id']), $this);?>
">
<input type="hidden" name="header_media_id" value="<?php echo $this->_tpl_vars['header_media_id']; ?>
">
</td>
</tr>

<?php endif; ?>

<?php if (! $this->_tpl_vars['square_media_id']): ?>
<tr>
<td id="right">Square Image Media ID:</td>
<td><input type="text" name="square_media_id" size="10" value="<?php echo $this->_tpl_vars['square_media_id']; ?>
"></td>
</tr>
<?php else: ?>
<tr>
<td colspan="2" align="center">
<a href="content.php?type=removesquare&catid=<?php echo $_GET['catid']; ?>
" class="link">Remove Square Image</a><br/>
<img src="<?php echo smarty_function_present_image_display_by_media_id(array('value' => $this->_tpl_vars['square_media_id']), $this);?>
">
<input type="hidden" name="square_media_id" value="<?php echo $this->_tpl_vars['square_media_id']; ?>
">
</td>
</tr>
<?php endif; ?>


</tbody>

<tfoot>
<tr>
<td colspan="2" align="center">
<input type="button" value="Reset Form" onClick="document.location.href='content.php';">
<?php if ($_GET['catid']): ?>
<input type="submit" name="submit" value="Update Category">
<input type="hidden" name="update" value="<?php echo $_GET['catid']; ?>
">
<?php else: ?>
<input type="submit" name="submit" value="Add New Content Category">
<?php endif; ?>	
	</td>
</tr>
</tfoot>
</table>
</form>