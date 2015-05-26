<?php 
	if (isset($_GET['msg']))
	{
		$nick = isset($_GET['nick']) ? $_GET['nick'] : ".";
		$msg  = isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : ".";
		if ($nick . $msg != '..' && $msg != '')
		{
			$f = fopen('msg34343434343434.html',"a+");
			$line = "<p class=\"chatp\"><span class=\"chatname\">$nick: </span><span class=\"chattxt\">$msg</span></p>";
			fwrite($f,$line."\r\n");
			fclose($f);
			echo $line;
		}
	}
	else if (isset($_GET['all']))
	{
		$flag = file('msg34343434343434.html');
		$content = "";
		foreach ($flag as $value) {
			$content .= $value;
		}
		echo $content;
	}
?>	
