<?php 
/**
 * 文章列表
 * posts.php
 */
if($this->is('index') && $this->options->relatedLinksTitle!='' && $this->options->relatedLinks!='' && $this->_currentPage == 1): ?><h2 class="section-title">最新文章</h2><?php endif; ?>
<section class="latest-post<?php if($this->is('archive')) { ?> archive-post<?php } ?>">
<?php if($this->have()) {
	while($this->next()): ?>
		<article class="post post-atmain<?php if($this->fields->thumbnail!='') echo ' post-with-thumbnail'; ?>" itemscope itemtype="http://schema.org/BlogPosting">
			<div class="post-text">
				<h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php if($this->is('index')){$this->sticky();} $this->title() ?></a></h2>
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
	<?php endwhile;
	}else{ ?>
	<div class="error-page">
		<object width="200" height="200" class="error-img" data="<?php Utils::indexTheme('assets/404.svg'); ?>" type="image/svg+xml"></object>
		<div class="error-info">
			<h1 class="error-404">404</h1>
			<h2 class="error-title">什么都没有找到</h2>
			<p>对应的关键词找不到任何相关文章。</p>
			<a href="<?php Utils::indexHome() ?>">返回首页</a>
		</div>
    </div>
	<?php } ?>
</section>
<!-- 分页按钮 -->
<div class="page-navigator">
	<span id="previous"><?php $this->pageLink('<span class="iconfont">&#xe749;</span>'); ?></span>
    <span id="next"><?php $this->pageLink('<span class="iconfont">&#xe749;</span>','next'); ?></span>
</div>