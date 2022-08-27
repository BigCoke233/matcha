<?php
/**
 * functions.php
 * 
 * 主题初始化
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once('libs/Utils.php');
require_once('libs/Matcha.php');
require_once('libs/Options.php');
require_once('libs/Comments.php');

Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Matcha','parseContent');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Matcha','parseContent');

function themeInit($archive) {
    if ($archive->hidden) header('HTTP/1.1 200 OK');//暴力解决访问加密文章会被 pjax 刷新页面的问题
    Helper::options()->commentsAntiSpam = false; //关闭反垃圾
    Helper::options()->commentsMaxNestingLevels = '9999';//最大嵌套层数
    Helper::options()->commentsPageDisplay = 'first';//强制评论第一页
    Helper::options()->commentsOrder = 'DESC';//将最新的评论展示在前
    Helper::options()->commentsCheckReferer = false;//关闭检查评论来源URL与文章链接是否一致判断(否则会无法评论)
}

function themeFields($layout)
{
    $showTOC = new Typecho_Widget_Helper_Form_Element_Radio('showTOC', array(
        true => _t('开启'), 
        false => _t('关闭')),
        false, 
        _t('是否开启文章目录'), 
        _t('解析文章目录展示在文章页面左侧，代替侧边栏的位置'));
    $layout->addItem($showTOC);
}