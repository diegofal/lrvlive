<?
	function write_log($content)
	{
		$filename = 'transations.log';
		$somecontent = "Add this to the file\n";
		
		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {
		
		   // In our example we're opening $filename in append mode.
		   // The file pointer is at the bottom of the file hence 
		   // that's where $somecontent will go when we fwrite() it.
		   if (!$handle = fopen($filename, 'a')) {
				echo "Cannot open file ($filename)";
				exit;
		   }
		
		   // Write $somecontent to our opened file.
		   if (fwrite($handle, $content."\n\n") === FALSE) {
			   echo "Cannot write to file ($filename)";
			   exit;
		   }
		   fclose($handle);
		} else {
		   echo "The file $filename is not writable";
		}
	}
	
	function write_error_log($content)
	{
		$filename = 'error.log';
		$somecontent = "Add this to the file\n";
		
		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {
		
		   // In our example we're opening $filename in append mode.
		   // The file pointer is at the bottom of the file hence 
		   // that's where $somecontent will go when we fwrite() it.
		   if (!$handle = fopen($filename, 'a')) {
				echo "Cannot open file ($filename)";
				exit;
		   }
			
			$content = "\n######################\n".date("r")."\n".$content."\n";
			
		   // Write $somecontent to our opened file.
		   if (fwrite($handle, $content) === FALSE) {
			   echo "Cannot write to file ($filename)";
			   exit;
		   }
		   fclose($handle);
		} else {
		   echo "The file $filename is not writable";
		}
	}
	
	function write_orders_log($content)
	{
		$filename = ROOT_PATH.'/orders.log';
		$somecontent = "Add this to the file\n";
	
		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {
	
			// In our example we're opening $filename in append mode.
			// The file pointer is at the bottom of the file hence
			// that's where $somecontent will go when we fwrite() it.
			if (!$handle = fopen($filename, 'a')) {
				echo "Cannot open file ($filename)";
				exit;
			}
				
			$content = "\n".date("r")."\n".$content."\n";
				
			// Write $somecontent to our opened file.
			if (fwrite($handle, $content) === FALSE) {
			echo "Cannot write to file ($filename)";
			exit;
			   }
			fclose($handle);
		} else {
		echo "The file $filename is not writable";
		}
	}
	
	function write_email_log($content)
	{
		$filename = ROOT_PATH.'/email.log';
		$somecontent = "Add this to the file\n";
	
		// Let's make sure the file exists and is writable first.
		if (is_writable($filename)) {
	
			// In our example we're opening $filename in append mode.
			// The file pointer is at the bottom of the file hence
			// that's where $somecontent will go when we fwrite() it.
			if (!$handle = fopen($filename, 'a')) {
				echo "Cannot open file ($filename)";
				exit;
			}
	
			$content = "\n".date("r")."\n".$content."\n";
	
			// Write $somecontent to our opened file.
			if (fwrite($handle, $content) === FALSE) {
				echo "Cannot write to file ($filename)";
				exit;
			}
			fclose($handle);
		} else {
			echo "The file $filename is not writable";
		}
	}
	
	function implode_array($thearray) {
		$output = "";
		foreach($thearray as $key => $value) {        
			if ($output != "") {
				$output .= ", ";
			}
			$output .= $key."=>".$value;
		}
		$output = "(".$output.")";
		return $output;
	}

?>
