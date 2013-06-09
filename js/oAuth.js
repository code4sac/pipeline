var helper = (function() {
  var BASE_API_PATH = 'plus/v1/';
  return {
    /**
     * Hides the sign in button and starts the post-authorization operations.
     *
     * @param {Object} authResult An Object which contains the access token and
     *   other authentication information.
     */
    onSignInCallback: function(authResult) {
      gapi.client.load('plus','v1', function(){
        console.log('oAuth: Callback');
        if (authResult['access_token']) {
          console.log('oAuth: found access_token');
          // Found access token, hide login button.
          $('#gConnect').hide();
          $('#joinBtn').show();
          $('#joinLogin').hide();
          helper.profile();
          OnLoadCallBack(); //
          //helper.addUser();
        } else if (authResult['error']) {
          OnLoadCallBack(); //
          console.log('oAuth: authResult->error');
          // There was an error, which means the user is not signed in.
          // As an example, you can handle by writing to the console:
          console.log('There was an error: ' + authResult['error']);
          $('#gConnect').show();
        }
      });
    },

    /**
     * Calls the OAuth2 endpoint to disconnect the app for the user.
     */
    disconnect: function() {
      console.log('disconnecting');
      // Revoke the access token.
      $.ajax({
        type: 'GET',
        url: 'https://accounts.google.com/o/oauth2/revoke?token=' +
            gapi.auth.getToken().access_token,
        async: false,
        contentType: 'application/json',
        dataType: 'jsonp',
        success: function(result) {
          console.log('revoke response: ' + result);
          $('#authOps').hide();
          $('#profile').empty();
          $('#visiblePeople').empty();
          $('#authResult').empty();
          $('#gConnect').show();
        },
        error: function(e) {
          console.log(e);
        }
      });
    },

    /**
     * Add user to SQL database on Login
     */
    addUser: function() {
      var request = gapi.client.plus.people.get( {'userId' : 'me'} );
      request.execute( function(profile) {
        // Add user to team_members
        //alert(profile.email);
        var uri = 'google_id='+profile.id+'&name='+profile.displayName;
        var member_exists = checkField('team_members', 'google_id', profile.id);
        if(member_exists > 0) {
          genericDialog('New User', 'views/add_user_form.php?'+uri);
        }
        //var res = ajaxPOST('ajax/add_user.php', uri);
        //if(res > 0) {
        //  alert('Welcome '+profile.displayName+', you can now join teams!');
       // }
      });
    },

    /**
     *  Get Name
     */
     getName: function() {
      var request = gapi.client.plus.people.get({'userId' : 'me'});
      request.execute( function(profile) {
        return profile;
      });
     },
     /**
      * Join Team
      */
     joinTeam: function() {
      var request = gapi.client.plus.people.get({'userId' : 'me'});
      request.execute( function(profile) {
        //alert(profile.displayName);
      });
     },
    /**
     * Gets and renders the currently signed in user's profile data.
     */
    profile: function(){
      var request = gapi.client.plus.people.get( {'userId' : 'me'} );
      request.execute( function(profile) {
       // alert(profile['email']);
        var stuff;
        for( var key in profile) {
          stuff = stuff + key +'\n' + profile[key]+"\n\n";
        }
        //alert(stuff);
        $('#profile').empty();
        if (profile.error) {
          $('#profile').append(profile.error);
          return;
        }
        $('#userInfo').append('Signed in as: '+profile.displayName);
        $('#disconnect').show();
      });
    }
  };
})();

/**
 * jQuery initialization
 */
$(document).ready(function() {
  $('#disconnect').click(helper.disconnect);
  $('#loaderror').hide();
});

/**
 * Calls the helper method that handles the authentication flow.
 *
 * @param {Object} authResult An Object which contains the access token and
 *   other authentication information.
 */
function onSignInCallback(authResult) {
  helper.onSignInCallback(authResult);
}
