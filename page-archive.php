<?php
/**
 * 归档页面
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');
?>
<div class="col-12" id="main" role="main">
	<div id="search">
	  	<input type="text" placeholder="搜索博客文章" name="" id="input_search" value="" />
        <a id="search-button"><span class="iconfont">&#xe82e;</span></a>
	</div>
	<div id="tag">
	  <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=30')->to($tags); 	
	   if($tags->have()): ?>
	   <h2>标签云</h2>
	   <ul class="tags-list">
		<?php while ($tags->next()): ?>
    		<li><a href="<?php $tags->permalink(); ?>" rel="tag" title="<?php $tags->count(); ?> 个话题">#<?php $tags->name(); ?></a></li>
		<?php endwhile; ?>
    	   </ul>
	   <?php endif; ?>
	</div>
	<br>
	<div class="archive-post" id="post-list">
	<?php
    $archives = Matcha::archives($this);
    $number = 0;
    foreach($archives as $year => $posts) {
        $open = ($number === 0) ? NULL : ' closed';
		echo '<h2 class="archive-year">'.$year.' 年 <button id="archive-button-'.$year.'" class="archive-button'.$open.'"><span class="iconfont">&#xe749;</span></button></h2>';
        echo '<ol id="archive-list-'.$year.'" class="archive-list'.$open.'">';
    		foreach($posts as $created => $post) {
        		echo '<li class="archive-item"><a href="'.$post['permalink'].'" class="no-line">
				<span class="archive-date">'.date('m-d', $created).'</span> · 
				'.$post['title'].'
				</a></li>';
			}
        echo '</ol>';
        $number++;
      }?>
	</div>
</div><!-- end #main-->

<?php $this->need('includes/footer.php'); ?>