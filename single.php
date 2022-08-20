<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('includes/header.php'); ?>

<div class="col-12" id="main" role="main">
    <article class="post post-atpage" itemscope itemtype="http://schema.org/BlogPosting">
        <div class="post-header">
            <h1 class="post-title post-title-atpage<?php if($this->is('page')): ?> page-title-atpage<?php endif; ?>" itemprop="name headline"><?php $this->title() ?></h1>
            <?php if($this->is('post')): ?>
            <ul class="post-meta post-meta-atpage">
                <li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
                <li><?php $this->category(','); ?></li>
                <?php if($this->user->hasLogin()):?>
                <li><a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" no-pjax>编辑</a></li>
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
</div>

<?php $this->need('includes/footer.php'); ?>