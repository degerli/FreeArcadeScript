<?php

if($seo_on == 1){
		$con1 = ''.$domain.'/contact/';
	}else{
		$con1 = ''.$domain.'/index.php?action=contact';
	};

echo'<div id="container">
<div id="content-container">
<div id="side">';
include("includes/blocks.php");
echo'</div>

<form action =\''.$con1.'\' method=\'post\'>
<div id="content">
<div class="content_nav">Contact Us</div>
<div style="clear:both"></div>
<div id="content2">
		<table width="100%">
			<tr>
				<td>Your E-mail:</td>
				<td><input type=\'text\' name=\'sender\' size=\'50\' /></td>
			</tr>
			<tr>
				<td>Your Name:</td>
				<td><input type=\'text\' name=\'name\' size=\'50\' /></td>
			</tr>
			<tr>
				<td>Your Message:</td>
				<td><textarea name=\'message\' rows=\'10\' cols=\'50\' ></textarea></td>
			</tr>
			<tr>
				<td><input type=\'submit\' value=\'Send\' /></td>
			</tr>
		</table>
	</div>
</form>
</div></div>';

$sender = clean($_POST['sender']);
$name = clean($_POST['name']);
$message = clean($_POST['message']);

echo'<noscript>';
if(!$sender || !$name || !$message){
echo 'All fields are required.';
}else{

$headers = 'From: '.$sender.' <'.$sender.'>';
$subject = 'Contact message from '.$name.' through '.$sitename;
mail($supportemail, $subject, $message, $headers);
echo '<p>Thank you, message has been sent.</p>';
};
echo'</noscript>';

$pagetitle = $sitename.' Contact Us Form';
$metatags = 'contact us';
$metadescription = $sitename.' contact us form';
?>