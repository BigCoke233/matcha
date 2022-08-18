<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <!-- start #optimize -->
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
    <link rel="dns-prefetch" href="//secure.gravatar.com" />
    <link rel="dns-prefetch" href="//busuanzi.ibruce.info" />

    <!-- 关闭百度转码 -->
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <!-- end #optimize -->
    
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php //设置 favicon
    if($this->options->favicon){ ?>
    <link rel="icon" type="image/x-icon" href="<?php $this->options->favicon(); ?>">
    <?php } 
    //输出网站标题、css 引用和其他 head 内容 ?>
    <title><?php Matcha::title($this); ?></title>
    <?php Matcha::head(); $this->header(); ?>
</head>