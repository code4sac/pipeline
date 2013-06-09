<?
include('../inc.php');
$sql = new mysql();

$google_id = filter_var($_GET['google_id'], FILTER_SANITIZE_NUMBER_INT);
$app_id = filter_var($_GET['app_id'], FILTER_VALIDATE_INT);
$user_name = filter_VAR($_GET['name'], FILTER_SANITIZE_STRING);

// Get userID
$uidQ = "
  SELECT id FROM team_members WHERE google_id = '$google_id'
";
$uid = $sql->getRows($uidQ);
$uid = $uid[0]->id;
// End Get userID

?>
<script type="text/javascript">
function submitForm() {
  var email_address = $('#email_address').val();
  if(email_address == '') {
    alert('please enter an email address. This is required so we can contact you');
  } else {
    var res = ajaxFormPOST('ajax/add_team_member.php', '#new_user_form');
    alert(res);
    show_team_members();
    $('.ui-dialog').remove(); 
  }
}
</script>
<p>
Thank you for joining the team! You will be listed on the page as a team member, and your email will be used to alert you of updates. <br/><br/>
If you would like to change your role, please leave the team and join again.
</p>
<hr/>
<form id="new_user_form">
  <label for="role">What would you like your primary role to be?</label>
  <select name="role" id="role">
  <option value="" SELECTED>Select a role...</option>
<?
  $query = "SELECT * FROM roles";
  $roles = $sql->getRows($query);
  foreach($roles as $role) {
  ?><option value="<?=$role->id;?>"><?=$role->role_title;?></option><?
  }
?>
  </select>
  <br/>
  <label for="email_address">Email Address: </label>
  <input type="text" name="email_address" id="email_address" />
  <input type="hidden" name="google_id" value="<?=$google_id;?>"/>
  <input type="hidden" name="app_id" value="<?=$app_id;?>"/>
  <input type="hidden" name="user_name" value="<?=$user_name;?>"/>
  <input type="hidden" name="member_id" value="<?=$uid;?>"/>
</form>
<button onClick="submitForm();">Join Team!</button>
