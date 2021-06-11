$(document).ready(function() {
    var logged = $('#logged').text();
    if (logged == '1') {
        $("#logged").attr('href', './');
        $("#logged")[0].click();
    }
});

const statuss = {
    0: 'Username not available',
    1: 'Logged in',
    2: 'Incorrect password'
};

function checkLogin() {
    event.preventDefault();
    var uname = $('#userid');
    var upwd = $('#userpwd');
    if (!uname.val()) {
        alert('Please Enter Username');
        uname.focus();
        return
    }
    if (!upwd.val()) {
        alert('Please Enter Password');
        upwd.focus()
        return
    }

    $.post({
        url: './loginOpe.php',
        data: {
            username: uname.val(),
            password: upwd.val()
        },
        success: function(data, status, xhr) {
            // console.log(statuss[JSON.parse(data).result])
            data = JSON.parse(data);
            if (data.result == 1) {
                $('#frmLogin').attr('action', './');
                $('#frmLogin').submit();
            } else {
                alert(statuss[data.result]);
                $('#frmLogin').attr('action', './');
            }
        }
    })
}