Python——搞定烦人的字符串编码

注意：以下讨论为Python2.x版本

在学习Python之前，就听说过Python的版本圣战，最可怕的是有的写Py3的程序员觉得Py2是另一种语言....所以在刚开始学习的时候，我索性把Python3和Python2的文档都看了一遍。

在之后写爬虫的过程中，我还是选择使用了Python2.x来写，原因嘛，emmmmm，可能就是因为一些好用的库或者框架的示例代码也是用旧一点的版本，所以为了效率，先用旧版本上手得了。在学习Python2之前，我还特意去比较了2和3的区别，其中着重被提及的就是字符串编码的问题，于是乎我在看旧版本文档的时候很仔细的去阅读了Python2的字符串部分。

然而结局证明，仔细阅读之后还是too young too simple，在读取文件，处理参数，以及处理http链接的过程中，经常一运行，发生两个对于Python的开发者熟悉的不能再熟悉的报错了。

```python
UnicodeDecodeError: 'ascii' codec can't decode byte 0xe6 in position 0: ordinal not in range(128)
```

```python
UnicodeEncodeError: 'ascii' codec can't encode characters in position 0-1: ordinal not in range(128)
```

怎么样，是不是非常眼熟上面的两句话，好吧，我承认我这个小白一开始发现有这种编码问题的时候，就是调用encode/decode各种调试，期望这两个函数中有一个能够生效，救救我苟延残喘的程序，而在最初的时候，好像这样做还挺有效果的。

但是好运不长，在编写爬虫的过程中，随着处理字符串的量越来越大，http请求参数越来越多，往往一个参数是由好几个参数拼接而成的，而有时候你并不知道是哪个地方出了问题，盲目的替换和使用encode/decode方法效率非常低下。而造成这个问题的原因，就是没有明确的思考为什么会出现编码错误，授人以鱼不如授人以渔，所以我们今天要来从根上探究一下这个问题。

# 编码的简介

首先，作为一名程序员，我想ASCII、Unicode、UTF-8三种字符编码大家肯定是听到过的，而这三种编码到底有什么区别呢？

ASCII是美国信息交换标准代码，是基于拉丁字母的一套电脑编码系统。它主要用于显示现代英语，而其扩展版本EASCII则可以部分支持其他西欧语言，并等同于国际标准ISO/IEC 646。

Unicode是电脑科学领域里的一项业界标准，它对世界上大部分的文字系统进行了整理、编码，使得电脑可以用以更为简单的方式来呈现和处理文字。

UTF-8是一种正对Unicode的可变长度字元编码，也是一种前缀码。它可以用来表示Unicode标准中的任何字元，且其编码中的第一个位元组仍与ASCII相容，这使得原来处理的ASCII的软体无须或只须少部分修改，即可以继续使用，因此，它逐渐成为了电子邮件、网页以及其他存储或传送文字的应用中，优先采用的编码。

