<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('includes/header.php'); ?>

<div class="col-12" id="main" role="main">
    <article class="post post-atpage" itemscope itemtype="http://schema.org/BlogPosting">
        <?php if($this->fields->thumbnail!=''): ?>
        <div class="post-thumbnail-atpage" md-hidden>
            <img class="lazy" data-src="<?php $this->fields->thumbnail(); ?>">
        </div>
        <?php endif; ?>
        <div class="post-header">
            <h1 class="post-title post-title-atpage<?php 
            if($this->is('page')){ ?> page-title-atpage<?php } 
            ?>" itemprop="name headline"><?php 
                $this->title();?>
                <button id="focus-mode" title="专注模式"><span class="iconfont">&#xe869;</span></button>
            </h1>
            <?php if($this->is('post')): ?>
            <ul class="post-meta post-meta-atpage">
                <li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php echo Matcha::date($this->created); ?></time></li>
                <li><?php $this->category(','); ?></li>
                <?php if($this->options->EnableViewsCount=='able'){ ?><li><?php Matcha::views($this); ?></li><?php } ?>
                <?php if($this->user->hasLogin()):?>
                <li><a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" target="_blank" no-pjax>编辑</a></li>
                <?php endif ?>
            </ul>
        <?php endif; ?>
        </div>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
		<?php if($this->is('post')) $this->copyDog($this);?>

        <?php if ($this->is('post') && $this->tags): ?>
        <p itemprop="keywords" class="tags-list post-tags-list"><span class="tags-title iconfont">&#xe7ae;</span> <?php $this->tags(' ', true, ''); ?></p>
        <?php endif; ?>
    </article>

    <?php $this->need('includes/comments.php'); ?>

    <?php if($this->is('post') && $this->fields->showTOC==true): ?>
    <!-- 文章目录 -->
    <aside id="tocbar" class="tocbar">
        <div id="toc">该篇文章没有目录</div>
    </aside>
    <?php endif; ?>
</div>

<?php $this->need('includes/footer.php'); ?>