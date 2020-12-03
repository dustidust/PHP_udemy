<?php

/******* IN DIESER DATEI DEFINIERE ICH DEN CODE, DER MIR DAS ROUTING ERZEUGT *******/

// ALS ERSTES LADE ICH MEIN FRAMEWORK, ALSO ICH LASSE MIR EINEN CONTAINER ERSTELLEN
require __DIR__ . "/../init.php";
//
$pathInfo = $_SERVER['PATH_INFO'];

/* ALTE SCHREIBWEISE...
// WENN DIE PATHINFO = /index IST,
if ($pathInfo == "/index") {
    // DANN MACH MIR DOCH BITTE EIN POSTSCONTROLLER
    $postsController = $container->make("postsController");
    // UND POSTSCONTROLLER: FUEHRE DOCH BITTE DIE INDEX() METHODE AUS
    $postsController->index();
    /***** DAS HEISST IN MEINER PUBLIC/INDEX.PHP DEFINIERE ICH JETZT, WIE SICH DAS PROGRAMM 
     * VERHALTEN SOLL, WENN ICH PUBLIC/INDEX.PHP/INDEX EINGEBE, KOMME ICH SO ZU MEINER 
     * STARTSEITE. DAS HAT JETZT DEN VORTEIL, DAS ICH JETZT MEINE GANZEN MINI (index.php) DATEIN 
     * LOS BIN UND SIE IN EINER INDEX DATEI BUENDELN KANN *****/
    /*
} elseif ($pathInfo == "/post") {
    $postsController = $container->make("postsController");
    $postsController->show();
}

/***** JETZT HABEN WIR EINE INDEX.PHP, DIE SICH UM UNSER ROUTING KUEMMERT. WIR FRAGEN AB
 WELCHE ADDRESSE WURDE ABGEFRAGT UND DANN WIRD DER PASSENDE CONTROLLER AUFGERUFEN*/
 
 
 // DAS IST DAS SELBE WIE OBEN NUR UEBERSICHTLICHER GESCHRIEBEN:
 $routes = [
     '/index' => [
         'controller' => 'postsController',
         'method' => 'index'
     ],
     '/post' => [
         'controller' => 'postsController',
         'method' => 'show'
     ]
   ];

// JETZT FRAGE ICH AB OB EINE $ROUTES EXISTIERT: IF (ISSET ($ROUTES [AN DER STELLE $PATHINFO] 
if (isset($routes[$pathInfo])){
    $route =$routes[$pathInfo];
    $controller = $container->make($route['controller']);
    $method = $route['method']; 
    $controller->$method();
}






