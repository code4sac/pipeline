<?
include('../inc.php');
$curl = new curls();

$foo = $curl->get('https://api.github.com/zen');
Dumper($foo);

?>
