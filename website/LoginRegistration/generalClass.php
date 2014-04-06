<?php

class General
{
 
    #Check if the user is logged in.
	public function logged_in () {
		return(isset($_SESSION['userId'])) ? true : false;
	}
 
	#if logged in then redirect to Template
	public function logged_in_protect() {
		if ($this->logged_in() === true) {
			header('Location:Template.php');
			exit();		
		}
	}
	
	#if not logged in then redirect to index.php
	public function logged_out_protect() {
		if ($this->logged_in() === false) {
			header('Location:../website/index.php');
			exit();
		}	
	}
 
}
?>
