<?
include('lib/html/head.php');
?>
<script type="text/javascript">
function doSearch() {
	var search_term = $('#search_term').val();
	ajaxGET('views/show_data.php?search=' + search_term, 'main_container');
}
$(function() {
	ajaxGET('views/pipeline.php', 'main_container');
	$('#search_term').keypress(function (e) {
		if(e.which == 13) {
			e.preventDefault();
			doSearch();
			$('#search_term').val('');
		}
	});
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
<!-- Main Menu 
================================================================ -->
<body>
    <div id="topsection">
      <div class="innertube">
		<span style="position: absolute; top: 3px; left: 50px;">
		<a href="/data">
		<img src="views/img/Logo-pipeline.png" />
		</a>
		</span>
		<span style="float: right; margin-top: 10px; margin-right: 10px;">
				<span style="">Search:</span> 
				<input id="search_term" class="frm_input" type="text" />
		</span>
	  </div>
    </div><!-- /#topsection -->
<!-- ============================================================ -->
	<div id="nav_menu">
	  <ul>
		<li><a href="/">CfS Home</a></li>
		<li><a href="/data">Data Portal</a></li>
		<li><a href="#" onClick="javascript:ajaxGET('views/about.html', 'main_container');">About</a></li>
		<li><a href="#" onClick="javascript:ajaxGET('views/help.html', 'main_container');">Help</a></li>
	  </ul>
	</div>
<!-- ============================================================== -->
<div id="maincontainer">
  <div id="contentwrapper">
	<div id="contentcolumn">
	  <div id="main_container" class="innertube">
		<!--TABS-->
		<!--END TABS-->
	  </div>
	</div><!-- /#contentcolumn -->
  </div><!-- /#contentWrapper -->
  <div id="footer">By: Code for Sacramento</div>
</div><!-- /#maincontainer -->
</body>
</html>
