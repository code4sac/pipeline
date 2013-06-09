<?
include('../inc.php');
$sql = new mysql();
$curl = new Curl();

$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
$query = "
	SELECT	apps.app_title
		,	apps.id
		,	apps.app_desc
		,	apps.img_url
    , apps.screenshot_url
		,	apps.production_date
		,	apps.date_added
    , apps.git_path
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
if($row->img_url == '') {
  $row->img_url = 'views/img/placeholder.png';
}

// gitHub API Calls - Gather info about repo
$git_api = 'https://api.github.com/repos/';
$git_api .= $row->git_path;
$git_url = 'http://www.github.com/'.$row->git_path;
$git_issues = $git_api.'/issues';
$issues    = json_decode($curl->get($git_issues));


?>
<script>
var google_id;
var user_name;
var app_id = '<?=$row->id;?>';

function joinTeam() {
  var uri = 'google_id='+google_id+'&name='+user_name+'&app_id='+app_id;
  //var res = ajaxPOST('ajax/add_team_member.php', uri);
  genericDialog('Join Team', 'views/team_member_form.php?'+uri);
  $('#joinBtn').unbind('click');
  $('#joinBtn').html('Leave Team');
  $('#joinBtn').click(function() {
    leaveTeam();
  });
  /*
  if(res > 0) {
    // member joined team!
    $('#joinBtn').html('Leave Team');
    ajaxGET('views/show_team_members.php?app_id='+app_id, 'team_members');
  }
  */
}
function leaveTeam() {
  var uri = 'google_id='+google_id+'&app_id='+app_id;
  if(confirm('Are you sure you want to leave the team?')) {
    ajaxPOST('ajax/leave_team.php', uri);
    show_team_members();
    $('#joinBtn').unbind('click');
    $('#joinBtn').html('Join Team');
    $('#joinBtn').click(function() {
      joinTeam();
    });
  }
}
function show_team_members() {
  ajaxGET('views/show_team_members.php?app_id='+app_id, 'team_members');
}
function check_team_member(google_id, app_id) {
  var ctm = ajaxGET('ajax/check_team_member.php?google_id='+google_id+'&app_id='+app_id);
  return ctm;
}
$(function() {
  var request = gapi.client.plus.people.get({'userId' : 'me'});
  request.execute( function(profile) {
    if(profile.displayName != undefined) {              // AUTHED = YES
      // Check here to see if user is team member.
      google_id = profile.id;
      user_name = profile.displayName;
      var member = check_team_member(profile.id, app_id);
      if(member.match(/true/)) {
        $('#joinBtn').unbind('click');
        $('#joinBtn').html('Leave Team');
        $('#joinBtn').click(function() {
          leaveTeam();
        });

      } else if (member.match(/false/)) {
        $('#joinBtn').unbind('click');
        $('#joinBtn').html('Join Team');
        $('#joinBtn').click(function() {
          joinTeam();
        });
      }
        $('#joinBtn').show();
    } else {                                            // AUTHED = NO
      $('#joinLogin').show();
    }
  });
  show_team_members();
});
</script>
<style>
.app_info th {
  text-align: right;
}

#centeredmenu {
float:left;
width:100%;
background:#fff;
overflow:hidden;
position:relative;
}
#centeredmenu ul {
clear:left;
float:left;
list-style:none;
margin:0;
padding:0;
position:relative;
left:50%;
text-align:center;
}
#centeredmenu ul li {
display:block;
float:left;
list-style:none;
margin:0;
padding:0;
position:relative;
right:50%;
}
#centeredmenu ul li a {
display:block;
margin:0 0 0 3px;
padding: 4px 10px;
background:#ddd;
color:#000;
text-decoration:none;
line-height:1.3em;
}
#centeredmenu ul li a:hover {
background:#369;
color:#fff;
}
#centeredmenu ul li a.active,
#centeredmenu ul li a.active:hover {
color:#fff;
background:#000;
font-weight:bold;
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
 <div id="repo_info">
  <div id="centeredmenu">
   <ul>
    <li><a href="<?=$git_url;?>" target="_blank">Code</a></li>
    <li><a href="<?=$git_url.'/issues';?>" target="_blank">Issues (<? echo count($issues);?>)</a></li>
    <li><a href="" target="_blank">Things To Do</a></li>
    <li><a href="<?=$git_url.'/wiki';?>" target="_blank">Wiki</a></li>
   </ul>
  </div>
 </div>
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
 <br />
 <br />
 <div id="team_info">
  <span style="font-weight: bolder">Team Information</span>
  <button style="display: none; float: right;" id="joinBtn">jsUpdate</button>
  <div style="display: none; float: right;" id="joinLogin">Sign in to Join this team</div>
  <hr/>
  <div style="display: none;" id="userID"></div>
  <div style="display: none;" id="userName"></div>
  <div id="team_members"></div>
 </div>
</div>
<div style="clear: both;"></div>
</div>

