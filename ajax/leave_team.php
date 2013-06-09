<? 
include('../inc.php');
$sql = new mysql();

$google_id = filter_var($_POST['google_id'], FILTER_SANITIZE_NUMBER_INT);
$app_id    = filter_var($_POST['app_id'], FILTER_VALIDATE_INT);

// Get Member ID
$memberQ = "
  SELECT  id
  FROM team_members
  WHERE google_id = '$google_id'
";
$memberid = $sql->getRows($memberQ);
$member_id = $memberid[0]->id;
// End Get Member ID

$removeQ = "
  DELETE FROM team_app
  WHERE memberID = '$member_id'
    AND appID = '$app_id'
";
$sql->update($removeQ);
?>
