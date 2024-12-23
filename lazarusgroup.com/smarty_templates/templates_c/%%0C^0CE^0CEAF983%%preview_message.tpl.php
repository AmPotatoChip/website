<?php /* Smarty version 2.6.11, created on 2010-12-01 15:38:20
         compiled from admin/preview_message.tpl */ ?>
<h2>Bulk Message Preview</h2>

<a href="bulkmail.php?type=bmm" class="link"><img src="/images/icons/back_16.gif" border="0" /> Return to Bulkmail Messages</a>
<p>
<table border="0" cellpadding="3" cellspacing="0" width="100%">
<tr>
<td style="background-color:#272E4F;color:#FFFFFF;" align="center">
<?php if ($this->_tpl_vars['templates']): ?>
<select name="template" onchange="templatePreview(this,'<?php echo $_GET['message_id']; ?>
');">
<option value='' />Please select a template
<?php unset($this->_sections['item']);
$this->_sections['item']['name'] = 'item';
$this->_sections['item']['loop'] = is_array($_loop=$this->_tpl_vars['templates']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo $this->_tpl_vars['templates'][$this->_sections['item']['index']]; ?>
" <?php if ($_GET['template'] == $this->_tpl_vars['templates'][$this->_sections['item']['index']]): ?>selected<?php endif; ?>/><?php echo $this->_tpl_vars['templates'][$this->_sections['item']['index']]; ?>

<?php endfor; endif; ?>
</select>
<?php endif; ?>
</td>
</tr>
</table>
</p>
<?php if ($this->_tpl_vars['message_preview_data']): ?>
<center>

<iframe src="preview_message_holder.php" width="760" height="500">

</iframe>

</center>
<?php endif; ?>