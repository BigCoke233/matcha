<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="sidebar" role="complementary">
    <?php if ($this->options->IfDisplayPages == 'able' ): ?>
    <section class="widget">
        <ul class="widget-list">
        	  <li><a href="<?php Utils::indexHome(); ?>">首页</a></li>
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
            <li><a href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </section>
    <?php endif ?>

	<section class="widget sidebar-foot">
        <ul class="widget-list">
            <li>Theme <a rel="nofollow" target="_blank" href="https://github.com/memset0/typecho-theme-ringo">Ringo</a> by <a  target="_blank" href="https://memset0.cn">memset0</a></li>
            <li>Powered by <a rel="nofollow" target="_blank" href="http://www.typecho.org">Typecho</a></li>
        </ul>
    </section>
</div><!--end #sidebar -->

<div id="helpbar">
    <div class="back-to-top">
        <button id="back2top">↑</button>
        <script>
            back2top.onclick = function() {
                var movement = document.body.scrollTop || document.documentElement.scrollTop;
                scrollBy(0, -movement);
            }
        </script>
    </div>
</div><!--end #helpbar -->