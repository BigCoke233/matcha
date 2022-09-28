<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-12" id="main" role="main">
    <?php 
    if($this->is('archive')) { 
        if($this->is('category')) { ?>
        <div class="category-page">
            <h3 class="category-page-title"><?php $this->archiveTitle('%s', '', ''); ?></h3>
            <p class="category-page-des"><?php echo $this->getDescription(); ?></p>
        </div><?php

        }
        elseif($this->is('tag')){ ?>
            <h3 class="tag-page-title"><? $this->archiveTitle('%s', '', ''); ?></h3><?php
        }
        else{ ?><h3 class="archive-title"><?
            $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ''); 
            ?></h3><?php
        }
    } ?>

	<?php //相关链接
    if($this->is('index') && $this->options->relatedLinks!='' && $this->_currentPage == 1):
	    if($this->is('index') && $this->options->relatedLinksTitle!=''): ?>
        <h2 class="section-title"><?php $this->options->relatedLinksTitle(); ?></h2>
        <?php endif; ?>
	<section class="indexlink"><?php Matcha::relatedLinks($this); ?></section>
    <?php endif; ?>

    <!-- 文章列表 -->
	<?php $this->need('includes/posts.php') ?>
</div>