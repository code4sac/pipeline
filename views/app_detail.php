<?
include('../inc.php');
$sql = new mysql();

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
$query = "
	SELECT	apps.app_title
		,	apps.id
		,	apps.app_desc
		,	apps.img_url
    , apps.screenshot_url
		,	apps.production_date
		,	apps.date_added
		,	category.cat_title
		,	status.status_title
	FROM apps
	JOIN category
		ON apps.app_cat = category.id
	JOIN status
		ON apps.app_status = status.id
	WHERE apps.id = '$id'
";
$rows = $sql->getRows($query);
$row = $rows[0];
$date_added = date('M jS Y', strtotime($row->date_added));
?>
<script>
  var request = gapi.client.plus.people.get({'userId' : 'me'});
  request.execute( function(profile) {
    if(profile.displayName != undefined) { 
      var foo;
      for (var pIndex in profile) {
      foo = foo + pIndex +':'+ profile[pIndex]+'\n';
      }
      alert(foo);
      alert(profile.id);
      // Change join tag  based on login status
      // Insert into database
      // count team members
    }
  });
</script>
<style>
.app_info th {
  text-align: right;
}
</style>
<div style="background-color: #fff; padding: 8px;">
<span style="font-size: 110%;">
<a href="#" onClick="ajaxGET('views/pipeline.php', 'main_container');">Pipeline</a> / <?=$row->app_title;?>
</span>
<br/>
<h2><?=$row->app_title;?></h2>
<hr/>
<div style="width: 500px; float: left;">
  <p style="min-height: 100px;"><?=$row->app_desc;?></p>
  <img src="<?=$row->screenshot_url;?>" />
</div>
<div style="width: 300px; margin-left: 500px;">
  <img src="<?=$row->img_url;?>"/>
  <table class="app_info">
    <tr>
      <th>Added to pipeline:</th>
      <td><?=$date_added;?></td>
    </tr>
    <tr>
      <th>Status:</th>
      <td><?=$row->status_title;?></td>
    </tr>
    <tr>
      <th>Category:</th>
      <td><?=$row->cat_title;?></td>
    </tr>
  </table>
  <button onClick="helper.joinTeam();">Join Team</button>
</div>
<div style="clear: both;"></div>
</div>

