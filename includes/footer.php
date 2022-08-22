<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer id="footer" role="contentinfo">
	&copy; <?php 
		if($this->options->startDate==''){
			echo date('Y');
		}else{
			$date=explode('-', $this->options->startDate);
			if($date[0]==date('Y')){
				echo date('Y');
			}elseif($date[0]<date('Y')){
				echo $date[0].' - '.date('Y');
			}else{
				echo '<span style="cursor:help" onclick="Toaster.send(\'博主把建站日期写错啦\');">偷偷告诉你，其实我是时空旅行者</span>';
			}
		}
	 ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
	<br />
	<?php if ($this->options->icpNum):?>
	<a rel="nofollow" href="http://beian.miit.gov.cn"> <?php $this->options->icpNum(); ?> </a>
	<br />
	<?php endif;
	if ($this->options->EnableBusuanzi == 'able' ): ?>
	<span id="busuanzi_value_site_pv">......</span> 次访问 ·
	<span id="busuanzi_value_site_uv">......</span> 位访客 
	<?php endif; ?>
</footer>
</div>
</div>

<?php if ($this->options->EnableBusuanzi == 'able' ): ?>
<script async src="//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js"></script>
<?php endif; ?>

<script>siteurl='<?php Utils::indexHome(); ?>';
pjaxCallback=function(){<?php $this->options->pjaxCallback(); ?>};
AjaxCommentEnabled='<?php $this->options->EnableAjaxComment(); ?>';
RandomLinks='<?php $this->options->EnableRandomLinks(); ?>';</script>

<?php //输出统计代码、js 引用等
if ($this->options->statCode) { $this->options->statCode(); } ?></div>
<?php Matcha::footer(); $this->footer(); ?>
</body>
</html>