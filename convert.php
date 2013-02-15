<?
/*****************************************************
 * Converts old episodes to database for The Whovian
 * @version 1.0
 * @autor   Michael Pritchard 2003
 * @website http://whovian.blue-ghost.co.uk
 * @email   who@blue-ghost.co.uk
 ****************************************************/

function file_get_contents($filename) {
$fp = @fopen($filename, "rb");
if (!($fp)) {
return "No File";
}
while (!feof($fp)) {
$temp .= fread($fp, 4096);
}
return $temp;
}

$output = file_get_contents($url);
$output = eregi_replace ("<!--", "", $output);
$output = eregi_replace ("-->", "", $output);
$output = eregi_replace ("<head>", "<!--", $output);
$output = eregi_replace ("</head>", "-->", $output);
$output = eregi_replace ("<p>", "<!--", $output);
$output = eregi_replace ("<p", "<!--", $output);
$output = eregi_replace ("</p>", "-->", $output);
$output = eregi_replace ("<tr>
        <td>Episode No.</td>
        <td>Name</td>
        <td>Transmission Date</td>
    </tr>", "", $output);
$output = eregi_replace ("<tr>", "", $output);
$output = eregi_replace ("<td>", "", $output);
$output = eregi_replace ("</td>", ",", $output);
$output = eregi_replace ("<table border=\"1\" bgcolor=\"#C0C0C0\">", "", $output);
$output = eregi_replace ("</table>", "", $output);
$output = eregi_replace ("</tr>", "<br/>", $output);
$output = eregi_replace ("&nbsp; </NOSCRIPT>  End of TheCounter.com Code", "", $output);
$output = eregi_replace ("<!--([^-]*([^-]|-([^-]|-[^>])))*-->", "", $output);
echo $output;
echo"<br/><br/>";
if ($handle = opendir('/home/blueghos/public_html/whovian/old/')) {
   while (false !== ($file = readdir($handle))) {
       if ($file != "." && $file != "..") {
           $list .= "<a href=convert.php?url=old/$file>$file</a><br/>";
       }
   }
   closedir($handle);
}
echo $list;
?>
