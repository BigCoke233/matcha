<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-12" id="main" role="main">
    <article class="post post-atpage" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title post-title-atpage" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <ul class="post-meta post-meta-atpage">
            <li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
            <li><?php $this->category(','); ?></li>
            <?php if($this->user->hasLogin()):?>
            <li><a href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>">编辑</a></li>
            <?php endif ?>
        </ul>
        <div class="post-content" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>
        <?php if ($this->options->IfDisplayNone == 'disable' ): ?>
        <p itemprop="keywords" class="tags"><?php $this->tags(' ', true, ''); ?></p>
        <?php else: ?>
        <p itemprop="keywords" class="tags"><?php $this->tags(' ', true, '<a href="#" class="none-tag">本文没有标签。</a>'); ?></p>
        <?php endif; ?>
    </article>

    <?php $this->need('comments.php'); ?>

    <div class="post-near">
        <div class="post-near-child post-near-child-left "><?php $this->theNext('%s', 'None'); ?> <br /> 上一篇 &laquo;</div>
        <div class="post-near-child post-near-child-right"><?php $this->thePrev('%s', 'None'); ?> <br /> &raquo; 下一篇</div>
    </div>
</div><!-- end #main-->

<?php $this->need('footer.php'); ?>