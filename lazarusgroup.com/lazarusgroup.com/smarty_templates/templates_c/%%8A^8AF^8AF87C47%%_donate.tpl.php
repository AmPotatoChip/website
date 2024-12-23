<?php /* Smarty version 2.6.11, created on 2011-07-15 13:16:43
         compiled from _donate.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'validate', '_donate.tpl', 1, false),array('modifier', 'stripslashes', '_donate.tpl', 35, false),)), $this); ?>
<?php echo smarty_function_validate(array('form' => 'donate','field' => 'fname','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_fname','message' => "First Name is a required field."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'lname','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_lname','message' => "Last Name is a required field."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'address','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_address','message' => "Address is a required field."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'city','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_city','message' => "City is a required field."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'state','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_state','message' => "State is a required field."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'zip','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_zip','message' => "Zip is a required field."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'phone','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_phone','message' => "Phone is a required field."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'email','criteria' => 'isEmail','transform' => 'trim','assign' => 'error_email','message' => "Email has to be valid."), $this);?>


<?php echo smarty_function_validate(array('form' => 'donate','field' => 'cc_type','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_cc_type','message' => "Credit Card Type is required."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'cc_name','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_cc_name','message' => "Name on Credit Card is required."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'cc_num','criteria' => 'isCCNum','transform' => 'trim','assign' => 'error_cc_num','message' => 'Credit Card Number has to be valid'), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'cc_month','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_cc_month','message' => "Credit Cart Expiration Month is required."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'cc_year','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_cc_year','message' => "Credit Cart Expiration Year is required."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'cc_ccv','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_cc_ccv','message' => "CCV Number is required."), $this);?>

<?php echo smarty_function_validate(array('form' => 'donate','field' => 'employer_occupation','criteria' => 'notEmpty','transform' => 'trim','assign' => 'error_employer_occupation','message' => "Employer or Occupation is required."), $this);?>


<?php echo smarty_function_validate(array('form' => 'donate','field' => 'donation_amount','criteria' => 'notEmpty','assign' => 'error_donation_amount','message' => "Donation Amount has to be 5.00 USD minimum."), $this);?>


<script type="text/javascript">
$(document).ready(function() {
	$('.hide').hide();
	$('.hidetoggle').click(function() {
		$('.hide').toggle();
		return false;
	});
});
</script>

<h2>Donate</h2>
<h3>Thank you for your support!</h3>


<?php if ($this->_tpl_vars['user_message']): ?>
	<p class="error"><?php echo ((is_array($_tmp=$this->_tpl_vars['user_message'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
</p>
<?php endif; ?>

<form name="donate" method="POST" action="donate.php" id="donateform">
<input class="hidden" type="hidden" name="eventname" value="donate">
<p><em>* Denotes a required field</em></p>
<fieldset>
	<legend>Contact Information</legend>

	<ul>
	<?php if ($this->_tpl_vars['error_fname']): ?><li class="yield"><?php echo $this->_tpl_vars['error_fname']; ?>
</li><?php endif; ?>
	<li><label for="fname"><em>*</em> First Name</label><input type="text" name="fname" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></li>

	<?php if ($this->_tpl_vars['error_lname']): ?><li class="yield"><?php echo $this->_tpl_vars['error_lname']; ?>
</li><?php endif; ?>
	<li><label for="lname"><em>*</em> Last Name</label> <input type="text" name="lname" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['lname'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></li>

	<?php if ($this->_tpl_vars['error_address']): ?><li class="yield"><?php echo $this->_tpl_vars['error_address']; ?>
</li><?php endif; ?>
	<li><label for=""><em>*</em> Address</label><input type="text" name="address" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></li>

	<li><label for="">Address 2</label><input type="text" name="address2" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['address2'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></li>

	<?php if ($this->_tpl_vars['error_city']): ?><li class="yield"><?php echo $this->_tpl_vars['error_city']; ?>
</li><?php endif; ?>
	<li><label for=""><em>*</em> City</label><input type="text" name="city" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['city'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></li>

	<?php if ($this->_tpl_vars['error_state']): ?><li class="yield"><?php echo $this->_tpl_vars['error_state']; ?>
</li><?php endif; ?>
	<li><label for=""><em>*</em> State</label><input type="text" name="state" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['state'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></li>

	<?php if ($this->_tpl_vars['error_zip']): ?><li class="yield"><?php echo $this->_tpl_vars['error_zip']; ?>
</li><?php endif; ?>
	<li><label for=""><em>*</em> Zip</label><input type="text" name="zip" value="<?php echo $this->_tpl_vars['zip']; ?>
"></li>

	<?php if ($this->_tpl_vars['error_phone']): ?><li class="yield"><?php echo $this->_tpl_vars['error_phone']; ?>
</li><?php endif; ?>
	<li><label for=""><em>*</em> Phone</label><input type="text" name="phone"value="<?php echo $this->_tpl_vars['phone']; ?>
"></li>

	<?php if ($this->_tpl_vars['error_email']): ?><li class="yield"><?php echo $this->_tpl_vars['error_email']; ?>
</li><?php endif; ?>
	<li><label for=""><em>*</em> Email</label><input type="text" name="email" value="<?php echo $this->_tpl_vars['email']; ?>
"></li>

	</ul>
</fieldset>

<!-- GUEST INFORMATION START -->
<fieldset>
<legend>Donation Amount</legend>
(<em>minimum donation amount of $5.00 USD</em>)
<ul>
<?php if ($this->_tpl_vars['error_donation_amount']): ?><li class="yield"><?php echo $this->_tpl_vars['error_donation_amount']; ?>
</li><?php endif; ?>
<li><label for=""><em>*</em> Amount $</label>
<input type="text" name="donation_amount" value="<?php echo $this->_tpl_vars['donation_amount']; ?>
"></li>
<li><label for="">If you want to make $100 donation over 5 payments, enter 20 above and select yes</label>
<select name="donation_recurring">
<option value="" />Please select
<option value="no" <?php if ($this->_tpl_vars['donation_recurring'] == 'no'): ?>selected<?php endif; ?> />No, This is a one time donation
<option value="yes" <?php if ($this->_tpl_vars['donation_recurring'] == 'yes'): ?>selected<?php endif; ?> />Yes, Please take the above amount over 5 months
</select>
</ul>
</fieldset>

<!-- GUEST INFORMATION END -->

<fieldset>
<legend>Secure Credit Card Information</legend>
<ul>
<?php if ($this->_tpl_vars['error_cc_type']): ?><li class="yield"><?php echo $this->_tpl_vars['error_cc_type']; ?>
</li><?php endif; ?>
<li><label for="" class="label_resize"><em>*</em> Credit Card Type:</label> 
<select name="cc_type">
<option value="" />Please select
<option value="mc" <?php if ($this->_tpl_vars['cc_type'] == 'mc'): ?>selected<?php endif; ?> />Master Card
<option value="visa" <?php if ($this->_tpl_vars['cc_type'] == 'visa'): ?>selected<?php endif; ?> />Visa
<option value="discover" <?php if ($this->_tpl_vars['cc_type'] == 'discover'): ?>selected<?php endif; ?> />Discover Card
<!--<option value="amex" <?php if ($this->_tpl_vars['cc_type'] == 'amex'): ?>selected<?php endif; ?> />American Express
-->
</select></li>
<?php if ($this->_tpl_vars['error_cc_name']): ?><li class="yield"><?php echo $this->_tpl_vars['error_cc_name']; ?>
</li><?php endif; ?>
<li><label for="" class="label_resize"><em>*</em> Name on Credit Card</label> <input type="text" name="cc_name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['cc_name'])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
"></li>
<?php if ($this->_tpl_vars['error_cc_num']): ?><li class="yield"><?php echo $this->_tpl_vars['error_cc_num']; ?>
</li><?php endif; ?>
<li><label for="" class="label_resize"><em>*</em> Credit card number</label> <input type="text" name="cc_num" value="<?php echo $this->_tpl_vars['cc_num']; ?>
"></li>
<?php if ($this->_tpl_vars['error_cc_month']): ?><li class="yield"><?php echo $this->_tpl_vars['error_cc_month']; ?>
</li><?php endif; ?>
<?php if ($this->_tpl_vars['error_cc_year']): ?><li class="yield"><?php echo $this->_tpl_vars['error_cc_year']; ?>
</li><?php endif; ?>
<li><label for="" class="label_resize"><em>*</em> Credit card expiration</label>
<select name="cc_month">
<option value="" selected="selected">Select Month
<option value="01" <?php if ($this->_tpl_vars['cc_month'] == '01'): ?>selected<?php endif; ?> >January
<option value="02" <?php if ($this->_tpl_vars['cc_month'] == '02'): ?>selected<?php endif; ?> >February
<option value="03" <?php if ($this->_tpl_vars['cc_month'] == '03'): ?>selected<?php endif; ?> >March
<option value="04" <?php if ($this->_tpl_vars['cc_month'] == '04'): ?>selected<?php endif; ?> >April
<option value="05" <?php if ($this->_tpl_vars['cc_month'] == '05'): ?>selected<?php endif; ?> >May
<option value="06" <?php if ($this->_tpl_vars['cc_month'] == '06'): ?>selected<?php endif; ?> >June
<option value="07" <?php if ($this->_tpl_vars['cc_month'] == '07'): ?>selected<?php endif; ?> >July
<option value="08" <?php if ($this->_tpl_vars['cc_month'] == '08'): ?>selected<?php endif; ?> >August
<option value="09" <?php if ($this->_tpl_vars['cc_month'] == '09'): ?>selected<?php endif; ?> >September
<option value="10" <?php if ($this->_tpl_vars['cc_month'] == '10'): ?>selected<?php endif; ?> >October
<option value="11" <?php if ($this->_tpl_vars['cc_month'] == '11'): ?>selected<?php endif; ?> >November
<option value="12" <?php if ($this->_tpl_vars['cc_month'] == '12'): ?>selected<?php endif; ?> >December
</select>

<select name="cc_year">
<option value=""selected="selected">Select Year
<option value="2010" <?php if ($this->_tpl_vars['cc_year'] == '2010'): ?>selected<?php endif; ?> >2010
<option value="2011" <?php if ($this->_tpl_vars['cc_year'] == '2011'): ?>selected<?php endif; ?> >2011
<option value="2012" <?php if ($this->_tpl_vars['cc_year'] == '2012'): ?>selected<?php endif; ?> >2012
<option value="2013" <?php if ($this->_tpl_vars['cc_year'] == '2013'): ?>selected<?php endif; ?> >2013
<option value="2014" <?php if ($this->_tpl_vars['cc_year'] == '2014'): ?>selected<?php endif; ?> >2014
<option value="2015" <?php if ($this->_tpl_vars['cc_year'] == '2015'): ?>selected<?php endif; ?> >2015
<option value="2016" <?php if ($this->_tpl_vars['cc_year'] == '2016'): ?>selected<?php endif; ?> >2016
<option value="2017" <?php if ($this->_tpl_vars['cc_year'] == '2017'): ?>selected<?php endif; ?> >2017
<option value="2018" <?php if ($this->_tpl_vars['cc_year'] == '2018'): ?>selected<?php endif; ?> >2018
</select>
</li>

		<?php if ($this->_tpl_vars['error_cc_ccv']): ?><li class="yield"><?php echo $this->_tpl_vars['error_cc_ccv']; ?>
</li><?php endif; ?>
		<li>
			<label for="" class="label_resize"><em>*</em> CCV Number</label>
			<input type="text" name="cc_ccv" value="<?php echo $this->_tpl_vars['cc_ccv']; ?>
">
		</li>

	</ul>
</fieldset>

<fieldset>
	<legend>Missouri Campaign Information</legend>
	<ul>
	<?php if ($this->_tpl_vars['error_employer_occupation']): ?><li class="yield"><?php echo $this->_tpl_vars['error_employer_occupation']; ?>
</li><?php endif; ?>
		<li>
			<label for="" class="label_resize"><em>*</em> Employer or<br>Occupation if self-employed</label>
			<input type="text" name="employer_occupation" value="<?php echo $this->_tpl_vars['employer_occupation']; ?>
">
		</li>
		<li>
			<label for="" class="label_resize"><em>*</em> Do you or your business have a contractual relationship with the City of Kansas City, Missouri?</label>
<select name="kccontract">
<option value="no" <?php if ($this->_tpl_vars['kccontract'] == 'no'): ?>selected<?php endif; ?> >No
<option value="yes" <?php if ($this->_tpl_vars['kccontract'] == 'yes'): ?>selected<?php endif; ?> >Yes
</select>
		</li>
	</ul>


<input type="submit" value="" class="submit">
</fieldset>
</form>

<p>Contributions to a candidate running for Mayor of Kansas City are limited to $3,000 for each election.<br><br>
Contributions to a political campaign are not tax deductible.<br><br>
Missouri Campaign Finance Disclosure Law requires all campaigns to list the name, address, employer or occupation if self-employed, of each person from whom the committee received one or more contributions, in money or other things of value, which in the aggregate total in excess of $25, together with the date and amount of each such contribution.
<br><BR>Deb Hermann for Kansas City utilizes secure internet technology for your contribution and credit card information.<br><br>Your details are safe.
</p>