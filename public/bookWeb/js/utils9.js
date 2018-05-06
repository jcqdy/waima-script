

let Utils = function() {

}

Utils.prototype.getQueryString = function() {
    var qs = location.search.substr(1), // 获取url中"?"符后的字串  
    args = {}, // 保存参数数据的对象
    items = qs.length ? qs.split("&") : [], // 取得每一个参数项,
    item = null,
    len = items.length
    
    for(var i = 0; i < len; i++) {
        item = items[i].split("=");
        var name = decodeURIComponent(item[0]),
        value = decodeURIComponent(item[1]);
        if(name) {
        args[name] = value;
        }
    }
    return args
}

Utils.prototype.showLoading = function () {
    $("#loading").show(0)
}

Utils.prototype.hideLoading = function () {
    $("#loading").hide(0)
}

Utils.prototype.showPrompt = (title, text, leftText, rightText, confirmCallback, cancelCallback) => {
    $(".prompt-content-title").text(title)
    $(".prompt-content-text").text(text)
    $(".prompt-operation-left").text(leftText).bind("tap", cancelCallback)
    $(".prompt-operation-right").text(rightText).bind("tap", confirmCallback)
    $(".prompt").show(0)
}

Utils.prototype.hidePrompt = () => {
    $(".prompt").hide(0)
    $(".prompt-content-title").text("")
    $(".prompt-content-text").text("")
    $(".prompt-operation-left").text("").unbind("tap")
    $(".prompt-operation-right").text("").unbind("tap")
}

Utils.prototype.showToast = (text, success) => {

    if (success) {
        $('.toast-content').removeClass('hidden')
    }else {
        $('.toast-content').addClass('hidden')
    }
    $('.toast-text').text(text)
    $(".toast").fadeIn(200)

    setTimeout(() => {
        $(".toast").fadeOut(200)
    }, 1500)
}

window.utils = new Utils()

let queryStrings = utils.getQueryString()
window.globalData = JSON.parse(queryStrings['globalData'])
