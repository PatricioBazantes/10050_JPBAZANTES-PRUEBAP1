<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Vehículos</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
    	body {text-align: center;}
		#inicioImg{align-items: center;left: 50%;top: 90%;width: 90px;height: 90px;position: static;}
		.Boton {background-color: #ffffff;border-width:2px;border-style:solid;border-color:rgba(121, 121, 121, 1);
			border-radius:10px;color: black;padding: 5px 10px;text-align: center;text-decoration: none;
			display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;
		}
		#nuevo{background-color:forestgreen; color:white}
		#borrar{background-color:red; color:white}
		#detalle{background-color:royalblue; color:white}
		#update{background-color:goldenrod}
		#regresar{background-color:orange;}
		#matriculacion{background-color:royalblue; color:white}
  	</style>
</head>
<body>
	<?php
	    include_once("../../constantes.php");
		require_once("class/class.matricula.php");
		
		$cn = conectar();
		$v = new matricula($cn);
		//vehiculo::MetodoEstatico();
		
		
//2.1 URL para la petición GET
//$URL = "http://localhost:8088/Vehiculo_CRUD/Vehiculo_PARTE_II/index.php?d=act/0";	
//$URL = "http://localhost:8088/Vehiculo_CRUD/Vehiculo_PARTE_II/index.php?d=act/5";	

//$URL = "http://localhost:8088/Vehiculo_CRUD/Vehiculo_PARTE_II/index.php?d=det/0";	
//$URL = "http://localhost:8088/Vehiculo_CRUD/Vehiculo_PARTE_II/index.php?d=det/5";		
		
    // Codigo necesario para realizar pruebas.
	//TODO EL CODIGO COMENTADO SIRVE PARA HACER PRUEBAS DE ESCRITORIO
		if(isset($_GET['d'])){
		  
		/*	echo "<br>PETICION GET <br>";
			echo "<pre>";
				print_r($_GET);
			echo "</pre>";
		*/
		  
			// 2.1 PETICION GET
			// $dato = $_GET['d'];
			
			// 2.2 DETALLE id
			$dato = base64_decode($_GET['d']);
			$tmp = explode("/", $dato);
			
			/*
			echo "<br>VARIABLE TEMP <br>";
			echo "<pre>";
				print_r($tmp);
			echo "</pre>";
			*/
			
			$op = $tmp[0];
			$id = $tmp[1];
			
			if($op == "det"){
				echo $v->get_detail_vehiculo($id);
			}elseif($op == "act"){
				echo $v->get_form($id);
			}elseif($op == "new"){
				echo $v->get_form();
			}elseif($op == "del"){
				echo $v->delete_vehiculo($id); 
			}
		
	
		//NUEVO CODIGO - PARTE III
		
		}else{
			   
				/*
				echo "<br>PETICION POST <br>";
				echo "<pre>"; //pruebas de escritorio para saver que se hace
					print_r($_POST);
				echo "</pre>";
		      */
			if(isset($_POST['Guardar']) && $_POST['op']=="new"){
				$v->save_vehiculo();
			}elseif(isset($_POST['Guardar']) && $_POST['op']=="act"){
				$v->update_vehiculo();
			}else{
				echo $v->get_list();
			}	
		}
				

		
//*******************************************************
		function conectar(){
			//echo "<br> CONEXION A LA BASE DE DATOS<br>";
			$c = new mysqli(SERVER,USER,PASS,BD);
			
			if($c->connect_errno) {
				die("Error de conexión: " . $c->mysqli_connect_errno() . ", " . $c->connect_error());
			}
		/*	else{
				echo "La conexión tuvo éxito .......<br><br>";
			}  */
			
			$c->set_charset("utf8");
			return $c;
		}
//**********************************************************
		
		
	?>	
</body>
</html>
