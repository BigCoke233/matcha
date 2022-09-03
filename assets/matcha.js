/**
 * Lib
 */
//使用 Toaster 的快捷方式
var toast = function(m) {
    Toaster.toast(m, {
        color: 'var(--theme-color)'
    });
}
//灯开关
function lightswitch(action = 'toggle'){
    if(action=='toggle'){
        $('body').toggleClass('matcha-dark');
    }
    else if(action=='off'){
        $('body').addClass('matcha-dark');
    }
    else if(action=='on'){
        $('body').removeClass('matcha-dark');
    }

    if($('body').hasClass('matcha-dark')){
        $('#light-switch').html('<span class="iconfont">&#xe7ee;</span>');
        $('#nav-light').html('<span class="iconfont">&#xe7ee;</span>');
        localStorage.setItem('matchaDark', 'yes'); //localStorage 供前端调用
        document.cookie = 'matchaDark=y'; //cookie 供后端调用
    }else{
        $('#light-switch').html('<span class="iconfont">&#xe7ac;</span>');
        $('#nav-light').html('<span class="iconfont">&#xe7ac;</span>');
        localStorage.setItem('matchaDark', 'no');
        document.cookie = 'matchaDark=n';
    }
}
//判断元素是否在视野中央
function isInViewport(el) {
    const viewPortHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight 
    const offsetTop = el.offsetTop
    const scrollTop = document.documentElement.scrollTop
    const top = offsetTop - scrollTop
    return top <= viewPortHeight*0.5
}

/**p
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
            toast('已将代码复制到剪切板');
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
        },
        onFinishedAll: function() {
            $('.fluidbox-anchor').fluidbox();//完成后加载 Fluidbox
        }
    });
    //设置 Fluidbox
    $(window).scroll(function() {
        $('.fluidbox-anchor').fluidbox('close');
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
//适配 CopyDog 插件
copydog_copied=function(){toast('成功复制到剪切板');}
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
//tocbot
var tocbotLoad = function() {
    //判断页面中是否有目录容器
    if($('#toc').length){
        //初始化 tocbot
        tocbot.init({
            tocSelector: '#toc',
            contentSelector: '.post-content',
            headingSelector: 'h2, h3',
            hasInnerContainers: true,
            smoothScroll: true,
            headingsOffset: 20,
            scrollSmoothOffset: -20
        });

        //用文章目录代替侧边栏
        var toc = $('#toc').children().html();//文章目录
        var navList = $('.sidebar-nav .widget-list').html();//原导航内容
        var headerContent = $('#header').html();//原 header 内容
        var sidebarFoot = $('.sidebar-foot').html();//侧边栏底部内容

        var turnedOff = false; //文章目录是否为手动关闭

        //打开目录
        function openToc(){
            $('.sidebar-foot').fadeOut().html('');
            $('.sidebar').addClass('tocbar');
            $('#header').addClass('toc-header').html('<h1><button id="toc-close"><span class="iconfont">&#xe650;</span></button> <span>文章目录</span></h1>');
            $('.sidebar-nav .widget-list').html('<li><a>该文章没有目录</a></li>').html(toc).attr('id','toc');
            $('#toc-close').click(closeToc);
        }
        openToc();

        //关闭目录
        function closeToc(manual = true){
            $('.sidebar-foot').html(sidebarFoot).fadeIn();
            $('.sidebar').removeClass('tocbar').css('top', '2.8em');
            $('#header').removeClass('toc-header').html(headerContent);
            $('.sidebar-nav .widget-list').removeAttr('id').html(navList);
            turnedOff=manual?true:false;
        }

        //监听关闭文章目录按钮
        $('#post-toc-toggle').click(function(){
            if($('.sidebar').hasClass('tocbar')){ closeToc() }else{ openToc();$('#toc-close').click(closeToc); }
        });

        //滚动监听
        var sidebarTop = $('.sidebar').css('top').replace('px','');
        $(window).scroll(function(){
            //headroom
            var scrollTop = $(window).scrollTop()
            var newTop = sidebarTop - scrollTop;
            if(newTop>=0) {
                $('.sidebar.tocbar').css('top', newTop);
            }else{
                $('.sidebar.tocbar').css('top', 0);
            }
            //当视口滚动到评论区，关闭文章目录
            if($('#comments').length){
                if(isInViewport(document.getElementById('comments'))){
                    if($('.sidebar').hasClass('tocbar')) closeToc(false);
                }else{
                    if(!turnedOff) openToc();
                }
            }
        });
    }
}


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
            $(this).children('.bracketdown-details-content').slideDown();
            $(this).attr('open','');
        }else{
            $(this).children('.bracketdown-details-content').slideUp();
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
        $('#light-switch').addClass('helpbar-up');
    } else {
        scaleOut($('#back2top'), '0.7');
        $('#light-switch').removeClass('helpbar-up');
    }
});
//Light Switch
if(typeof(allowDarkMode)!=undefined){
    //监听用户手动开关灯事件
    $('#light-switch').click(function(){lightswitch('toggle')});
    $('#nav-light').click(function(){lightswitch('toggle')});
    //自动开关灯，以及自动操作后的提示
    $(document).ready(function(){
        var matchaDark = localStorage.getItem('matchaDark');
        var time = new Date();
        var hour = time.getHours();
        if(matchaDark=='yes' && !$('body').hasClass('matcha-dark')){
            //根据用户设置，在前端自动关灯
            lightswitch('off');
            toast('已为您自动关灯');
        }
        else if(window.matchMedia('(prefers-color-scheme:dark)').matches){
            //跟随系统深色模式
            lightswitch('off');
            toast('已为您自动关灯');
        }
        else if((hour>18 || hour<7) && $('body').hasClass('matcha-dark')){
            //后端根据时间关灯后，前端给出提示
            $('#light-switch').html('<span class="iconfont">&#xe7ee;</span>');
            $('#nav-light').html('<span class="iconfont">&#xe7ee;</span>');
            toast('天晚了，已为您自动关灯');
        }else if($('body').hasClass('matcha-dark')){
            $('#light-switch').html('<span class="iconfont">&#xe7ee;</span>');
            $('#nav-light').html('<span class="iconfont">&#xe7ee;</span>');
        }
    });
}
//移动端菜单按钮
$('#nav-drop').click(function(){ $('.navbar-dropdown').fadeIn().addClass('down') });
$('#nav-rise').click(function(){ $('.navbar-dropdown').fadeOut().removeClass('down') });
$('.navbar-dropdown a').click(function(){ $('.navbar-dropdown').fadeOut().removeClass('down') });
//页面不在顶部时收起导航栏
$(window).scroll(function(event){
    if($(window).scrollTop()!=0){
        $('#small-header').addClass('shrink');
        $('.container').addClass('with-shrunk-nav');
    }else{
        $('#small-header').removeClass('shrink')
        $('.container').removeClass('with-shrunk-nav');
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
        toast('短期内不会再显示此类信息');
    });
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
//归档页面展开收起
var archiveInit = function(){
    //监听归档页面展开收起按钮
    $('.archive-button').click(function(){
        var target = $(this).attr('id').replace('button', 'list');
        $('#'+target).slideToggle();
        $(this).toggleClass('closed');
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
    archiveInit();
    tocbotLoad();
    CommentClosedBtn();
    if(AjaxCommentEnabled=='able'){
        matchaComment.bindButton();
        matchaComment.core();
    }
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
        if ($('.toc').length) tocbot.destroy();//摧毁文章目录
        $(window).off('scroll');//取消文章目录自动关闭的滚动绑定
    }).on('pjax:complete', function() {
        $("#main").removeClass("fadeout").addClass("fadein").hide().fadeIn(700);
        JSLoad();
        toc='';
        pjaxCallback();
        $('#pjax-loading').remove();
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