<?
include('../inc.php');
$sql = new mysql();

$app_id = filter_var($_GET['app_id'], FILTER_VALIDATE_INT);

$query = "
  SELECT  team_members.id
      ,   team_members.google_id
      ,   team_members.display_name
      ,   team_app.appID
      ,   team_app.memberID
      ,   roles.role_title
   FROM team_app
   JOIN team_members ON team_app.memberID = team_members.id
   JOIN roles ON team_app.roleID = roles.id
   WHERE team_app.appID = '$app_id'
";
$rows = $sql->getRows($query);

?><table style="width: 100%;">
<?
foreach($rows as $row) {
?>
<tr>
  <td><?=$row->display_name;?></td>
  <td><?=$row->role_title;?></td>
</tr>
<?
}
