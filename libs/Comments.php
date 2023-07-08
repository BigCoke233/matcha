<?php
Class Comments {
    /**
     * 解决评论框不跟随
     */
    public static function replyScript($archive) {
        if ($archive->allow('comment')) echo "<!--<nocompress>--><script type=\"text/javascript\">(function(){window.TypechoComment={dom:function(id){return document.getElementById(id)},create:function(tag,attr){var el=document.createElement(tag);for(var key in attr){el.setAttribute(key,attr[key])}return el},reply:function(cid,coid){var comment=this.dom(cid),parent=comment.parentNode,response=this.dom('$archive->respondId'),input=this.dom('comment-parent'),form='form'==response.tagName?response:response.getElementsByTagName('form')[0],textarea=response.getElementsByTagName('textarea')[0];if(null==input){input=this.create('input',{'type':'hidden','name':'parent','id':'comment-parent'});form.appendChild(input)}input.setAttribute('value',coid);if(null==this.dom('comment-form-place-holder')){var holder=this.create('div',{'id':'comment-form-place-holder'});response.parentNode.insertBefore(holder,response)}comment.appendChild(response);this.dom('cancel-comment-reply-link').style.display='';if(null!=textarea&&'text'==textarea.name){textarea.focus()}return false},cancelReply:function(){var response=this.dom('$archive->respondId'),holder=this.dom('comment-form-place-holder'),input=this.dom('comment-parent');if(null!=input){input.parentNode.removeChild(input)}if(null==holder){return true}this.dom('cancel-comment-reply-link').style.display='none';holder.parentNode.insertBefore(response,holder);return false}}})();</script><!--</nocompress>-->";
    }

    /**
     * 获取上级评论人
     */
    public static function getParent($coid){
        $db   = Typecho_Db::get();
        $prow = $db->fetchRow($db->select('parent')
            ->from('table.comments')
            ->where('coid = ? AND status = ?', $coid, 'approved'));
        $parent = $prow['parent'];
        if ($parent != "0") {
            $arow = $db->fetchRow($db->select('text','author','status')
                ->from('table.comments')
                ->where('coid = ?', $parent));
            $author = $arow['author'];
            $status = $arow['status'];
            if($author){
                if($status=='approved'){
                    $href   = ' <span class="comment-at">回复 <a uid="'.$parent.'" href="#li-comment-'.$parent.'">@'.$author.'</a></span>';;
                }else if($status=='waiting'){
                    $href   = '<a>评论审核中···</a>';
                }
            }
            echo $href;
        } else {
            echo "";
        }
    }

    /**
     * 获取 Cravatar 头像链接
     */
    public static function gravatar($email, int $size = 100, int $useCDN = NULL)
    {
        //MD5 EMail
        $email = md5($email);

        // 如果配置了 CustomGravatarCDN，则用 CustomGravatarCDN 拼接
        if (Helper::options()->CustomGravatarCDN) {
            $avatar = Helper::options()->CustomGravatarCDN . $email . '?s=' . $size;
        } // 否则，使用 Cravatar
        else {
            $avatar = 'https://cravatar.cn/avatar/' . $email . '?s=' . $size;
        }

        return $avatar;
    }

    /**
     * 获取评论者头像
     */
    public static function getAvatar($email, int $size = 100)
    {
        //Hash
        $email_hash = md5(strtolower($email));

        //EMail
        $email = strtolower($email);

        $avatar = self::gravatar($email, $size);

        return $avatar;
    }
}