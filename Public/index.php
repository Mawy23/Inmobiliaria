<?php

// Definimos la constante 'ROOT' que contiene la ruta al directorio raíz de la aplicación
define('ROOT', dirname(__DIR__).DIRECTORY_SEPARATOR);

// Definimos la constante 'APP' que apunta al directorio 'App' dentro del directorio raíz
define('APP', ROOT.'App'.DIRECTORY_SEPARATOR);

// Definimos la constante 'VIEWS' que apunta al directorio 'Views' dentro del directorio 'App'
define('VIEWS', APP.'Views'.DIRECTORY_SEPARATOR);

// Definimos la constante 'PUBLIC_FOLDER' que representa el nombre de la carpeta pública
define('PUBLIC_FOLDER', 'public');

// Definimos la constante 'PUBLIC_FOLDER_PATH' que contiene la ruta completa a la carpeta pública
define('PUBLIC_FOLDER_PATH', ROOT.PUBLIC_FOLDER.DIRECTORY_SEPARATOR);

// Cargamos el autoloader de Composer, que permite cargar automáticamente las clases
require ROOT.'vendor/autoload.php';

// Importamos la clase Router desde el espacio de nombres Core
use Core\Router;

// Creamos una nueva instancia del Router, que se encargará de manejar las rutas de la aplicación
$router = new Router();
