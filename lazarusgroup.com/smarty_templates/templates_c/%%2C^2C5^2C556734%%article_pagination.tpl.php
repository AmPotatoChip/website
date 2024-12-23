<?php /* Smarty version 2.6.11, created on 2018-03-22 00:39:49
         compiled from article_pagination.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'assign_adv', 'article_pagination.tpl', 4, false),array('function', 'math', 'article_pagination.tpl', 16, false),)), $this); ?>
<?php if ($this->_tpl_vars['page_breaks']): ?>

<div id="pagination">
<?php echo smarty_function_assign_adv(array('var' => 'run_stop','value' => '3'), $this);?>



<?php echo smarty_function_assign_adv(array('var' => 'highest_page','value' => $this->_tpl_vars['page_breaks']), $this);?>





<br/>

<?php echo smarty_function_assign_adv(array('var' => 'page_no','value' => "range(1,".($this->_tpl_vars['page_breaks']).")"), $this);?>

<?php if ($_GET['pbr']):  echo smarty_function_math(array('equation' => "a-b",'a' => $_GET['pbr'],'b' => 1,'assign' => 'marker'), $this);?>

<?php else:  $this->assign('marker', '1');  endif; ?>

<b>Page:</b>&nbsp;&nbsp;
<?php if ($_GET['pbr'] > 1):  echo smarty_function_math(array('equation' => "a-b",'a' => $_GET['pbr'],'b' => 1,'assign' => 'previous'), $this);?>

<a href="full_content.php?article_id=<?php echo $_GET['article_id']; ?>
&full=yes&pbr=<?php echo $this->_tpl_vars['previous']; ?>
"><<</a> 

<?php endif; ?>

<?php echo smarty_function_math(array('equation' => "a-b",'a' => $_GET['pbr'],'b' => 1,'assign' => 'page_run'), $this);?>

<?php if ($this->_tpl_vars['page_run'] > 0): ?>
<a href="?article_id=<?php echo $_GET['article_id']; ?>
&full=yes&pbr=<?php echo $this->_tpl_vars['page_run']; ?>
" <?php if ($_GET['pbr'] == $this->_tpl_vars['page_run']): ?>style="font-weight:bold;color:#CC0000;background-color:#fff;"<?php endif; ?>><?php echo $this->_tpl_vars['page_run']; ?>
</a>&nbsp;
<?php endif; ?>

<?php echo smarty_function_math(array('equation' => "a+b",'a' => $this->_tpl_vars['page_run'],'b' => 1,'assign' => 'page_run'), $this);?>

<?php if ($this->_tpl_vars['page_run'] <= $this->_tpl_vars['highest_page']): ?>
<a href="?article_id=<?php echo $_GET['article_id']; ?>
&full=yes&pbr=<?php echo $this->_tpl_vars['page_run']; ?>
" <?php if ($_GET['pbr'] == $this->_tpl_vars['page_run']): ?>style="font-weight:bold;color:#CC0000;background-color:#fff;"<?php endif; ?>><?php echo $this->_tpl_vars['page_run']; ?>
</a>&nbsp;
<?php endif; ?>

<?php echo smarty_function_math(array('equation' => "a+b",'a' => $this->_tpl_vars['page_run'],'b' => 1,'assign' => 'page_run'), $this);?>

<?php if ($this->_tpl_vars['page_run'] <= $this->_tpl_vars['highest_page']): ?>
<a href="?article_id=<?php echo $_GET['article_id']; ?>
&full=yes&pbr=<?php echo $this->_tpl_vars['page_run']; ?>
" <?php if ($_GET['pbr'] == $this->_tpl_vars['page_run']): ?>style="font-weight:bold;color:#CC0000;background-color:#fff;"<?php endif; ?>><?php echo $this->_tpl_vars['page_run']; ?>
</a>&nbsp;
<?php endif; ?>

<?php echo smarty_function_math(array('equation' => "a+b",'a' => $_GET['pbr'],'b' => 1,'assign' => 'next'), $this);?>

<?php if ($this->_tpl_vars['next'] < $this->_tpl_vars['highest_page']): ?> 
<a href="full_content.php?article_id=<?php echo $_GET['article_id']; ?>
&full=yes&pbr=<?php echo $this->_tpl_vars['next']; ?>
">>></a>
<?php endif; ?>


</div>
<?php endif; ?>