<?php
/**
 * 你愿意，等我回来吗？
 * 
 * @package Typecho Theme Ringo
 * @author memset0, abc1763613206
 * @version 0.2.4
 * @link https://github.com/memset0/typecho-theme-ringo
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');
?>
<div class="col-12" id="main" role="main">
	<?php /* $access = new Access_Core(); echo $access->overview['pv']['all']['total']; */?>
	<?php while($this->next()): ?>
		<article class="post post-atmain" itemscope itemtype="http://schema.org/BlogPosting">
			<h2 class="post-title" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
			<ul class="post-meta">
				<li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time></li>
				<li><?php $this->category(','); ?></li>
				<li itemprop="interactionCount"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 comment', '1 comment', '%d comments'); ?></a></li>
			</ul>
            <div class="post-content" itemprop="articleBody">
				<?php $this->content(''); ?>
            </div>
		</article>
	<?php endwhile; ?>

	<div class="page-navigator">
	  <span id="previous"><?php $this->pageLink('←'); ?></span>
    	  <span id="next"><?php $this->pageLink('→','next'); ?></span>
    	</div>
</div><!-- end #main-->

<?php $this->need('includes/footer.php'); ?>