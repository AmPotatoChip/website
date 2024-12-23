<?php /* Smarty version 2.6.11, created on 2011-10-19 10:11:22
         compiled from admin/photoslide_groups.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', 'admin/photoslide_groups.tpl', 1, false),array('function', 'cycle', 'admin/photoslide_groups.tpl', 71, false),array('modifier', 'stripslashes', 'admin/photoslide_groups.tpl', 33, false),array('modifier', 'addslashes', 'admin/photoslide_groups.tpl', 79, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'slideshow_group','field' => 'group_name','criteria' => 'notEmpty','assign' => 'error_group_name','message' => 'Group Name can not be empty'), $this);?>


<h2>Photo Slideshow Groups</h2>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/_error.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<p><a href="javascript:;" class="link" onClick="hideunhide('form');" style="border: 1px solid #CC0000; padding: 6px; -moz-border-radius:7px;"><img src="/images/icons/briefcase_add_16.gif" border="0" /> Add a new group</a></p>

<p>
<?php if ($_GET['group_id']): ?>
<form name="slideshow_group" method="POST" action="photoslide_groups.php?group_id=<?php echo $_GET['group_id']; ?>
">
<?php else: ?>
<form name="slideshow_group" method="POST" action="photoslide_groups.php">
<?php endif; ?>
<table id="form" style="display:none;">
<thead>
<tr>
<td colspan="2">Photo Slideshow Groups</td>
</tr>
</thead>
<tbody>
<?php if ($this->_tpl_vars['error_group_name']): ?>
<tr>
<td>&nbsp;</td>
<td id="red"><?php echo $this->_tpl_vars['error_group_name']; ?>
</td>
</tr>
<?php endif; ?>
<tr>
<td id="right">Slideshow Group Name:</td>
<td><input type="text" name="group_name" value="<?php echo $this->_tpl_vars['group_name']; ?>
" size="40" maxlength="80"></td>
</tr>

<tr>
<td id="right" valign="top">Description:</td>
<td><textarea name="description" rows="6" cols="37"><?php echo ((is_array($_tmp=$this->_tpl_vars['description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea></td>
</tr>

</tbody>

<tfoot>
<tr>
<td colspan="2" align="right">
<input type="button" value="Clear Form" onClick="document.location.href='photoslide_groups.php';">
<?php if ($_GET['group_id']): ?>
<input type="submit" value="Update Slideshow Group">
<?php else: ?>
<input type="submit" value="Add New Slideshow Group">
<?php endif; ?></td>
</tr>
</tfoot>
</table>
<?php if ($this->_tpl_vars['group_id']): ?>
<input type="hidden" name="group_id" value="<?php echo $this->_tpl_vars['group_id']; ?>
">
<?php endif; ?>
</form>
</p>

<table id="display" width="850" style="font-size: 12px">
<thead>
<tr valign="bottom">
<td width="30">ID</td>
<td width="125">Group Name</td>
<td>Description</td>
<td width="100" align="center"># of Images</td>
<td width="60" align="center">Default</td>
<td width="70" align="center">Edit Group</td>
<td width="120" align="center">Edit Slideshow</td>
<td width="65" align="center">Delete</td>
</tr>
</thead>
<tbody>
<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=($this->_tpl_vars['sg'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<td valign="top"><?php echo $this->_tpl_vars['sg'][$this->_sections['item']['index']]['group_id']; ?>
</td>
	<td valign="top"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['sg'][$this->_sections['item']['index']]['group_name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</b></td>
	<td valign="top"><?php echo ((is_array($_tmp=$this->_tpl_vars['sg'][$this->_sections['item']['index']]['description'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</td>
	<td valign="top" align="center"><?php echo $this->_tpl_vars['sg'][$this->_sections['item']['index']]['slide_count']; ?>
</td>
	<td valign="top" align="center"><input type="radio" value="<?php echo $this->_tpl_vars['sg'][$this->_sections['item']['index']]['group_id']; ?>
" name="default_group" <?php if ($this->_tpl_vars['sg'][$this->_sections['item']['index']]['default'] == 'yes'): ?>checked<?php endif; ?> onclick="setSlideshowGroupDefault(this);"></td>
	<td valign="top" align="center"><a href="photoslide_groups.php?group_id=<?php echo $this->_tpl_vars['sg'][$this->_sections['item']['index']]['group_id']; ?>
"><img src="/images/icons/briefcase_config_16.gif" border="0" /></a></td>
	<td valign="top" align="center"><a href="photoslide.php?group_id=<?php echo $this->_tpl_vars['sg'][$this->_sections['item']['index']]['group_id']; ?>
"><img src="/images/icons/briefcase_edit_16.gif" border="0" /></a></td>
	<td valign="top" align="center"><a href="delete_photoslide_group.php?group_id=<?php echo $this->_tpl_vars['sg'][$this->_sections['item']['index']]['group_id']; ?>
" onclick="return confirm('Are you sure you would like to delete (<?php echo ((is_array($_tmp=$this->_tpl_vars['sg'][$this->_sections['item']['index']]['group_name'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
)');"><img src="/images/icons/briefcase_close_16.gif" border="0" /></a></td>
</tr>
<?php endfor; endif; ?>
</tbody>
</table>

<?php if ($_GET['group_id']): ?>
<script language="javascript">
onload=hideunhide('form');
</script>
<?php endif; ?>

<?php if ($this->_tpl_vars['show_form']): ?>
<script language="javascript">
onload=hideunhide('form');
</script>
<?php endif; ?>