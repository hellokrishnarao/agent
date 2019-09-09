<?php
class Photo {
	public $src = "upload/";
	public $tmp;
	public $filename;
	public $type;
	public $uploadfile;
	private $file_name;

	function __construct() {

		$this->filename = $_FILES["file"]["name"];
		$this->tmp = $_FILES["file"]["tmp_name"];
		$this->uploadfile = "asbkdbkj";
	}
	public function uploadfile() {
		if (move_uploaded_file($this->tmp, $this->uploadFile)) {
			return true;
		}
	}

}

?>