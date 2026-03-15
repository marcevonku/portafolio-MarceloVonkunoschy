<?php

namespace App\Core;

class Router
{
    public function dispatch()
    {
        // 1. Obtener y limpiar la URL
        // Capturamos la URI de la solicitud (incluyendo parámetros GET)
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';

        // Usamos parse_url para aislar la ruta y eliminar parámetros GET (?foo=bar)
        $uri = parse_url($requestUri, PHP_URL_PATH);

        // Elimina el subdirectorio y normaliza la URI. 
        // Después de esta llamada, $uri será una de estas formas:
        // '/' (para la ruta raíz) o 'Principal/Brokers' (para la ruta AJAX)
        $uri = $this->removeSubdirectory($uri);

        // ----------------------------------------------------


        // **INICIO DE LA LÓGICA DE SEGMENTACIÓN CORREGIDA**

        // Si la URI es '/', $segments debe ser un array vacío para usar los valores por defecto.
        if ($uri === '/') {
            $segments = [];
        } else {
            // Divide la URL en partes (segmentos)
            $segments = explode('/', $uri);
        }

        // El primer segmento es el Controlador. El valor por defecto es 'Principal'.
        $controllerName = array_shift($segments);
        if (!$controllerName) {
            $controllerName = 'Principal';
        }

        // La acción por defecto es 'index'.
        $actionName = array_shift($segments);
        if (!$actionName) {
            $actionName = 'index';
        }

        // Los segmentos restantes son Parámetros
        $params = $segments;

        // **FIN DE LA LÓGICA DE SEGMENTACIÓN CORREGIDA**

        // 2. Formatear nombres de clases y métodos
        // Convertimos 'principal' a 'PrincipalController' (Convención de nombramiento)
        $controllerClass = 'App\\Controllers\\' . ucfirst($controllerName) . 'Controller';
        $actionMethod = $actionName;

        // 3. Verificar y cargar el Controlador
        if (!class_exists($controllerClass)) {
            // Manejo de error 404
            header("HTTP/1.0 404 Not Found");
            echo "Error 404: Controlador no encontrado para la ruta '{$controllerName}'";
            return;
        }

        // 4. Instanciar y ejecutar
        $controller = new $controllerClass();

        // DEBUG: Imprime qué método y clase se buscan
        echo "";

        if (!method_exists($controller, $actionMethod)) {
            // Manejo de error 404: Método no encontrado
            header("HTTP/1.0 404 Not Found");
            echo "Error 404: Acción '{$actionMethod}' no definida en el controlador";
            return;
        }

        // Llama al método del controlador (la acción) y le pasa los parámetros
        call_user_func_array([$controller, $actionMethod], $params);
    }

    private function removeSubdirectory(string $uri): string
    {
        // Limpiamos la URI y quitamos query params
        $uri = parse_url($uri, PHP_URL_PATH);
        
        // Eliminamos explícitamente index.php si está presente
        $uri = str_replace('/index.php', '', $uri);
        $uri = str_replace('index.php', '', $uri);

        // Obtenemos el nombre exacto de la carpeta de la aplicación dinámicamente
        // Ej: 'calculator_scalping'
        $appName = basename(dirname(__DIR__, 2));

        // Buscamos dónde está esa carpeta en la URI y cortamos todo lo que la precede
        $pos = strpos($uri, '/' . $appName . '/');
        if ($pos !== false) {
            $uri = substr($uri, $pos + strlen('/' . $appName . '/'));
        } else {
            // Caso donde la URI termina exactamente en el nombre de la app (ej. /portafolio/calculator_scalping)
            $parts = explode('/' . $appName, $uri);
            $pos = end($parts); // Verificamos si termina
            if (str_ends_with($uri, '/' . $appName)) {
                $uri = ''; // Estamos en la raíz
            } else {
                // Si la URI empieza directamente con el nombre (sin barra inicial)
                $uri = ltrim($uri, '/');
                if (strpos($uri, $appName . '/') === 0) {
                    $uri = substr($uri, strlen($appName . '/'));
                } elseif ($uri === $appName) {
                    $uri = '';
                }
            }
        }
        
        $uri = trim($uri, '/');
        
        if (empty($uri)) {
            return '/';
        }
        
        return $uri;
    }
}
