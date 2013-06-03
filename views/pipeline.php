<?
include('../inc.php');
?>
<script type="text/javascript">
$(function() {
	$( "#tabs" ).tabs({
		beforeLoad: function( event, ui ) {
		ui.jqXHR.error(function() {
			ui.panel.html(
			"Couldn't load this tab. We'll try to fix this as soon as possible. " +
			"If this wouldn't be a demo." );
		});
		}
	});
});
</script>
	  <div class="pl_head">
		This is a description of the pipeline
		</div>
		<div id="tabs">
		  <ul>
			<li><a href="views/show_apps.php?s=1">In Production</a></li>
			<li><a href="views/show_apps.php?s=2">In Development</a></li>
			<li><a href="views/show_apps.php?s=4">Seeking a Team</a></li>
			<li><a href="views/show_apps.php?s=3">Wishlist</a></li>
		  </ul>
	    </div>
