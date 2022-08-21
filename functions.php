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

Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Matcha','parseContent');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Matcha','parseContent');