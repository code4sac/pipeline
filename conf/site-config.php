<?
$site_config = array (
  'mysql' =>
    array (
      'host'  => 'localhost',
      'port'  => '3306',
      'user'  => 'abraxxus_cfsdp',
      'pass'  => 'code4s@c',
      'db'    => 'abraxxus_cfsPipeLine',
			'resType' => 'object',
			'result'=> false,
			'errors'=> true,
			'debug'	=> true
    ),
	'site' =>
		array (
			'wwwroot'	=> '/core',
			'root'		=> '/home1/abraxxus/www/codeforsacramento-sandbox/pipeline',
			'lang'		=> 'en',
			'charset'	=> 'utf-8',
			'jquery'	=> true,
			'jquery_theme' => 'smoothness',
			'google_api'	=> false
		)
);
?>
