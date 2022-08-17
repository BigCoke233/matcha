<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once('libs/Utils.php');
require_once('libs/Matcha.php');

function themeConfig($form) {
    //footer 相关
    
    $icpNum = new Typecho_Widget_Helper_Form_Element_Text('icpNum', NULL, NULL, _t('网站备案号'), _t('在这里填入中国大陆的ICP网站备案号（无需带a标签，如 <code>浙ICP备19006255号-1</code> ），留空则不显示'));
    $form->addInput($icpNum);

    $startYear = new Typecho_Widget_Helper_Form_Element_Text('startYear', NULL, '2022', _t('网站建立年份'), _t('在这里填入您网站建立年份（显示在页面底部），<b>必须填写</b>'));
    $form->addInput($startYear->addRule('required', _t('此处必须填写')));
    $statCode = new Typecho_Widget_Helper_Form_Element_Textarea('statCode', NULL, NULL, _t('站点统计代码'), _t('
        <p class="description">在这里填入 <b>带 script 标签的</b> 站点统计代码，留空则不显示。</p>
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

    //实验性功能
    $IndexDisplayMode = new Typecho_Widget_Helper_Form_Element_Radio('IndexDisplayMode', array(
            'FullText' => _t('显示全文'),
            'Excerpt200' => _t('总是截断前200字符'),
            'Title' => _t('仅显示标题')
        ),
        'FullText',
        _t('首页文章显示模式'),
        _t('
            <p class="description"><b>实验性功能</b>:重写了文章的显示部分，运用<code>excerpt</code>和<code>summary</code>标签断开</p>
            <p class="description"><b>默认为显示全文，在其他模式下more标签可能失效。</b></p>
        ')
    );
    $form->addInput($IndexDisplayMode->addRule('required', _t('此处必须设置')));
}
