function updateOneField(table, id, field, value) {
	var action = 'update';
	var opts = '?action='+action+'&table='+table+'&id='+id+'&field='+field+'&value='+value;
	ajaxPOST('/data/ajax/mysql_js_func.php' + opts);
}
function deleteRow(table, id) {
	var action = 'delete';
	var opts = '?action='+action+'&table='+table+'&id='+id;
	ajaxPOST('/data/ajax/mysql_js_func.php' + opts);
}
function checkField(table, field, value) {
  var action = 'check';
  var opts = '?action='+action+'&table='+table+'&field='+field+'&value='+value;
  var res;
  res = ajaxPOST('ajax/mysql_js_func.php' + opts);
  return res;
}
