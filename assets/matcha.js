/**
 * Functions
 */
//bigfoot.js
var bigfoodLoad = function(){
    var bigfoot = $.bigfoot(
        {
            deleteOnUnhover: true,
            activeOnHover: true
        }
    );
};
//prismJS
var prismLoad = function(){
    if (typeof Prism !== 'undefined') {
        var pres = document.getElementsByTagName('pre');
        for (var i = 0; i < pres.length; i++){
        if (pres[i].getElementsByTagName('code').length > 0)
        pres[i].className  = 'line-numbers';}
        Prism.highlightAll(true,null);
    }
    Prism.plugins.toolbar.registerButton('copy', {
        text: '',
        onClick: function (env) {
            var text = env.element.innerText;
            navigator.clipboard.writeText(text);
            Toaster.send('已将代码复制到剪切板');
        }
    });
};
//jquery.lazy.js loader
lazyloader = function(){
    $('.lazy').Lazy({
        effect: 'fadeIn',
        visibleOnly: true,
        effectTime: 300,
        onError: function(element) {
            console.log('error loading ' + element.data('src'));
        }
    });
};
//auto set archor link target
var linkTarget = function() {
    host_url=window.location.protocol+'//'+window.location.host;
    $('.post-content a:not([no-linkTarget]), .comment-content a:not([no-linkTarget])').each(function(){
        if($(this).attr('href').indexOf(host_url) < 0 && $(this).attr('href').indexOf('#') < 0 && !$(this).hasClass('no-linkTarget')) {
            $(this).attr('target','_blank');
            $(this).prepend('<span class="iconfont external-icon">&#xe832;</span>').addClass('no-linkTarget');
        }
    });
}
//links
var linkFlow = function(){
    if(RandomLinks=='able'){
        //先打乱友情链接的顺序
        $(".links-item").each(function(){
            if(Math.random() <= 0.5){
                $(this).prependTo($(this).parent());            
            }
        });
    }
    //再启用瀑布流布局
    if($('.links-container').length>0){
        $('.links-container').masonry({
            // options
            itemSelector: '.links-item',
            percentPosition: true
        });
    }
}
//搜索功能
var searchInit = function(){
    $('#input_search').on("input propertychange", function(){
        $('#search-button').attr('href','http://'+window.location.host+'/index.php/search/'+$('#input_search').val()+'/')
    });
    $('#search-button').click(function(){
        if($('#search-button').attr('href')==null){
            Toaster.error('请输入关键词');
        }
    });
    //当浏览器返回时，以上代码会失效，这里自动刷新一下页面
    if($('#input_search').length){
        $(document).ready(function () {
            if (window.history && window.history.pushState) {
                $(window).on('popstate', function () {
                    if($('#input_search').length){
                        $('#input_search').val('');
                        $('body').append('<a href="'+ window.location.href +'" id="pjax-refresh" style="display:none"> </a>');
                        $('#pjax-refresh').click()
                    }
                });
            }
        });
    }
}
//适配 CopyDog 插件
copydog_copied=function(){Toaster.send('成功复制到剪切板');}
//Go to Top
/**
 @description 页面垂直平滑滚动到指定滚动高度
 @author zhangxinxu(.com)
*/
var scrollSmoothTo = function (position) {
    if (!window.requestAnimationFrame) {
        window.requestAnimationFrame = function(callback, element) {
            return setTimeout(callback, 17);
        };
    }
    var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    var step = function () {
        var distance = position - scrollTop;
        scrollTop = scrollTop + distance / 5;
        if (Math.abs(distance) < 1) {
            window.scrollTo(0, position);
        } else {
            window.scrollTo(0, scrollTop);
            requestAnimationFrame(step);
        }
    };
    step();
};


/**
 * Animation
 */
//通用的缩放动画
scaleIn = function(object, time) {
    object.css('transition', time).css('transform', 'scale(0)');
    object.show();
    object.css('transform', 'scale(1)');
}
scaleOut = function(object, time) {
    object.css('transition', time).css('transform', 'scale(0)')
}

//details 标签，适配 BracketDown 插件
var detailsAnimate = function() {
    $('details').on("click",function(e){
        e.preventDefault();//阻止 details 直接显示内容
        if(!$(this).attr('open')){
            $(this).attr('open','');
        }else{
            $(this).addClass('closing');
            setTimeout(() => { 
                $(this).removeClass('closing');
                $(this).removeAttr('open');
            }, 300);
        }
    });
}

/**
 * Event Listenr
 */

//Back2Top Button
$('#back2top').hide();
$("#back2top").on("click",function(){scrollSmoothTo(0)});
$(window).scroll(function() {
    if ($(window).scrollTop() > 450) {
        scaleIn($('#back2top'), '0.7');
    } else {
        scaleOut($('#back2top'), '0.7');
    }
});
//Comment Closed Feedback
var CommentClosedBtn = function(){
    $('#comment-closed').click(function(){
        $('#comment-closed').addClass('fade');
        setTimeout(function(){
            $('#comment-closed').remove();
        },300);
        document.cookie = 'commentsClosedKnown=y';
        Toaster.send('短期内不会再显示此类信息');
    });
}

/**
 * JS Lib Loader
 */
 
//Must load when page finish
var JSLoad = function(){
    SmoothScroll();
    linkTarget();
    bigfoodLoad();
    detailsAnimate();
    prismLoad();
    linkFlow();
    lazyloader();
    searchInit();
    if(AjaxCommentEnabled=='able'){
        matchaComment.bindButton();
        matchaComment.core();
    }
    CommentClosedBtn();
}
JSLoad();

//Load Pjax
$(document).pjax('a[href^="' + siteurl + '"]:not(a[target="_blank"], a[no-pjax], .cancel-comment-reply a, .comment-reply a)', {
        container: '#main',
        fragment: '#main',
        timeout: 8000
    }).on('pjax:send', function() {
        $('body').append('<div class="spinner" role="spinner" id="pjax-loading"><div class="spinner-icon"></div></div>');
        $("#main").removeClass("fadein").addClass("fadeout");
        scrollSmoothTo(0);
    }).on('pjax:complete', function() {
        $("#main").removeClass("fadeout").addClass("fadein").hide().fadeIn(700);
        JSLoad();
        pjaxCallback();
        $('#pjax-loading').remove()

        return Toaster;
});

/**
 * Copyright
 */
console.log(
    "%c 🍵 Theme Matcha %c by Eltrac https://guhub.cn %c ",
    "color: #fff; margin: 1em 0; padding: 5px 0; background: rgb(197,197,106);",
    "margin: 1em 0; padding: 5px 0; background: #efefef;",
    "display: block;margin-left:-0.5em;"
);