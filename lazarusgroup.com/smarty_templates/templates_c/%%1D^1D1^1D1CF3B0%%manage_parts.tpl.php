<?php /* Smarty version 2.6.11, created on 2011-07-14 16:34:38
         compiled from admin/manage_parts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'debug', 'admin/manage_parts.tpl', 1, false),array('function', 'cycle', 'admin/manage_parts.tpl', 91, false),array('modifier', 'stripslashes', 'admin/manage_parts.tpl', 133, false),)), $this); ?>
<?php echo smarty_function_debug(array(), $this);?>


<?php if ($this->_tpl_vars['MessageResult']): ?>
	<h3><?php echo $this->_tpl_vars['MessageResult']; ?>
</h3>
<?php endif; ?>



<?php if ($this->_tpl_vars['PageType'] == 'subcategory_select'): ?>
	<div id="test_wrap">
 	<h1 class="headline_products">Select SubCategory to Edit</h1>
 	<br clear="all">
 	
 	<table style="font-size: .7em;" >
 	<thead>
<tr>
<td >Category
</td>
 
<td>Sub Category
</td>
<td> &nbsp;
</td>
 	</thead>
 	
 	<tbody>
	<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['CategoryPairs'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
	

<tr>
<td><?php echo $this->_tpl_vars['CategoryPairs'][$this->_sections['x']['index']]['category']; ?>

</td>
 
<td><?php echo $this->_tpl_vars['CategoryPairs'][$this->_sections['x']['index']]['sub_category']; ?>

</td>
<td><a href="/admin/manage_parts.php?sub_category_id=<?php echo $this->_tpl_vars['CategoryPairs'][$this->_sections['x']['index']]['id']; ?>
">USE</A>
</td>
</tr>
	
	
	
	<?php endfor; endif; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>


<?php if ($this->_tpl_vars['PageType'] == 'item_detail'): ?>
	<div id="test_wrap">
	
	<?php echo $this->_tpl_vars['SubCategoryList'][0]['category']; ?>
 > <?php echo $this->_tpl_vars['SubCategoryList'][0]['sub_category']; ?>

	
	
 	<h1 class="headline_products">Add images to groups</h1>
 	<br clear="all">
 	
 	<table style="font-size: .7em;" >
 	<thead>
<tr>
<td > ID
</td>
 <td >Name
</td>
<td>Image
</td>
<td> Page #
</td>
<td> CMS Article
</td>


</thead>
 	
 	<tbody>
<form name="IMAGE_REPLACE" method="POST" action="/admin/manage_parts.php"   enctype="multipart/form-data" >

<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['SubCategoryList'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['x']['show'] = true;
$this->_sections['x']['max'] = $this->_sections['x']['loop'];
$this->_sections['x']['step'] = 1;
$this->_sections['x']['start'] = $this->_sections['x']['step'] > 0 ? 0 : $this->_sections['x']['loop']-1;
if ($this->_sections['x']['show']) {
    $this->_sections['x']['total'] = $this->_sections['x']['loop'];
    if ($this->_sections['x']['total'] == 0)
        $this->_sections['x']['show'] = false;
} else
    $this->_sections['x']['total'] = 0;
if ($this->_sections['x']['show']):

            for ($this->_sections['x']['index'] = $this->_sections['x']['start'], $this->_sections['x']['iteration'] = 1;
                 $this->_sections['x']['iteration'] <= $this->_sections['x']['total'];
                 $this->_sections['x']['index'] += $this->_sections['x']['step'], $this->_sections['x']['iteration']++):
$this->_sections['x']['rownum'] = $this->_sections['x']['iteration'];
$this->_sections['x']['index_prev'] = $this->_sections['x']['index'] - $this->_sections['x']['step'];
$this->_sections['x']['index_next'] = $this->_sections['x']['index'] + $this->_sections['x']['step'];
$this->_sections['x']['first']      = ($this->_sections['x']['iteration'] == 1);
$this->_sections['x']['last']       = ($this->_sections['x']['iteration'] == $this->_sections['x']['total']);
?>
	
 
<input type="hidden" name="record[<?php echo $this->_sections['x']['index']; ?>
]" value="<?php echo $this->_tpl_vars['SubCategoryList'][$this->_sections['x']['index']]['id']; ?>
">
<input type="hidden" name="category" value="<?php echo $this->_tpl_vars['SubCategoryList'][0]['category']; ?>
">
<input type="hidden" name="sub_category" value="<?php echo $this->_tpl_vars['SubCategoryList'][0]['sub_category']; ?>
">

<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#FFFFFF,#DFE5FF"), $this);?>
">

<td><?php echo $this->_tpl_vars['SubCategoryList'][$this->_sections['x']['index']]['id']; ?>

</td>
<td><?php echo $this->_tpl_vars['SubCategoryList'][$this->_sections['x']['index']]['name']; ?>

</td>
 
<td><input type="file" name="image[<?php echo $this->_sections['x']['index']; ?>
]" id="file1" size="0" onChange="validateField(this);" ><?php echo $this->_tpl_vars['SubCategoryList'][$this->_sections['x']['index']]['image']; ?>

</td>
<td><input type="text" name="page[<?php echo $this->_sections['x']['index']; ?>
]" value="<?php echo $this->_tpl_vars['SubCategoryList'][$this->_sections['x']['index']]['pageno']; ?>
" size="3">
</td>
<td>[ <a href="/admin/manage_parts.php?item_id=<?php echo $this->_tpl_vars['SubCategoryList'][$this->_sections['x']['index']]['id']; ?>
">Edit Item Page</a> ]
</td>
</tr>
	
	
	
	<?php endfor; endif; ?>
	</tbody>
	</table>
	<input type="submit" value="go!">
	</FORM>
	
	</div>

<?php endif; ?>


<?php if ($this->_tpl_vars['PageType'] == 'item_detail_edit'): ?>
	<div id="test_wrap">
	
 	<h1 class="headline_products"><?php echo $this->_tpl_vars['ItemDetailText']['name']; ?>
</h1>
 	<br clear="all">
 	<P>image: <?php echo $this->_tpl_vars['ItemDetailText']['image']; ?>
<br>
 	
 	</P>
	<form name="manage_parts" method="POST" action="">
		<input type="hidden" name="detail_id" value="<?php echo $this->_tpl_vars['ItemDetailText']['id']; ?>
">
		<input type="hidden" name="testchange" value="<?php echo $this->_tpl_vars['ItemDetailText']['id']; ?>
">
		<textarea id="full_content" name="full_content"><?php echo ((is_array($_tmp=$this->_tpl_vars['ItemDetailText']['article'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</textarea>
	<input type="submit" value="Save">
	</form>

	</div>
<script type="text/javascript">
      
        var oFCKeditor = new FCKeditor( 'full_content' ) ;
        oFCKeditor.BasePath = "fckeditor/" ;
        oFCKeditor.EditorAreaCSS = "/stylesheet.css";
        oFCKeditor.Width = '700';
        oFCKeditor.Height = '500';
        oFCKeditor.ReplaceTextarea() ;
      
</script>
<?php endif; ?>
