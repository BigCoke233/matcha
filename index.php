<?php
/**
 * 简洁清新的纯文字 Typecho 主题
 * 
 * @package Typecho Theme Matcha
 * @author memset0, Eltrac
 * @version 0.1.0
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
				<li itemprop="interactionCount"><a href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('0 评论', '1 评论', '%d 评论'); ?></a></li>
			</ul>
            <div class="post-content" itemprop="articleBody">
				<?php $this->content(''); ?>
            </div>
		</article>
	<?php endwhile; ?>

	<div class="page-navigator">
	  <span id="previous"><?php $this->pageLink('<span class="iconfont">&#xe628;</span>'); ?></span>
    	  <span id="next"><?php $this->pageLink('<span class="iconfont">&#xe642;</span>','next'); ?></span>
    	</div>
</div><!-- end #main-->

<?php $this->need('includes/footer.php'); ?>