<?php

// Definimos el espacio de nombres 'Core' para organizar la estructura del core de la aplicación
namespace Core;

class Router
{
    // Propiedades para almacenar el controlador, la acción y los parámetros de la URL
    private $urlController = null;
    private $urlAction     = null;
    private $urlParams     = [];

    // Constructor que se ejecuta cuando se instancia el Router
    public function __construct()
    {
        // Llamamos al método para dividir la URL en partes
        $this->splitUrl();

        // Si no se especifica un controlador en la URL, cargamos el controlador "Home" por defecto
        if (! $this->urlController) {
            $page = new \App\Controllers\Home();
            $page->index();
        }
        // Verificamos si el archivo del controlador solicitado existe
        elseif (file_exists(APP . 'Controllers/' . ucfirst($this->urlController) . '.php')) {
            // Creamos una instancia del controlador solicitado
            $controller          = '\\App\\Controllers\\' . ucfirst($this->urlController);
            $this->urlController = new $controller();

            // Verificamos si la acción (método) existe y es invocable
            if (method_exists($this->urlController, $this->urlAction) && is_callable([$this->urlController, $this->urlAction])) {
                // Si hay parámetros en la URL, llamamos al método con ellos
                if (! empty($this->urlParams)) {
                    call_user_func_array([$this->urlController, $this->urlAction], $this->urlParams);
                }
                // Si no hay parámetros, simplemente llamamos al método de la acción
                else {
                    $this->urlController->{$this->urlAction}();
                }
            }
            // Si no se especifica una acción, llamamos al método "index" por defecto
            else {
                if (strlen($this->urlAction) == 0) {
                    $this->urlController->index();
                }
                // Si no se encuentra la acción, llamamos al controlador de error para mostrar "404 Page Not Found"
                else {
                    $page = new \App\Controllers\Error();
                    $page->pageNotFound($this->urlController, $this->urlAction);
                }
            }
        }
        // Si el controlador no existe, mostramos el error 404
        else {
            $page = new \App\Controllers\Error();
            $page->pageNotFound($this->urlController, $this->urlAction);
        }
    }

    // Método privado que se encarga de dividir la URL en controlador, acción y parámetros
    private function splitUrl()
    {
        // Verificamos si existe el parámetro 'url' en la petición GET
        if (isset($_GET['url'])) {
            // Eliminamos los posibles '/' al inicio y final de la URL y la filtramos para sanitizarla
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // Dividimos la URL en partes usando '/' como delimitador
            $url = explode('/', $url);

            // Asignamos el primer segmento como controlador y el segundo como acción
            $this->urlController = isset($url[0]) ? $url[0] : null;
            $this->urlAction     = isset($url[1]) ? $url[1] : null;

            // Eliminamos los segmentos ya asignados (controlador y acción)
            unset($url[0], $url[1]);

            // Los parámetros restantes se guardan como un array
            $this->urlParams = array_values($url);
        }
    }

    // Método para verificar las rutas que requieren autenticación
    public function checkAuth()
    {
        // rutas que requieren autenticacion
        $protectedRoutes = ['home', 'profile'];

        // Si la ruta solicitada está protegida y el usuario no está autenticado, redirigimos al login
        if (in_array($this->urlController, $protectedRoutes) && !Session::checkAuth()) {
            header('Location: /login');
            exit;
        }
    }
}
