<?
include('../inc.php');
$sql = new mysql();
?>
<script type="text/javascript">
$(function() {
	function show_app_detail(id) {
		alert(id);
	}
});
</script>
<?
$status_id = filter_var($_GET['s'], FILTER_VALIDATE_INT);

$query = "
	SELECT	apps.app_title
		,	apps.id
		,	apps.app_desc
		,	apps.img_url
		,	apps.production_date
		,	apps.date_added
		,	category.cat_title
		,	status.status_title
	FROM apps
	JOIN category
		ON apps.app_cat = category.id
	JOIN status
		ON apps.app_status = status.id
	WHERE apps.app_status = '$status_id'
";
$rows = $sql->getRows($query);
?>
<style>
.app_box {
	width: 300px;
	height: 350px;
	margin-right: 5px;
  border-bottom: 1px solid #ccc;
  border-left: 1px solid #EEE;
  border-right: 1px solid #EEE;
	float: left;
}
</style>
<div style="padding: 10px;">
<?
foreach($rows as $app) {
?>
	<div class="app_box">
	  <a href="#" onClick="ajaxGET('views/app_detail.php?id=<?=$app->id;?>', 'main_container')">
		<img src="<?=$app->img_url;?>" />
	  </a>
	<div style="padding: 5px;">
	<span style="font-weight: bold; text-align: center; width: 300px;"><?=$app->app_title;?></span>
	<p><?=$app->app_desc;?></p>
	<br/>
	<a href="#" onClick="ajaxGET('views/app_detail.php?id=<?=$app->id;?>','main_container')">Learn More</a>
    </div>
	</div>
<?
}
?>
	<div style="clear: both;"></div>
</div>
