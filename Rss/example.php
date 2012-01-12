<?php

header( 'Content-Type: text/html; charset=utf-8' );

error_reporting(E_ALL);

include './Rss.php'; // include library

$Rss = new Rss; // create object

/*
	XML way
*/
$feed = $Rss->getFeed('http://blog.danaketh.com/feed/rss2');

echo '<pre>';
foreach($feed as $item)	{
	echo "<b>Title:</b> <a href=\"$item[link]\">$item[title]</a>\n";
	echo "<b>Published:</b> $item[date]\n";
	echo "\n$item[description]\n";
	echo "<hr/>";
}
echo '</pre>';

/*
	SimpleXML way
*/
$feed = $Rss->getFeed('http://blog.danaketh.com/feed/rss2', 'SXML');

echo '<pre>';
foreach($feed as $item)	{
	echo "<b>Title:</b> <a href=\"$item[link]\">$item[title]</a>\n";
	echo "<b>Published:</b> $item[date]\n";
	echo "\n$item[description]\n";
	echo "<hr/>";
}
echo '</pre>';

/*
	Text way
*/
$feed = $Rss->getFeed('http://blog.danaketh.com/feed/rss2', 'TXT');

echo '<pre>';
foreach($feed as $item)	{
	echo "<b>Title:</b> <a href=\"$item[link]\">$item[title]</a>\n";
	echo "<b>Published:</b> $item[date]\n";
	echo "\n$item[description]\n";
	echo "<hr/>";
}
echo '</pre>';

?>