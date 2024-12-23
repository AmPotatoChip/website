#!/usr/local/bin/php
<?
session_start();			// start session.
define('BASE_PATH','/var/www/sites/lazarusgroup.com/');
define('SITE_PATH',BASE_PATH.'public_html/');
define('URL','https://lazarusgroup.com/');
define('ADMIN_URL',URL.'admin/');
define('MEDIA_VAULT',SITE_PATH.'media_vault/');
define('SITE_TPL_ROOT',BASE_PATH.'smarty_templates/');
define('SITE_COMPILE_ROOT',SITE_TPL_ROOT.'templates_c/');

require_once(BASE_PATH.'private/dbconn.php');
require_once(SITE_PATH.'admin/common/bulk_mail_class.php');


$BMC = new BULK_MAIL_CLASS();
$batches = $BMC->runCronjob();


?>