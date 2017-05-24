# getEasemob 获取环信聊天记录
----------------获取聊天记录下载地址，解析下载的gz文件并按行插入数据库---------------------
Setp 1、 *----------------------需要新建一个数据表来存数据-----------------------------
 *	--------------------------------------------------
	Author: 程伟 <286609081@qq.com>
	--------------------------------------------------
--
-- 表的结构 `member_talk`
--
    CREATE TABLE IF NOT EXISTS `member_talk` (
      `id` int(8) NOT NULL,
      `msg_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//消息ID',
      `timestamp` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '消息发送时间',
      `direction` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
      `to` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '接收人的username或者接收group的ID',
      `from` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '发送人username',
      `chat_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '用来判断单聊还是群聊。chat: 单聊；groupchat: 群聊',
      `msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '消息内容',
      `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '文本消息类型'
    ) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户聊天记录';
 * */
Setp 2、创建好数据表之后，打开getMessage.php文件，填写配置项，
    $options['client_id'] = 'xxxxxxxxx';
    $options['client_secret'] = 'xxxxxx';
    $options['org_name'] = 'xxxxx';
    $options['app_name'] = 'xxxxxx';

	Enjoy!!!

	