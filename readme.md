<html lang="en"><head>
    <meta charset="UTF-8">
   <body marginheight="0"><h2>情话一言 Telegram bot</h2>
<p>这是为<a href="https://t.me/qinghua_box">情话箱</a>频道开发的一言机器，基于本地数据库

</p>
<h3>开始使用</h3>
<p>开始之前我已默认你已经有一台Linux服务器，并且已经安装了nodejs及npm

</p>
<ol>
<li>打开telegram，登录账号，完成验证，目光聚集在左上角的搜索框</li>
<li>搜索创建机器人@botfahter，有个官方认证的符号，不要搞错了</li>
<li>进入botfather界面，点击底部的/start，开始创建机器人</li>
<li>输入/start后，会出现使用菜单的说明，创建一个新的机器人，点击蓝色字体/newbot</li>
<li>然后设置机器人的名称，这个名称可以被公开搜索到，所以名字不能重复</li>
<li>接着创建机器人的username，这个机器人的username必须以bot结尾，这个需要注意一下</li>
<li>最后，创建成功后，会有这个机器人的聊天窗口，以及想要调用这个机器人的API接口token，复制这个token</li>
<li>登录你的服务器，执行<code>git clone https://github.com/zyh001/Yiyan_bot.git &amp;&amp; cd  Yiyan_bot &amp;&amp; mv env.example .env</code></li>
<li>接下来执行<code>vim .env</code>编辑配置文件，将其中的xxxx替换为你刚刚复制的token</li>
<li>修改完毕保存后执行<code>npm install</code>待依赖安装完成后执行<code>npm -g install pm2 ; pm2 start</code></li>
</ol>
<p>到这里你的服务已经完成了，可以在telegram与机器人对话，发送 /getqh 就可以获取一条历史推送

</p>
<p><a href="http://www.wtfpl.net/"><img src="http://www.wtfpl.net/wp-content/uploads/2012/12/wtfpl-badge-4.png" width="80" height="15" alt="WTFPL"></a>
</body></html>
