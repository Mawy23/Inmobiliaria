<?php

// Definimos el espacio de nombres 'Core' para organizar la estructura del core de la aplicación
namespace Core;

// Usamos la clase Exception para lanzar excepciones en caso de errores
use Exception;

class View
{
    // Método estático para renderizar vistas
    public static function render($views = [], $args = [], $header = 'templates/header', $footer = 'templates/footer')
    {
        // Obtenemos la URL base utilizando la clase Util
        $baseUrl = Util::baseUrl();

        // Extraemos las variables del array $args y las hace disponibles como variables en el alcance actual
        extract($args, EXTR_SKIP);

        // Construimos la ruta del archivo de cabecera y verificamos si es legible
        $file = VIEWS."$header.php";
        if (is_readable($file)) {
            require $file; // Incluimos el archivo de cabecera
        } else {
            throw new Exception("$file not found"); // Lanzamos una excepción si el archivo no se encuentra
        }

        // Recorremos cada vista pasada como argumento
        foreach ($views as $view) {
            // Construimos la ruta del archivo de vista y verificamos si es legible
            $file = VIEWS."$view.php";
            if (is_readable($file)) {
                require $file; // Incluimos el archivo de vista
            } else {
                throw new Exception("$file not found"); // Lanzamos una excepción si el archivo no se encuentra
            }
        }

        // Construimos la ruta del archivo de pie de página y verificamos si es legible
        $file = VIEWS."$footer.php";
        if (is_readable($file)) {
            require $file; // Incluimos el archivo de pie de página
        } else {
            throw new Exception("$file not found"); // Lanzamos una excepción si el archivo no se encuentra
        }
        exit; // Terminamos el script después de renderizar las vistas
    }

    // Método estático para renderizar datos en formato JSON
    public static function renderJson($data, $code = 200, $charset = 'utf-8')
    {
        // Codificamos los datos en formato JSON
        $response = json_encode($data);

        // Establecemos el código de respuesta HTTP
        http_response_code($code);
        
        // Establecemos la cabecera de tipo de contenido para JSON
        header("Content-type: application/json; charset=".$charset);
        
        // Enviamos la respuesta JSON al cliente
        echo $response;
        exit; // Terminamos el script después de enviar la respuesta
    }
}
