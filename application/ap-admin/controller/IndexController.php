<?php

class IndexController extends Controller {


	public function index() {

		$SC = Config::parseSystemConfig();
		$this->setViewData('serverdata', $SC['server']);
		$this->setViewData('databasedata', $SC['database']);
	}


	// Save the systemconfig
	public function savesystemconfig() {

		$SC = Config::parseSystemConfig();

		$dataArr = array(
			'server' => $_POST['serverdata'],
			'database' => $_POST['databasedata'],
			'domainmapping' => $SC['domainmapping'],
			'subdomainmapping' => $SC['subdomainmapping'],
		);

		if ( isset($_POST['serverdata']) && isset($_POST['databasedata']) ) {
			$this->writeini($dataArr, Config::getSystemConfigPath() );
		}

		// Redirect to where we came from
		Apace::redirect( Apace::getRefererUrl() );

	}


	public function writeini($array, $file)
	{
	    $res = array();
	    foreach($array as $key => $val)
	    {
	        if(is_array($val))
	        {
	            $res[] = "\r\n[$key]";
	            foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
	        }
	        else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
	    }
	    $this->saveini($file, implode("\r\n", $res));
	}

	
	public function saveini($fileName, $dataToSave)
	{    if ($fp = fopen($fileName, 'w'))
	    {
	        $st = microtime(TRUE);
	        do
	        {            
	        	$canWrite = flock($fp, LOCK_EX);
	           if(!$canWrite) usleep(round(rand(0, 100)*1000));
	        } while ((!$canWrite)and((microtime(TRUE)-$st) < 5));

	        if ($canWrite) {   
	        	fwrite($fp, $dataToSave);
	            flock($fp, LOCK_UN);
	        }

	        fclose($fp);
	    }

	}

	// Switch a config param to icon for display in admin frontend
	public static function switchconfigparamtoicon($key) {

		$r = null;
		switch ($key) {
		    case 'timezone':
		        $r = '<i class="fa fa-clock-o""></i>';
		        break;
		    default:
		        $r = null;
		}

		return $r;

	}

	
}