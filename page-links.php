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
          <div class="row">
            <?php Links_Plugin::output('<a href="{url}" target="_blank" title="{title}" class="links-item" no-linkTarget>{name}</a>'); ?>
          </div>
        </div>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
    </article>
    <?php $this->need('includes/comments.php'); ?>
</div>

<?php $this->need('includes/footer.php'); ?>