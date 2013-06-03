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
          helper.profile();
          helper.people();
        } else if (authResult['error']) {
          console.log('oAuth: authResult->error');
          // There was an error, which means the user is not signed in.
          // As an example, you can handle by writing to the console:
          console.log('There was an error: ' + authResult['error']);
          $('#gConnect').show();
        }
        console.log('authResult', authResult);
      });
    },

    /**
     * Calls the OAuth2 endpoint to disconnect the app for the user.
     */
    disconnect: function() {
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
     * Gets and renders the list of people visible to this app.
     */
    people: function() {
      var request = gapi.client.plus.people.list({
        'userId': 'me',
        'collection': 'visible'
      });
      request.execute(function(people) {
        $('#visiblePeople').empty();
        $('#visiblePeople').append('Number of people visible to this app: ' +
            people.totalItems + '<br/>');
        for (var personIndex in people.items) {
          person = people.items[personIndex];
          $('#visiblePeople').append('<img src="' + person.image.url + '">');
        }
      });
    },

    /**
    *
     */
     getName: function() {
      var request = gapi.client.plus.people.get({'userId' : 'me'});
      request.execute( function(profile) {
        return profile;
      });
     },
     joinTeam: function() {
      var request = gapi.client.plus.people.get({'userId' : 'me'});
      request.execute( function(profile) {
        alert(profile.displayName);
      });
     },
    /**
     * Gets and renders the currently signed in user's profile data.
     */
    profile: function(){
      var request = gapi.client.plus.people.get( {'userId' : 'me'} );
      request.execute( function(profile) {
        $('#profile').empty();
        if (profile.error) {
          $('#profile').append(profile.error);
          return;
        }
        //$('#userInfo').append(
//            $('<img src=\"' + profile.image.url + '\">'));
        $('#userInfo').append('Signed in as: '+profile.displayName);
        if (profile.cover && profile.coverPhoto) {
          $('#userInfo').append(
              $('<p><img src=\"' + profile.cover.coverPhoto.url + '\"></p>'));
        }
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
