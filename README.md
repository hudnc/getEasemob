# getEasemob ��ȡ���������¼
----------------��ȡ�����¼���ص�ַ���������ص�gz�ļ������в������ݿ�---------------------
Setp 1�� *----------------------��Ҫ�½�һ�����ݱ���������-----------------------------
 *	--------------------------------------------------
	Author: ��ΰ <286609081@qq.com>
	--------------------------------------------------
--
-- ��Ľṹ `member_talk`
--
    CREATE TABLE IF NOT EXISTS `member_talk` (
      `id` int(8) NOT NULL,
      `msg_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//��ϢID',
      `timestamp` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '��Ϣ����ʱ��',
      `direction` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
      `to` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '�����˵�username���߽���group��ID',
      `from` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '������username',
      `chat_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '�����жϵ��Ļ���Ⱥ�ġ�chat: ���ģ�groupchat: Ⱥ��',
      `msg` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '��Ϣ����',
      `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '�ı���Ϣ����'
    ) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='�û������¼';
 * */
Setp 2�����������ݱ�֮�󣬴�getMessage.php�ļ�����д�����
    $options['client_id'] = 'xxxxxxxxx';
    $options['client_secret'] = 'xxxxxx';
    $options['org_name'] = 'xxxxx';
    $options['app_name'] = 'xxxxxx';

	Enjoy!!!

	