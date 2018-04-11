
$().ready(function(){

    window.currentSelectedText = []
    window.noteMarks = []

    let screenWidth = $(window).width(),
        screenHeight = $(window).height(),
        footerShowDelta = 30,
        $allTextSpan = null,
        $article = $("#article"),
        $footer = $("#footer"),
        $footerOperation = $(".footer-operation"),
        $fontButton = $("#fontButton"),
        $backButton = $("#backButton"),
        $progressButton = $("#progressButton"),
        $body = $("body"),
        puStatus = {
            readPos: 1.0,
            fontSize: Number(globalData.userInfo.fontSize),
            backColor: Number(globalData.userInfo.backColor)
        },
        isLoading = false

    let queryStrings = utils.getQueryString()
    window.article = JSON.parse(queryStrings['article'])

    //上报阅读记录
    setTimeout(function() {
        window.server.readRecord({
            userId: globalData.userInfo.userId,
            scriptId: article.scriptId
        }, function(res) {
          
        })
    }, 1500)
    

    //更新用户阅读状态
    let updatePuStatus = (status) => {

        puStatus = status
        let newData = Object.assign({
            userId: globalData.userInfo.userId,
            scriptId: article.scriptId
        }, puStatus)

        window.server.putStatus(newData, function(res) {
            
        })
    }
    
    //数据请求
    window.server.scriptFetch({
        scriptId: article.scriptId
    }, function(res) {
        if (res.status == 200) {
            console.log('====================================');
            console.log(res);
            console.log('====================================');
            if (res.data.script.inBookCase) {
                $collectionButton.addClass('footer-selected')
            }
            noteMarks = res.data.script.noteMark
            scriptFileFetch(res.data.script.fileUrl)
        }
    })

    var assembleMark

    let scriptFileFetch = function(url) {

        window.server.scriptFileFetch(url, function(res) {
            let content = res

            $article.html(content)
            $allTextSpan = $("#article span.text")

            let indexArr = []
            noteMarks.map((obj, index) => {
                let markId = obj.markId
                markId.map((id) => {
                    $allTextSpan.eq(Number(id)).addClass('text-marked').data("note", obj)
                })
            })

            for(let i=0; i < $allTextSpan.length; i++) {
                $item = $($allTextSpan[i])
                $item.data("index", i)
            }
            
            $allTextSpan.bind("longTap", function(event) {
                event.stopPropagation()
                let _this = $(this)
                let index = _this.data().index
                if (!_this.hasClass('text-selected') && !_this.hasClass('text-marked')) {
                    _this.addClass('text-selected')   
                    $("#writeNoteButton").show(0)
                    footerResetStatus()
                    currentSelectedText.push({index: index, text: _this.html()})
                    $article.unbind("click")
                }
            })

            $allTextSpan.bind("click", function(e) {
                
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

                }else if(_this.hasClass('text-marked')) {
                    event.stopPropagation()
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

    bindArticleClick()

    //状态重置
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

    //底部菜单样式变化
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

    //点击底部菜单
    $("#footer div").on("touchend", function(event){
        let id = $(this)[0]["id"]
        if (id != 'collectionButton') {

            $fontButton.removeClass('footer-selected')
            $backButton.removeClass('footer-selected')
            $progressButton.removeClass('footer-selected')
            $(event.target).addClass('footer-selected')
            showOperation(id)

        }else {
            
            if (isLoading) return
            isLoading = true
            window.utils.showLoading()

            if ($(this).hasClass('footer-selected')) {
                
                $(this).removeClass('footer-selected')
                window.server.unCollectionBook({
                    userId: globalData.userInfo.userId,
                    scriptIds: article.scriptId
                }, function(res) {
                    window.utils.hideLoading()
                    isLoading = false
                })
            }else {
                $(this).addClass('footer-selected')
                window.server.collectionBook({
                    userId: globalData.userInfo.userId,
                    scriptId: article.scriptId
                }, function(res) {
                    window.utils.hideLoading()
                    isLoading = false
                })
            }
        }
    })

    $article.bind("touchmove", function(event) {
        footerResetStatus()
    })

    //字体控制
    $("#fontSlider").ionRangeSlider({
        type: "single",
        min: 12,
        max: 20,
        from: 12 ,
        step: 2,
        onStart: function (data) {
            
        },
        onChange: function (data) {
            // let from = data.from
            // $article.removeClass("f0 f25 f50 f75 f100")
            // $article.addClass("f" + from)
        },
        onFinish: function (data) {
            let from = data.from
            $article.removeClass("f12 f14 f16 f18 f20")
            $article.addClass("f" + from)
            updatePuStatus(Object.assign(puStatus, {fontSize: Number(from)}))
        }
    })

    var fontSlider = $("#fontSlider").data("ionRangeSlider")

    //进度控制
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

    
    //点击切换背景颜色
    $(".back-content div").bind("tap", function() {
        event.stopPropagation()        

        let id = $(this)[0]["id"]
        $body.removeClass("back-white back-yellow back-green back-black")
        $footer.removeClass("back-white back-yellow back-green back-black")
        $footerOperation.removeClass("back-white back-yellow back-green back-black")
        $article.removeClass("text-color-white")
        $(".back-content div").removeClass("back-selected")
        $(this).addClass("back-selected")

        switch (id) {
            case "backWhite":
                $body.addClass("back-white")
                $footer.addClass("back-white")
                $footerOperation.addClass("back-white")
                updatePuStatus(Object.assign(puStatus, {backColor: 1}))
                break;

            case "backYellow":
                $body.addClass("back-yellow")
                $footer.addClass("back-yellow")
                $footerOperation.addClass("back-yellow")
                updatePuStatus(Object.assign(puStatus, {backColor: 2}))
                break;

            case "backGreen":
                $body.addClass("back-green")
                $footer.addClass("back-green")
                $footerOperation.addClass("back-green")
                updatePuStatus(Object.assign(puStatus, {backColor: 3}))
                break;

            case "backBlack":
                $body.addClass("back-black")
                $article.addClass("text-color-white")
                $footer.addClass("back-black")
                $footerOperation.addClass("back-black")
                updatePuStatus(Object.assign(puStatus, {backColor: 4}))
                break;
        
            default:
                break;
        }
    })

    //初始化UI
    let initStatus = (() => {

        let backcolorIndex = puStatus.backColor - 1
        $(".back-content div:eq("+ backcolorIndex +")").addClass("back-selected")

        switch (backcolorIndex) {
            case 0:
                $body.addClass("back-white")
                $footer.addClass("back-white")
                $footerOperation.addClass("back-white")
                break;

            case 1:
                $body.addClass("back-yellow")
                $footer.addClass("back-yellow")
                $footerOperation.addClass("back-yellow")
                break;

            case 2:
                $body.addClass("back-green")
                $footer.addClass("back-green")
                $footerOperation.addClass("back-green")
                break;

            case 3:
                $body.addClass("back-black")
                $article.addClass("text-color-white")
                $footer.addClass("back-black")
                $footerOperation.addClass("back-black")
                break;
        }

        fontSlider.update({
            min: 12,
            max: 20,
            from:  Number(puStatus.fontSize),
            step: 2
        })

        $article.removeClass("f12 f14 f16 f18 f20")
        $article.addClass("f" + puStatus.fontSize)

    })()

    $("#share").bind("tap", function() {
        wx.miniProgram.navigateTo({
            url:"../share/share?article=" + JSON.stringify(article)
        })
    })

})

