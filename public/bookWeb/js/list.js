
$().ready(function() {

    let $notes = $('#notes'),
        $title = $('.notes-list-header-title'),
        $writer = $('.notes-list-header-writer'),
        $right = $('.notes-list-header-right'),
        $notesList = $('#notesList'),
        $noteListContent = $('.notes-list-content')
        isLoading = false
        
    $title.text(article.scriptName)
    let writerText = "编剧： " + article.writer.join(' / ')
    $writer.text(writerText)
    $right.attr('src', article.coverUrl)

    var resetUI = function() {
        $('.notes-list-content').html('')
        $notesList.hide(0)
        $("#article").removeClass("body-modal")
    }

    var initUI = function() {
        $("#article").addClass("body-modal")
        $notesList.show(0, function() {
            $notesList.animate({
                top: 0
            }, 300)
        })
        assembleList()
    }
    
    $notes.bind('tap', function() {
        initUI()
    })

    var assembleList = function() {
        let listhtml = ''

        $marks = $('#article span.text')

        noteMarks.map((obj, index) => {

            let mark = $marks[Number(obj.markId[0])].innerHTML

            listhtml += '<div class="notes-list-item">' +
                            '<div class="notes-list-item-left">' +
                                '<div class="notes-list-time">' +
                                    '<div class="notes-list-date">'+ obj.day +'</div>' +
                                    '<div class="notes-list-year">'+ obj.year +'/'+ obj.mon +'</div>' +
                                '</div>' +
                            '</div>' + 
                            '<div class="notes-list-item-right">' +
                                '<div class="notes-list-mark">'+ mark +'</div>' +
                                '<div class="notes-list-border"></div>' +
                                '<div class="notes-list-note">'+ obj.note +'</div>' +
                                '<div class="notes-list-delete"></div>' +
                            '</div>' +
                        '</div> '
        })

        $('.notes-list-content').html(listhtml)

        noteMarks.map((obj, index) => {
            $noteListContent.find('.notes-list-item').eq(index).data('note', obj)
        })
    }

    $notesList.on('tap', '.notes-list-item', function(event) {
        let note = $(this).data('note')
        let data = ''
        noteMarks.map(obj => {
            if (obj.noteId == note.noteId) {
                data = obj
            }
        })

        window.startEditNote(data, 'list')
    })

    $notesList.on('tap', '.notes-list-delete', function(event) {
        event.stopPropagation()

        if (isLoading) return
        isLoading = true

        let $item = $(this).parents('.notes-list-item')
        let note = $item.data('note')

        utils.showPrompt('提示', '确定要删除此条笔记？', '取消', '确定', () => {
            utils.showLoading()
            window.server.noteDel({noteId: note.noteId}, (res) => {
                utils.hideLoading()
                isLoading = false
                if (res.status == 200) {
                    utils.showToast('删除成功', true)
                    $item.remove()
                    noteMarks = noteMarks.filter((obj, index) => {
                        return obj.noteId != note.noteId
                    })

                    let $articleSpan = $("#article span.text")
                    note.markId.map((id) => {
                        $articleSpan.eq(Number(id)).data("note", '').removeClass('text-selected, text-marked')
                    })

                }else {
                    utils.showToast("请重试", false)
                }
            })
            utils.hidePrompt()
        }, () => {
            isLoading = false
            utils.hidePrompt()
        })
    })

    $('#notesListClose').bind('tap', function() {
        $notesList.animate({
            top: '100%'
        }, 300, function() {
            resetUI()
        })
    })

})