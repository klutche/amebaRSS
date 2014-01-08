<?php 
function amebaRSS($url, $n='10') {
	$xml = @simplexml_load_file($url, NULL, LIBXML_NOCDATA);
	$item = $xml->channel->item;
	$i = 1;
	echo '<ul>'."\n";
	foreach ($item as $val) {
		if (mb_strpos($val->title, 'PR:') === FALSE) {
			echo '<li>'."\n";
			echo '<h2>'.$val->title.'</h2>'."\n";
			echo '<p class="date">'.date('Y-m-d H:i:s', strtotime($val->pubDate)).'</p>'."\n";
			echo mb_strimwidth(trim(strip_tags($val->description)), 0, 30, '･･･', 'UTF-8');
			echo '<a href="'.$val->link.'" target="_blank">'.続きを読む.'</a><br>'."\n";
			echo '</li>'."\n";
			$i++;
			if ($i > $n) {
				break;
			}
		}
	}
	echo '</ul>'."\n";
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>タイトル</title>
<link rel="stylesheet" href="css/reset.css">
<style type="text/css">
body { color:#333; font-size:14px; }
ul { margin:20px; }
li { margin-bottom:10px; padding-bottom:10px; border-bottom:solid 1px #ccc; }
h2 { font-size:18px; font-weight:bold; }
.date { margin-bottom:5px; color:#999; }
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>

<?php amebaRSS('http://feedblog.ameba.jp/rss/ameblo/nakagawa-shoko/rss20.xml', '10'); ?>

</body>
</html>