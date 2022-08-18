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
}
//auto set archor link target
var linkTarget = function() {
    host_url=window.location.host;
    $('.post a').each(function(){
        if($(this).attr('href').indexOf(host_url) < 0 && $(this).attr('href').indexOf('#') < 0 && !$(this).hasClass('no-linkTarget')) {
            $(this).attr('target','_blank');
            $(this).prepend('<span class="iconfont external-icon">&#xe832;</span>').addClass('no-linkTarget');
        }
    });
}

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
    // 当前滚动高度
    var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    // 滚动step方法
    var step = function () {
        // 距离目标滚动距离
        var distance = position - scrollTop;
        // 目标滚动位置
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

/**
 * JS Lib Loader
 */
 
//Must load when page finish
JSLoad = function(){
    hljs.highlightAll();
    SmoothScroll();
    linkTarget();
    bigfoodLoad();
    detailsAnimate();
}
JSLoad();

//Load Pjax
$(document).pjax('a[href^="' + siteurl + '"]:not(a[target="_blank"], a[no-pjax], #cancel-comment-reply-link, #comment-form a)', {
        container: '#main',
        fragment: '#main',
        timeout: 8000
    }).on('pjax:send', function() {
        scrollSmoothTo(0);
		//开始显示加载条
        NProgress.start();
    }).on('pjax:complete', function() {
        $("#main").addClass("fadein").hide().fadeIn(300);
        JSLoad();
        pjaxCallback();
		//加载条完成
        NProgress.done();
    });