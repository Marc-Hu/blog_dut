<?php

if(isset($_SESSION['connected'])){
	session_destroy();
}

if(isset($_SESSION['connected'])){
	goPage('/');
}