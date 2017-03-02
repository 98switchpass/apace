<?php

require_once('minify.php');
require_once('lessc.inc.php');

/**
 * Development Environment
 *
 * Anything that will use the Minify or Lessc libraries must go via Apace Development Environment
 *
 */
class DevelopmentEnvironment {

	protected $minify;

	public function __construct() {
		$this->minify = new Minify();
	}

	/**
	 * Compress a single javascript file
	 */
	public function compressJavascript($file, $targetFolder) {

		if ($file) {

			$ch = curl_init();
			$file .= '.js';

			$ac = parse_ini_file( dirname(dirname(dirname(__FILE__))).'\application'.DIRECTORY_SEPARATOR.$targetFolder.'\configuration\config.ini', true );
			$url = $ac['application']['baseurl'].'data/'.$targetFolder.'data/js/'.$file;

			$fileToCompress = $this->fileGetContentsCurl($url, $ch);
			
			$minifyContent = $this->minify->minifyJs($fileToCompress);
			$minifiedFile = fopen( dirname(dirname(dirname(__FILE__))).'\data'.DIRECTORY_SEPARATOR.$targetFolder.'data\js\minified'.DIRECTORY_SEPARATOR.$file, "w" );
			fwrite($minifiedFile, $minifyContent);
			fclose($minifiedFile);

			curl_close($ch);

		}

	}

	/**
	 * Compress a single less file
	 */
	public function compileLess($fileFullPath, $file, $targetFolder) {

		if ($fileFullPath) {
			$returnfileName = $file.'.less';
			$file .= '.css';
			$less = new lessc();
			$less->setFormatter("compressed");
			try {
				$less->compileFile($fileFullPath, dirname(dirname(dirname(__FILE__))).'\data'.DIRECTORY_SEPARATOR.$targetFolder.'data\css\minified'.DIRECTORY_SEPARATOR.$file);
				echo ' '.$returnfileName.' was compiled and compressed to CSS';
			} catch (exception $e) {
				echo ' ERROR! :'.$e->getMessage();
			}

		}

	}

	/**
	 * Get the contents of a file via Curl
	 *
	 * @return string $data		Contains the file contents
	 */
	public function fileGetContentsCurl($url, $ch) {

	    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

	    $data = curl_exec($ch);

	    return $data;
	    
	}

}