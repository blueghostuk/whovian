<?
$title = "Information on the Doctor";
include("inc.php");
if (!$_GET['doc'])
{
  $doc = 1;
}else
{
	$doc = $_GET['doc'];
}
//Get the doctor's info from variable $doc
$doc_query   = mysql_query("SELECT `id`,`char`,`start`,`end` FROM `doctors` WHERE 1 AND `id` = '$doc' LIMIT 0, 1");
$doc_results = mysql_fetch_array($doc_query);

//Get the stories info from variable $doc
$story_query = mysql_query("SELECT `serial`,`title`,`details` FROM `stories` WHERE 1 AND `doctor` = '$doc' ORDER BY `id` ASC LIMIT 0, 100");
$story       = mysql_num_rows($story_query);
echo"
    <div align=\"center\">
  <p><strong>Doctor Info</strong></p>
  <table width=\"50%\" border=\"0\">
    <tr>
      <td><div align=\"center\"><strong>Number</strong></div></td>
      <td><div align=\"center\">".$doc_results["id"]."</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>Actor</strong></div></td>
      <td><div align=\"center\">".$doc_results["char"]."</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>Start Date</strong></div></td>
      <td><div align=\"center\">".$doc_results["start"]."</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>End Date</strong></div></td>
      <td><div align=\"center\">".$doc_results["end"]."</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>Story Count</strong></div></td>
      <td><div align=\"center\">$story</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>Episode Count</strong></div></td>
      <td><div align=\"center\">&lt;EPISODE COUNT&gt;</div></td>
    </tr>
  </table>
  <p><strong>Story Info</strong></p>
  <table width=\"85%\" border=\"0\">
    <tr>
      <td><strong>Serial ID</strong></td>
      <td><strong>Story Name</strong></td>
      <td><strong>Details</strong></td>
    </tr>";
while ( $story_results = mysql_fetch_array($story_query) )
{
$char='50';
$story_results['details']=substr($story_results['details'], 0, $char);
if (strlen($story_results["details"]) < 20) {
$read ="";
} else {
$read = " ...";
}
echo"<tr>
       <td>
         <a class=\"comments\" href=\"story.php?id=".$story_results["serial"]."\">".$story_results["serial"]."</a>
       </td>
       <td>
         <a class=\"comments\" href=\"story.php?id=".$story_results["serial"]."\">".$story_results["title"]."</a>
       </td>
       <td>
         ".$story_results["details"]."$read
       </td>
     </tr>";
}
echo"</table></div>";
?>
