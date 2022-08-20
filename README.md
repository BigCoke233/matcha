![](screenshot.png)

# Theme Matcha

<a href="#"><img src="https://img.shields.io/badge/build-passing-brightgreen.svg?style=flat-square"></a>
<a href="#"><img src="https://img.shields.io/badge/made%20with-%E2%9D%A4-ff69b4.svg?style=flat-square"></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-GPL v3.0-blue.svg?style=flat-square"></a> 
<a href="https://typecho.org"><img src="https://img.shields.io/badge/for-Typecho-blueviolet.svg?style=flat-square"></a> 

Matcha 是基于 [Ringo](https://github.com/memset0/typecho-theme-ringo) 二次开发的 Typecho 主题，而 [Ringo](https://github.com/memset0/typecho-theme-ringo) 本身是移植自 Hexo 的 [Journal](https://github.com/SumiMakito/hexo-theme-Journal) 主题。所以 Matcha 主题是踩在 memset0 和 SumiMakito 两位大佬的肩膀上完成的，当然，也还并没有完成。

总体上来讲，Matcha 是基于 Ringo 的代码和 Journal 的设计进行二次创作的，增加和优化了许多功能，并且加入了一些自己的设计。

## 特色

相较于 Ringo 和 Journal，Matcha 做了以下修改

- 整体设计上的改动
    - 主题的强调色从原来的棕褐色改为抹茶色
    - 将累赘的分页导航改为「上一页」和「下一页」的设计
    - 去除了页面中部分元素突兀的阴影
    - 页面字体采用「思源宋体」，并给站点标题加上了艺术字体
    - 删除了一些设置项，化繁为简
    - Ringo 主题并不是完全复刻的 journal 主题，Matcha 设置了一个选项，可以在 Ringo 和 Journal 主题的样式之间自由切换
- 用户体验的提升
    - 给归档页面加上了搜索和标签云，并且排列更加紧凑
    - 增加了 Pjax 无刷新功能
    - 页面滚动更加平滑
    - 完全重写了评论区的样式
    - 完全重写了返回顶部按钮
    - 替换 Highlight.js，使用更轻量级的 Prism.js
    - 显示代码行数，增加一键复制功能
    - 自动检测文章中的链接是否是外部链接，如果是，则自动设置为`在新标签页打开`，并且在链接前加上明显的标识
- 文章可读性提高
    - 使用 Pangu.php 在中英文之间自动用空格分隔
    - 使用 bigfoot.js 优化文章脚注的显示
    - 优化了文章内容的样式
    - 适配 BracketDown 插件，支持在文章中加入短代码
- 优化文件结构，代码可读性提高
- 动画、各种组件的样式等细节上的调整
- 修复了一些原主题遗留的 bug
- ......

具体的外观可以访问[我的博客](https://blog.guhub.cn/)查看。

## 使用

1. 直接 `clone` 或者下载仓库 `main` 分支
2. 将文件夹重命名为 `matcha`
3. 将主题文件夹放入主题安装目录 `/ust/themes/`
4. 登入后台进行简单的配置

如果在使用过程中遇到任何问题，请先查看 [FAQ](doc.md)，若没能解决，再询问作者。

Enjoy~

## 引用

[jQuery](https://jquery.com/) | 
[Pjax](https://github.com/defunkt/jquery-pjax) | 
[Pangu.php](https://github.com/cchlorine/pangu.php) | 
[Prism.js](https://prismjs.com/) | 
[Bootstrap Grid](https://github.com/twbs/bootstrap/blob/main/dist/css/bootstrap-grid.css) | 
[nprogress](https://github.com/rstacruz/nprogress) | 
[smoothscroll.js](https://www.smoothscroll.net/) | 
[bigfoot.js](http://bigfootjs.com/) | 
[toaster.js](https://github.com/bigcoke233/toaster.js) | 
[Masonry](https://github.com/desandro/masonry)

感谢以上开源项目的开发者！

## 计划

- [x] 平滑滚动
- [x] 优化页面滚动条的样式
- [x] 重写评论板块的样式
- [x] 优化代码高亮功能（考虑换成 Prism.js）
- [ ] 增加「友情链接」功能
- [ ] 增加「自定义导航栏」功能
- [ ] ~~ajax 评论无刷新~~（暂时搁置）

---

Copyright &copy; 2022 SumiMakito, memset0 & Eltrac, under GPL v3.0 License.