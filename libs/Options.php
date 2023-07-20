<?php
/**
 * Options.php
 * 
 * Matcha 主题设置页面
 */
function themeConfig($form) {

    /**
     * 基本信息
     */

    echo '<div style="border:1px solid #ddd;background:#eee;padding:1em;margin-top:1em">
        <h1 style="margin:0;font-weight:600">Matcha 主题配置</h1>
        <p style="line-height:1.5;margin:0">主题配置有关的说明请查看<a rel="noreferrer" href="https://matcha.guhub.cn/">说明文档</a></p>
    </div>';

    //主题色
    $themeColor = new Typecho_Widget_Helper_Form_Element_Radio('themeColor', array(
        'matcha' => _t('抹茶绿'),
        'ocean' => _t('海青色'),
        'kirin' => _t('秋麒麟'),
        'maple' => _t('枫树红'),
        'violet' => _t('紫罗兰'),
        'custom' => _t('自定义主题色')
    ),
    'matcha',
    _t('<h2>首要设置</h2> 主题色'),
    _t('选择一个主题色'));
    $form->addInput($themeColor->addRule('required', _t('此处必须设置')));
    //自定义主题色
    $themeColorCustom = new Typecho_Widget_Helper_Form_Element_Text('themeColorCustom', NULL, NULL, 
        _t('自定义主题色'), 
        _t('只有在上一个设置项选择「自定义主题色」，这个设置才会生效，在这里写入任何 css 支持的颜色代码'));
    $form->addInput($themeColorCustom);
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
    <p class="description">若选择 根据 more 标签截断，主题会截取 <code>&lt;!--more--></code> 之前的内容，这样能保留这一文段的样式，而不是单调的文字。</p>
    <p class="description">若选择 截断前200字符，主题总是会截取文章前 200 字纯文本，且不保留原本样式。</p>
    <p class="description">若选择 不输出摘要，文章列表中只会显示文章标题和元信息。</p>')
    );
    $form->addInput($IndexDisplayMode->addRule('required', _t('此处必须设置')));

    /**
     * 相关信息
     */
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, 'favicon.png', _t('<h2>相关信息</h2> 浏览器图标（Favicon）'), _t('在这里填入一个指向图片文件的 url 来自定义浏览器标签栏显示的图标，留空则默认为 favicon.ico'));
    $form->addInput($favicon);

    $icpNum = new Typecho_Widget_Helper_Form_Element_Text('icpNum', NULL, NULL, _t('网站备案号'), _t('在这里填入中国大陆的ICP网站备案号（无需带a标签，如 <code>浙ICP备19006255号-1</code> ），留空则不显示'));
    $form->addInput($icpNum);
       $policeNum = new Typecho_Widget_Helper_Form_Element_Text('policeNum', NULL, NULL, _t('公安备案号'), _t('在这里填入中国大陆的公安网站备案号（无需带a标签，如 <code>京公网安备11010102002019号</code> ），留空则不显示'));
    $form->addInput($policeNum);
    $policeUrl = new Typecho_Widget_Helper_Form_Element_Text('policeUrl', NULL, NULL, _t('公安备案号链接地址'), _t('在这里填入中国大陆的公安网站备案号链接地址（无需带a标签，如 <code>http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010102002019</code> ），留空则不显示'));
    $form->addInput($policeUrl);
    $startDate = new Typecho_Widget_Helper_Form_Element_Text('startDate', NULL, date('Y-m-d'), _t('网站建立日期'), _t('用于显示在页脚的版权信息，以及计算网站建立时长，格式为 Y-m-d'));
    $form->addInput($startDate);
    $umamiURL = new Typecho_Widget_Helper_Form_Element_Text('umamiURL', NULL, NULL, _t('umami Website URL'), _t('在这里填入对应域名的 <a rel="nofollow noreferrer" target="_blank" href="https://cloud.umami.is/">Umami</a> Track URL（如 <code>https://analytics.umami.is/script.js</code> ），留空则不开启功能'));
    $form->addInput($umamiURL);
    $umamiID = new Typecho_Widget_Helper_Form_Element_Text('umamiID', NULL, NULL, _t('umami Website ID'), _t('在这里填入对应域名的 <a rel="nofollow noreferrer" target="_blank" href="https://cloud.umami.is/">Umami</a> Website ID（如 <code>9caf0ded-6e8e-409c-9ds4-231fe253a8ac</code> ），留空则不开启功能'));
    $form->addInput($umamiID);

    /**
     * 进阶功能
     */
    //首页相关链接
    $relatedLinksTitle = new Typecho_Widget_Helper_Form_Element_Text('relatedLinksTitle', NULL, NULL, _t('<h2>进阶功能</h2> 首页「相关链接」标题'), _t('
        <p class="description">下一个设置项不留空则生效，自定义相关链接之前显示的标题</p>'));
    $form->addInput($relatedLinksTitle);
    $relatedLinks = new Typecho_Widget_Helper_Form_Element_Textarea('relatedLinks', NULL, NULL, _t('首页「相关链接」内容'), _t('
        <p class="description">使用特定的 JSON 格式书写，可以在首页文章目录之前展示一个相关链接版块，详情请查看说明文档</p>'));
    $form->addInput($relatedLinks);
    // 分类导航
    $categoryNav = new Typecho_Widget_Helper_Form_Element_Radio('categoryNav', array(
        'able' => _t('启用'),
        'disable' => _t('停用'),
    ),
    'disable',
    _t('是否启用侧边栏分类导航'),
    _t('
        启用后，将在侧边栏首页和独立页面中间加入所有分类页面。
    ')
    );
    $form->addInput($categoryNav->addRule('required', _t('此处必须设置')));
    // Gravatar CDN
    $CustomGravatarCDN = new Typecho_Widget_Helper_Form_Element_Text('CustomGravatarCDN', NULL, NULL, _t('自定义评论头像 Gravatar CDN'), _t('
    <p class="description">在此处填入你期望使用的 Gravatar CDN 链接，形如 <code>https://cravatar.cn/avatar/</code></p>
    <p class="description">留空则使用 <a rel="nofollow noreferrer" target="_blank" href="https://cravatar.cn/">Cravatar</a></p>'));
    $form->addInput($CustomGravatarCDN);

    /**
     * 附加功能
     */
    //启用 CDN 加速
    $StaticCDN = new Typecho_Widget_Helper_Form_Element_Select('StaticCDN', array(
            'local' => _t('本地资源（不加速）'),
            'bytedance' => _t('字节跳动资源库（推荐）'),
            'cdnjs' => _t('CDNJS'),
            'custom'=> _t('自定义')
        ),
        'local',
        _t('<h2>附加功能</h2> 选择静态文件加速 CDN'),
        _t('如果你的服务器速度较慢，可以选择一个 CDN 引用静态文件资源库，可以一定程度地提高页面加载速度。若选择自定义，则需要填写下一项')
    );
    $form->addInput($StaticCDN->addRule('required', _t('此处必须设置')));
    //自定义 CDN
    $CustomCDN = new Typecho_Widget_Helper_Form_Element_Text('CustomCDN', NULL, NULL, _t('自定义 CDN'), _t('
    <p class="description">上一个设置选择「自定义」，则通过此处设置的 CDN 引入主题所需的静态文件。</p>
    <p class="description">如果您拥有自己的储存服务，可以将主题的 assets 目录上传，选择「自定义」并在这里填写对应的 URL，以 “/” 结尾。</p>'));
    $form->addInput($CustomCDN);
    //夜间模式设置
    $DarkMode = new Typecho_Widget_Helper_Form_Element_Select('DarkMode', array(
        'default' => _t('默认日间模式，自动+手动开关（默认）'),
        'dark' => _t('默认夜间模式，自动+手动开关'),
        'no' => _t('总是日间模式，不可开关（不启用夜间模式）'),
        'always' => _t('总是夜间模式，不可开关'),
    ),
    'default',
    _t('选择「夜间模式」应用方式'),
    _t('选择如何在你的网站上应用夜间模式')
    );
    $form->addInput($DarkMode->addRule('required', _t('此处必须设置')));
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
        _t('是否启用 <a rel="nofollow noreferrer" target="_blank" href="https://busuanzi.ibruce.info/">不蒜子</a> 统计功能'),
        _t('
            <a rel="nofollow noreferrer" target="_blank" href="https://busuanzi.ibruce.info/">不蒜子</a>是一个即装即用的网页 js 计数脚本，目前可与主题进行对接显示访问数，<b>默认启用</b>
        ')
    );
    $form->addInput($EnableBusuanzi->addRule('required', _t('此处必须设置')));
    //启用字数统计
    $EnableWordsCounter = new Typecho_Widget_Helper_Form_Element_Radio('EnableWordsCounter', array(
        'able' => _t('启用'),
        'disable' => _t('停用'),
    ),
    'disable',
    _t('是否启用 <a rel="nofollow noreferrer" target="_blank" href="https://github.com/elatisy/Typecho_WordsCounter">字数统计</a> 功能'),
    _t('
        <a rel="nofollow noreferrer" target="_blank" href="https://github.com/elatisy/Typecho_WordsCounter">字数统计</a>是一个基于WordsCounter插件统计全站字数的
    ')
    );
    $form->addInput($EnableWordsCounter->addRule('required', _t('此处必须设置')));

    /**
     * 自定义 & 开发者设置
     */
    //自定义时间显示
    $timeFormat = new Typecho_Widget_Helper_Form_Element_Text('timeFormat', NULL, NULL, _t('<h2>自定义</h2> 自定义时间格式'), _t('
        <p class="description">留空则默认采用人性化时间（即“昨天、前天、几天前”），若不想要使用人性化时间则在此填入 PHP 时间格式，例如：<code>Y-m-d G:i:s</code></p>'));
    $form->addInput($timeFormat);
    //自定义页脚附加信息
    $footerInfo = new Typecho_Widget_Helper_Form_Element_Text('footerInfo', NULL, NULL, _t('页脚附加信息'), _t('
        <p class="description">将会在显示在 footer 标签结束之前，即页脚版权信息和不算子统计之后，可以在这里写入备案信息等附加内容</p>'));
    $form->addInput($footerInfo);
    //自定义导航栏
    $customNav = new Typecho_Widget_Helper_Form_Element_Textarea('customNav', NULL, NULL, _t('自定义导航栏'), _t('
        <p class="description">用 JSON 书写，具体格式参考文档。</p>'));
    $form->addInput($customNav);
    //自定义 head
    $customHead = new Typecho_Widget_Helper_Form_Element_Textarea('customHead', NULL, NULL, _t('自定义 head 头部'), _t('
        <p class="description">将会输出在 head 标签结束之前，通常用于引入 css 文件。</p>'));
    $form->addInput($customHead);
    //自定义 footer
    $customFooter = new Typecho_Widget_Helper_Form_Element_Textarea('customFooter', NULL, NULL, _t('自定义 footer 页脚'), _t('
        <p class="description">将会输出在 body 标签结束之前，通常用于引入 js 文件。</p>'));
    $form->addInput($customFooter);
    //自定义 pjax 回调函数
    $pjaxCallback = new Typecho_Widget_Helper_Form_Element_Textarea('pjaxCallback', NULL, NULL, _t('Pjax 回调函数'), _t('
        <p class="description">用于在 Pjax 切换页面后刷新某些元素，避免失效。如果你没有使用其他插件或者没有遇到问题，这里应当留空。</p>'));
    $form->addInput($pjaxCallback);
}
