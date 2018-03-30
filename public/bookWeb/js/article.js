
$().ready(function(){

    window.textArr = []
    let screenWidth = $(window).width()
    let screenHeight = $(window).height()
    let footerShowDelta = 30

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

            // let tempArr = content.split("\n")
            // let newArr = []
            // let html = ""

            // console.log('====================================');
            // console.log(tempArr);
            // console.log('====================================');

            // tempArr.map((obj, index) => {
            //   newArr.push({text: obj, selected: false, index: index})
            //   if (obj == "") {
            //     html += "</br>"
            //   }else {
            //     html += "<span class='fragment' data-index="+ index +">"+ obj +"</span></br>"
            //   }
            // })

            // textArr = newArr

            $("#article").html(content)
            
            $("span.text").bind("taphold", function(event) {
                event.preventDefault()
                event.stopPropagation()
                console.log(this.dataset.index)
                let _this = $(this)
                if (_this.hasClass('marked')) {
                    _this.removeClass('marked')
                }else {
                    _this.addClass('marked')    
                }
            })

            $("span.text").bind("click", function(event) {
                //let endx = Math.floor(event.changedTouches[0].pageX)
                //let endy = Math.floor(event.changedTouches[0].pageY)
                event.preventDefault()
                event.stopPropagation()
                console.log('====================================');
                console.log(event);
                console.log('====================================');
                
                let $footer = $("#footer")
                if ($footer.hasClass('footer-show')) {
                    $footer.removeClass('footer-show')
                    footerResetStatus()
                }else {
                    $footer.addClass('footer-show')
                    showSizeBar()
                }
            })
        })
        
    }
    
    /*事件 */

    let footerResetStatus = function() {
        $("#footer").find('div').removeClass('footer-selected')
        $("#notes").hide(0)
        $("#share").hide(0)
    }

    let showSizeBar = function() {
        $("#notes").show(0)
        $("#share").show(0)
    }

    let showOperation = function(id) {
        switch (id) {
            case "fontButton":
                $('.font-operation').show(0)
                break;

            case "backButton":
                $('.back-operation').show(0)
                break;

            case "progressButton":
                
                break;

            case "collectionButton":
                
                break;
        
            default:
                break;
        }
    }

    $("#footer div").on("touchend", function(event){
        event.preventDefault()
        event.stopPropagation()
        $("#footer").find('div').removeClass('footer-selected')
        $(event.target).addClass('footer-selected')
        let id = $(this)[0]["id"]
        showOperation(id)
    })

    // $("#article").bind("tap", function(event) {
    //     //let endx = Math.floor(event.changedTouches[0].pageX)
    //     //let endy = Math.floor(event.changedTouches[0].pageY)
    //     event.preventDefault()
    //     event.stopPropagation()
    //     console.log('====================================');
    //     console.log(event);
    //     console.log('====================================');
        
    //     let $footer = $("#footer")
    //     if ($footer.hasClass('footer-show')) {
    //         $footer.removeClass('footer-show')
    //         footerResetStatus()
    //     }else {
    //         $footer.addClass('footer-show')
    //         showSizeBar()
    //     }
    // })

    $("#fontSlider").ionRangeSlider({
        type: "single",
        min: 0,
        max: 100,
        from: 50,
        keyboard: true,
        onStart: function (data) {
            console.log("onStart");
        },
        onChange: function (data) {
            console.log("onChange");
        },
        onFinish: function (data) {
            console.log("onFinish");
        },
        onUpdate: function (data) {
            console.log("onUpdate");
        }
    });

    
    
})

