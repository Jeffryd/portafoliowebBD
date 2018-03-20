<?php
require_once 'vendor/autoload.php';

$app = new \Slim\Slim();

//Conectar la base de datos con php
//Orden de instancias Servidor, usuario, contrasena, bdatos
$db = new mysqli('localhost','root','','bdatcompleta');

// Configuración de cabeceras
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

$app-> get ( "/pruebas", function() use($app, $db){
  echo "Hola mundo desde Slim PHP";
  var_dump($db);
});

$app-> get("/pruebas2", function() use($app){
  echo "Hola Ady desde Slim PHP";
});

// ENLISTAR TODOS LOS proyectos
$app->get('/listarproyectos', function() use($db, $app){
// Hacer la consulta multitabla
$sql = ("SELECT  pro.Cliente, pro.Trabajo_Realizado, pro.IdImagen, cat.Nombre categoria
  FROM proyecto pro LEFT OUTER JOIN categoria cat
  on pro.IdCategoria = cat.IdCategoria ORDER BY cat.Nombre;");

// paso la cosulata a una variable
  $query = $db->query($sql);

// Recorro la variable y genero un array
  	$proyectos = array();
  	while ($proyecto = $query->fetch_assoc()) {
  		$proyectos[] = $proyecto;
  	}

// La variable $proyectos contiene el array y paso a generar las categorias
function reduceByNames(array $users)
{
    return array_reduce($users, function ($acc, $u) {
		if( array_key_exists($u['Nombre'], $acc) ){
			$acc[$u['Nombre']][] = $u ;
			return $acc;
		}else{
			$nuevo = [ $u['Nombre'] => [ $u ] ];
			return array_merge($acc, $nuevo);
		}
    }, []);
}

// Genero el resultado por ahora sin categorizarlo(pues comente la funcion)
$result = array(
			'status' => 'success',
			'code'	 => 200,
    'data' => $proyectos
        // 'data' => (reduceByNames($proyectos ))
		);


echo json_encode($result);



});

//Listar Categorias
$app->get('/listarcategorias', function() use($db, $app){
// Hacer la consulta multitabla
$sql = ("SELECT cat.IdCategoria, cat.Nombre Categoria , pro.Cliente, pro.Trabajo_Realizado
FROM categoria cat  LEFT OUTER JOIN proyecto pro
on cat.IdCategoria = pro.IdCategoria GROUP by pro.IdCategoria;");

// paso la cosulata a una variable
  $query = $db->query($sql);

// Recorro la variable y genero un array
  	$categorias = array();
  	while ($categoria = $query->fetch_assoc()) {
  		$categorias[] = $categoria;
  	}



// Genero el resultado por ahora sin categorizarlo(pues comente la funcion)
$result = array(
			'status' => 'success',
			'code'	 => 200,
    'data' => $categorias
        // 'data' => (reduceByNames($proyectos ))
		);


echo json_encode($result);



});


// MOSTRAR UN SOLO PRODUCTO
$app->get('/proyecto/:Id', function($id) use($db, $app){
	$sql = 'SELECT * FROM proyecto WHERE IdProyecto = '.$id;
	$query = $db->query($sql);

	$result = array(
		'status' 	=> 'error',
		'code'		=> 404,
		'message' 	=> 'Proyecto no disponible'
	);

	if($query->num_rows == 1){
		$proyecto = $query->fetch_assoc();

		$result = array(
			'status' 	=> 'success',
			'code'		=> 200,
			'data' 	=> $proyecto
		);
	}

	echo json_encode($result);
});

// ELIMINAR UN PRODUCTO
$app->get('/delete-proyecto/:Id', function($id) use($db, $app){
	$sql = 'DELETE FROM proyecto WHERE IdProyecto = '.$id;
	$query = $db->query($sql);

	if($query){
		$result = array(
			'status' 	=> 'success',
			'code'		=> 200,
			'message' 	=> 'El proyecto se ha eliminado correctamente!!'
		);
	}else{
		$result = array(
			'status' 	=> 'error',
			'code'		=> 404,
			'message' 	=> 'El proyecto no se ha eliminado!!'
		);
	}

	echo json_encode($result);
});

// ACTUALIZAR UN PRODUCTO
$app->post('/update-proyecto/:id', function($id) use($db, $app){
	$json = $app->request->post('json');
	$data = json_decode($json, true);

//Capturar datos ingresados
$Cliente = $data['Cliente'];
$Descripcion = $data['Descripcion'];
$Tiempo_Invertido = $data['Tiempo_Invertido'];
$Programas_Utilizados = $data['Programas_Utilizados'];
$Trabajo_Realizado = $data['Trabajo_Realizado'];
$Fecha_Elaborado = $data['Fecha_Elaborado'];
$IdCategoria = $data['IdCategoria'];
$IdImagen = $data['IdImagen'];

//Variable asigna el valor en cada campo determinado para la insercion en la tabla
$sql = ("UPDATE proyecto SET
    Cliente = '$Cliente', Descripcion = '$Descripcion',
    Tiempo_Invertido = '$Tiempo_Invertido',
    Programas_Utilizados = '$Programas_Utilizados',
    Trabajo_Realizado = '$Trabajo_Realizado',
    Fecha_Elaborado = '$Fecha_Elaborado',
    IdCategoria = '$IdCategoria',
    IdImagen   = '$IdImagen'
   WHERE IdProyecto = '{$id}'  " );

var_dump($sql);

$query = $db -> query($sql);

if($query){
  $result = array(
    'status' 	=> 'success',
    'code'		=> 200,
    'message' 	=> 'El proyecto se ha actualizado correctamente!!'
  );
}else{
  $result = array(
    'status' 	=> 'error',
    'code'		=> 404,
    'message' 	=> 'El proyecto no se ha actualizado!!'
  );
}

echo json_encode($result);

});

////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////
//Subir Imagenes  a la base de bdatos
$app->post ('/subirimagenes', function() use($app, $db)

{
$result = array(
  'status' =>'error',
  'code' =>'404',
  'message' =>'El archivo no subio',
 );

 if(isset($_FILES["uploads"])){
 	$piramideUploader = new PiramideUploader();

 	$upload = $piramideUploader->upload("image", "uploads", "uploads", array("image/jpeg","image/png","image/gif"));
  $file = $piramideUploader -> getInfoFile();
  $file_name = $file['complete_name'];

var_dump($file);
 }

echo json_encode($result);


});

//Guardar proyectos en bdatos y seleccionar ruta de navegacion
$app->post ('/addproyectos', function() use($app, $db)
{
//Capturar los datos y pasarlos al archivo json
$json = $app->request->post('json');
$data = json_decode($json, true);


//Preveer error de campos vacios
if(!isset($data['Cliente'])){
		$data['Cliente']=null;
	}
if(!isset($data['Descripcion'])){
  		$data['Descripcion']=null;
}
if(!isset($data['Tiempo_Invertido'])){
		$data['Tiempo_Invertido']=null;
}
if(!isset($data['Programas_Utilizados'])){
		$data['Programas_Utilizados']=null;
	}
if(!isset($data['Trabajo_Realizado'])){
  		$data['Trabajo_Realizado']=null;
  	}
if(!isset($data['Fecha_Elaborado'])){
    		$data['Fecha_Elaborado']=null;
    	}
if(!isset($data['IdCategoria'])){
      		$data['IdCategoria']=null;
      	}
if(!isset($data['IdImagen'])){
        		$data['IdImagen']=null;
        	}



//Capturar datos ingresados
$Cliente = $data['Cliente'];
$Descripcion = $data['Descripcion'];
$Tiempo_Invertido = $data['Tiempo_Invertido'];
$Programas_Utilizados = $data['Programas_Utilizados'];
$Trabajo_Realizado = $data['Trabajo_Realizado'];
$Fecha_Elaborado = $data['Fecha_Elaborado'];
$IdCategoria = $data['IdCategoria'];
$IdImagen = $data['IdImagen'];

//Variable asigna el valor en cada campo determinado para la insercion en la tabla
$query = ("INSERT INTO proyecto(
  Cliente, Descripcion, Tiempo_Invertido, Programas_Utilizados,
 Trabajo_Realizado, Fecha_elaborado,IdCategoria,IdImagen )
VALUES (
  '$Cliente','$Descripcion','$Tiempo_Invertido','$Programas_Utilizados',
  '$Trabajo_Realizado','$Fecha_Elaborado','$IdCategoria','$IdImagen' ); " );

//Inserta los datos en la tabla de la base de datos
  $insert = $db->query($query);


  //Contingencia por si hay un error lanzar el mensaje

  $result = array(
    		'status' => 'error',
    		'code'	 => 404,
    		'message' => 'Proyecto no agregado'
    	);
  //Si todo sale bien se procede normalmente
  if($insert){
    		$result = array(
    			'status' => 'success',
    			'code'	 => 200,
    			'message' => 'Proyecto agregado correctamente'
    		);
    	}

  echo json_encode($result);
});

////////////////////////////////////////////////////////////////////////////////
//Anadir categorias en bdatos y assignar ruta de navegacion
$app->post ('/addCategorias', function() use($app, $db)
{
  //Capturar los datos y pasarlos al archivo json
$json = $app->request->post('json');
$data = json_decode($json, true);

                                                              //Insert categorias
/////////////////////////////////////////////////////////////////////////////
//Preveer error de campos vacios
if(!isset($data['Nombre'])){
		$data['Nombre']=null;
	}
//////////////////////////////////////////////////////////////////////////////
//Capturar datos ingresados
$Nombre = $data['Nombre'];

//Variable asigna el valor en cada campo determinado para la insercion en la tabla
$query = ("INSERT INTO categoria(
  Nombre )
VALUES (
  '$Nombre')");

//Inserta los datos en la tabla de la base de datos
$insert = $db->query($query);

//Contingencia por si hay un error lanzar el mensaje
$result = array(
  		'status' => 'error',
  		'code'	 => 404,
  		'message' => 'Proyecto no agregado'
  	);
//Si todo sale bien se procede normalmente
if($insert){
  		$result = array(
  			'status' => 'success',
  			'code'	 => 200,
  			'message' => 'Categoria Agregada correctamente'
  		);
  	}



echo json_encode($result);
});



$app->run();
 ?>
