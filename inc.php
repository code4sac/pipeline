<? // Include all files.
// Error Reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Include main site config.
defined('ROOT_PATH') or define('ROOT_PATH', realpath(dirname(__FILE__)));
include(ROOT_PATH.'/conf/site-config.php');

// Include all files below this line ----------------------------------------
include(ROOT_PATH.'/lib/util.php');
include(ROOT_PATH.'/lib/mysqli.php');
include(ROOT_PATH.'/lib/curl.php');
if($site_config['site']['google_api']) {
	require_once(ROOT_PATH.'/lib/google-api/Google_Client.php');
	require_once(ROOT_PATH.'/lib/google-api/contrib/Google_Oauth2Service.php');
}
