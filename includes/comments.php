<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    } 
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>
<div role="comment" id="<?php $comments->theId(); ?>" class="comment-body<?php 
if ($comments->_levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}
$comments->alt(' comment-odd', ' comment-even');
echo $commentClass; 
?>">
    <div class="comment-body-inner">
      <div class="comment-avatar">
        <img class="lazy avatar" src="<?php Utils::indexTheme('assets/loading.gif'); ?>" data-src="<?php echo Comments::getAvatar($comments->mail); ?>" />
        <span class="comment-reply">
		      <?php $comments->reply('回复'); ?>
		    </span>
      </div>
	  <div class="comment-main comment-author-info">
		<div class="comment-content">
		  <?php $comments->content(); ?>
	    </div>
		<p class="comment-meta">
		  <span class="comment-author">
        <a href="<?php echo $comments->url; ?>" target="_blank"><?php echo $comments->author; ?></a>
      </span>
		  <span class="comment-date">
		    <?php if ('waiting' == $comments->status) { ?>
            <em class="comment-waiting">您的评论正在审核中。</em>
            <?php } else { ?>
		    <?php echo Matcha::date($comments->created); 
              Comments::getParent($comments->coid); 
			  } ?>
		  </span>
		</p>
	  </div>
	</div>
	  <?php if ($comments->children) { ?>
        <div class="comment-children">
          <?php $comments->threadedComments($options); ?>
        </div>
      <?php } ?>
</div>
<?php } 
Comments::replyScript($this); ?>
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <script>login=false;</script>
        <?php $msg=isset($GLOBALS['msgPage']) && $GLOBALS['msgPage']; ?>
        <h2 class="comment-form-title<?php if($msg) echo ' message-page-title'; ?>">
          <?php if($msg){ $this->title(); } else { echo '添加新评论'; }  ?>
          <span class="cancel-comment-reply"><?php $comments->cancelReply(); ?></span>
        </h2>
        <?php if($msg) $this->content(); ?>
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
              <div class="submit-text submit-section">
                <textarea rows="8" cols="50" name="text" id="textarea" class="textarea" placeholder="留下你的智慧 ~" required ><?php $this->remember('text'); ?></textarea>
              </div>
              <div class="submit-action submit-section">
                <?php if($this->user->hasLogin()): ?>
                <div class="comments-profile">
                  <?php $this->author->gravatar(32); ?>
                  <div class="comments-profile-author">
                    <a class="comments-profile-name" href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a><br>
                    <a class="comments-logout" href="<?php $this->options->logoutUrl(); ?>" title="Logout" no-pjax><?php _e('退出'); ?></a>
                  </div>
                </div>
                <script>login=true;</script>
                <?php else: ?>
                <input class="input-username" type="text" name="author" id="author" class="text" placeholder="用户名" value="<?php $this->remember('author'); ?>" required />
                <input class="input-email" type="email" name="mail" id="mail" class="text" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                <input class="input-url" type="url" name="url" id="url" class="text" placeholder="网址 (选填) " value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                <?php endif; ?>
                <button class="submit" id="comment-submit"><?php if(!$msg) { echo '提交评论'; } else { echo '写下留言'; } ?></button>
              </div>
              <div class="submit-extra">
                <div class="owo"></div>
                <?php if(Utils::isPluginAvailable('CommentToMail') || Utils::isPluginAvailable('Mailer')): ?>
                <div class="comments-mail-me">
                  <input aria-label="有回复时通知我" name="receiveMail" type="checkbox" value="yes" id="receiveMail" checked />
                  <label for="receiveMail">有回复时通知我</label>
                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
    <?php else: 
    $show=false;
    if(isset($_COOKIE["commentsClosedKnown"])){
      if($_COOKIE["commentsClosedKnown"]!='y') $show=true;
    }else{
      $show=true;
    }
    if($show){ ?>
      <div class="comment-closed"><p>本页的评论功能已关闭</p><button id="comment-closed">×</button></div>
    <?php } endif; ?>

    <?php if ($comments->have()): ?>
    <?php $comments->listComments(); ?>
    <div class="comment-pagenav"><?php $comments->pageNav(
      '<span class="iconfont">&#xe628;</span>', 
      '<span class="iconfont">&#xe642;</span>'); ?></div>
    <?php endif; ?>
</div>