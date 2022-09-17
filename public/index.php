<?php
// Front Controller 

//echo "Request URL : ";
// echo $_SERVER['QUERY_STRING'];

/**
 * Routing 
 */
require '../Core/Router.php';

$router = new Router();

//echo get_class($router);

// Anadiendo rutas  a la tabla de ENRUTAMIENTO
$router->add('',['controller'=>'Home','action'=>'index']);
$router->add('posts',['controller' =>'posts','action' =>'index']);
//$router->add('posts/new',['controller' =>'posts','action' =>'new']);
$router->add('{controller}/{action}');
$router->add('admin/{action}/{controller}');

//Mostramos las rutas 
echo '<pre>';
//var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(),true));
echo '</pre>';



//Recuperamos la ruta de la URL
$url = $_SERVER['QUERY_STRING'];


//Verificamos la ruta de la URL y mostramos la ruta 
if($router->match($url)){
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';
}

else{
    echo "<h1>La ruta no existe </h1>";
}



