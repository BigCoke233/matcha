<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * Matcha.php
 * 处理主题显示的内容
 */

class Matcha
{
    /**
     * 输出头部
     * 包括 css 引用、标题
     */
    public static function head() {
        Matcha::linkCSS();
        Matcha::iconfont();
    }

    /**
     * 输出 link 标签引用 css
     */
    public static function linkCSS() {
        //要引入的 css 文件名
        $includes=array("grid", "style", "normalize");
        foreach($includes as $value){
            echo '<link rel="stylesheet" href="';
            Utils::indexTheme('assets/'.$value.'.css');
            echo '" />';
            echo PHP_EOL;
        }
    }

    /**
     * 引用 iconfont
     */
    public static function iconfont() {
        echo "<style>@font-face {font-family: 'iconfont';src: url('";
        Utils::indexTheme('assets/iconfont.woff2');
        echo "') format('woff2'),url('";
        Utils::indexTheme('assets/iconfont.woff'); 
        echo "') format('woff'),url('";
        Utils::indexTheme('assets/iconfont.ttf');
        echo "') format('truetype');}</style>";
    }

    /* ======================= */

    /**
     * 输出尾部
     * 包括 js
     */
    public static function footer() {
        Matcha::script();
    }

    /**
     * 输出尾部
     * 包括 js
     */
    public static function script() {
        //要引入的 js 文件名
        $includes=array("grid", "style", "normalize", "compatible");
        foreach($includes as $value){
            echo '<script src="';
            Utils::indexTheme('assets/'.$value.'.css');
            echo '"></script>';
            echo PHP_EOL;
        }
    }

    /* ============= */

    /**
     * 输出完备的标题
     */
    public static function title(Widget_Archive $archive) 
    {
        $archive->archiveTitle(array(
            'category'  =>  '分类 %s 下的文章',
            'search'    =>  '包含关键字 %s 的文章',
            'tag'       =>  '标签 %s 下的文章',
            'author'    =>  '%s 发布的文章'
        ), '', ' | ');
        Helper::options()->title();
    }

    /**
     * 统一输出页面导航
     * html 结构
     */
    public static function pageNav(Widget_Archive $archive, $tag) 
    {
        $archive->widget('Widget_Contents_Page_List')->to($pages);
        //首页链接
        echo '<'.$tag.'><a href="';
        Utils::indexHome();
        echo '">首页</a></'.$tag.'>';
        //页面列表
        while($pages->next()) {
            echo '<'.$tag.'><a href="';
            $pages->permalink(); 
            echo '" title="';
            $pages->title(); 
            echo '">';
            $pages->title(); 
            echo '</a></'.$tag.'>';
        }
    }

    /**
     * 统一输出站点标题及副标题
     * html 结构
     */
    public static function siteName() 
    {
        echo '<div class="site-name"><a id="logo" href="';
        Utils::indexHome();
        echo '" class="site-title">'.Helper::options()->title.'</a><p class="description site-description">'.Helper::options()->description.'</p></div>';
    }
}