<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer id="footer" role="contentinfo">
	&copy; <?php _e($this->options->startYear) ?> - <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
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
pjaxCallback=function(){<?php $this->options->pjaxCallback(); ?>}</script>

<?php
//输出统计代码
if ($this->options->hideStatCode == 'able' ): ?><div style="display:none"><?php endif; 
if ($this->options->statCode) { $this->options->statCode(); }
if ($this->options->hideStatCode == 'able'): ?></div><?php endif; 
//其他
Matcha::footer();
$this->footer(); ?>
</body>
</html>