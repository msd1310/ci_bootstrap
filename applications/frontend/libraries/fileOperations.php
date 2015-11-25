<?php

class fileOperations {

	private $fileName ;
	private $dirName;
	private $fileHandle;
	private $backupFileName;
	private $tempFileName;
	
	public function __construct($fileName){
	    $this->fileName = $fileName;
	}
	public function createFile($writeMode){
	    
		$this->dirname = dirname($this->fileName);
		if (!is_dir($this->dirname) && $writeMode != "r") {
			mkdir($this->dirname, 0755, true);
		}
		
		if(!empty($this->fileName)) {
			if($writeMode == "r") {
				if(file_exists($this->fileName)) {	
					$this->fileHandle = fopen($this->fileName, $writeMode); 
				} else {
					return false;
				}
			} else { 
				$this->fileHandle = fopen($this->fileName, $writeMode); 
			}
			return true;
	    }
		
	    return false;
	}

	public function closeFile(){
	    fclose($this->fileHandle);
	}

	public function writeToFile($dataToInsert){
	    
		self::createFile('w');
	    if(fwrite($this->fileHandle , $dataToInsert)) {
	         return true;
	    }
	    self::closeFile();
	    return false;
	}
	public function appendToFile($dataToInsert){
	    self::createFile('a');
	    if(fwrite($this->fileHandle , $dataToInsert)) {
	         return true;
	    }
	    self::closeFile();
	    return false;
	}

	/* reading file content */
	/*
		params: bytesToRead : int - how many bytes to read if not set it will read all file
	*/
	public function readFromFile($bytesToRead = 0){
	    self::createFile('r');
	    if($bytesToRead > 0) {
	       if($result = fread($this->fileHandle , $bytesToRead)) {
	         return $result;
	       }
	    } else {
	    	if($result = fread($this->fileHandle , filesize($this->fileName))) {
	         return $result;
	       }
	    }
	    self::closeFile();
	    return false;
	}
	
	public function readFileToArr($seperator, $bytesToRead = 4096){
	    $fileContents	=	array();
		if(self::createFile('r')) {
			while(!feof($this->fileHandle)) 
			{
				$output	=	fgets($this->fileHandle, $bytesToRead);
				if(trim($output) != '')
				{
					$fileContents[]	=	explode("|",trim($output));
				}
			}
			self::closeFile();
			return $fileContents;
		} else {
			return "";
		}
	}
}
// How to use :
/*
$fileName = "<Enter File Name with Full Path Here>";
$file = new fileOperations($fileName);
$file->writeToFile("First line from method writeToFile ...\n");
$file->appendToFile("... line added via method appendToFile\n");
$file->appendToFile("... another line added via method appendToFile x2 \n");
echo nl2br($file->readFromFile($fileName));
*/

?>