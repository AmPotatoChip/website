<?php /* Smarty version 2.6.11, created on 2011-07-18 20:13:37
         compiled from catalog_controller_products.tpl */ ?>
<?php $this->assign('conf', $this->_tpl_vars['content_array']['config']);  $this->assign('cont', $this->_tpl_vars['content_array']['content']); ?>

<?php if ($this->_tpl_vars['content_array']['config']['name'] == 'category'): ?>
	<div id="test_wrap_<?php echo $this->_tpl_vars['content_array']['config']['colorsection']; ?>
">
	<h1 class="headline_products"><?php echo $this->_tpl_vars['item_array'][0]['category']; ?>
</h1>
<?php echo $this->_tpl_vars['item_array'][0]['Category_Content']; ?>

	<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['item_array'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<div class="product_wrap">
			<h2 class="headline_products"><?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
</h2>
			<p>
			<a href="/catalog.php?category=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['category']; ?>
&sub_category=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
&cd=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['article_id']; ?>
">
			<img src="/userfiles/image/thumbs/<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['image']; ?>
" border="0" width="100"  title="<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
" alt="<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
" name="<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
" class="media_lib_image_left">
			</a>
			</p>
			<br clear="all">
			<div class="readmore">
				<a href="/catalog.php?category=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['category']; ?>
&sub_category=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
&cd=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['article_id']; ?>
"> <?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
&#187; </a>
			</div>
		</div>
	<?php endfor; endif; ?>
	</div>
<?php endif; ?>


<?php if ($this->_tpl_vars['content_array']['config']['name'] == 'sub_category'): ?>
	<div id="test_wrap_<?php echo $this->_tpl_vars['content_array']['config']['colorsection']; ?>
">
	<p class="breadcrumbs"><a href="/catalog.php?category=<?php echo $this->_tpl_vars['item_array'][0]['category']; ?>
"><?php echo $this->_tpl_vars['item_array'][0]['category']; ?>
</a> > <?php echo $this->_tpl_vars['item_array'][0]['sub_category']; ?>
</p>
 	<h1 class="headline_products"><?php echo $this->_tpl_vars['item_array'][0]['sub_category']; ?>
</h2>

	<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=($this->_tpl_vars['item_array'])) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<div class="product_wrap">
			<h2 class="headline_products"><?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
</h2>
			<p>
			<a href="/catalog.php?category=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['category']; ?>
&sub_category=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['sub_category']; ?>
&name=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
">
			<img src="/userfiles/image/thumbs/<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['image']; ?>
" border="0" width="125"  title="<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
" alt="<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
" name="<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
" class="media_lib_image_left">
			</a>
			</p>
			<br clear="all">
			<div class="readmore">
				<a href="/catalog.php?category=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['category']; ?>
&sub_category=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['sub_category']; ?>
&name=<?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
"> <?php echo $this->_tpl_vars['item_array'][$this->_sections['x']['index']]['name']; ?>
 Details &#187; </a>
			</div>
		</div>
	<?php endfor; endif; ?>
	</div>
<?php endif; ?>



<?php if ($this->_tpl_vars['content_array']['config']['name'] == 'items'): ?>
	<div id="test_wrap_<?php echo $this->_tpl_vars['content_array']['config']['colorsection']; ?>
">
	
	<p class="breadcrumbs"><a href="/catalog.php?category=<?php echo $this->_tpl_vars['content_array']['config']['category']; ?>
"><?php echo $this->_tpl_vars['content_array']['config']['category']; ?>
</a> > <a href="/catalog.php?category=<?php echo $this->_tpl_vars['content_array']['config']['category']; ?>
&sub_category=<?php echo $this->_tpl_vars['content_array']['config']['sub_category']; ?>
"><?php echo $this->_tpl_vars['content_array']['config']['sub_category']; ?>
</a> > <?php echo $this->_tpl_vars['content_array']['config']['item_name']; ?>
</p>
 	<h1 class="headline_products"><?php echo $this->_tpl_vars['content_array']['config']['item_name']; ?>
</h2>

 	<?php if ($this->_tpl_vars['content_array']['config']['CMSCONTENT']): ?>
 		<?php echo $this->_tpl_vars['content_array']['config']['CMSCONTENT']; ?>

 	<?php else: ?>
 	<img src="/userfiles/image/display/<?php echo $this->_tpl_vars['content_array']['config']['image']; ?>
" border="0"  title="<?php echo $this->_tpl_vars['content_array']['config']['item_name']; ?>
" alt="<?php echo $this->_tpl_vars['content_array']['config']['item_name']; ?>
" class="media_lib_image_left">
 		
 	<?php endif; ?>
 	
 	<br clear="all">
 	
	<?php echo $this->_tpl_vars['item_array']; ?>

	</div>
<?php endif; ?>