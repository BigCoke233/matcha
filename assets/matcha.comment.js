/**
 * 前端实现异步提交评论
 */

replyTo = '';
var matchaComment = {};

matchaComment.bindButton = function() {
    $(".comment-reply a").click(function () {
            replyTo = $(this).parent().parent().parent().parent().attr("id");
        });
    $(".cancel-comment-reply a").click(function () { replyTo = ''; });
}

matchaComment.before = function(){
    //禁用评论表单
    $("#comment-form input,#comment-form textarea,#comment-form .submit").attr('disabled', true).css('cursor', 'not-allowed');
    $('#comment-form').animate({ opacity: .5 }, 300);
}
 
matchaComment.after = function(ok){
    //先取消对表单的禁用
    $("#comment-form input,#comment-form textarea,#comment-form .submit").attr('disabled', false).css('cursor', 'pointer');
    $('#comment-form').animate({ opacity: 1 }, 300);
    if(ok){
        //如果发送成功
        $("#textarea").val('');//清空评论框
        replyTo = '';//清空回复 id
    }
    //...
}

matchaComment.core = function() {
    $('#comment-submit').click(function(e) {
        matchaComment.before();
        //POST 基本信息
        if(login){
            var commentData = {
                'text': $('#comment-form [name="text"]').val()
            }
        }else{
            var commentData = {
                'author': $('#comment-form [name="author"]').val(),
                'mail': $('#comment-form [name="mail"]').val(),
                'url': $('#comment-form [name="url"]').val(),
                'text': $('#comment-form [name="text"]').val()
            }
        }
        //如果是回复
        if(replyTo!=''){
            commentData['parent']=replyTo.replace('comment-','');
        }
        //如果开启了评论邮件提醒插件
        if($('[name="receiveMail"]').length){
            commentData['receiveMail']=$('[name="receiveMail"]').val();
        }
        //ajax 发送评论
        $.ajax({
            type: 'POST',
            url: $('#comment-form').attr('action'),
            data: commentData,
            error: function(e) {
                Toaster.error('评论发送失败，请尝试刷新');
            },
            success: function(data) {
                //通过传过来的 data 是否包含评论区 html 判断是否成功
                if (!$('#comments', data).length) {
                    data=$('<body></body>').prepend(data);
                    if($('pre>code>h1', data).length){
                        var msg = $('pre>code>h1', data).text();
                    }
                    else if($('title').eq(0).text().trim().toLowerCase() === 'error'){
                        var msg = $('.container', data).eq(0).text();
                    }
                    else{
                        var msg = '评论提交失败';
                    }

                    Toaster.error(msg);//提示用户发送失败
                    matchaComment.after(false);//评论失败
                    return false
                }
                //获取评论数据
                var htmlData = $(document.createElement('body')).append(data);
                if (htmlData.html()) {
                    //如果 htmlData 存在，获取 id
                    newCommentId = htmlData.html().match(/id=\"?comment-\d+/g).join().match(/\d+/g).sort(function (a, b) { return a - b }).pop();
                }else{
                    //如果不存在，提示错误
                    Toaster.error('获取评论 ID 时发生错误，请尝试刷新');
                    return false;
                }
                //处理评论数据
                var newComment; 
                if(''===replyTo) {
                    if(!$('.comment-list').length) {
                        $('.respond').after($(htmlData)[0].querySelector('.comment-list'));
                    }
                    else if($('.prev').length) {
                        $('.comments-pagenav li a').eq(1).click();
                    }else{
                        newComment  = $("#comment-" + newCommentId, data);
                        //然后将新评论压入评论列表
                        $('.comment-list').first().prepend(newComment);
                    }
                }
                else {
                    newComment = $("#comment-" + newCommentId, data);
                    if($('#' + replyTo).hasClass('comment-parent')){
                        //如果回复的对象是父级评论
                        if ($('#' + replyTo).find('.comment-children').length) {
                            $('#' + replyTo + ' .comment-children .comment-list').first().prepend(newComment);
                            TypechoComment.cancelReply();
                        }
                        else {
                            $('#' + replyTo).append('<div class="comment-children"><ol class="comment-list"></ol></div>');
                            $('#' + replyTo + ' .comment-children .comment-list').first().prepend(newComment);
                            TypechoComment.cancelReply();
                        }
                    }else{
                        //如果回复的对象是子级评论
                        //直接插入在对应的子级评论之后
                        $('#' + replyTo).after(newComment);
                        TypechoComment.cancelReply();
                    }
                }
                matchaComment.after(true);
                Toaster.send('评论发送成功');
            }
        });
    });
}