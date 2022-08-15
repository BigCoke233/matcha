<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <!-- start #optimize -->
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
    <link rel="dns-prefetch" href="//secure.gravatar.com" />
    <link rel="dns-prefetch" href="//busuanzi.ibruce.info" />
    <link rel="dns-prefetch" href="//cdn.bootcss.com" />

    <!-- 关闭百度转码 -->
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <!-- end #optimize -->
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">

    <!-- 自适应 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
    　　<script src="https://cdn.jsdelivr.net/gh/livingston/css3-mediaqueries-js@master/css3-mediaqueries.min.js"></script>
    <![endif]-->
	
	<link rel="icon" type="image/x-icon" href="favicon.png">

    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/grid.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/style.css'); ?>?2019081002">
    
    <!--[if lt IE 9]>
    <script src="//cdn.jsdelivr.net/gh/aFarkas/html5shiv@latest/dist/html5shiv.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/scottjehl/Respond@latest/dest/respond.min.js"></script>
    <![endif]-->

    <?php $this->header(); ?>
</head>
<body>

<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->

<!-- 移动端适配 -->
<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/compatible.css'); ?>">

<!-- 也显示出一遍正常标题来以便适配移动端 -->
<div style="display:none" class="compatible">
            <a id="logo" class="site-title" href="<?php Utils::indexHome(); ?>">
                <?php $this->options->title();?> 
            </a>
            <p class="description site-description">
                <?php $this->options->description();?>
            </p>
</div>

<header id="header" class="clearfix">
    <div class="site-name">
    <?php if ($this->options->logoUrl): ?>
        <a id="logo" href="<?php $this->options->siteUrl(); ?>">
            <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />
        </a>
    <?php else: ?>
        <a id="logo" href="<?php Utils::indexHome(); ?>" class="site-title">
            <?php if ($this->options->displayTitle) { $this->options->displayTitle(); }else{ $this->options->title();}?> 
        </a>
        <p class="description site-description">
            <?php if ($this->options->displayCoTitle) { $this->options->displayCoTitle(); }else{ $this->options->description();}?>
        </p>
    <?php endif; ?>
    </div>
</header><!-- end #header -->

<?php $this->need('includes/sidebar.php'); ?>

<div id="body">
    <div class="container">

<div class="small-header" id="small-header"  onclick="window.open('<?php $this->options->siteUrl(); ?>','_self')">
    <div class="site-name">
    <?php if ($this->options->logoUrl): ?>
        <a id="logo" href="<?php Utils::indexHome(); ?>">
            <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>" />
        </a>
    <?php else: ?>
        <a id="logo" href="<?php Utils::indexHome(); ?>" class="site-title">
            <?php if ($this->options->displayTitle) { $this->options->displayTitle(); }else{ $this->options->title();}?> 
        </a>
        <p class="description site-description">
            <?php if ($this->options->displayCoTitle) { $this->options->displayCoTitle(); }else{ $this->options->description();}?>
        </p>
    <?php endif; ?>
    </div>

    <div class="page-links">
    <?php if ($this->options->IfDisplayPages == 'able' ): ?>
        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php while($pages->next()): ?>
        <span><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></span>
        <?php endwhile; ?>
    <?php endif ?>
    </div>
</div>

<?php if ($this->options->WhereToDisplaySearch == 'top' ): ?>
	<div class="site-search-top">
		<form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
			<label for="s" class="sr-only">搜索关键字</label>
			<input type="text" id="s" name="s" class="text" placeholder="在这里输入关键字哦 ~ (回车搜索)" />
			<!-- <button type="submit" class="submit">搜索</button> -->
		</form>
	</div>
<?php endif; ?>