<?php
/**
 * 留言页面
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('includes/header.php');?>

<div class="col-12" id="main" role="main">
    <?php $GLOBALS['msgPage']=true;
    $this->need('includes/comments.php');
    $GLOBALS['msgPage']=false; ?>
</div>

<?php $this->need('includes/footer.php'); ?>