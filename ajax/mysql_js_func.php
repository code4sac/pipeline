<? // MySQL functions for javascript
include('../inc.php');

$action = $_GET['action'];
switch($action) {
	case 'update':
		mjs_update();
		break;
	case 'delete':
		mjs_delete();
		break;
  case 'check':
    mjs_check();
    break;
	case 'other':
		mjs_other();
		break;
}

function mjs_check() {
  $sql = new mysql();
	$table	= $_GET['table'];
	$field	= $_GET['field'];
	$value	= $_GET['value'];

  $query = "SELECT $field FROM $table WHERE $field = '$value'";
  $row = $sql->getRows($query);
  print count($row);
}

function mjs_update() {
	$sql = new mysql();
	$table	= $_GET['table'];
	$field	= $_GET['field'];
	$value	= $_GET['value'];
	$id			= $_GET['id'];
	$query = "
		UPDATE	$table
		SET $field = '$value'
		WHERE id = '$id'
	";
	$sql->update($query);
}

function mjs_delete() {
	$sql = new mysql();
	$table	= $_GET['table'];
	$id		= $_GET['id'];
	$query	= "
		DELETE FROM $table WHERE id='$id'
	";
	$sql->update($query);
}
