<?php
/**
 * 文章汇总输出
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');

$this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
$year = 0;
$mon = 0;
$output = ''; 
while ($archives->next()):
	$year_tmp = date('Y', $archives->created);
	$mon_tmp = date('m', $archives->created);
	if ($year != $year_tmp) {   
		$year = $year_tmp;
		$mon = $mon_tmp;
		$output .= '
			<div class="post post-atmain archive-model">
				<h3 class="archive-year">'.$year.'</h3>
			</div>
		';
	} //输出年份   
	$output .= '
		<article class="post post-atmain archive-model" itemscope itemtype="http://schema.org/BlogPosting">
			<h2 class="archive-title" itemprop="name headline">
				<a itemprop="url" href="'.$archives->permalink .'">
					<time class="archive-time" datetime="'.date('c',$archives->created).'" itemprop="datePublished">'.date('m-d', $archives->created).'</time>
					· '. $archives->title .'
				</a>
			</h2>
		</article>
	'; //输出文章日期和标题
endwhile;
?>
<script type="text/javascript">
        function button_search(){
            var G=document.getElementById('input_search').value;
            G="http://"+window.location.host+"/index.php/search/"+G+"/";
            window.location.href=G;
        }
        function key_search(e){
          var evt = window.event || e;
          if (evt.keyCode == 13){
            var G=document.getElementById('input_search').value;
            G="http://"+window.location.host+"/index.php/search/"+G+"/";
            window.location.href=G;
          }
        }
    </script>
<div class="col-12" id="main" role="main">
	<div id="search">
	  <input type="text" placeholder="搜索博客文章" name="" id="input_search" value="" onkeydown="key_search(event);"/>
       <button onclick="button_search()"><span class="iconfont">&#xe82e;</span></button>
	</div>
	<div id="tag">
	  <?php $this->widget('Widget_Metas_Tag_Cloud', 'sort=mid&ignoreZeroCount=1&desc=0&limit=30')->to($tags); 	
	   if($tags->have()): ?>
	   <h2>标签云</h2>
	   <ul class="tags-list">
		<?php while ($tags->next()): ?>
    		<li><a href="<?php $tags->permalink(); ?>" rel="tag" title="<?php $tags->count(); ?> 个话题"><?php $tags->name(); ?></a></li>
		<?php endwhile; ?>
    	   </ul>
	   <?php endif; ?>
	</div>
	<div id="post-list">
		<h2>文章列表</h2>
		<?php echo $output; ?>
	</div>
</div><!-- end #main-->

<?php $this->need('includes/footer.php'); ?>