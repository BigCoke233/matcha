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
            <li>Theme <a rel="nofollow" target="_blank" href="https://github.com/BigCoke233/matcha">Matcha</a> by <a  target="_blank" href="https://https://github.com/BigCoke233/">Eltrac</a></li>
            <li>Powered by <a rel="nofollow" target="_blank" href="http://www.typecho.org">Typecho</a></li>
        </ul>
    </section>
</div><!--end #sidebar -->