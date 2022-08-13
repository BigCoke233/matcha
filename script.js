function GoTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

$(document).pjax('a[href^="' + siteurl + '"]:not(a[target="_blank"], a[no-pjax])', {
        container: '#main',
        fragment: '#main',
        timeout: 8000
    }).on('pjax:send', function() {
        GoTop();
        NProgress.start();
    }).on('pjax:complete', function() {
        $("#main").addClass("fadein").hide().fadeIn(300);
        hljs.initHighlightingOnLoad();
        NProgress.done();
    })