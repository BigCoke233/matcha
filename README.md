![](screenshot.png)

# Theme Matcha

<a href="#"><img src="https://img.shields.io/badge/build-passing-brightgreen.svg?style=flat-square"></a>
<a href="#"><img src="https://img.shields.io/badge/made%20with-%E2%9D%A4-ff69b4.svg?style=flat-square"></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-GPL v3.0-blue.svg?style=flat-square"></a> 
<a href="https://typecho.org"><img src="https://img.shields.io/badge/for-Typecho-blueviolet.svg?style=flat-square"></a> 

Matcha 是基于 [Ringo](https://github.com/memset0/typecho-theme-ringo) 二次开发的 Typecho 主题，而 [Ringo](https://github.com/memset0/typecho-theme-ringo) 本身是移植自 Hexo 的 [Journal](https://github.com/SumiMakito/hexo-theme-Journal) 主题。所以 Matcha 主题是踩在 memset0 和 SumiMakito 两位大佬的肩膀上完成的，当然，也还并没有完成。

总体上来讲，Matcha 是基于 Ringo 的代码和 Journal 的设计进行二次创作的，增加和优化了许多功能，并且加入了一些自己的设计。

## 特色

- **响应式设计**，在常见的屏幕尺寸下表现良好
- **全站无刷新**，应用了 Pjax 和 Ajax，切换页面和发表评论时更流畅
- **有两种样式可供选择**，一种更加简洁，另一种则更大气
- **平滑滚动**，翻阅页面时滚动更加自然
- **图片懒加载**，延迟加载图片，提升页面速度
- **带行号的代码高亮**，采用轻量级的 Prism.js
- **更好的字体**，借助 Google Font，采用思源系列字体
- **访客统计**，即插即用的统计功能
- **增强可读性**，精心设计的文字排版
- More to find

<details>
<summary>相较于 Ringo 所做的修改</summary>

- 整体设计上的改动
    - 主题的强调色从原来的棕褐色改为抹茶色
    - 将累赘的分页导航改为「上一页」和「下一页」的设计
    - 去除了页面中部分元素突兀的阴影
    - 页面字体采用「思源宋体」，并给站点标题加上了艺术字体
    - 删除了一些设置项，化繁为简
- 用户体验的提升
    - 增加了 Pjax 全站无刷新功能
	- 增加了 Ajax 评论无刷新功能
    - 页面滚动更加平滑
    - 完全重写了评论区的样式
    - 完全重写了返回顶部按钮
    - 完全重写了 404 页面
    - 替换 Highlight.js，使用更轻量级的 Prism.js
    - 自动检测文章中的链接是否是外部链接，如果是，则自动设置为`在新标签页打开`，并且在链接前加上明显的标识
	- 适配了一些插件以便拓展主题功能
	- 更人性化的时间显示
- 文章可读性提高
    - 使用 Pangu.php 在中英文之间自动用空格分隔
    - 使用 bigfoot.js 优化文章脚注的显示
    - 优化了文章内容的样式
    - 适配 BracketDown 插件，支持在文章中加入短代码
- 功能上的增加
	- 增加了友情链接页面，并支持友情链接乱序显示
	- 归档页面增加搜索功能，并兼容了 Pjax
	- 归档页面增加标签云显示
	- 显示代码行数，增加一键复制功能
- 优化文件结构，代码可读性提高
- 动画、各种组件的样式等细节上的调整
- 修复了一些原主题遗留的 bug
- ......

</details>

具体的外观可以访问[我的博客](https://blog.guhub.cn/)查看。

## 使用

1. 直接 `clone` 或者下载仓库 `main` 分支
2. 将文件夹重命名为 `matcha`
3. 将主题文件夹放入主题安装目录 `/usr/themes/`
4. 登入后台进行简单的配置

如果在使用过程中遇到任何问题，请先查看 [FAQ](doc.md)，若没能解决，再询问作者。<br>
你也可以加入 QQ 群（924171480）与各路大佬交流。当然这并不是主题用户交流群，只要是与我作品相关的内容都可以在群里讨论，就当作是一个随意的交流群吧。

## 拓展

这些插件可以拓展主题的功能，并且主题已经适配了它们，可以放心使用

- [Links](http://www.imhan.com/archives/typecho_links_20141214/)：友情链接插件，如果要使用友情链接功能就必须安装这个插件
- [Sticky](https://github.com/jazzi/sticky-for-typecho)：文章置顶插件，如果想要置顶一篇或多篇文章就可以使用这个插件
- [BracketDown](https://github.com/BigCoke233/typecho-plugin-BracketDown)：语法拓展插件，如果想要在文章里使用短代码就需要安装这个插件
- [CopyDog](https://github.com/BigCoke233/typecho-plugin-CopyDog)：版权狗插件，可以在文章末尾生成一个显示版权信息的卡片

## 鸣谢

#### 开源项目

[jQuery](https://jquery.com/) | 
[jQuery Lazy](http://jquery.eisbehr.de/lazy/) |
[Pjax](https://github.com/defunkt/jquery-pjax) | 
[Pangu.php](https://github.com/cchlorine/pangu.php) | 
[Prism.js](https://prismjs.com/) | 
[smoothscroll.js](https://www.smoothscroll.net/) | 
[bigfoot.js](http://bigfootjs.com/) | 
[toaster.js](https://github.com/bigcoke233/toaster.js) | 
[Masonry](https://github.com/desandro/masonry)

#### 矢量图

[Pixabay 用户 - OpenClipart-Vectors](https://pixabay.com/zh/vectors/screaming-surprised-smiley-emotion-146426/)：提供 404 页面使用的矢量图

## 计划

### 已知 bug

**#1 在评论区退出登录时，需要点击两次退出按钮才能成功退出**<br>
复现方法：在 pjax 正常启用的情况下，确保自己是登陆状态，跳转到一个有评论区的页面，点击评论框下的退出按钮，会发现页面进行了刷新，并且成功发送了 HTTP 请求。这时就算是刷新页面也无法成功退出，必须再次点击退出按钮才能够退出，会发现这时发送了一个数据不同的 HTTP 请求，状态码和上次也一样也是 302 Found。
造成原因：未知
解决方案：未知
临时方案：遇到需要退出登录的情况，在后台退出或是点击两次退出按钮。

**如果你发现了其他 bug，请在 Issues 页面提出。**

### 新增功能

- [x] 平滑滚动
- [x] 优化页面滚动条的样式
- [x] 重写评论板块的样式
- [x] 优化代码高亮功能
- [x] 增加「友情链接」功能
- [x] ajax 评论无刷新
- [ ] 支持自定义主题色
- [ ] 增加「日落模式」和「夜间模式」
- [ ] 添加说说页面
- [ ] 支持显示文章目录
- [ ] 兼容 ExSearch 插件

---

Copyright &copy; 2022 SumiMakito, memset0 & Eltrac, under GPL v3.0 License.