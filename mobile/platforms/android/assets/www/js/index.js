
    var restPost = function(urlS, dataJson, cb){
        $.ajax({
            url: urlS, 
            type: 'POST', 
            contentType: 'application/json', 
            data: JSON.stringify( dataJson ),
            dataType: 'json',
            success: function (data) {
                cb(data);
            },
            error: function(jqXHR, status, error){
                console.log(urlS);
                console.log(error); 
                console.log(jqXHR); 
            }
        });
    }

$(document).ready(function(){
        $( "#btnLogin" ).click(function() {
            var email = $("#email").val(); 
            var password = $("#password").val(); 
            var user = { };
            user ["email"] = email; 
            user ["password"] = password; 
            restPost("http://192.168.0.17:8000/api/login/", user, function(responseJson) {
                alert("autenticado");
            });
        });
    }); 
