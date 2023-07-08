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
        Matcha::preconnect();
        Matcha::linkCSS();
        Matcha::iconfont();
        Helper::options()->customHead();
    }

    /**
     * 输出 link 标签引用 css
     */
    public static function linkCSS() {
        if(isset(Helper::options()->StaticCDN) && Helper::options()->StaticCDN!='custom') {
            //非自定义 CDN
            if(Helper::options()->StaticCDN!='local'){
                if(Helper::options()->StaticCDN=='bytedance'){
                    $src_link = array(
                        'https://lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/normalize/8.0.1/normalize.min.css',
                        'https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/bigfoot/2.1.4/bigfoot-default.min.css',
                        'https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/prism/1.27.0/themes/prism.min.css',
                        'https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/prism/1.27.0/plugins/toolbar/prism-toolbar.min.css',
                        'https://lf9-cdn-tos.bytecdntp.com/cdn/expire-1-M/prism/1.27.0/plugins/line-numbers/prism-line-numbers.min.css',
                        'https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/fluidbox/2.0.5/css/fluidbox.min.css',
                        'https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/tocbot/4.18.2/tocbot.css'
                    );
                }
                elseif(Helper::options()->StaticCDN=='cdnjs'){
                    $src_link = array(
                        'https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css',
                        'https://cdnjs.cloudflare.com/ajax/libs/bigfoot/2.1.4/bigfoot-default.min.css',
                        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.28.0/themes/prism.min.css',
                        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.28.0/plugins/toolbar/prism-toolbar.min.css',
                        'https://cdnjs.cloudflare.com/ajax/libs/prism/1.28.0/plugins/line-numbers/prism-line-numbers.min.css',
                        'https://cdnjs.cloudflare.com/ajax/libs/fluidbox/2.0.5/css/fluidbox.min.css',
                        'https://cdnjs.cloudflare.com/ajax/libs/tocbot/4.18.2/tocbot.css'
                    );
                }

                foreach($src_link as $value){
                    echo '<link rel="stylesheet" href="'.$value.'" />';
                }
                
                $local_includes=array();//没有额外的本地文件
            }else{
                //要引入的 css 文件名
                $local_includes=array(
                    "normalize", 
                    "bigfoot/bigfoot",
                    "prism/prism",
                    "jquery/jquery.fluidbox.min",
                    "tocbot/tocbot"
                );
            }
            //必须要在本地引入的文件
            array_push($local_includes,"toaster/toaster","matcha/matcha");
            foreach($local_includes as $value){
                echo '<link rel="stylesheet" href="';
                Utils::indexTheme('assets/'.$value.'.css');
                echo '" />';
            }
        } else {
            //自定义 CDN
            $includes=array(
                "normalize", 
                "bigfoot/bigfoot",
                "prism/prism",
                "jquery/jquery.fluidbox.min",
                "tocbot/tocbot",
                "toaster/toaster",
                "matcha/matcha"
            );

            foreach($includes as $value){
                echo '<link rel="stylesheet" href="'.Helper::options()->CustomCDN.$value.'.css" />';
            }
        }
    }
    
     /**
     * 输出 preconnect 标签
     */
    public static function preconnect() {
        if(isset(Helper::options()->StaticCDN) && (Helper::options()->StaticCDN!=('local'||'custom'))){
            if(Helper::options()->StaticCDN=='bytedance'){
                $src_link = array(
                    '//lf3-cdn-tos.bytecdntp.com/',
                    '//lf9-cdn-tos.bytecdntp.com/',
                    '//lf26-cdn-tos.bytecdntp.com/',
                );
            }
            elseif(Helper::options()->StaticCDN=='cdnjs'){
                $src_link = array(
                    '://cdnjs.cloudflare.com/',
                );
            }
            echo '<!-- 预连接 -->';
            foreach($src_link as $value){
                echo '<link rel="preconnect" href="'.$value.'" />';
            }
            
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
     * 将主题设置传递给前端
     */
    static public function footerSetting() {
        echo '<script>';
        echo 'siteurl="'; Utils::indexHome(); echo '";'; //站点 url
        echo 'pjaxCallback=function(){'.Helper::options()->pjaxCallback.'};';
        if(Helper::options()->DarkMode=='default' || Helper::options()->DarkMode=='dark'){
            echo 'allowDarkMode=true;';
        }
        echo '</script>';
    }

    /**
     * 输出 js 引用
     */
    public static function script() {
        if(isset(Helper::options()->StaticCDN) && Helper::options()->StaticCDN!='custom') {
            //非自定义 CDN
            if(Helper::options()->StaticCDN!='local'){
                if(Helper::options()->StaticCDN=='bytedance'){
                    $src_link = array(
                        'https://lf6-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery/3.6.0/jquery.min.js',
                        'https://lf6-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery.pjax/2.0.1/jquery.pjax.min.js',
                        'https://lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery.lazy/1.7.11/jquery.lazy.min.js',
                        'https://lf9-cdn-tos.bytecdntp.com/cdn/expire-1-M/bigfoot/2.1.4/bigfoot.min.js',
                        'https://lf3-cdn-tos.bytecdntp.com/cdn/expire-1-M/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js',
                        'https://lf6-cdn-tos.bytecdntp.com/cdn/expire-1-M/fluidbox/2.0.5/js/jquery.fluidbox.min.js',
                        'https://lf26-cdn-tos.bytecdntp.com/cdn/expire-1-M/tocbot/4.18.2/tocbot.min.js'
                    );
                }
                elseif(Helper::options()->StaticCDN=='cdnjs'){
                    $src_link = array(
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/2.0.1/jquery.pjax.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.11/jquery.lazy.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/bigfoot/2.1.4/bigfoot.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/fluidbox/2.0.5/js/jquery.fluidbox.min.js',
                        'https://cdnjs.cloudflare.com/ajax/libs/tocbot/4.18.2/tocbot.min.js'
                    );
                }

                foreach($src_link as $value){
                    echo '<script src="'.$value.'"></script>';
                }
                
                $local_includes=array();//没有额外的本地文件
            }else{
                //要引入的 js 文件名
                $local_includes=array(
                    "jquery/jquery.min",
                    "jquery/jquery.pjax.min",
                    "jquery/jquery.lazy.min",
                    "jquery/jquery.fluidbox.min",
                    'jquery/jquery.ba-throttle-debounce.min',
                    'tocbot/tocbot.min',
                    "bigfoot/bigfoot"
                );
            }
            //必须要在本地引入的文件
            array_push($local_includes,
                "prism/prism",
                "toaster/toaster",
                'smoothscroll/smoothscroll'
            );
            if(Helper::options()->EnableAjaxComment=='able') array_push($local_includes, 'matcha/matcha.comment');
            array_push($local_includes, 'matcha/matcha'); //主题核心文件在最后引入
            foreach($local_includes as $value){
                echo '<script src="';
                Utils::indexTheme('assets/'.$value.'.js');
                echo '"></script>';
            }
        } else {
            //自定义 CDN
            $includes=array(
                "jquery/jquery.min",
                "jquery/jquery.pjax.min",
                "jquery/jquery.lazy.min",
                "jquery/jquery.fluidbox.min",
                'jquery/jquery.ba-throttle-debounce.min',
                'tocbot/tocbot.min',
                "bigfoot/bigfoot",
                "prism/prism",
                "toaster/toaster",
                'smoothscroll/smoothscroll'
            );
            if(Helper::options()->EnableAjaxComment=='able') array_push($includes, 'matcha/matcha.comment');
            array_push($includes, 'matcha/matcha'); //主题核心文件在最后引入

            foreach($includes as $value){
                echo '<script src="'.Helper::options()->CustomCDN.$value.'.js"></script>';
            }
        }
    }

    /* ============= */

    /**
     * 输出完备的标题
     */
    public static function title(Widget_Archive $archive) 
    {
        $archive->archiveTitle(array(
            'category'  =>  '%s',
            'search'    =>  '搜索 %s',
            'tag'       =>  '#%s',
            'author'    =>  '%s 的文章'
        ), '', ' - ');
        Helper::options()->title();
    }

    /**
     * 统一输出页面导航
     * html 结构
     */
    public static function pageNav(Widget_Archive $archive, $tag) 
    {
        $data = json_decode(Helper::options()->customNav, true);

        if(Helper::options()->customNav!='' && $data==null) {
            echo '导航栏设置错误';
            return false;
        }

        if(Helper::options()->customNav=='' || $data['type']=='addition'){
            $archive->widget('Widget_Contents_Page_List')->to($pages);
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

        if(Helper::options()->customNav!='' && $data!=null) {
            foreach($data['content'] as $item) {
                echo '<'.$tag.'><a href="'.$item['link'].'" title="'.$item['text'].'">'.$item['text'].'</a></'.$tag.'>';
            }
        }
    }

    /**
     * 统一输出分类导航
     * html 结构
     */
    public static function categoryNav(Widget_Archive $archive, $tag)
    {
        // 如果开启了分类导航，则输出分类
        if(Helper::options()->categoryNav=='able') {
            $archive->widget('Widget_Metas_Category_List')->to($categories);
            while($categories->next()) {
                echo '<'.$tag.'><a href="';
                $categories->permalink(); 
                echo '" title="';
                $categories->name(); 
                echo '">';
                $categories->name(); 
                echo '</a></'.$tag.'>';
            }
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
            $archive->content('继续阅读');
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
        if(Helper::options()->timeFormat!=''){
            return date(Helper::options()->timeFormat, $created);
        }else{
            //计算时间差
            $diff = time() - $created;
            $d = floor($diff/3600/24);
            
            $Y = date('Y', $created);

            //输出时间
            if(date('Y-m-d', $created)==date('Y-m-d')){
                return '今天';
            }
            elseif($d==1){
                return '昨天';
            }
            elseif($d==2){
                return '前天';
            }
            elseif($d<=31){
                return $d.' 天前';
            }
            elseif($Y==date('Y')) {
                return date('m-d', $created);
            }
            else {
                return date('Y-m-d', $created);
            }
        }
    }

    /**
     * 页脚版权信息 年份
     */
    static public function copyrightYear() 
    {
        if(Helper::options()->startDate==''){
			echo date('Y');
		}else{
			$date=explode('-', Helper::options()->startDate);
			if($date[0]==date('Y')){
				echo date('Y');
			}elseif($date[0]<date('Y')){
				echo $date[0].' - '.date('Y');
			}else{
				echo '<span style="cursor:help" onclick="Toaster.send(\'博主把建站日期写错啦\');">[偷偷告诉你，其实我是时空旅行者]</span>';
			}
		}
    }

    /**
     * 页脚 额外信息
     */
    static public function footerInfo() 
    {
        //ICP备案号
        if (Helper::options()->icpNum!='') {
            echo '<br />';
            echo '<a rel="nofollow" href="http://beian.miit.gov.cn"> '.Helper::options()->icpNum.' </a>';
        }
        //公安备案号
        if (Helper::options()->policeNum!='') {
            echo ' | ';
            echo '<a target="_blank" rel="nofollow" href="'.Helper::options()->policeUrl.'"><img src="/police.png" />'.Helper::options()->policeNum.'</a>';
        }
        //字数统计
        if (Helper::options()->EnableWordsCounter=='able') {
            echo '<br />';
            echo '书写了 ';
            WordsCounter_Plugin::allOfCharacters();
            echo ' 字';
        }
        //不蒜子统计
        if (Helper::options()->EnableBusuanzi=='able') {
            if (Helper::options()->EnableWordsCounter=='able') echo ' · ';
            echo '<span id="busuanzi_value_site_pv">......</span> 次访问 ·
                  <span id="busuanzi_value_site_uv">......</span> 位访客 ';
            echo '<script async src="//busuanzi.ibruce.info/busuanzi/2.3/busuanzi.pure.mini.js"></script>';
        }
        //附加信息
        if (Helper::options()->footerInfo!='') echo '<div class="footer-info">'.Helper::options()->footerInfo.'</div>';
        //umami
        if (Helper::options()->umamiID!='' && Helper::options()->umamiURL!='') {
            echo '<script async defer src="'.Helper::options()->umamiURL.'" data-website-id="'.Helper::options()->umamiID.'"></script>';
        }
    }

    /**
     * LazyLoad
     */
    static public function parseLazyLoad($text){
        $text = preg_replace(
			'/\<img(.*?)src=\"(.*?)\"(.*?)alt=\"(.*?)\"(.*?)\>/s',
			'<figure><a href="${2}" class="fluidbox-anchor" no-linkTarget><img${1}src="'.Utils::indexThemeUrl('assets/loading.gif').'" data-src="${2}"${3}class="lazy"${4}></a><figcaption>${3}</figcaption></figure>',
		$text);
        return $text;
    }

    /**
     * 为文章标题添加id
     */
    static public function parseTocbot($text){
        $text = preg_replace(
			'/\<h(2|3)(.*?)\>(.*?)\<\/h(2|3)\>/s',
			'<h${1}${2} id="heading-${3}">${3}</h${1}>',
		$text);
        return $text;
    }

    /**
     * <!--less-->
     */
    static public function parseLess($text){
        $text = preg_replace(
			'/(.*?)\<\!\-\-less\-\-\>(.*?)/s',
			'${2}',
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
			$text = Matcha::parseTocbot(Matcha::parseLazyLoad($text));
        }
        return $text;
    }

    /**
     * 解析摘要内容
     */
    static public function parseExcerpt($data, $widget, $last)
    {
        $text = empty($last) ? $data : $last;
        if ($widget instanceof Widget_Archive) {
			$text = Matcha::parseLess(Matcha::parseTocbot(Matcha::parseLazyLoad($text)));
        }
        return $text;
    }

    /**
     * 文章浏览量统计
     */

    static public function views($archive)
    {
        $cid = $archive->cid;
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();

        //若不存在 vies 项，则创建并返回 0
        if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
            return 0;
        }

        //获取 cookie 中用户已阅读的文章列表
        $viewed = Typecho_Cookie::get('__post_viewed');
        if(empty($viewed)){
            $viewed=array();
        }else{
            $viewed=explode(',',$viewed);
        }

        //获取文章阅览量
        $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
        if(!in_array($cid, $viewed) && $archive->is('single')){
            //浏览量加一
            $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
            //将本篇文章 cid 加入 Cookie
            array_push($viewed, $cid);
            $viewed=implode(',', $viewed);
            Typecho_Cookie::set('__post_viewed', $viewed);
        }

        //返回阅览量
        $viewsCount = $row['views'];
        if (array_key_exists('viewsNum', $db->fetchRow($db->select()->from('table.contents')))) {
            //兼容部分主题/插件的阅览量统计
            $viewsCount = $row['views']+$row['viewsNum'];
        }

        echo $viewsCount.' 次阅读';
    }

    /**
    * 文章归档
    */
    public static function archives($widget) {
        $db = Typecho_Db::get();
        $rows = $db->fetchAll($db->select()
        ->from('table.contents')
         ->order('table.contents.created', Typecho_Db::SORT_DESC)
        ->where('table.contents.type = ?', 'post')
        ->where('table.contents.status = ?', 'publish'));
          
        $stat = array();
        foreach ($rows as $row) {
            $row = $widget->filter($row);
            $arr = array(
                'title' => $row['title'],
                'permalink' => $row['permalink']
            );
            $stat[date('Y', $row['created'])][$row['created']] = $arr;
        }
        return $stat;
    }

    /**
     * 输出 body 标签的 class
     */
    public static function bodyClass() {
        $class_list = array();

        //判断夜间模式
        $ifDark=false;
        if(isset($_COOKIE['matchaDark'])) {
            if($_COOKIE['matchaDark']=='y') {
                $ifDark=true;
            }
            elseif(Helper::options()->DarkMode=='default' && date('H')>18 && date('H')<7 && $_COOKIE['matchaDark']=='n') {
                $ifDark=true;
            }
            elseif(Helper::options()->DarkMode=='dark' && !$_COOKIE['matchaDark']=='n'){
                $ifDark=true;
            }
            elseif(Helper::options()->DarkMode=='always') {
                $ifDark=true;
            }
        }else{
            if(Helper::options()->DarkMode=='dark' || Helper::options()->DarkMode=='always'){
                $ifDark=true;
            }
        }
        if($ifDark) array_push($class_list, 'matcha-dark');

        //是否开启「超简洁模式」
        if(Helper::options()->EnableExtraSimple=='able') array_push($class_list, 'extrasimple');

        if(!empty($class_list)){
            $class_list = implode(' ', $class_list);
            echo ' class="'.$class_list.'"';
        }else{
            return false;
        }
    }

    /**
     * 主题色
     */
    public static function getThemeColor() 
    {
        if(Helper::options()->themeColor=='maple'){
            return '#E95A2D';
        }
        elseif(Helper::options()->themeColor=='kirin'){
            return '#DAA520';
        }
        elseif(Helper::options()->themeColor=='ocean'){
            return '#20B2AA';
        }
        elseif(Helper::options()->themeColor=='violet'){
            return '#6A5ACD';
        }
        elseif(Helper::options()->themeColor=='custom'){
            return Helper::options()->themeColorCustom;
        }
        else{
            return '#c5c56a';
        }
    }

    /**
     * 首页相关链接
     */
    public static function relatedLinks($archives)
    {
        $data = '['.Helper::options()->relatedLinks.']';
        if($data!=''){
            $data=json_decode($data, true);
            foreach($data as $item){
                echo '<div class="indexlink-item">';

                //如果是文章
                if($item['type']=='post') {
                    if(!isset($item['cid'])) {
                        echo '没有设置 cid，请检查你的设置';
                        return false;
                    }
                    $post=Helper::widgetById('Contents', $item['cid']);
                    echo '<a href="'.$post->permalink.'">
                        <h2>'.$post->title.'</h2>
                        <p>';
                    if(isset($item['des'])){
                        echo $item['des'];
                    }else{
                        $post->excerpt(30);
                    }
                    echo '</p></a>';
                }
                //如果是自定义链接
                else {
                    if(!isset($item['title']) || !isset($item['des']) || !isset($item['link'])) {
                        echo '信息设置不完整，请检查你的设置';
                        return false;
                    }
                    echo '<a href="'.$item['link'].'" target="_blank">
                        <h2>'.$item['title'].'</h2>
                        <p>'.$item['des'].'</p></a>';
                }

                echo '</div>';
            }
        }
        return false;
    }
}
