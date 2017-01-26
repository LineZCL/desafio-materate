
    var restPost = function(urlS, dataJson, cbSuccess, cbFail){
        $.ajax({
            url: urlS, 
            type: 'POST', 
            contentType: 'application/json', 
            data: JSON.stringify( dataJson ),
            dataType: 'json',
            cache: true,
            success: function (data) {
                cbSuccess(data);
            },
            error: function(jqXHR, status, error){
                cbFail(error);
            }
        });
    }

    var restGet = function(urlS, cbSuccess, cbFail){
        $.ajax({
            url: urlS,
            type: "GET",
            cache: true,  
            success: function(data){
                cbSuccess(data);
            },
            error: function(jqXHR, status, error){
                cbFail(error);
            }
        });

    }


