$(document).ready(function(){
    $('#sign_in_btn').click(function() {
        $('#sign_up_detail').css('display', 'none');
        $('#sign_in_detail').css('display', 'block');
        $('#sign_up_div').css('display', 'none');
        $('#sign_in_div').css('display', 'block');
    })
    $('#back_to_sign_up').click(function() {
        $('#sign_up_detail').css('display', 'block');
        $('#sign_in_detail').css('display', 'none');
        $('#sign_up_div').css('display', 'block');
        $('#sign_in_div').css('display', 'none');
    })
    $('#forgot_password').click(function() {
        console.log('sdf')
        $('#password_reset_anchor')[0].click();
    })
})