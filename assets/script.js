/**
 * Functions
 */
 
//Pangu.js
function panguLoad() {
    document.addEventListener('DOMContentLoaded', () => {
        pangu.autoSpacingPage();
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
 * Event Listenr
 */
$("#back2top").on("click",function(){scrollSmoothTo(0)});

/**
 * JS Lib Loader
 */
 
//Must load when page finish
hljs.highlightAll();
panguLoad();

//Load Pjax
$(document).pjax('a[href^="' + siteurl + '"]:not(a[target="_blank"], a[no-pjax])', {
        container: '#main',
        fragment: '#main',
        timeout: 8000
    }).on('pjax:send', function() {
        scrollSmoothTo(0);
		//开始显示加载条
        NProgress.start();
    }).on('pjax:complete', function() {
        $("#main").addClass("fadein").hide().fadeIn(300);
        hljs.highlightAll();
		panguLoad();
		//加载条完成
        NProgress.done();
    })