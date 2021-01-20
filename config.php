<?php 
//Exemplos das aulas de autoload na pasta htdocs/namespace
spl_autoload_register(function($class_name){
	//class é a pasta que contém as classes.
	$file_name = "class".DIRECTORY_SEPARATOR.$class_name. ".php"; 
	
	if(file_exists($file_name)){
		require_once($file_name);
	}
});
?>