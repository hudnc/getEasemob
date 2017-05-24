<?php
/*
 * ----------------获取聊天记录下载地址，解析下载的gz文件并按行插入数据库---------------------
 *----------------------需要新建一个数据表来存数据-----------------------------
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
    header("Content-type: text/html; charset=utf-8");
    //new 对象
    include_once 'Easemob.class.php';
    $options['client_id'] = 'xxxxxxxxx';
    $options['client_secret'] = 'xxxxxx';
    $options['org_name'] = 'xxxxx';
    $options['app_name'] = 'xxxxxx';
    $e = new Easemob($options);
    //获取指定日期的聊天记录 日期格式为2017052401 代表2017年5月24日凌晨1点到1点59分59秒内的聊天记录
    $s_time = '2017052401';//如果想获取前一个小时的聊天记录，则使用 data('YmdH',time()-3600) 生成
    $down_url = getchatMessage($s_time,$e);
    //导出聊天记录接口不是实时接口获得的时间存在一定的延时，不能够作为实时拉取消息的接口使用。
    //目前提供两种方式来导出聊天记录，即下载历史消息文件和拉取历史消息两个接口，其中拉取历史消息接口为旧有接口并于2017年3月1日起停止使用，建议使用下载历史消息文件接口。
    //Path: /{org_name}/{app_name}/chatmessages/${time}  接口限制是一分钟一次
    //连接数据库
    $conn = mysqli_connect('localhost','root','root','database');
    //获取gz压缩包，并且读取里面的文件，写入到数据库中
    $gz = @trim(file_get_contents($down_url));//去除后面的空格，不然file_get_contents函数报错。
    if(empty($gz)){
        echo 'die';
        die;
    }
    file_put_contents('test.gz',$gz);
    //打开压缩包
    $res = gzopen('test.gz','rb');
    //读取文件
    $content = '';
    while (!gzeof($res)) {
        $content .= gzgets($res).',';
    }
    $content = substr($content,0,strlen($content)-1);
    //读取成功后，json 转数组，插入到数据库中
    $content = json_decode('['.$content.']',1);
    foreach ($content as $key =>$list){
        $data = '';
        $data['msg_id']=$list['msg_id'];
        $data['timestamp']=$list['timestamp'];
        $data['direction']=$list['direction'];
        $data['to']=$list['to'];
        $data['from']=$list['from'];
        $data['chat_type']=$list['chat_type'];
        $data['msg']=$list['payload']['bodies'][0]['msg'];
        $data['type']=$list['payload']['bodies'][0]['type'];
        $query = "INSERT  INTO `member_talk` (`msg_id`,`timestamp`,`direction`,`to`,`from`,`chat_type`,`msg`,`type`) VALUES('".$data['msg_id']."','".$data['timestamp']."','".$data['direction']."','".$data['to']."','".$data['from']."','".$data['chat_type']."','".$data['msg']."','".$data['type']."')";
//        echo $query;
        $isok = $conn->query($query);
        if($isok){
            echo $conn->insert_id.'插入成功！'.PHP_EOL;
        }
    }
    //如果存在聊天记录，返回.gz的下载地址，错误或者超时返回null
    function getchatMessage($s_time,$e){
        $msg_list = $e->getChatRecord($s_time);
        if(isset($msg_list['error'])){
            return 'null';
        }else{
            $count = count($msg_list['data']);
            if($count>'1'){
                $str = '';
                foreach ($msg_list['data'] as $key =>$data){
                    $str=$str.$key.'---'.$data['url'].PHP_EOL;
                }
            }else{
                $str=$msg_list['data'][0]['url'].PHP_EOL;
            }
            return $str;
        }
    }
