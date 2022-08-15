<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer id="footer" role="contentinfo">

	&copy; <?php _e($this->options->startYear) ?> - <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
	<br />
	<?php if ($this->options->icpNum):?>
		<a rel="nofollow" href="http://beian.miit.gov.cn"> <?php $this->options->icpNum(); ?> </a>
		<br />
	<?php endif;?>

	<?php if ($this->options->EnableBusuanzi == 'able' ): ?>
		<span id="busuanzi_value_site_pv">......</span> 次访问 ·
		<span id="busuanzi_value_site_uv">......</span> 位访客 
	<?php endif; ?>
	<?php if ($this->options->EnableBusuanzi == 'able' && $this->options->EnableWordsCounter == 'able' ): ?>
	·
	<?php endif; ?>
	<?php if ($this->options->EnableWordsCounter == 'able' ): ?>
		<span id="words_counter"><?php WordsCounter_Plugin::allOfCharacters(); ?></span> words
	<?php endif; ?>

</footer><!-- end #footer -->

<?php if ($this->options->WhereToDisplaySearch == 'bottom' ): ?>
<div class="site-search">
	<form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
		<label for="s" class="sr-only">搜索关键字</label>
		<input type="text" id="s" name="s" class="text" placeholder="在这里输入关键字哦 ~ (回车搜索)" />
		<!-- <button type="submit" class="submit">搜索</button> -->
	</form>
</div>
<?php endif; ?>
	</div>

</div><!-- end #body -->
<?php if ($this->options->EnableBusuanzi == 'able' ): ?>
<script async src="//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js"></script>
<?php endif; ?>

<!-- <style>.MathJax:focus {outline: none;}</style>
<script type="text/x-mathjax-config">
MathJax.Hub.Config({
	extensions: ["tex2jax.js"],
	jax: ["input/TeX","output/HTML-CSS"],
	"fast-preview": {disabled: true},
	tex2jax: {inlineMath:[ ["$", "$"] ],displayMath:[ ["$$","$$"] ],processEscapes: true},
	"HTML-CSS": { availableFonts: ["TeX"] }
});
</script>
<script type="text/javascript" src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script> -->

<script src="<?php Utils::indexTheme('assets/jquery.min.js'); ?>"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
<script src="<?php Utils::indexTheme('assets/pangu.js'); ?>"></script>
<script>siteurl='<?php Utils::indexHome(); ?>';</script>
<script src="<?php Utils::indexTheme('assets/script.js'); ?>"></script>

<?php if ($this->options->hideStatCode == 'able' ): ?>
	<div style="display:none">
<?php endif; ?>
<?php if ($this->options->statCode) { $this->options->statCode(); }?>
<?php if ($this->options->hideStatCode == 'able'): ?>
	</div>
<?php endif; ?>

<?php $this->footer(); ?>
</body>
</html>