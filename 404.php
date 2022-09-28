<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('includes/header.php'); ?>
    <div class="error-page">
        <object width="200" height="200" class="error-img" data="<?php Utils::indexTheme('assets/404.svg'); ?>" type="image/svg+xml"></object>
        <div class="error-info">
            <h1 class="error-404">404</h1>
            <h2 class="error-title">页面... 我页面呢？</h2>
            <p>我那么大一个页面怎么不见了？</p>
            <a href="<?php Utils::indexHome() ?>">返回首页</a>
        </div>
    </div>
<?php $this->need('includes/footer.php'); ?>
