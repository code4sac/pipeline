<?
include('lib/html/head.php');
?>
<script type="text/javascript">
function doSearch() {
	var search_term = $('#search_term').val();
	ajaxGET('views/show_data.php?search=' + search_term, 'main_container');
}
$(function() {
  $('#gConnect').hide();
  $('#disconnect').hide();
	ajaxGET('views/pipeline.php', 'main_container');
	$('#search_term').keypress(function (e) {
		if(e.which == 13) {
			e.preventDefault();
			doSearch();
			$('#search_term').val('');
		}
	});
  // oAuth2.0 stuff
  var po = document.createElement('script');
  po.type = 'text/javascript'; po.async = true;
  po.src = 'https://plus.google.com/js/client:plusone.js';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(po, s);
  $('#disconnect').click(helper.disconnect);
  // End oAuth stuff.
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
        <div style="float:left;" id="userInfo"></div>
        <!-- oAuth -->
        <div id="gConnect" style="float: right;">
          <button class="g-signin"
            data-scope="https://www.googleapis.com/auth/plus.login"
            data-requestvisibleactions="http://schemas.google.com/AddActivity"
            data-clientId="377499120081-d6ohp7ebt8fflcq4rcs2bah3u1hljggl.apps.googleusercontent.com"
            data-callback="onSignInCallback"
            data-theme="dark"
            data-cookiepolicy="single_host_origin">
          </button>
          <button id="disconnect">Disconnect</button>
        </div>
        <!-- /oAuth -->
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
