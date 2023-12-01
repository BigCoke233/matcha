<?php
/**
 * 友链页面
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');?>

<div class="col-12" id="main" role="main">
    <article class="post post-atpage" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="post-header">
            <h1 class="post-title post-title-atpage page-title-atpage" itemprop="name headline"><?php $this->title() ?></h1>
        </div>
        <div class="links-container container-fluid">
            <?php if(Utils::isPluginAvailable('Links')) {
            Links_Plugin::output('<a href="{url}" target="_blank" title="{title}" class="links-item" no-linkTarget>
                <div class="links-content">
                    <section class="links-avatar">
                        <img src="'.Utils::indexThemeUrl('assets/loading.gif').'" data-src="{image}" class="links-img lazy" />
                    </section>
                    <section class="links-profile">
                        <h4 class="links-name">{name}</h4>
                        <p class="links-description">{title}</p>
                    </section>
                </div>
            </a>'); }
            else {
                echo 'Links 插件未启用，若要使用友情连接功能，请安装并启用 Links 插件。';
            }?>
        </div>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>
    <?php $this->need('includes/comments.php'); ?>
</div>

<?php $this->need('includes/footer.php'); ?>