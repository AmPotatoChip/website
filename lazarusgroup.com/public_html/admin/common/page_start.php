<?
// configuration file
session_start();			// start session.

define('BASE_PATH','/var/www/sites/lazarusgroup.com/');
define('SITE_PATH',BASE_PATH.'public_html/');

define('URL','http://beta.lazarusgroup.com/');

define('ADMIN_URL',URL.'admin/');
define('MEDIA_VAULT',SITE_PATH.'media_vault/');
define('SITE_TPL_ROOT',BASE_PATH.'smarty_templates/');
define('SITE_COMPILE_ROOT',SITE_TPL_ROOT.'templates_c/');
define('PAGE_TITLE','lazarusgroup.com');
define('PAGE_BRAND','lazarusgroup.com');

require_once('smarty/Smarty.class.php');
require_once('smarty/SmartyValidate.class.php');
require_once(BASE_PATH.'private/dbconn.php');
require_once('../common/lgsystems.class.php');
require_once('admin_lib.php');

$LGCLASS = new LGSystems_CLASS() or die('Can not load main class!');
$LGCLASS->error_display=true;

$smarty =& new Smarty;
if(empty($_POST)){ SmartyValidate::connect($smarty, true); }else{ SmartyValidate::connect($smarty); }

$smarty->force_compile = true;
$smarty->config_overwrite = false;

$smarty->left_delimiter = '!{';
$smarty->right_delimiter = '}';
$smarty->template_dir = SITE_TPL_ROOT;
$smarty->compile_dir = SITE_COMPILE_ROOT;
//$smarty->config_dir = SITE_CONFIG_ROOT;
//$smarty->cache_dir = SITE_CACHE_ROOT;
$smarty->trusted_dir = array(SITE_TPL_ROOT);
$smarty_vars = array(); //initialize the array for hold template variables


?>
