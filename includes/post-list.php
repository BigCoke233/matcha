<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-12" id="main" role="main">
	<?php if($this->is('archive')) { ?><h3 class="archive-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ''); ?></h3><?php } ?>
	<?php if($this->is('index') && $this->options->relatedLinks!='' && $this->_currentPage == 1): ?><!-- 相关链接 -->
	<?php if($this->options->relatedLinksTitle!=''): ?><h2 class="section-title"><?php $this->options->relatedLinksTitle(); ?></h2><?php endif; ?>
	<section class="indexlink"><?php Matcha::relatedLinks($this); ?></section><?php endif; ?>
	<!-- 文章列表 -->
	<?php if($this->options->relatedLinksTitle!='' && $this->options->relatedLinks!='' && $this->_currentPage == 1): ?><h2 class="section-title">最新文章</h2><?php endif; ?>
	<section class="latest-post">
	<?php while($this->next()): ?>
		<article class="post post-atmain<?php if($this->fields->thumbnail!='') echo ' post-with-thumbnail'; ?>" itemscope itemtype="http://schema.org/BlogPosting">
			<div class="post-text">
				<h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->sticky(); $this->title() ?></a></h2>
				<ul class="post-meta">
					<li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php echo Matcha::date($this->created); ?></time></li>
					<li><?php $this->category(','); ?></li>
					<?php if($this->options->EnableViewsCount=='able'){ ?><li><?php Matcha::views($this); ?></li><?php } ?>
					<li itemprop="interactionCount"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></a></li>
				</ul>
				<div class="post-content" itemprop="articleBody">
					<?php Matcha::excerpt($this); ?>
				</div>
			</div><?php if($this->fields->thumbnail!=''): ?>
			<div class="post-thumbnail" md-hidden>
				<a href="<?php $this->permalink() ?>"><img class="lazy" src="<?php Utils::indexTheme('assets/loading.gif'); ?>" data-src="<?php $this->fields->thumbnail(); ?>"></a>
			</div><?php endif;?>
		</article>
	<?php endwhile; ?>
	</section>
	<!-- 分页按钮 -->
	<div class="page-navigator">
	  <span id="previous"><?php $this->pageLink('<span class="iconfont">&#xe749;</span>'); ?></span>
      <span id="next"><?php $this->pageLink('<span class="iconfont">&#xe749;</span>','next'); ?></span>
    </div>
</div>