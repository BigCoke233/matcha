<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
	<h3><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>
    
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo;', '&raquo;'); ?>
    
    <?php endif; ?>

    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
    
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
            <?php if($this->user->hasLogin()): ?>
            <p>
                <?php _e('登录身份: '); ?>
                <a href="<?php $this->options->profileUrl(); ?>">
                    <?php $this->user->screenName(); ?>
                </a>
                .
                <a href="<?php $this->options->logoutUrl(); ?>" title="Logout">
                    <?php _e('退出'); ?>
                    &raquo;
                </a>
            </p>
            <div class="submit-area">
            <?php else: ?>
            <div class="submit-area">
                <input type="text" name="author" id="author" class="text" placeholder="用户名" value="<?php $this->remember('author'); ?>" required />
                <input type="email" name="mail" id="mail" class="text" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                <input type="url" name="url" id="url" class="text" placeholder="网址 (选填) " value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
            <?php endif; ?>
                <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" placeholder="可以在这里写评论哦 ~" required ><?php $this->remember('text'); ?></textarea>
                <button type="submit" class="ripple submit"><?php _e('提交评论'); ?></button>
            </div>
        </form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
