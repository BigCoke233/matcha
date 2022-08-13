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
function GoTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

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
        GoTop();
		//开始显示加载条
        NProgress.start();
    }).on('pjax:complete', function() {
        $("#main").addClass("fadein").hide().fadeIn(300);
        hljs.highlightAll();
		panguLoad();
		//加载条完成
        NProgress.done();
    })