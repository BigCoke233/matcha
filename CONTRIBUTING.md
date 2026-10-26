# 贡献指南

## 目录结构

```
├─assets        # 前端使用的静态资源
├─includes      # 可复用的 php 组件
│  ├─comments.php
│  ├─footer.php
│  ├─head.php
│  ├─header.php
│  ├─main.php
│  ├─posts.php
│  └─sidebar.php
└─libs          # 内部库
   ├─Comments.php   # 评论相关的工具函数
   ├─Matcha.php     # 主题显示等相关的工具函数
   ├─Options.php    # 自定义主题设置页面
   └─Utils.php      # 杂项工具函数
``` 

## Commits 和 Pull Request

1. 使用 [Scoped Commits](https://scopedcommits.com/)，这是 Linux 内核开发使用的 commit 信息编写风格，也就是先写改动的影响范围，再写具体改动内容。
2. 提交 Pull Request 前请先 `git rebase origin/master`，在本地处理完冲突再提交。
3. 单个 commit 应该能够作为版本号使用，也就是 `checkout` 到这个 commit 的时候，运行代码也不会出现问题，是自包含（self-contained）的。如果提交了多个 commit，可以考虑 `git squash` 成一个。

## LLM 使用

### 绝对禁止

1. LLM 生成的 Pull Request 描述、Issues 和 commit 信息
2. 模型生成的图像资源
3. **提交由 LLM 生成的代码**（或 Vibe code）
    - 此类代码的版权状态不明，无法追溯到模型训练数据中的具体代码，以及原本代码的授权协议，模型使用者极有可能没有权利使用这些代码，这些代码也极有可能与本项目的 GPL-v3.0 协议不兼容。
4. 传播尚未自己验证过的 LLM 生成的信息

### 容许

1. 使用 LLM 做代码审查、搜集信息和提出方案

