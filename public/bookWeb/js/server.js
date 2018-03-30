
let root = "https://script-test.ekaogo.com"
let jsonp = true

let request = function(url, data, callback) {

    data = Object.assign(data, {appName:'waima-script', appVersion:'1.0', platform:'ios', userId: '5a9bb12f50cc87d908cde1ab'})
    if (jsonp) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            data: data?data:{},
            //async:false,
            dataType: 'jsonp',
            jsonp:"callback",
            jsonpCallback:"success_jsonpCallback",
            timeout: 3000,
            success: function(data){
                callback && callback(data)
            },
            error: function(xhr, type){
                console.log(xhr.response)
            }

        })
    }else {
        $.ajax({
            type: data?"POST":"GET",
            url: url,
            dataType: 'json',
            data: data?data:{},
            timeout: 3000,
            success: function(data){
                callback && callback(data)
            },
            error: function(xhr, type){
                console.log(xhr.response)
            }
        })
    }
}

window.Server = function() {}

var a = Server.prototype

a.scriptFetch = function(data, callback) {
	request(root + "/read/script/fetch", data, callback, "POST")
}

a.scriptFileFetch = function(url, callback) {
    $.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        timeout: 3000,
        success: function(data){
         
            //callback && callback(data)
        },
        error: function(xhr, type){
          

        },
        complete: function(data) {
            if (data.responseText) {
                callback && callback(data.responseText)
            }
        }
    })
}

window.server = new window.Server()