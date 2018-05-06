
let root = "https://script-test.ekaogo.com"
let jsonp = true

let request = function(url, data, callback) {

    window.globalData.appName

    data = Object.assign(data, {appName:window.globalData.appName, 
        appVersion:window.globalData.appVersion, 
        platform:window.globalData.platform, 
        userId: window.globalData.userInfo.userId})

    if (jsonp) {
        Zepto.ajax({
            type: "GET",
            url: url,
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
                callback && callback(xhr)
            }

        })
    }else {
        Zepto.ajax({
            type: data?"POST":"GET",
            url: url,
            dataType: 'json',
            data: data?data:{},
            timeout: 3000,
            success: function(data){
                callback && callback(data)
            },
            error: function(xhr, type){
                callback && callback(xhr)
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
    Zepto.ajax({
        type: 'GET',
        url: url,
        dataType: 'json',
        timeout: 3000,
        success: function(data){
         
            //callback && callback(data)
        },
        error: function(xhr, type){
            if (xhr.response) {
                callback && callback(xhr.response)
            }
        },

        complete: function(data) {
            // if (data.responseText) {
            //     callback && callback(data.responseText)
            // }
        }
    })
}

a.readRecord = function(data, callback) {
	request(root + "/user/user/readRecord", data, callback, "POST")
}

a.putStatus = function(data, callback) {
	request(root + "/read/script/putStatus", data, callback, "POST")
}

a.collectionBook = function(data, callback) {
	request(root + "/read/bookCase/add", data, callback, "POST")
}

a.unCollectionBook = function(data, callback) {
	request(root + "/read/bookCase/delete", data, callback, "POST")
}

a.fetchPkgList = function(callback) {
	request(root + "/read/collect/pkgList", {}, callback, "POST")
}

a.addPkg = function(data, callback) {
	request(root + "/read/collect/addPkg", data, callback, "POST")
}

a.addCollect = function(data, callback) {
	request(root + "/read/collect/add", data, callback, "POST")
}

a.editNote = function(data, callback) {
	request(root + "/read/noteMark/editNote", data, callback, "POST")
}

a.addNote = function(data, callback) {
	request(root + "/read/noteMark/addNote", data, callback, "POST")
}

a.collectDel = function(data, callback) {
	request(root + "/read/collect/del", data, callback, "POST")
}

a.noteDel = function(data, callback) {
	request(root + "/read/noteMark/del", data, callback, "POST")
}

window.server = new window.Server()