<link rel="alternate" type="application/rss+xml" title="冰音Project" href="https://www.9bingyin.com/rss.xml">
<link rel="sitemap" type="application/xml" title="站点地图" href="<?php $this->options->siteUrl(); ?>sitemap.xml" />
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need("includes/head.php"); ?>
<body<?php Matcha::bodyClass(); ?>>
<?php $this->need('includes/sidebar.php'); ?>
<div id="body">
    <!-- 移动端导航 -->
    <div class="small-header" id="small-header">
        <div class="navbar">
            <div class="navbar-action">
                <div class="navbar-action-left">
                    <button class="navbar-button" id="nav-light"><span class="iconfont">&#xe7ac;</span></button>
                    
                </div>
                <div class="navbar-action-right">
                    <button class="navbar-button" id="nav-drop"><span class="iconfont">&#xe650;</span></button>
                </div>
            </div>
            <div class="navbar-dropdown">
                <button class="navbar-button navbar-dropup" id="nav-rise"><span>+</span></button>
                <h2>页面</h2>
                <ul class="widget-list"><li><a href="<?php $this->options->siteUrl(); ?>" rel="section">首页</a></li><?php Matcha::pageNav($this, "li"); ?></ul>
            </div>
        </div>
        <?php Matcha::siteName(); ?>
    </div>
    <!--页面主体-->
    <div class="container">