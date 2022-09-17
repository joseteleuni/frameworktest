<?php

/**
 * Router
 * 
 */

 class Router {

    /**
     * Array asociativo para almacenar las rutas -> TABLA DE ENRUTAMIENTO
     * @var array
     */
    protected $routes = [];

    /**
     * Parametros desde la URL macheada
     * @var array
     */
     protected $params = [];  

    /**
     * Metodo para anadir una ruta a la tabla de enrutamiento
     * 
     * @param  string $route : La ruta del URL
     * @param  array  $params : Parametros ( Controller , action)
     * 
     * @return void
     */

     public function add($route, $params = [])
     {

      // Convertir  la ruta a una Expresion regular : escape , forward slashes
        $route = preg_replace('/\//','\\/',$route);

      //Convertir variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z-]+)',$route);
      
      // Anadir al inicio y al final delimitadores y flag case sensitive
         $route = '/^'.$route.'$/i';

      $this->routes[$route] = $params;

     }

    /**
     * Verifica que la ruta exista en la tabla de enrutamiento
     * seteando la propiedad $params con los parametros de la URL
     * 
     * @param string $url : La ruta URL
     * 
     * @return boolean : true si hace match , sino es false
     */

     public function match($url)
     {
        /** 
        *foreach ($this->routes as $route=>$params ){
        *    if ($url == $route){
        *        $this->params = $params;
        *  
        *        return true;
        *    }
        *  
        *}
        */

        //$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
      foreach($this->routes as $route=>$params) {
        if(preg_match($route, $url, $matches)){
           //Obtener los grupos nombrados
           //$params = [];

           foreach ($matches as $key => $match){
              if(is_string($key)){
                $params[$key] = $match;
              }
           }
           $this->params = $params;

           return true;

        }
        
      }
        return false;

     }

    /**
     * Metodo que obtiene los parametros macheados
     * 
     * @return array
     */

     public function getParams(){
        return $this->params;
     }


    /**
     * Metodo para mostrar todas las rutas de la tabla de enrutamiento
     * 
     * @return array
     */

     public function getRoutes()
     {
        return $this->routes;
     }


 }