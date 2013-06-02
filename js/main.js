// html request. My standard.
function ajaxGET(url, outDiv) {
  console.log('AJAX->GET: '+url+' => '+outDiv);
  var retVal;
  $.ajax({
    url: url,
    type: 'GET',
    async: false,
    success: function(data, stat, jqXHR) {
      $('#' + outDiv).html(data);
      retVal = data;
    }
  });
  return retVal;
}

function ajaxPOST(url, uri) {
  console.log('AJAX->POST: '+url);
  var retVal;
  $.ajax({
    url: url,
    data: uri,
    type: 'POST',
    async: false,
    success: function(data, stat, jqXHR) {
      retVal = data;
    }
  });
  return retVal;
}

function ajaxFormPOST(url, e) {
  console.log('AJAX->FORM::POST: '+url);
  var uri = encodeURI($(e).serialize());
  console.log(uri);
  var retVal;
  $.ajax({
    url: url,
    data: uri,
    type: 'POST',
    async: false,
    success: function(data, stat, jqXHR) {
      retVal = data;
    }
  });
  return retVal;
}

// Utility Dialog
function genericDialog(title, url) {
	var formBody = $('<div>', {
		title: title,
		id: 'utilDialog'
	});

  var data = ajaxGET(url);
	formBody.html(data);
	formBody.dialog({
		height: 400,
		width: 750,
		show: 'fade',
		close: function() {
			$(this).remove();
		},
		buttons: {
			'Close': function() {
				$(this).effect('fade', function() {
					$(this).remove();
				});
			}
		}
	});
}
