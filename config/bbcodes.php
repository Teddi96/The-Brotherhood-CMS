   <script type="text/javascript">
         function swap(image) {
             document.getElementById("main").src = image.href;
         }
     </script>

<?php


function showBBcodes($text) {

// BBcode array
$find = array(
'~\[b\](.*?)\[/b\]~s',
'~\[i\](.*?)\[/i\]~s',
'~\[u\](.*?)\[/u\]~s',
'~\[quote\](.*?)\[/quote\]~s',
'~\[size=(.*?)\](.*?)\[/size\]~s',
'~\[color=(.*?)\](.*?)\[/color\]~s',
'~\[url\]((?:ftp|https?)://.*?)\[/url\]~s',
'~\[url=(.*?)\](.*?)\[/url\]~s',
'~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s',
'~\[youtube\].*?(?:v=)?([^?&[]+)(&[^[]*)?\[/youtube\]~s',
'~\[\*\]~s',
'~\[list\](.*?)\[\/list\]~s',
'~\[list=a\](.*?)\[\/list\]~s',
'~\[list=1\](.*?)\[\/list\]~s',
'~\[pastebin\]http://pastebin.com/(.*?)\[/pastebin\]~s',
'~\r~s'
);

// HTML tags to replace BBcode
$replace = array(
'<b>$1</b>',
'<i>$1</i>',
'<span style="text-decoration:underline;">$1</span>',
'<pre>$1</pre>',
'<span style="font-size:$1px;">$2</span>',
'<span style="color:$1;">$2</span>',
'<a href="$1">$1</a>',
'<a href="$1">$2</a>',
//'<a href="$1" onclick="swap(this); return false;"> <img src="$1" alt="" /></a>',
'<a href="$1" data-lightbox="$1"><img src="$1" width="250px" /></a>',
'<iframe width="560" height="315" src="https://youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>',
'<li>',
'<ul>$1</ul>',
'<ol type="a">$1</ol>',
'<ol>$1</ol>',
'<div style="height: 350px; overflow: auto;"><script src="http://pastebin.com/embed_js.php?i=$1"></script></div>',
'<br />'
);

// Replacing the BBcodes with corresponding HTML tags
return preg_replace($find,$replace,$text);
}

?>
