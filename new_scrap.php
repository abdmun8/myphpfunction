<?php
ini_set('max_execution_time', 300);

$username = 'boscare@bengkelbos.co.id';
$password = 'C4r3impressive';
 
//Which folders or label do you want to access? - Example: INBOX, All Mail, Trash, labelname 
//Note: It is case sensitive
$imapmainbox = "INBOX";
 
//Select messagestatus as ALL or UNSEEN which is the unread email
$messagestatus = "ALL";
 
//-------------------------------------------------------------------
 
//Gmail Connection String
$imapaddress = "{mail.bengkelbos.co.id}";
 
//Gmail host with folder
$hostname = $imapaddress . $imapmainbox;
 
//Open the connection
$connection = imap_open($hostname,$username,$password) or die('Cannot connect to : ' . imap_last_error());
 
//Grab all the emails inside the inbox
$emails = imap_search($connection,$messagestatus);
 
//number of emails in the inbox
$totalemails = imap_num_msg($connection);
  
// echo "Total Emails: " . $totalemails . "<br>";
  
if($emails) {
  
  //sort emails by newest first
  rsort($emails);

  	$databli = array();
	$datalaz = array();
	$dataelv = array();
	$datasop = array();
	//loop through every email int he inbox
	$b=0;$l=0;$e=0;$s=0;

	function after ($this, $inthat){
        if (!is_bool(strpos($inthat, $this)))
        return substr($inthat, strpos($inthat,$this)+strlen($this));
    };
  	foreach($emails as $email_number) {
    
    //grab the overview and message
    $header = imap_fetch_overview($connection,$email_number,0);
 
    //Because attachments can be problematic this logic will default to skipping the attachments    
    $message = imap_fetchbody($connection,$email_number,1.1);
         if ($message == "") { // no attachments is the usual cause of this
          $message = imap_fetchbody($connection, $email_number, 1);
    }
    
    // print_r($header);
  //   if(preg_match('/BLIBLI.COM/', $header[0]->from) && preg_match('/Pesanan\\sBaru/', $header[0]->subject)){
	 //    // split the header array into variables
	 //    // $status = ($header[0]->seen ? 'read' : 'unread');
	 //    // $subject = $header[0]->subject;
	 //    // $from = $header[0]->from;
	 //    // $date = $header[0]->date;
	 //    $databli[$b]['subject']= $header[0]->subject;
	 //    $databli[$b]['from']= $header[0]->from;
	 //    $databli[$b]['date']= $header[0]->date;
	 //    // $databli[$b]['message']= $message;
	 //    $dom = new DOMDocument();
	 //    $dom->loadHTML($message);
	 //    $xpath = new DOMXPath($dom);
		// $tables = $xpath->query('.//td/table'); // fetch all tables inside td
		// $temp = array();
		// foreach($tables as $table){
		//    // Do your stuff with each table
		//    $temp[] = $table->nodeValue; // $table is your current $table
		// }

		// // // if(preg_match('', subject))

		// // $databli[$b]['message']= $temp[0];
		// $new ='';
		// // $temp[0] = substr($temp[0], -120, strpos($temp[0], "pada"));
		// $new = after ('pada', $temp[0]);
		// $msg = substr($new, 1,46);
	 //    // print_r($new);
	 //    // $split = explode("-",$msg);
	 //    $new = trim($new);



	 //    print_r($new);
		// $a = preg_split("/\\s-\\s+/", $new);
		// print_r($a);
	 //    die;

	    
	 //    // echo "status: " . $status . "<br>";
	 //    // echo "subject: " . $subject . "<br>";
	 //    // echo "from: " . $from . "<br>";
	 //    // echo "date: " . $date . "<br>";
	 //    // echo "message: " . $message . "<br><hr><br>";
	 //    $b++;
  //   }	

    // split the header array into variables
    if(preg_match('/Lazada/', $header[0]->from) && preg_match('/New\\s/Order/', $header[0]->subject)){
    	// $status = ($header[0]->seen ? 'read' : 'unread');
	    // $subject = $header[0]->subject;
	    // $from = $header[0]->from;
	    // $date = $header[0]->date;

	    // echo "status: " . $status . "<br>";
	    // echo "subject: " . $subject . "<br>";
	    // echo "from: " . $from . "<br>";
	    // echo "date: " . $date . "<br>";
	    // echo "message: " . $message . "<br><hr><br>";
	    $dom = new DOMDocument();
	    $dom->loadHTML($message);
	    $xpath = new DOMXPath($dom);
		$tables = $xpath->query('.//p/blockquote'); // fetch all tables inside td
		$temp = array();
    }
    die;
	    
 
//This is where you would want to start parsing your emails, send parts of the email into a database or trigger something fun to happen based on the emails.
 
  }  
} 
// print_r($databli);
 
// close the connection
imap_close($connection);

?>