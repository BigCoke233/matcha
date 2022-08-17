<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-12" id="main" role="main">
	<!-- 文章列表 -->
	<?php while($this->next()): ?>
		<article class="post post-atmain" itemscope itemtype="http://schema.org/BlogPosting">
			<h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
			<ul class="post-meta">
				<li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
				<li><?php $this->category(','); ?></li>
				<li itemprop="interactionCount"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></a></li>
			</ul>
            <div class="post-content" itemprop="articleBody">
				<?php Matcha::excerpt($this); ?>
            </div>
		</article>
	<?php endwhile; ?>
	<!-- 分页按钮 -->
	<div class="page-navigator">
	  <span id="previous"><?php $this->pageLink('<span class="iconfont">&#xe628;</span>'); ?></span>
      <span id="next"><?php $this->pageLink('<span class="iconfont">&#xe642;</span>','next'); ?></span>
    </div>
</div>