(function($){
$('#btnLogin').click(function(){
    var username = $('#txtUsername').val();
    var password = $('#txtPassword').val();
    $('#txtUsername').prop('disabled', true);
    $('#txtPassword').prop('disabled', true);
    $(this).prop('disabled', true);
    $('#loginError').slideUp();
    var loadingImg = $('<div class="login-wait"><img src="/assets/images/loader4.gif"/></div>');
    $('#divBody').prepend( loadingImg );

    $.ajax({
      url: ajax_login_url,
      dataType: "json",
      method: 'POST',
      data: {
        username: username,
        password: password 
      },
      success: function( data ) {
        if( data.loggedIn ) {
          window.location.href = data.next_url;
        } else {
          loadingImg.remove();
          $('#txtUsername').prop('disabled', false);
          $('#txtPassword').prop('disabled', false);
          $('#btnLogin').prop('disabled', false);
          $('#divBody').prepend( $('<div class="alert alert-danger" id="loginError">Unable to login!</div>') );
        }
      }
    });
});
$('.enter-submit').keyup(function(evt){
  if( evt.keyCode == 13 ) {
    $('#btnLogin').trigger('click');
  }
});
})(jQuery);