<?php

class Application
{
    public static function process()
    {
        $controllerName = "Afficheur";
        $task = "afficheAccueil";

        if(!empty($_GET['controller'])){
            $controllerName = ucfirst($_GET['controller']);
        }

        if(!empty($_GET['task'])){
            $task = $_GET['task'];
        }

        $controllerName = "\Controllers\\" .$controllerName;

        $controller = new $controllerName();
        $controller->$task();
    }
}