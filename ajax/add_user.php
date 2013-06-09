<?
include('../inc.php');
$sql = new mysql();

$google_id    = filter_var($_POST['google_id'], FILTER_SANITIZE_NUMBER_INT);
$display_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

// Check for dups
$dupQ = "
  SELECT  COUNT(id) as count
  FROM team_members WHERE google_id = '$google_id'
";
$dupRes = $sql->getRows($dupQ);
// Check for dups, then insert or bail.
if($dupRes[0]->count == 0) {
  $insQ = "
    INSERT INTO team_members VALUES (
      '0',
      '$google_id',
      '$display_name'
      )
  ";
  $res_id = $sql->insert($insQ);
  print $res_id;
}
