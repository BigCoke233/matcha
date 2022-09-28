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
function isInViewport(el, offset = 0) {
    const viewPortHeight = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight 
    const offsetTop = el.offsetTop
    const scrollTop = document.documentElement.scrollTop
    const top = offsetTop - scrollTop
    return top <= viewPortHeight*offset
}

/**p
 * Functions
 */
//bigfoot.js
var bigfootLoad = function(){
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
};
Prism.plugins.toolbar.registerButton('copy', {
    text: '',
    onClick: function (env) {
        var text = env.element.innerText;
        navigator.clipboard.writeText(text);
        toast('已将代码复制到剪切板');
    }
});
//jquery.lazy.js loader
lazyloader = function(){
    $('.lazy').Lazy({
        effect: 'fadeIn',
        visibleOnly: true,
        effectTime: 300,
        onError: function(element) {
            console.log('error loading ' + element.data('src'));
        },
        afterLoad: function(el) {
            $(el).addClass('lazy-loaded');
            //完成后加载 Fluidbox
            $('.fluidbox-anchor').fluidbox().on('openstart.fluidbox', function(){
                $(this).parent().css('overflow', 'visible');
            }).on('closestart.fluidbox', function(){
                $(this).parent().css('overflow', 'hidden');
            });
            $(window).scroll(function() {
                $('.fluidbox-anchor').fluidbox('close');
            });
        }
    });
};
//ExSearch 
function ExSearchCall(item){
    if (item && item.length) {
        $('.ins-close').click(); // 关闭搜索框
        let url = item.attr('data-url'); // 获取目标页面 URL
        $.pjax({url: url, 
            container: '#main',
            fragment: '#main',
            timeout: 8000, }); // 发起一次 PJAX 请求
    }
}
//auto set archor link target
var linkTarget = function() {
    host_url=window.location.protocol+'//'+window.location.host;
    $('.post-content a:not([no-linkTarget]), .comment-content a:not([no-linkTarget])').each(function(){
        if($(this).attr('href').indexOf(host_url) < 0 && $(this).attr('href').indexOf('#') < 0 && !$(this).hasClass('no-linkTarget')) {
            $(this).attr('target','_blank');
            $(this).prepend('<span class="iconfont external-icon">&#xe888;</span>').addClass('no-linkTarget');
        }
    });
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

        //滚动监听
        $(window).scroll(function(){
            //当视口滚动到评论区，关闭文章目录
            if($('#comments').length){
                if(isInViewport(document.getElementById('comments'), 0.5)){
                    $('#toc').fadeOut();
                }else{
                    $('#toc').fadeIn();
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
    $('details').attr('open','');//强制开启，但不显示内容
    $('details').on("click",function(e){
        e.preventDefault();//阻止 details 直接显示内容
        if(!$(this).hasClass('opened')){
            $(this).children('.bracketdown-details-content').slideDown();
            $(this).addClass('opened');
        }else{
            $(this).children('.bracketdown-details-content').slideUp();
            $(this).addClass('closing');
            setTimeout(() => { 
                $(this).removeClass('closing').removeClass('opened');
            }, 300);
        }
    });
}

//专注模式
var toggleFocusMode = function(){
    $('#sidebar').fadeToggle();
    $('#helpbar').fadeToggle();
    $('.post-thumbnail-atpage').slideToggle();
    $('body').toggleClass('focus-mode')
    if($('body').hasClass('focus-mode')){
        scaleIn($('#focus-mode-close'), '0.7');
        toast('已开启专注模式');
    }else{
        scaleOut($('#focus-mode-close'), '0.7');
        toast('已关闭专注模式');
    }
}


/**
 * Event Listenr
 */

//Back2Top Button
$('#back2top').hide();
$("#back2top").on("click",function(){scrollSmoothTo(0)});

var back2topShow = function(){
    if ($(window).scrollTop() > 450) {
        scaleIn($('#back2top'), '0.7');
        $('#focus-mode-close').addClass('helpbar-up');
    } else {
        scaleOut($('#back2top'), '0.7');
        $('#focus-mode-close').removeClass('helpbar-up');
    }
}
$(window).scroll(back2topShow);
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
        $(this).parent().slideUp();
        document.cookie = 'commentsClosedKnown=y';
        toast('短期内不会再显示此类信息');
    });
}
//搜索功能
var doSearch = function(){
    if($('#input_search').val()==null){
        Toaster.error('请输入关键词');
    }else{
        let url = window.location.protocol+'//'+window.location.host+'/index.php/search/'+$('#input_search').val()+'/';
        $.pjax({url: url, 
            container: '#main',
            fragment: '#main',
            timeout: 8000, });
    }
}

var searchInit = function(){
    $('#search-button').click(doSearch);
    $(document).keydown(function (e) {
        if(e.keyCode==13 && $('#input_search').is(":focus")) doSearch();
    });
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
    try {
        if(typeof SmoothScroll === "function") SmoothScroll();
        if(typeof matchaComment !== 'undefined'){
            matchaComment.bindButton();
            matchaComment.core();
        }
    } catch(e) {}
    linkTarget();
    bigfootLoad();
    detailsAnimate();
    prismLoad();
    lazyloader();
    searchInit();
    archiveInit();
    tocbotLoad();
    CommentClosedBtn();
    $('.focus-mode-btn').click(toggleFocusMode);
}
JSLoad();

//Load Pjax
$(document).pjax('a[href^="' + siteurl + '"]:not(a[target="_blank"], a[no-pjax], .cancel-comment-reply a, .comment-reply a)', {
        container: '#main',
        fragment: '#main',
        timeout: 8000
    }).on('pjax:send', function() {
        $('body').append('<div class="progress" role="spinner" id="pjax-loading"><div class="progress-bar"></div></div>');
        $("#main").removeClass("fadein").addClass("fadeout");
        if ($('.toc').length) tocbot.destroy();//摧毁文章目录
        $(window).off('scroll');
        $(window).on('scroll', back2topShow);//取消文章目录自动关闭的滚动绑定
        if($('body').hasClass('focus-mode')) toggleFocusMode();//切换页面时关闭专注模式
        
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