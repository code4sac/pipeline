<?
include('lib/html/head.php');
?>
<script type="text/javascript">
function OnLoadCallBack() {
  // I had to do some horrible stuff to make this work...
  // This gets called from js/oAuth.js->onSigninCallback. 
  ajaxGET('views/pipeline.php', 'main_container');
};
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
            data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email"
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
		<li><a href="#" onClick="javascript:ajaxGET('views/curls.php', 'main_container');">CURLS</a></li>
	  </ul>
	</div>
<!-- ============================================================== -->
<div id="maincontainer">
  <div id="contentwrapper">
	<div id="contentcolumn">
	  <div id="main_container" class="innertube">
		<!--TABS-->
    <div style="margin: 0 auto; height: 300px; background-color: #fff; width: 100%">
   <img src="views/img/icon-loading-animated.gif" /> 
    </div>
		<!--END TABS-->
	  </div>
	</div><!-- /#contentcolumn -->
  </div><!-- /#contentWrapper -->
  <div id="footer">By: Code for Sacramento</div>
</div><!-- /#maincontainer -->
<script type="text/javascript">
$(function() {
  // oAuth2.0 stuff
  var po = document.createElement('script');
  po.type = 'text/javascript'; po.async = true;
  po.src = 'https://plus.google.com/js/client:plusone.js';
  var s = document.getElementsByTagName('script')[0];

  s.parentNode.insertBefore(po, s);   // Run Check
  // End oAuth stuff.
  $('#gConnect').hide();
  $('#disconnect').hide();
});

</script>
</body>
</html>
