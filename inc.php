<?
/**********************************************
 * Includes file for The Whovian
 * @version 1.0
 * @autor   Michael Pritchard 2003
 * @website http://whovian.blue-ghost.co.uk
 * @email   who@blue-ghost.co.uk
 *********************************************/
 
//Database Information
require('/home/blueghos/db.php');
$dbase   = "blueghos_whovian";

//Connects to the database --closed in footer.php
$db = mysql_connect($db_host, $db_user, $db_pwd);
mysql_select_db($dbase,$db);

//If you only want database information, and no page header.
if ($noheaders)
{}
else
{
  include("header.php");
}
?>
