# QQ Web Hook
🤖来自腾讯QQ官方的QQ群聊机器人


## 添加机器人

搜索QQ：`2854196399`添加好友

> 此机器人内测中，需要新建群聊才能使用。

创建一个新群聊，邀请该好友加入群聊，开启`消息推送`，在设置中生成一个`webhook`地址，复制下来

记录一下`key=`后面的参数，即为下文的`$key`

## 安装

使用 composer 进行安装

```bash
composer require sy-records/qq-webhook
```

## 使用

```php
$key = "";
$robot = \Luffy\QQWebHook\Robot::getInstance($key);
$robot->send("沈唁志博客\r\nhttps://qq52o.me");
```

## 截图

![发送成功截图](https://cdn.jsdelivr.net/gh/sy-records/qq-webhook/images/send-success.png)
