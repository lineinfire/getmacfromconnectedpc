<?php
	// echo shell_exec("sudo $arp -an ".$_SERVER['REMOTE_ADDR']); 
	// shell_exec("arp -a ".escapeshellarg($_SERVER['REMOTE_ADDR'])." | grep -o -E '(:xdigit:{1,2}:){5}:xdigit:{1,2}'");
	/*
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$mac = shell_exec('arp $ip_address | cut -d " " -f4');
	echo "<br />Server Mac is: ";  
	echo $mac;
	echo "<br>-----------------------------------<br>";


	echo GetMAC();

	function GetMAC(){
	    ob_start();
	    system('getmac');
	    $Content = ob_get_contents();
	    ob_clean();
	    return substr($Content, strpos($Content,'\\')-20, 17);
	}
	*/
	echo "--------------------------------------<br>";

	$ipAddress=$_SERVER['REMOTE_ADDR'];
	echo "Your IP Address : ". $ipAddress;
	$macAddr=false;

	#run the external command, break output into lines
	$arp=`arp -a $ipAddress`;
	$lines=explode("\n", $arp);

	#look for the output line describing our IP address
	foreach($lines as $line)
	{
	   $cols=preg_split('/\s+/', trim($line));
	   if ($cols[0]==$ipAddress)
	   {
	       $macAddr=$cols[1];
	       echo "<br>Your MAC address is ".$macAddr."<br>";
	   }
	}
	echo "--------------------------------------<br>";
?>