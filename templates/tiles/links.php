<?php


function writebody() {
global $db, $domain, $sitename, $cachelife, $template, $gamesfolder, $thumbsfolder, $limitboxgames, $seo_on, $blogentriesshown, $enabledcode_on, $comments_on, $directorypath, $autoapprovecomments, $gamesonpage, $abovegames, $belowgames, $ads1, $ads2, $ads3, $bannersleft, $showwebsitelimit, $supportemail, $showblog, $blogentriesshown, $blogcharactersshown, $blogcommentpermissions, $blogcommentsshown, $blogfollowtags, $blogcharactersrss, $usrdata, $userid, $showpages, $suserid;

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<div id="content">
<div class="content_nav">Partners</div>
	<table align=\'center\' border=\'0\' width=\'100%\'>
			<tr>
				<td align=\'center\' class=\'content\'>';
					$rlinkx2 = "SELECT * FROM fas_links where activate != '0' ORDER BY activate desc ";
					$rlinkx1 = sqlcache('linkspage', $cachelife, $rlinkx2);
					foreach($rlinkx1 as $row ){
					echo '<a href=\''.$row['url'].'\' target=\'_blank\'><font size=\'3\'>'.$row['title'].'</font></a><br>';
                    };
echo'
</td>
</tr>
</table>

<hr width=\'85%\'>


';

if(isset($_POST['submit'])){
	$title = clean($_POST['title']);
	$url = clean($_POST['url']);
	$linkbackat = clean($_POST['linkbackat']);
	$emailaddress = clean($_POST['emailaddress']);
	$dateadded = time();
      $IPaddress = $_SERVER['REMOTE_ADDR'];
	if(!$title || !$url){
		echo '<div class=\'error\'>Title or URL was not filled.</div>';
		include ('templates/'.$template.'/footer.php');
		exit;
	}
	mysql_query("INSERT INTO fas_links SET
					title='$title',
					url='$url',
					dateadded='$dateadded',
					IPaddress='$IPaddress',
				      linkbackreq='1',
				      linkbackat='$linkbackat',
				      emailaddress='$emailaddress'
					");

	echo '<div class=\'msg\'>Link Added, waiting for verification.<p>
<b><font size=\'4\'>If our link is not up on your end before we check, your link will be deleted without notice.</font></div><br />
	</div></div>		';
}else{
	if($seo_on == 1){
		$submitlink = ''.$domain.'/links/';
	}else{
		$submitlink = ''.$domain.'/index.php?action=links';
	}

	echo '
	<form action=\''.$submitlink.'\' method=\'POST\'>
        <div class="content_nav">Submit Your Link</div>
        <div style="clear:both"></div>
	<table align=\'center\' width=\'100%\'>
		<tr>
			<td   class=\'content\'><b>If we do not see our link up on your end when we do our verification check, your
link will be deleted with out notice or being activated.<p>
If you take ours down later, we take yours down. <p>
Please, don\'t waste your time or ours. <p>
Our link:<br>
Anchor: '.$sitename.'<br>
URL: '.$domain.'<p></b></td>

		</tr>
		<tr>
			<td   class=\'content\'>Enter your link info:</td>
		</tr>
		<tr>
			<td class=\'content\' align=\'center\'>Title:
			<input type=\'text\' name=\'title\' size=\'35\'></td>
		</tr>
		<tr>
			<td class=\'content\' align=\'center\'>URL:
			<input type=\'text\' name=\'url\' size=\'40\' value=\'http://\'></td>
		</tr>
		<tr>
			<td class=\'content\' align=\'center\'>Location of reciprocal link:
			<input type=\'text\' name=\'linkbackat\' size=\'40\' value=\'http://\'></td>
		</tr>
		<tr>
			<td class=\'content\' align=\'center\'>E-mail Address:
			<input type=\'text\' name=\'emailaddress\' size=\'40\' value=\'\'></td>
		</tr>
		<tr>
			<td class=\'content\' align=\'center\'><input type=\'submit\' name=\'submit\' value=\'Add Link\'></td>
		</tr>
	</table>
	</form>
</div></div></div>';
};
};


$pagetitle = $sitename.' link partners';
$metatags = 'links, link exchange, link partners';
$metadescription = $sitename.' link partners';
?>