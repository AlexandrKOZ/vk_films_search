<!html>
<head>
</head>
<body style='margin:0px;padding:0px;'>
<?php
header('Content-Type: text/html; charset=utf8');
$ref=$_SERVER[HTTP_REFERER];
preg_match_all('!\d+!', $ref, $matches);
$ref1=$matches[0][0];
mysql_connect('localhost', 'user', 'password') or die(mysql_error());
mysql_select_db('dbname');
mysql_query("SET NAMES utf8");
$query=mysql_query("SELECT title, xfields FROM dle_post WHERE id='$ref1'") or die(mysql_error());
$data=mysql_fetch_assoc($query);
$xfields=$data[xfields];
$xfields_array=explode('||', $xfields);
for ($i=0; $i<count($xfields_array); $i++) {
		if (substr_count($xfields_array[$i], 'tags')>0) {
				$tmp_array=explode('|', $xfields_array[$i]);
				$tags_array=explode(',', $tmp_array[1]);
				$year = $tags_array[0];
				//print $year;
			}
	}
$title=$data[title];
$title=stripslashes($title);
$e = explode('"',$title); 
$result = array(); 
for ($i = 0,$s = sizeof($e); $i < $s; ++$i) 
{ 
 if ($e[$i] === '') {continue;} 
 $result[] = array('in_quotes' => $i % 2 != 0,'string' => $e[$i]); 
} 
$title=$result[1]['string'];
$title1=$result[1]['string'];
$title2=$result[1]['string'];
$title=str_replace(')', '', $title);
$title=str_replace('(', '', $title);
$title=$title." $year";
//$title=preg_replace('/\\s*\\([^()]*\\)\\s*/', '', $title);
$search_string=str_replace(' ', '%20', $title);
$api_id = '4567020';
$token='e5167c8c4e74da93fa';
$vk_id = 'efbe9ba173a4408647f3ad180e9631083e273362b11991bcd856106ddd6e471567b274538b40e25c97373';
$resp=file_get_contents("https://api.vk.com/method/video.search?q=$search_string&sort=2&adult=1&filters=long&shorter=14500&longer=3000&hd=0&count=1&v=5.25&access_token=$vk_id") or die('cant');
$resp=json_decode($resp, $assoc=true);
//print_r($resp);
$player_src=$resp["response"][items];
$player=$player_src[0][player];
//print $title;
if ($player==NULL) {
			$resp=array();
			$title1=preg_replace('/\\s*\\([^()]*\\)\\s*/', '', $title1);
			$title1=$title1." $year";
			$search_string1=str_replace(' ', '%20', $title1);
			$api_id = '4567020';
			$token='e5167c8c4e74da93fa';
			$vk_id = 'efbe9ba173a4408647f3ad180e9631083e273362b11991bcd856106ddd6e471567b274538b40e25c97373';
			$resp=file_get_contents("https://api.vk.com/method/video.search?q=$search_string1&sort=2&adult=1&filters=long&shorter=14500&longer=3000&hd=0&count=1&v=5.25&access_token=$vk_id") or die('cant');
			$resp=json_decode($resp, $assoc=true);
			$player_src=$resp["response"][items];
			$player=$player_src[0][player];
			if ($player==NULL) {
					$resp=array();
					$title2=preg_replace('/\\s*\\([^()]*\\)\\s*/', '', $title2);
					$title2=str_replace(':', '', $title2);
					$search_string2=str_replace(' ', '%20', $title2);
					$api_id = '4567020';
					$token='e5167c8c4e74da93fa';
					$vk_id = 'efbe9ba173a4408647f3ad180e9631083e273362b11991bcd856106ddd6e471567b274538b40e25c97373';
					$resp=file_get_contents("https://api.vk.com/method/video.search?q=$search_string2&sort=2&adult=1&filters=long&shorter=14500&longer=3000&hd=0&count=1&v=5.25&access_token=$vk_id") or die('cant');
					//print ("https://api.vk.com/method/video.search?q=$search_string2&sort=2&adult=1&filters=long&shorter=14500&longer=1200&hd=0&count=1&v=5.25&access_token=$vk_id");
					$resp=json_decode($resp, $assoc=true);
					$player_src=$resp["response"][items];
					$player=$player_src[0][player];
					if ($player==NULL) {
							print ("<font color=lightgray>Фильм не найден, приносим свои извинения. Возможно вы найдете его по ссылке ниже.</font>");
							print ("
									
									<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
								<!-- dbfilm_film_not_found -->
								<ins class='adsbygoogle'
									 style='display:inline-block;width:450px;height:220px'
									 data-ad-client='ca-pub-2243787355563922'
									 data-ad-slot='8124702893'></ins>
								<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
								</script>
									
								");
							die();
						}
				}
			print ("<iframe src='$player' width='450' height='250' frameborder='1'></iframe>");	
			// $string=file_get_contents($player);
			// $pattern = "|url240=(.+?)&amp|is";
			// preg_match($pattern, $string, $matches);
			// $urls[]=$matches[1];
			// $pattern = "|url360=(.+?)&amp|is";
			// preg_match($pattern, $string, $matches);
			// $urls[]=$matches[1];
			// $pattern = "|url480=(.+?)&amp|is";
			// preg_match($pattern, $string, $matches);
			// $urls[]=$matches[1];
			// $pattern = "|url720=(.+?)&amp|is";
			// preg_match($pattern, $string, $matches);
			// $urls[]=$matches[1];
			// for ($i=0; $i<=count($urls); $i++) {
					// $result_string=$urls[$i];
					// $url_array=pathinfo($result_string);
					// $filename_array=explode('.', $url_array[filename]);
					// $film_name=$title.".mp4";
					// $film_name=str_replace(' ', '_', $film_name);
					// if ($filename_array[1]=='240') {
							// $urls[$i]=urlencode($urls[$i]);
							// print ("<a target=blank href=download.php?fname=$urls[$i]&flmname=$film_name&action=download>Скачать 240</a> ");
						// }
					// if ($filename_array[1]=='360') {
							// print ("<a target=blank href=download.php?fname=$urls[$i]&flmname=$film_name&action=download>Скачать 360</a> ");
						// }
					// if ($filename_array[1]=='480') {
							// print ("<a target=blank href=download.php?fname=$urls[$i]&flmname=$film_name&action=download>Скачать 480</a> ");
						// }
					// if ($filename_array[1]=='720') {
							// print ("<a target=blank href=download.php?fname=$urls[$i]&flmname=$film_name&action=download>Скачать 720</a> ");
						// }	
				// }
			die();	
	}
	
// $string=file_get_contents($player);
// $pattern = "|url240=(.+?)&amp|is";
// preg_match($pattern, $string, $matches);
// $urls[]=$matches[1];
// $pattern = "|url360=(.+?)&amp|is";
// preg_match($pattern, $string, $matches);
// $urls[]=$matches[1];
// $pattern = "|url480=(.+?)&amp|is";
// preg_match($pattern, $string, $matches);
// $urls[]=$matches[1];
// $pattern = "|url720=(.+?)&amp|is";
// preg_match($pattern, $string, $matches);
// $urls[]=$matches[1];
print ("<iframe src='$player' width='450' height='250' frameborder='1'></iframe>");
// for ($i=0; $i<=count($urls); $i++) {
		// $result_string=$urls[$i];
		// $url_array=pathinfo($result_string);
		// $filename_array=explode('.', $url_array[filename]);
		// $film_name=$title.".mp4";
		// $film_name=str_replace(' ', '_', $film_name);
		// if ($filename_array[1]=='240') {
				// $urls[$i]=urlencode($urls[$i]);
				// print ("<a target=blank href=download.php?fname=$urls[$i]&flmname=$film_name&action=download>Скачать 240</a> ");
			// }
		// if ($filename_array[1]=='360') {
				// //$urls[$i]=str_replace('?', '', $urls[$i]);
				// print ("<a target=blank href=download.php?fname=$urls[$i]&flmname=$film_name&action=download>Скачать 360</a> ");
			// }
		// if ($filename_array[1]=='480') {
				// //$urls[$i]=str_replace('?', '', $urls[$i]);
				// print ("<a target=blank href=download.php?fname=$urls[$i]&flmname=$film_name&action=download>Скачать 480</a> ");
			// }
		// if ($filename_array[1]=='720') {
				// //$urls[$i]=str_replace('?', '', $urls[$i]);
				// print ("<a target=blank href=download.php?fname=$urls[$i]&flmname=$film_name&action=download>Скачать 720</a> ");
			// }	
	// }

?>
</body>