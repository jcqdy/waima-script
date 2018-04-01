
$().ready(function(){

    window.textArr = []
    let screenWidth = $(window).width()
    let screenHeight = $(window).height()
    let footerShowDelta = 30
    let $allTextSpan = null
    let $article = $("#article")
    let $footer = $("#footer")
    let currentSelectedText = []
    let $body = $("body")

    let data = JSON.parse(decodeURI(window.location.href).split(".html?")[1].split("article=")[1])

    window.server.scriptFetch({
        scriptId: data.scriptId
    }, function(res) {
        if (res.status == 200) {
            scriptFileFetch(res.data.script.fileUrl)
        }
    })

    let scriptFileFetch = function(url) {

        window.server.scriptFileFetch(url, function(res) {
            let content = res

            $article.html(content)
            $allTextSpan = $("#article span.text")

            for(let i=0; i < $allTextSpan.length; i++) {
                $item = $($allTextSpan[i])
                $item.data("index", i)
            }
            
            $allTextSpan.bind("longTap", function(event) {
                event.stopPropagation()
                let _this = $(this)
                let index = _this.data().index
                if (_this.hasClass('text-selected')) {
                    // _this.removeClass('text-selected')
                    // $("#writeNoteButton").hide(0)
                    // currentSelectedText = currentSelectedText.filter((obj) => {
                    //     return obj.index != index
                    // })
                }else {
                    _this.addClass('text-selected')   
                    $("#writeNoteButton").show(0)
                    footerResetStatus()
                    currentSelectedText.push({index: index, text: _this.text()})
                    $article.unbind("click")
                }
            })

            $allTextSpan.bind("click", function() {
                
                let _this = $(this)
                let index = _this.data().index
                if (_this.hasClass('text-selected')) {
                    _this.removeClass('text-selected')
                    currentSelectedText = currentSelectedText.filter((obj) => {
                        return obj.index != index
                    })

                    if (currentSelectedText.length <= 0) {
                        $("#writeNoteButton").hide(0)
                        setTimeout(function(){
                            bindArticleClick()
                        }, 500)
                    }
                }
            })

        })
        
    }
    
    /*事件 */

    var bindArticleClick = function() {
        $article.bind("click", function(event) {

            if (currentSelectedText.length > 0) {
                //$currentSelectedText.trigger("longTap")
                //$currentSelectedText = null
            }else {
                if ($footer.hasClass('footer-show')) {
                    $footer.removeClass('footer-show')
                    footerResetStatus()
                }else {
                    $footer.addClass('footer-show')
                    showSideBar()
                    updateProgress()
                }
            }
        })
    }

    let footerResetStatus = function() {
        $footer.removeClass('footer-show')
        $footer.find('div').removeClass('footer-selected')
        $("#notes").hide(0)
        $("#share").hide(0)
        resetFooterOperation()
    }

    let resetFooterOperation = function() {
        $(".font-operation").removeClass('operation-show')
        $(".back-operation").removeClass('operation-show')
        $(".progress-operation").removeClass('operation-show')
    }

    let showSideBar = function() {
        $("#notes").show(0)
        $("#share").show(0)
    }

    let showOperation = function(id) {
        switch (id) {
            case "fontButton":
                resetFooterOperation()
                $('.font-operation').addClass('operation-show')
                break;

            case "backButton":
                resetFooterOperation()
                $('.back-operation').addClass('operation-show')
                break;

            case "progressButton":
                resetFooterOperation()
                $('.progress-operation').addClass('operation-show')
                break;

            case "collectionButton":
                resetFooterOperation()
                break;
        
            default:
                break;
        }
    }

    $("#footer div").on("touchend", function(event){
      
        $footer.find('div').removeClass('footer-selected')
        $(event.target).addClass('footer-selected')
        let id = $(this)[0]["id"]
        showOperation(id)
    })

    $article.bind("touchmove", function(event) {
        footerResetStatus()
    })

    $("#fontSlider").ionRangeSlider({
        type: "single",
        min: 0,
        max: 100,
        from: 20,
        step: 25,
        onStart: function (data) {
            
        },
        onChange: function (data) {
            // let from = data.from
            // $article.removeClass("f0 f25 f50 f75 f100")
            // $article.addClass("f" + from)
        },
        onFinish: function (data) {
            let from = data.from
            $article.removeClass("f0 f25 f50 f75 f100")
            $article.addClass("f" + from)
        }
    })

    $("#progressSlider").ionRangeSlider({
        type: "single",
        min: 0,
        max: 100,
        from: 20,
        onStart: function (data) {

        },
        onChange: function (data) {
            // let from = data.from
            // $article.removeClass("f0 f25 f50 f75 f100")
            // $article.addClass("f" + from)
        },
        onFinish: function (data) {
            let from = data.from
            let totalHeight = $("html").height()
            let scrollToHeight = totalHeight * from / 100
            $("html").scrollTop(scrollToHeight)
        }
    })

    var progressSlider = $("#progressSlider").data("ionRangeSlider")

    var updateProgress = function() {
        let currentOffset = $("html").scrollTop()
        let totalHeight = $("html").height()

        let from = Math.floor(currentOffset / totalHeight * 100)
        
        progressSlider.update({
            min: 0,
            max: 100,
            from: from
        })
    }

    $(".back-content div").bind("tap", function() {
        event.stopPropagation()

        let id = $(this)[0]["id"]
        $body.removeClass("back-white back-yellow back-green back-black")
        $article.removeClass("text-color-white")
        switch (id) {
            case "backWhite":
                $body.addClass("back-white")
                break;

            case "backYellow":
                $body.addClass("back-yellow")
                break;

            case "backGreen":
                $body.addClass("back-green")
                break;

            case "backBlack":
                $body.addClass("back-black")
                $article.addClass("text-color-white")
                break;
        
            default:
                break;
        }
    })

})

