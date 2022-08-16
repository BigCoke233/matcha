<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require('libs/Utils.php');

function themeConfig($form) {

    //更友好的界面
    _e('<div id="typecho-welcome">
            <h3>欢迎使用 <a href="https://github.com/memset0/typecho-theme-ringo">Typecho Theme Ringo</a>！ <img src="https://img.shields.io/github/stars/memset0/typecho-theme-ringo.svg?style=social"></h3s>
            <li> Brought You By <a href="https://memset0.cn">memset0</a> and <a href="https://github.com/abc1763613206">abc1763613206</a> </li>
            <ul>
                <li>当前最新版本 <a href="https://github.com/memset0/typecho-theme-ringo"><img src="https://img.shields.io/github/release/memset0/typecho-theme-ringo.svg?style=flat-square" alt="https://img.shields.io/github/release/memset0/typecho-theme-ringo.svg?style=flat-square" ></a> </li> 
                <li> 请在下方进行您的主题设置。<b>务必将每一个单选框都设定一遍</b>以保证在之后的使用中不会出问题。 </li>
                <li> 有问题请在 Github Issues 中反馈：<a href="https://github.com/memset0/typecho-theme-ringo/issues"> https://github.com/memset0/typecho-theme-ringo/issues</a>  </li>
            </ul> 
        </div>
        <hr class="line"></hr>
        ');

    //header 相关
    
    $displayTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'displayTitle',
        NULL,
        NULL,
        _t('显示站点标题'),
        _t('
            <p class="description">在这里填入在侧边栏显示的站点标题，如不设置 <b>默认为当前站点标题</b> ，可以通过插入 <code>&lt;br&gt;</code> 换行！</p>
            <p class="description"><b>建议一行内不超过 10 字符以确保最佳体验</b></p>
        ')
    );
    $form->addInput($displayTitle);

    $displayCoTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'displayCoTitle',
        NULL,
        NULL,
        _t('显示站点描述'),
        _t('
            <p class="description">在这里填入在侧边栏显示的站点副标题（站点标题下方一行灰色小字），如不设置 <b>默认为站点描述</b> ，可以通过插入 <code>&lt;br&gt;</code> 换行！
            <p class="description"><b>建议一行内不超过 10 字符以确保最佳体验</b></p>
        ')
    );
    $form->addInput($displayCoTitle);

    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'logoUrl',
        NULL,
        NULL,
        _t('站点 LOGO 地址'),
        _t('
            <p class="description">在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO。</p>
            <p class="description"><b>如果填写会将替换标题和副标题！</b></p>
        ')
    );
    $form->addInput($logoUrl->addRule('xssCheck', _t('请不要在图片链接中使用特殊字符')));

    //footer 相关
    
    $IfDisplayPages = new Typecho_Widget_Helper_Form_Element_Radio('IfDisplayPages', array(
            'able' => _t('显示'),
            'disable' => _t('不显示'),
        ),
        'able',
        _t('是否在侧边栏显示创建的页面'),
        _t('
            <p class="description">是否显示侧边栏的页面（多用于关于&&友情链接），<b>默认显示</b></p>
        ')
    );
    $form->addInput($IfDisplayPages->addRule('required', _t('此处必须设置')));

    $WhereToDisplaySearch = new Typecho_Widget_Helper_Form_Element_Radio('WhereToDisplaySearch', array(
            'top' => _t('顶部'),
            'bottom' => _t('底部'),
            'none' => _t('不显示'),
        ),
        'none',
        _t('搜索框显示位置'),
        _t('
            <p class="description">因个人口味而异，<b>默认不显示</b></p>
        ')
    );
    $form->addInput($WhereToDisplaySearch->addRule('required', _t('此处必须设置')));
    
    $icpNum = new Typecho_Widget_Helper_Form_Element_Text('icpNum', NULL, NULL, _t('网站备案号'), _t('在这里填入中国大陆的ICP网站备案号（无需带a标签，如 <code>浙ICP备19006255号-1</code> ），留空则不显示'));
    $form->addInput($icpNum);

    $startYear = new Typecho_Widget_Helper_Form_Element_Text('startYear', NULL, '2017', _t('网站建立年份'), _t('在这里填入您网站建立年份（显示在页面底部），<b>必须填写</b>'));
    $form->addInput($startYear->addRule('required', _t('此处必须填写')));
    $statCode = new Typecho_Widget_Helper_Form_Element_Text('statCode', NULL, NULL, _t('站点统计代码'), _t('

        <p class="description">在这里填入 <b>带 script 标签的</b> 站点统计代码，留空则不显示。（建议您对代码进行简单的压缩）</p>
        <hr class="line"></hr>
        '));
    $form->addInput($statCode);
    $hideStatCode = new Typecho_Widget_Helper_Form_Element_Radio('hideStatCode', array(
            'able' => _t('隐藏'),
            'disable' => _t('显示'),
        ),
        'able',
        _t('是否隐藏统计标志'),
        _t('
            <p class="description">是否将统计标志用 CSS 的 display 函数隐藏起来（常用于隐藏 CNZZ 等统计站点显示的标志，防止影响美观），<b>默认隐藏</b></p>
            <p class="description"><b>现阶段暂没有对显示内容的统计标志做特别优化，因而会出现显示错乱的问题，建议隐藏。</b></p>
        ')
    );
    $form->addInput($hideStatCode->addRule('required', _t('此处必须设置')));

    //附加功能相关


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

    $EnableWordsCounter = new Typecho_Widget_Helper_Form_Element_Radio('EnableWordsCounter', array(
            'able' => _t('启用'),
            'disable' => _t('停用'),
        ),
        'disable',
        _t('是否启用 <a rel="nofollow" target="_blank" href="https://github.com/elatisy/Typecho_WordsCounter">WordsCounter</a> 适配功能'),
        _t('
            <p class="description">与插件 <a rel="nofollow" href="https://github.com/elatisy/Typecho_WordsCounter">WordsCounter</a> 配合使用，显示在侧边栏下方，可以统计文章字数。<b>默认停用</b></p>
            <p class="description"><b>启用前请务必确保您安装启用好了这个插件！</b></p>
        ')
    );
    $form->addInput($EnableWordsCounter->addRule('required', _t('此处必须设置')));


    //实验性功能
    $IfDisplayNone = new Typecho_Widget_Helper_Form_Element_Radio('IfDisplayNone', array(
            'able' => _t('显示'),
            'disable' => _t('不显示'),
        ),
        'disable',
        _t('是否显示 none 标签'),
        _t('
            <p class="description"><b>实验性功能</b>:是否显示文章中的 none 标签，<b>默认不显示</b></p>
            <p class="description">Typecho 的文章如果没有标签，默认会显示一个无样式的 none</p>
            <p class="description">本主题已经对 none 标签进行了特殊优化使其更加美观，当然你也可以直接将其移除</p>
        ')
    );
    $form->addInput($IfDisplayNone->addRule('required', _t('此处必须设置')));

    $IndexDisplayMode = new Typecho_Widget_Helper_Form_Element_Radio('IndexDisplayMode', array(
            'FullText' => _t('显示全文(可使用more标签截断)'),
            'Title' => _t('仅显示标题'),
            'AutoExcerpt' => _t('自动截断(不推荐,丢失格式)'),
            'AutoSummary' => _t('另一种自动截断(截断第一部分标题中部分,保留格式)'),
            'Excerpt200' => _t('总是截断前200字符(丢失格式)')
        ),
        'FullText',
        _t('首页文章显示模式'),
        _t('
            <p class="description"><b>实验性功能</b>:重写了文章的显示部分，运用<code>excerpt</code>和<code>summary</code>标签断开</p>
            <p class="description"><b>默认为显示全文，在其他模式下more标签可能失效。</b></p>
        ')
    );
    $form->addInput($IndexDisplayMode->addRule('required', _t('此处必须设置')));

    //现阶段下该设置基本无用，注释掉好了
    /*
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));

    
    
    $form->addInput($sidebarBlock->multiMode());
    */
}
