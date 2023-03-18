<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!-- 侧边栏 -->
<aside id="sidebar" class="sidebar" role="complementary">
  <section class="widget widget-nav sidebar-nav">
    <header id="header" class="header"><?php Matcha::siteName(); ?></header>
    <ul class="widget-list">
      <li><a href="<?php $this->options->siteUrl(); ?>" rel="section">首页</a></li>
      <?php Matcha::categoryNav($this, "li"); ?>
      <?php Matcha::pageNav($this, "li"); ?>
    </ul>
  </section>
  <!-- 版权信息 -->
	<section class="widget sidebar-foot">
    <ul class="widget-list">
      <li>Theme <a rel="nofollow" target="_blank" href="https://github.com/BigCoke233/matcha" class="no-linkTarget">Matcha</a> by <a  target="_blank" href="https://github.com/BigCoke233/" class="no-linkTarget">Eltrac</a></li>
      <li>Powered by <a rel="nofollow" target="_blank" href="http://www.typecho.org" class="no-linkTarget">Typecho</a></li>
    </ul>
  </section>
</aside>
<!-- 工具栏 -->
<div id="helpbar">
<?php if($this->options->DarkMode=='default' || $this->options->DarkMode=='dark'){ ?><button id="light-switch" title="开关灯"><span class="iconfont">&#xe7ac;</span></button><?php } 
if(Utils::isPluginAvailable('ExSearch')) { ?><button class="search-form-input" title="搜索"><span class="iconfont">&#xe82e;</span></button><?php } ?>
</div>