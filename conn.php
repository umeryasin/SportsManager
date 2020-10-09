<?php
class conn{
	public function connect()
	{
		$con=mysqli_connect("localhost","root","","db_sportsmanager");
		return $con;
	}
}
?>