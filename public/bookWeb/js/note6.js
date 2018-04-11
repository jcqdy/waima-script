
$().ready(function() {

    let isLoading = false,
        noteStatus = 0, //0为新增，1为编辑
        pkgId = "",
        noteId = null,
        article = window.article,
        asyncNote = {}

    let $noteContainer = $("#noteContainer"),
        $noteBack = $("#noteBack"),
        $writeNoteButton = $("#writeNoteButton"),
        $markText = $("#markText"),
        $iconStar = $(".icon-star"),
        $collectionText = $(".collection-text"),
        $iconPlant = $(".icon-plant"),
        $noteTextarea = $("#noteTextarea"),
        $folderMaskCreate = $("#folderMaskCreate"),
        $folderMaskSelectContent = $("#folderMaskSelectContent"),
        $folderMaskCreateContent = $("#folderMaskCreateContent"),
        $folderMaskClose = $("#folderMaskClose"),
        $folderMask = $("#folderMask"),
        $folderMaskCreateConfirm = $("#folderMaskCreateConfirm"),
        $folderMaskCreateInput = $("#folderMaskCreateInput"),
        $foldersWrap = $(".folder-mask-folders-wrap")

        var fetchPkgList = () => {
            
            if (isLoading) return
            isLoading = true
            window.utils.showLoading()

            window.server.fetchPkgList(function(res) {
                isLoading = false
                window.utils.hideLoading()
                if (res.status == 200) {
                    let html = ""
                    res.data.map((obj, index) => {
                        html += '<div class="folder-mask-folders-item" data-id='+ obj.pkgId +'>'+ obj.name +'</div>'
                    })
                    $foldersWrap.html(html)
                }
            })
        }

    window.setTimeout(fetchPkgList, 1000)

    
    let initPageUI = (status, note) => {

        if (status == 0) {

            pkgId = ""
            noteId = null
            $collectionText.addClass("disable")
            $iconStar.addClass("disable")
            $iconPlant.addClass("disable")
            $("#noteTextarea").focus()

        }else {

            pkgId = note.pkgId
            noteId = note.noteId
            $("#noteTextarea").val(note.note)
            $collectionText.removeClass("disable")
            $iconStar.removeClass("disable")
            $iconPlant.removeClass("disable")
            if (note.pkgId.length > 0) {
                $collectionText.addClass("selected")
                $iconStar.addClass("selected")
            }
        }
    }

    let resetPageUI = () => {
        $("body, html").removeClass("body-modal")
        $noteContainer.hide(0)
        $collectionText.addClass("disable").removeClass('selected')
        $iconStar.addClass("disable").removeClass('selected')
        $iconPlant.addClass("disable")
        $("#noteTextarea").val("")
    }

    //打开笔记界面
    $writeNoteButton.bind("tap", function() {

        noteStatus = 0
        initPageUI(noteStatus)

        let marks = []
        window.currentSelectedText.map((obj, index) => {
            marks.push(obj.text)
        })

        let marksString = marks.join("</br>")

        $markText.html(marksString)

        $noteContainer.show(0, function() {
            $("body, html").addClass("body-modal")
            $noteContainer.animate({
                top: 0
            }, 300)
        })
        
    })

    //数据同步
    var asyncData = (pkgId) => {

        let $articleSpan = $("#article span.text")
        console.log('====================================');
        console.log(asyncNote);
        console.log('====================================');
        asyncNote.markId.map((id, index) => {
            $articleSpan.eq(Number(id)).data("note", Object.assign(asyncNote, {pkgId: pkgId}))
        })
    }

    var addData = (data) => {
        let $articleSpan = $("#article span.text")
        let note = {
            noteId: data.noteId,
            markId: data.markId,
            note: data.note,
            pkgId: data.pkgId
        }
        window.noteMarks.push(note)
        window.currentSelectedText = []
        $("#writeNoteButton").hide(0)
        data.markId.map((id) => {
            $articleSpan.eq(Number(id)).data("note", note).removeClass('text-selected').addClass('text-marked')
        })
    }

    //选择收藏文件夹
    $(document).on("tap", ".folder-mask-folders-item", (e) => {

        pkgId = $(e.target).data("id")

        if (noteId != null) {

            if (isLoading) return
            isLoading = true
            window.utils.showLoading()
            window.server.addCollect({
                pkgId: pkgId,
                noteId: noteId
            }, (res) => {

                window.utils.hideLoading()
                isLoading = false
                if (res.status == 200) {
                    $iconStar.addClass('selected')
                    $collectionText.addClass('selected')
                    resetMaskUI()
                    asyncData(pkgId)
                }else {
                    console.log('====================================');
                    console.log(res);
                    console.log('====================================');
                }

            })

        }else {
            $iconStar.addClass('selected')
            $collectionText.addClass('selected')
            resetMaskUI()
        }
    })

    $(document).on("tap", "#article span.text.text-marked", (e) => {
        e.stopPropagation()
        let note = $(e.target).data("note")
        asyncNote = note
        noteStatus = 1
        initPageUI(noteStatus, note)

        let $articleSpan = $("#article span.text")

        let marks = []
        note.markId.map((id, index) => {
            marks.push($articleSpan.eq(Number(id)).html())
        })

        let marksString = marks.join("</br>")

        $markText.html(marksString)

        $noteContainer.show(0, function() {
            $("body, html").addClass("body-modal")
            $noteContainer.animate({
                top: 0
            }, 300)
        })
    })

    //关闭笔记界面
    $noteBack.bind("tap", function() {

        if (pkgId.length > 0 && noteId == null && noteStatus == 0 && $iconStar.hasClass("selected")) {
            window.utils.showPrompt("退出此次编辑？", "笔记将不会被保存，素材收藏也会无效", "退出", "继续编辑", () => {
                window.utils.hidePrompt()
            }, () => {
                window.utils.hidePrompt()
                $noteContainer.animate({
                    top: '100%'
                }, 300, function() {
                    resetPageUI()
                })
            })
        }else {
            window.utils.hidePrompt()
            $noteContainer.animate({
                top: '100%'
            }, 300, function() {
                resetPageUI()
            })
        }

    })
    
    //监听笔记变化
    $noteTextarea.bind('input propertychange', function() {
        let value = $.trim($(this).val())
        if (value.length > 0) {
            $collectionText.removeClass("disable")
            $iconStar.removeClass("disable")
            $iconPlant.removeClass("disable")
        }else {
            $collectionText.addClass("disable")
            $iconStar.addClass("disable")
            $iconPlant.addClass("disable")
        }
    })

    //切换动画
    $folderMaskCreate.bind("tap", function() {
        $folderMaskSelectContent.animate({
            left: "-100%"
        })

        $folderMaskCreateContent.animate({
            left: 0
        })
    })

    let resetMaskUI = function() {
        $folderMask.hide(0)
        $folderMaskSelectContent.css("left", 0)
        $folderMaskCreateContent.css("left", "100%")
        $folderMaskCreateInput.val('')
    }

    //关闭浮层
    $folderMaskClose.bind("tap", function() {
        resetMaskUI()
    })

    //开启浮层
    $(".icon-star, .collection-text").bind("tap", function() {

        if ($(this).hasClass('selected')) {

            if (noteId != null) {

                if (isLoading) return
                isLoading = true

                window.utils.showLoading()
                window.server.collectDel({
                    noteId: noteId,
                    pkgId: pkgId
                }, (res) => {

                    window.utils.hideLoading()
                    isLoading = false
                    if (res.status == 200) {
                        $iconStar.removeClass('selected')
                        $collectionText.removeClass('selected')
                        pkgId = ""
                        asyncData(pkgId)
                    }

                })

            }else {
                $iconStar.removeClass('selected')
                $collectionText.removeClass('selected')
                pkgId = ""
            }
            
        }else if(!$(this).hasClass("disable")) {
            fetchPkgList()
            $folderMask.show(0)
        }

        
    })

    //创建收藏夹
    $folderMaskCreateConfirm.bind("tap", () => {

        if (isLoading) return
        isLoading = true

        let value = $.trim($folderMaskCreateInput.val())
        if (value.length > 0) {

            window.utils.showLoading()
            window.server.addPkg({
                pkgName: value
            }, (res) => {
                isLoading = false
                window.utils.hideLoading()
                if (res.status == 200) {

                    pkgId = res.data.pkgId

                    if (noteId != null) {

                        setTimeout(() => {
                            window.server.addCollect({
                                pkgId: pkgId,
                                noteId: noteId
                            }, (res1) => {
                
                                if (res1.status == 200) {
                                    $iconStar.addClass('selected')
                                    $collectionText.addClass('selected')
                                    resetMaskUI()
                                    asyncData(pkgId)
                                }
                
                            }) 
                        }, 500)

                    }else {
                        $iconStar.addClass('selected')
                        $collectionText.addClass('selected')
                        resetMaskUI()
                    }

                    pkgId = res.data.pkgId
                    

                    resetMaskUI()
                }
            })

        }else {
            console.log('====================================');
            console.log("请输入收藏夹名称");
            console.log('====================================');
        }
    })

    //新增或编辑笔记
    $iconPlant.bind("tap", () => {

        if ($(this).hasClass("disable")) return

        let note = $.trim($noteTextarea.val())
        if (note.length <= 0) return

        if (isLoading) return
        isLoading = true
        window.utils.showLoading()

        let mark = {}
        let markId = []

        window.currentSelectedText.map((obj, index) => {
            mark[obj.index] = obj.text
            markId.push(obj.index) 
        })

        if (noteStatus == 0) {
            window.server.addNote({
                scriptId: article.scriptId,
                note: note,
                mark: JSON.stringify(mark),
                markId: markId.join(',')
            }, (res) => {
                isLoading = false
                window.utils.hideLoading()

                if (res.status == 200) {
                    noteId = res.data.noteId
                    let $articleSpan = $("#article span.text")
                    if (pkgId.length > 0) {
                        setTimeout(() => {
                            let res1 = res
                            window.server.addCollect({
                                pkgId: pkgId,
                                noteId: res.data.noteId
                            }, (response) => {
                                if (response.status == 200) {
                                    addData(Object.assign(res.data, {pkgId: pkgId}))
                                    $noteContainer.animate({
                                        top: '100%'
                                    }, 300, function() {
                                        resetPageUI()
                                    })
                                }else {
    
                                }
                            })
                        }, 200)
                        
                    }else {
                        addData(res.data)
                        $noteContainer.animate({
                            top: '100%'
                        }, 300, function() {
                            resetPageUI()
                        })
                    }
                    
                }else {

                }
            })

        }else {
            
            window.server.editNote({
                noteId: noteId,
                note: note
            }, (res) => {
                window.utils.hideLoading()
                isLoading = false
                if (res.status == 200) {
                    let $articleSpan = $("#article span.text")
                    asyncNote.markId.map((id, index) => {
                        $articleSpan.eq(Number(id)).data("note", Object.assign(asyncNote, {note: note}))
                    })
                    $noteContainer.animate({
                        top: '100%'
                    }, 300, function() {
                        resetPageUI()
                    })
                }
            })

        }
        
    })

})