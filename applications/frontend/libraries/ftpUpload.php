<?php
	#ini_set('display_errors',1);
	class ftpUpload
	{
		private $ftp_server = "180.179.108.53";
		private $ftp_username = "srgmdevs";
		private $ftp_password = "srgm1885*!@#";
		private $conn_id;
		private $login_result = false;
		
		function connect()
		{
			$this->conn_id = ftp_connect($this->ftp_server);
			if($this->conn_id)
			{
				$this->login_result = @ftp_login($this->conn_id, $this->ftp_username, $this->ftp_password);
				if($this->login_result)
				{
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
		
		function put($dest,$sourceFile)
		{
			//$this->debug($sourceFile, $dest);
			$upload = ftp_put($this->conn_id, $dest, $sourceFile, FTP_BINARY) or die("Upload Error");
			return $upload;
		}
		
		function close()
		{
			ftp_close($this->conn_id);
		}
			
		function debug($sourceFile='',$dest='')
		{
			echo "FROM : ".$sourceFile;
			echo "<hr>";
			echo "TO : ".$dest;
			echo "<hr>";
			die;
		}
		
		function file_exists_ftp($fileName='')
		{
			if(!empty($fileName))
			{
				$fName = "ftp://".$this->ftp_username.":".$this->ftp_password."@".$this->ftp_server.$fileName;
				if (is_file($fName)){
					return true;
				} 
			}
			return false;
		}
	}
	
	// How to use :
		/*
	// Upload File to FTP
			$ftp_path	=	$include_promo_ftp.'/'.$prod_fold.'/include/'.$createdFileName.".".$createdFileExtension;
			require_once('ftpUpload.php');
			$upload = new ftpUpload();
			$upload->connect();
			$up = $upload->put($ftp_path,$zone_list_path);
			if($up) { 
				$errMsg .= "FTP Upload Successfully Completed"; 
			} else { 
				$errMsg .= "FTP Upload Failed"; 
			} 
			$upload->close();
		*/
?> 