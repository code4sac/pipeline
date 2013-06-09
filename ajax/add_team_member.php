<?
include('../inc.php');
$sql = new mysql();

$google_id = filter_var($_POST['google_id'], FILTER_SANITIZE_NUMBER_INT);
$app_id    = filter_var($_POST['app_id'], FILTER_VALIDATE_INT);
$user_name = filter_VAR($_POST['user_name'], FILTER_SANITIZE_STRING);
$member_id = filter_VAR($_POST['member_id'], FILTER_VALIDATE_INT);
$role      = filter_VAR($_POST['role'], FILTER_VALIDATE_INT);


// Check for dups
$dupQ = "
  SELECT  COUNT(id) as count
  FROM team_app
  WHERE memberID = '$member_id'
    AND appID = '$app_id'
";
$dupRes = $sql->getRows($dupQ);
// Check for dups, then insert or bail.
if($dupRes[0]->count == 0) {
  $insQ = "
    INSERT INTO team_app VALUES (
      '0',
      '$member_id',
      '$app_id',
      '$role',
      '1'
      )
  ";
  $res_id = $sql->insert($insQ);
  print "Thanks for joining the team!";
} else {
  print "You are already a member of this team.";
}
