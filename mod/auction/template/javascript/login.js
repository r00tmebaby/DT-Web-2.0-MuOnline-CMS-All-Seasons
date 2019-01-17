$(function() {
    $('#login').click(function() {
        var username = $("#username").val();
        var password = $("#password").val();

        if (username.length > 2 && password.length > 2) {
            $.ajax({
                type: "POST",
                url: "./",
                data: {
                    login: "logMeIn",
                    user: username,
                    pass: password
                }
            }).done(function(status) {
                $("#login_response").fadeOut(500).html(status).fadeIn(500);
            });
        } else {
            $("#login_response").fadeOut(500).html("Моля, въведете потребителско име и парола.").fadeIn(500);
        }

        return false;
    });
});