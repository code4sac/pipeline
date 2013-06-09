<? 
include('../inc.php');
$sql = new mysql();

$google_id = filter_var($_GET['google_id'], FILTER_SANITIZE_NUMBER_INT);
$app_id    = filter_var($_GET['app_id'], FILTER_VALIDATE_INT);

// Get Member ID
$memberQ = "
  SELECT  id
  FROM team_members
  WHERE google_id = '$google_id'
";
$memberid = $sql->getRows($memberQ);
$member_id = $memberid[0]->id;
// End Get Member ID

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
  print "false";
} else {
  print "true";
}
?>
