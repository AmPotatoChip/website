<?php /* Smarty version 2.6.11, created on 2018-02-13 13:30:41
         compiled from admin/editor_tab.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/editor_tab.tpl', 23, false),array('modifier', 'stripslashes', 'admin/editor_tab.tpl', 32, false),)), $this); ?>
<form name="content_editor" method="POST" action="">
<table border="0" cellpadding="3" cellspacing="0" id="form">
<thead>
	<tr>
		<td colspan="2">Content Editor</td>
	</tr>
</thead>
<tbody>
<?php if ($_GET['article_id']): ?>
	<tr>
		<td id="right">Change Category:</td>
		<td>
		<select name="cat_id">
		<?php unset($this->_sections['cat']);
$this->_sections['cat']['name'] = 'cat';
$this->_sections['cat']['loop'] = is_array($_loop=($this->_tpl_vars['categories'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cat']['show'] = true;
$this->_sections['cat']['max'] = $this->_sections['cat']['loop'];
$this->_sections['cat']['step'] = 1;
$this->_sections['cat']['start'] = $this->_sections['cat']['step'] > 0 ? 0 : $this->_sections['cat']['loop']-1;
if ($this->_sections['cat']['show']) {
    $this->_sections['cat']['total'] = $this->_sections['cat']['loop'];
    if ($this->_sections['cat']['total'] == 0)
        $this->_sections['cat']['show'] = false;
} else
    $this->_sections['cat']['total'] = 0;
if ($this->_sections['cat']['show']):

            for ($this->_sections['cat']['index'] = $this->_sections['cat']['start'], $this->_sections['cat']['iteration'] = 1;
                 $this->_sections['cat']['iteration'] <= $this->_sections['cat']['total'];
                 $this->_sections['cat']['index'] += $this->_sections['cat']['step'], $this->_sections['cat']['iteration']++):
$this->_sections['cat']['rownum'] = $this->_sections['cat']['iteration'];
$this->_sections['cat']['index_prev'] = $this->_sections['cat']['index'] - $this->_sections['cat']['step'];
$this->_sections['cat']['index_next'] = $this->_sections['cat']['index'] + $this->_sections['cat']['step'];
$this->_sections['cat']['first']      = ($this->_sections['cat']['iteration'] == 1);
$this->_sections['cat']['last']       = ($this->_sections['cat']['iteration'] == $this->_sections['cat']['total']);
?>
			<option value="<?php echo $this->_tpl_vars['categories'][$this->_sections['cat']['index']]->id; ?>
" <?php if ($this->_tpl_vars['cat_id'] == $this->_tpl_vars['categories'][$this->_sections['cat']['index']]->id): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['categories'][$this->_sections['cat']['index']]->name; ?>
</option>
		<?php endfor; endif; ?>
		</select>
		</td>
	</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['editor_setup']['set_headline'] == 'true'):  echo smarty_function_validate(array('form' => 'content_editor','field' => 'headline','criteria' => 'notEmpty','assign' => 'error_headline','message' => "Headline is required."), $this);?>

<?php if ($this->_tpl_vars['error_headline']): ?>
	<tr>
		<td>&nbsp;</td>
		<td id="red"><?php echo $this->_tpl_vars['error_headline']; ?>
</td>
	</tr>
<?php endif; ?>
	<tr>
		<td id="right">Headline:</td>
		<td><input type="text" name="headline" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['headline'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="40" maxlength="70"></td>
	</tr>
<?php endif; ?>	
<?php if ($this->_tpl_vars['editor_setup']['set_subhead'] == 'true'):  echo smarty_function_validate(array('form' => 'content_editor','field' => 'subhead','criteria' => 'notEmpty','assign' => 'error_subhead','message' => "Subhead is required."), $this);?>

<?php if ($this->_tpl_vars['error_subhead']): ?>
	<tr>
		<td>&nbsp;</td>
		<td id="red"><?php echo $this->_tpl_vars['error_subhead']; ?>
</td>
	</tr>
<?php endif; ?>
	<tr>
		<td id="right">Subhead:</td>
		<td><input type="text" name="subhead" value="<?php echo $this->_tpl_vars['subhead']; ?>
" size="40" maxlength="70"></td>
	</tr>
<?php endif;  if ($this->_tpl_vars['editor_setup']['set_exerpt'] == 'true'): ?>	
<?php echo smarty_function_validate(array('form' => 'content_editor','field' => 'exerpt','criteria' => 'notEmpty','assign' => 'error_exerpt','message' => "Exerpt is required."), $this);?>

<?php if ($this->_tpl_vars['error_exerpt']): ?>
	<tr>
		<td>&nbsp;</td>
		<td id="red"><?php echo $this->_tpl_vars['error_exerpt']; ?>
</td>
	</tr>
<?php endif; ?>
	<tr>
		<td id="right" valign="top">Excerpt:</td>
		<td><textarea id="exerpt" name="exerpt"><?php echo ((is_array($_tmp=$this->_tpl_vars['exerpt'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
	</tr>
<script>
    CKEDITOR.replace( 'exerpt',{ filebrowserBrowseUrl: 'ckeditor/filemanager/index.html',
 	extraAllowedContent: {
		'p' : {styles:'*',attributes:'*',classes:'*'}
	}}
	 );
</script>
<?php endif;  echo smarty_function_validate(array('form' => 'content_editor','field' => 'full_content','criteria' => 'notEmpty','assign' => 'error_full_content','message' => "Full Content is required."), $this);?>

<?php if ($this->_tpl_vars['error_full_content']): ?>
	<tr>
		<td>&nbsp;</td>
		<td id="red"><?php echo $this->_tpl_vars['error_full_content']; ?>
</td>
	</tr>
<?php endif; ?>
	<tr>
		<td id="right" valign="top">Full Content:</td>
		<td>
		<textarea id="full_content" name="full_content"><?php echo ((is_array($_tmp=$this->_tpl_vars['full_content'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
	
<script>

 	CKEDITOR.replace('full_content', 
 	{ filebrowserBrowseUrl: 'ckeditor/filemanager/index.html',
 	extraAllowedContent: {
		'p' : {styles:'*',attributes:'*',classes:'*'}
	}}
 	);
    
</script>

		</td>
	</tr>
<?php if ($this->_tpl_vars['editor_setup']['set_byline'] == 'true'):  echo smarty_function_validate(array('form' => 'content_editor','field' => 'byline','criteria' => 'notEmpty','assign' => 'error_byline','message' => "Byline is required."), $this);?>
	
<?php if ($this->_tpl_vars['error_byline']): ?>
	<tr>
		<td>&nbsp;</td>
		<td id="red"><?php echo $this->_tpl_vars['error_byline']; ?>
</td>
	</tr>
<?php endif; ?>
	<tr>
		<td id="right">Byline:</td>
		<td><input type="text" name="byline" value="<?php echo $this->_tpl_vars['byline']; ?>
" size="70" maxlength="120"></td>
	</tr>
<?php endif;  if ($this->_tpl_vars['editor_setup']['set_dateline'] == 'true'):  echo smarty_function_validate(array('form' => 'content_editor','field' => 'dateline','criteria' => 'notEmpty','assign' => 'error_dateline','message' => "Dateline is required."), $this);?>
	
<?php if ($this->_tpl_vars['error_dateline']): ?>
	<tr>
		<td>&nbsp;</td>
		<td id="red"><?php echo $this->_tpl_vars['error_dateline']; ?>
</td>
	</tr>
<?php endif; ?>
	<tr>
		<td id="right">Dateline:</td>
		<td>
		<link rel="stylesheet" type="text/css" media="all" href="/admin/common/calendar/calendar-win2k-cold-1.css" title="win2k-cold-1" />
		<script type="text/javascript" src="/admin/common/calendar/calendar.js"></script>
		<script type="text/javascript" src="/admin/common/calendar/lang/calendar-en.js"></script>
		<script type="text/javascript" src="/admin/common/calendar/calendar-setup.js"></script>
		
		<input type="text" name="dateline" id="dateline" size="15" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['dateline'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
">
		<button type="reset" id="trigger">...</button>
		
		
		<script type="text/javascript">
		Calendar.setup({
			inputField     :    "dateline",      // id of the input field
			ifFormat       :    "%Y-%m-%d",       // format of the input field
			showsTime      :    false,            // will display a time selector
			button         :    "trigger",   // trigger for the calendar (button ID)
			singleClick    :    true,           // double-click mode
			step           :    1                // show all years in drop-down boxes (instead of every other year as default)
		});
		</script>
		</td>
	</tr>
<?php endif; ?>	
<tr>
	<td id="right">SEO Title:</td>
	<td><input type="text" name="seo_title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['seo_title'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="70" maxlength="120"></td>
</tr>

<tr>
	<td id="right">SEO Keywords:</td>
	<td><input type="text" name="seo_keywords" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['seo_keywords'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
" size="70" maxlength="120"></td>
</tr>

<tr>
	<td id="right" valign="top">SEO Description:</td>
	<td><textarea cols="67" rows="4" name="seo_description"><?php echo ((is_array($_tmp=$this->_tpl_vars['seo_description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
</tr>s

</tbody>

<tfoot>
	<tr>
		<td colspan="2" align="right">
		<?php if ($this->_tpl_vars['update']): ?>
			<input type="hidden" name="update" value="<?php echo $this->_tpl_vars['update']; ?>
">
			<input type="submit" name="submit" value="Update Article">
		<?php else: ?>
		<input type="submit" name="submit" value="Add Content">
		<?php endif; ?>
		</td>
	</tr>
</tfoot>
</table>


<input type="hidden" name="form_name" value="content">
<input type="hidden" name="catid" value="<?php echo $_GET['catid']; ?>
">
</form>