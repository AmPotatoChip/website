<?php /* Smarty version 2.6.11, created on 2010-06-22 10:25:51
         compiled from receipt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'print_r', 'receipt.tpl', 38, false),)), $this); ?>
<h2>Donation Receipt</h2>

<p>
<strong>Transaction ID:</strong> <?php echo $this->_tpl_vars['rdata']['id']; ?>
<br/>
<strong>Donation Amount:</strong> $<?php echo $this->_tpl_vars['rdata']['donation_amount']; ?>
 USD<br/>

<br/>

<?php echo $this->_tpl_vars['rdata']['name']; ?>
<br/>
<?php echo $this->_tpl_vars['rdata']['address']; ?>
<br/>
<?php echo $this->_tpl_vars['rdata']['city']; ?>
, <?php echo $this->_tpl_vars['rdata']['state']; ?>
 <?php echo $this->_tpl_vars['rdata']['zip']; ?>
<br/><br/>

<?php if ($this->_tpl_vars['rdata']['interested_in']): ?>
<strong>Interested In:</strong>

<?php unset($this->_sections['x']);
$this->_sections['x']['name'] = 'x';
$this->_sections['x']['loop'] = is_array($_loop=$this->_tpl_vars['rdata']['interested_in']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 echo $this->_tpl_vars['rdata']['interested_in'][$this->_sections['x']['index']]; ?>

<?php endfor; endif; ?>
<br/><br/>
<?php endif; ?>

<strong>Name on Credit Card:</strong> <?php echo $this->_tpl_vars['rdata']['cc_name']; ?>
<br/>
<strong>Credit Card Type:</strong> <?php echo $this->_tpl_vars['rdata']['cc_type']; ?>
<br/>
<strong>Credit Card Number:</strong> <?php echo $this->_tpl_vars['rdata']['cc_num']; ?>
<br/>
<strong>Credit Card Expiration Date:</strong> <?php echo $this->_tpl_vars['rdata']['cc_exp']; ?>
<br/><br/>




</p>

<p>
Thank you for supporting Deb Hermann for Kansas City.
If you have any questions please contact the office at 816.721.6454 or send us an email at <a href="mailto:staff@debhermannforkansascity.com">staff@debhermannforkansascity.com</a>
</p>
<!--
<pre>
<?php echo print_r($this->_tpl_vars['rdata']); ?>

</pre>-->