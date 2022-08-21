<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once("Pangu.php");
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
        Helper::options()->customHead();
    }

    /**
     * 输出 link 标签引用 css
     */
    public static function linkCSS() {
        //要引入的 css 文件名
        $includes=array(
            "normalize", 
            "prism/prism", 
            "grid", 
            "toaster/toaster", 
            "matcha", 
            "bigfoot/bigfoot");
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
        Utils::indexTheme('assets/iconfont/iconfont.woff2');
        echo "') format('woff2'),url('";
        Utils::indexTheme('assets/iconfont/iconfont.woff'); 
        echo "') format('woff'),url('";
        Utils::indexTheme('assets/iconfont/iconfont.ttf');
        echo "') format('truetype');}</style>";
    }

    /* ======================= */

    /**
     * 输出尾部
     * 包括 js
     */
    public static function footer() {
        Matcha::script();
        Helper::options()->customFooter();
    }

    /**
     * 输出 js 引用
     */
    public static function script() {
        //要引入的 js 文件名
        $includes=array(
            "jquery/jquery.min",
            "jquery/jquery.pjax.min",
            "jquery/jquery.lazy.min",
            "masonry/masonry.pkgd.min",
            "smoothscroll/smoothscroll",
            "nprogress/nprogress.min",
            "prism/prism",
            "toaster/toaster",
            "bigfoot/bigfoot"
        );
        if(Helper::options()->EnableAjaxComment=='able') array_push($includes, 'matcha.comment');
        array_push($includes, 'matcha'); //主题核心文件在最后引入
        foreach($includes as $value){
            echo '<script src="';
            Utils::indexTheme('assets/'.$value.'.js');
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

    /**
     * 首页文章摘要显示
     * html 结构
     */
    public static function excerpt(Widget_Archive $archive) 
    {
        if(Helper::options()->IndexDisplayMode=='FullText'){
            $archive->content('');
        }
        elseif(Helper::options()->IndexDisplayMode=='Excerpt200'){
            $archive->excerpt(200);
        }
    }

    /**
     * 人性化的时间显示
     */
    public static function date($created)
    {
        $Y = date('Y', $created);
        if(date('Y-m-d', $created)==date('Y-m-d')){
            return '今天';
        }
        elseif(date('Y-m', $created)==date('Y-m')){
            if(intval(date('d', $created))==intval(date('d')-1)){
                return '昨天';
            }
            elseif(intval(date('d', $created))==intval(date('d')-2)){
                return '前天';
            }
            elseif(intval(date('d', $created))<intval(date('d'))){
                return strval(intval(date('d'))-intval(date('d', $created))).' 天前';
            }
        }
        elseif($Y==date('Y')) {
            return date('m-d', $created);
        }
        else {
            return date('Y-m-d', $created);
        }
    }

    /**
     * LazyLoad
     */
    static public function lazyLoad($text){
        $text = preg_replace(
			'/\<img(.*?)src(.*?)alt=\"(.*?)\"(.*?)\>/s',
			'<figure><img${1}data-src${2}class="lazy"${4}><figcaption>${3}</figcaption></figure>',
		$text);
        return $text;
    }

    /**
     * 解析文章内容
     */
    static public function parseContent($data, $widget, $last)
    {
        $text = empty($last) ? $data : $last;
        if ($widget instanceof Widget_Archive) {
			$text = Matcha::lazyLoad(pangu($text));
        }
        return $text;
    }
}