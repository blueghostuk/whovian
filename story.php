<?
$title = "Story Information";
include("inc.php");
if (!$_GET['id'])
{
  echo"No Story selected";
  exit();
}else
{
	$id = $_GET['id'];
}

//Get Story Details from variable $id
$story_query   = mysql_query("SELECT `serial`,`title`,`doctor`,`details` FROM `stories` WHERE 1 AND `serial` LIKE '$id' LIMIT 0, 30");
$story_results = mysql_fetch_array($story_query);
$sid           = $story_results["serial"];
$doc           = $story_results["doctor"];

//Get Episode Details from variable $sid
$ep_query  = mysql_query("SELECT `episode`,`title`,`tx`,`duration` FROM `episodes` WHERE 1 AND `story` LIKE '$sid' ORDER BY `episode` ASC LIMIT 0, 10");
$episodes  = mysql_num_rows($ep_query);

//Get first and last tx dates
$tx1_query   = mysql_query("SELECT `tx` FROM `episodes` WHERE 1 AND `story` LIKE '$sid' ORDER BY `episode` ASC LIMIT 0, 1");
$tx1_results = mysql_fetch_array($tx1_query);
$tx1         = $tx1_results["tx"];

$tx2_query   = mysql_query("SELECT `tx` FROM `episodes` WHERE 1 AND `story` LIKE '$sid' ORDER BY `episode` DESC LIMIT 0, 1");
$tx2_results = mysql_fetch_array($tx2_query);
$tx2         = $tx2_results["tx"];
//Get Doctor Information from $doc
$doc_query   = mysql_query("SELECT `id`,`char` FROM `doctors` WHERE 1 AND `id` = '$doc' LIMIT 0, 30");
$doc_results = mysql_fetch_array($doc_query);
echo"
    <div align=\"center\">
    <p>".$ep_results["title"]."</p>
    <table width=\"50%\" border=\"0\">
    <tr>
      <td><div align=\"center\"><strong>Story Information</strong></div></td>
    </tr>
    </table>
    <table width=\"50%\" border=\"0\">
    <tr>
      <td><div align=\"center\"><strong>Serial</strong></div></td>
      <td><div align=\"center\">".$story_results["serial"]."</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>Doctor</strong></div></td>
      <td><div align=\"center\">".$doc_results["id"].". ".$doc_results["char"]."</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>Episodes</strong></div></td>
      <td><div align=\"center\">$episodes</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>Start Date</strong></div></td>
      <td><div align=\"center\">$tx1</div></td>
    </tr>
    <tr>
      <td><div align=\"center\"><strong>End Date</strong></div></td>
      <td><div align=\"center\">$tx2</div></td>
    </tr>
    </table>
    <p>&nbsp;</p>
    <table width=\"75%\" border=\"0\">
    <tr>
      <td><strong>Episode Number</strong></td>
      <td><strong>Name</strong></td>
      <td><strong>First Transmission</strong></td>
      <td><strong>Duration (mins:secs)</strong></td>
    </tr>";
while ( $ep_results = mysql_fetch_array($ep_query) )
{
echo"<tr>
      <td>".$ep_results["episode"]."</td>
      <td>".$ep_results["title"]."</td>
      <td>".$ep_results["tx"]."</td>
      <td>".$ep_results["duration"]."</td>
    </tr>";
}
echo"</table><p>&nbsp;</p><table width=\"85%\" border=\"0\">
    <tr>
      <td><strong>Story Details</strong></td>
    </tr>
    <tr>
      <td>".$story_results["details"]."</td>
    </tr>
    </table>
    </div>";
?>
