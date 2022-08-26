<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer id="footer" role="contentinfo">
	&copy; <?php Matcha::copyrightYear(); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
	<?php Matcha::footerInfo(); ?>
	<!-- 返回顶部按钮 -->
	<div id="helpbar">
		<?php if($this->options->DarkMode=='default' || $this->options->DarkMode=='dark'){ ?><button id="light-switch" title="开关灯"><span class="iconfont">&#xe7ac;</span></button><?php } ?>
		<button id="back2top" title="返沪顶部"><span class="iconfont">&#xe749;</span></button>
	</div>
</footer>
</div>
</div>

<footer id="script"><?php
	Matcha::footerSetting(); 
	Matcha::footer(); 
	$this->footer(); 
?></footer>

</body>
</html>