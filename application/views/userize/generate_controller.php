<?php
$fp=fopen($file_location,'w');
fwrite($fp, 
'
<?php
/* 
This file is generated by Userize Library
Author   : Fariz Yoga Syahputra
Facebook : www.facebook.com/yoga.aprilio
Github   : www.github.com/farizyoga
*/

if ( ! defined('."'BASEPATH'".')) exit('."'No direct access script allowed'".'); 

class '.$file_name.' extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->userize->init();

	}

	public function index() {

		echo '."'This Controller is generated by Userize Library'".';

	}

}



?>
'
);
fclose($fp);
chmod($file_location,0777);
echo "<div class='col-lg-4'>";
echo "Controller Generated Successfully";
echo "</div>";
?>
