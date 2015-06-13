<?php
define("PROFILE", TRUE);

class profiler {
	var $page = "default";
	var $timers = array();
	var $exec_times = array();
	
	public function profiler($page)	{
		if(PROFILE) {
			$this->page = $page;
			$this->start_block("Total");
		}
	}
	
	public function start_block($key) {
		if (PROFILE) {
			$this->timers[$key] = new timer(true);
		}		
	}
	
	public function stop_block($key) {
		if (PROFILE) {
			$timer = $this->timers[$key];
			$this->exec_times[$key] = $timer->get();
			unset($this->timers[$key]);
		}
	}
	
	public function end() {				
		if (PROFILE) {			
			$this->stop_block("Total");
			$total = $this->exec_times["Total"];
			
			if ($total > 1) {			
				$log = $this->page." - ".date("c")."\n";
				$log .= "GET = ".var_export($_GET, true)."\n";
				$log .= "POST = ".var_export($_POST, true)."\n";
				$log .= "------------------------\n";
				foreach ($this->exec_times as $key=>$value) {
					$log .= round($value*100/$total)."%\t";
					$log .= "$value \t $key \n";
				}
				$this->write_log($log, $this->page);
			}
		}
	}

	private function write_log($content, $page)
	{
		$filename = ROOT_PATH."/profile_$page.log";
		
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
}

class timer
{
	var $start;

	/*  start the timer  */
	public function timer($start = 0)
	{
		if($start) {
			$this->start();
		}
	}

	/*  start the timer  */
	public function start()
	{
		$this->start = $this->get_time();
	}
	
	/*  get the current timer value  */
	public function get($decimals = 8)
	{
		return round(($this->get_time() - $this->start),$decimals);
	}

	/*  format the time in seconds  */
	private function get_time()
	{
		list($usec,$sec) = explode(' ', microtime());
		return ((float)$usec + (float)$sec);
	}
}