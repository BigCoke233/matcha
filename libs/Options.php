<?php
/**
 * Options.php
 * 
 * Matcha 主题设置页面
 */
function themeConfig($form) {

    /**
     * 个性化
     */

    //首页摘要显示模式
    $IndexDisplayMode = new Typecho_Widget_Helper_Form_Element_Radio('IndexDisplayMode', array(
        'FullText' => _t('根据 more 标签截断'),
        'Excerpt200' => _t('截断前 200 字符'),
        'Title' => _t('不输出摘要')
    ),
    'FullText',
    _t('文章摘要显示模式'),
    _t('
    <p class="description">该设置相会影响首页的文章列表内的文章内容摘要如何显示。</p>
    <p class="description">若选择 根据 more 标签截断，主题会截取 <code><!--more--></code> 标签之前的内容，这样能保留这一文段的样式，而不是单调的文字。</p>
    <p class="description">若选择 截断前200字符，主题总是会截取文章前 200 字纯文本，且不保留原本样式。</p>
    <p class="description">若选择 不输出摘要，文章列表中只会显示文章标题和元信息。</p>')
    );
    $form->addInput($IndexDisplayMode->addRule('required', _t('此处必须设置')));
    //Favicon 设置
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, 'favicon.png', _t('浏览器图标（Favicon）'), _t('在这里填入一个指向图片文件的 url 来自定义浏览器标签栏显示的图标，留空则默认为 favicon.ico<hr>'));
    $form->addInput($favicon);

    /**
     * 基本信息
     */
    $icpNum = new Typecho_Widget_Helper_Form_Element_Text('icpNum', NULL, NULL, _t('网站备案号'), _t('在这里填入中国大陆的ICP网站备案号（无需带a标签，如 <code>浙ICP备19006255号-1</code> ），留空则不显示'));
    $form->addInput($icpNum);
    $startDate = new Typecho_Widget_Helper_Form_Element_Text('startDate', NULL, date('Y-m-d'), _t('网站建立日期'), _t('用于显示在页脚的版权信息，以及计算网站建立时长，格式为 Y-m-d'));
    $form->addInput($startDate);
    $statCode = new Typecho_Widget_Helper_Form_Element_Textarea('statCode', NULL, NULL, _t('站点统计代码'), _t('
        <p class="description">在这里填入 <b>带 script 标签的</b> 站点统计代码，留空则不显示。</p>
        <hr class="line"></hr>
        '));
    $form->addInput($statCode);

    /**
     * 附加功能 & 实验性功能
     */
    //启用 CDN 加速
    $StaticCDN = new Typecho_Widget_Helper_Form_Element_Select('StaticCDN', array(
            'local' => _t('本地资源（不加速）'),
            'bytedance' => _t('字节跳动资源库（推荐）'),
            'cdnjs' => _t('CDNJS'),
        ),
        'local',
        _t('选择静态文件加速 CDN'),
        _t('如果你的服务器速度较慢，可以选择一个 CDN 引用静态文件资源库，可以一定程度地提高页面加载速度。')
    );
    $form->addInput($StaticCDN->addRule('required', _t('此处必须设置')));
    //友情链接随机排序
    $EnableRandomLinks = new Typecho_Widget_Helper_Form_Element_Radio('EnableRandomLinks', array(
            'able' => _t('启用'),
            'disable' => _t('停用'),
        ),
        'able',
        _t('是否启用友情链接随机排序'),
        _t('
            启用后，友情链接页面的友情链接列表将会随机排序，每次刷新后得到的顺序都不一样。
        ')
    );
    $form->addInput($EnableRandomLinks->addRule('required', _t('此处必须设置')));
    //启用 ajax 评论
    $EnableAjaxComment = new Typecho_Widget_Helper_Form_Element_Radio('EnableAjaxComment', array(
            'able' => _t('启用'),
            'disable' => _t('停用'),
        ),
        'able',
        _t('是否启用 Ajax 评论无刷新功能（Beta）'),
        _t('
            启用后将使用 Ajax 异步提交评论，提交评论后页面不会刷新。这个功能目前还在测试中。
        ')
    );
    $form->addInput($EnableAjaxComment->addRule('required', _t('此处必须设置')));
    //启用文章浏览量统计
    $EnableViewsCount = new Typecho_Widget_Helper_Form_Element_Radio('EnableViewsCount', array(
            'able' => _t('启用'),
            'disable' => _t('停用'),
        ),
        'able',
        _t('是否启用文章浏览量统计'),
        _t('
            启用后，将在文章列表和文章内页显示当前文章的浏览量，并实时统计。
        ')
    );
    $form->addInput($EnableViewsCount->addRule('required', _t('此处必须设置')));
    //启用不蒜子统计
    $EnableBusuanzi = new Typecho_Widget_Helper_Form_Element_Radio('EnableBusuanzi', array(
            'able' => _t('启用'),
            'disable' => _t('停用'),
        ),
        'able',
        _t('是否启用 <a rel="nofollow" target="_blank" href="https://busuanzi.ibruce.info/">不蒜子</a> 统计功能'),
        _t('
            <a rel="nofollow" target="_blank" href="https://busuanzi.ibruce.info/">不蒜子</a>是一个即装即用的网页 js 计数脚本，目前可与主题进行对接显示访问数，<b>默认启用</b>
        ')
    );
    $form->addInput($EnableBusuanzi->addRule('required', _t('此处必须设置')));

    /**
     * 自定义
     */
    //自定义 head
    $customHead = new Typecho_Widget_Helper_Form_Element_Textarea('customHead', NULL, NULL, _t('自定义 head 头部信息'), _t('
        <p class="description">将会输出在 head 标签结束之前，通常用于引入 css 文件。</p>'));
    $form->addInput($customHead);
    //自定义 footer
    $customFooter = new Typecho_Widget_Helper_Form_Element_Textarea('customFooter', NULL, NULL, _t('自定义 footer 页脚信息'), _t('
        <p class="description">将会输出在 body 标签结束之前，通常用于引入 js 文件。</p>'));
    $form->addInput($customFooter);
    //自定义 pjax 回调函数
    $pjaxCallback = new Typecho_Widget_Helper_Form_Element_Textarea('pjaxCallback', NULL, NULL, _t('Pjax 回调函数'), _t('
        <p class="description">用于在 Pjax 切换页面后刷新某些元素，避免失效。如果你没有使用其他插件或者没有遇到问题，这里应当留空。</p>'));
    $form->addInput($pjaxCallback);
}
