<?php

// app/Controllers/PrincipalController.php
namespace App\Controllers;

// Al inicio de PrincipalController.php, arriba del namespace
ini_set('error_log', __DIR__ . '/../../debug.log');

// Incluye tu modelo de Brokers
use App\Models\BrokersModel;
use App\Models\OperacionesModel;

error_log('[PrincipalController::INGRESO] >>> INICIO');
class PrincipalController
{

    // Método por defecto: index() - Se ejecuta si la URL es /
    public function index()
    {
        // Instanciamos operaciones model para pasar el historial inicial
        $operacionesModel = new OperacionesModel();
        $historial = $operacionesModel->obtenerTodas();
        error_log('[PrincipalController::solapa1-cargar historial] Params recibidos: ' . print_r($historial, true));
        // Cargar la Vista
        $this->renderView('Principal/index', ['historial' => $historial]);
    }

    /**
     * GET /Principal/Brokers
     * Obtiene todos los brokers y los devuelve en formato JSON
     */
    public function Brokers()
    {

        error_log('[PrincipalController] Ingresó a: Brokers()');
        try {
            // Configura el header para respuesta JSON
            header('Content-Type: application/json; charset=utf-8');

            // Instanciamos el modelo
            $brokersModel = new BrokersModel();
            $brokers = $brokersModel->obtenerTodos();

            error_log('[PrincipalController::solapa1-cargar historial] Params recibidos: ' . print_r($brokers, true));

            // Devuelve SOLO el array de brokers (sin wrapper)
            echo json_encode([
                'success' => true,
                'data' => $brokers
            ]);
            exit; // Importante: detener la ejecución aquí

        } catch (\Exception $e) {
            // Manejo de errores
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Error al obtener los brokers',
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }

    /**
     * POST /Principal/guardarBroker
     * Guarda o actualiza un broker
     */
    public function guardarBroker()
    {
        error_log('[PrincipalController] Ingresó a: guardarBroker()');
        try {
            // Configura el header para respuesta JSON
            header('Content-Type: application/json; charset=utf-8');

            // Verifica que sea una petición POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                echo json_encode([
                    'success' => false,
                    'error' => 'Método no permitido. Use POST.'
                ]);
                exit;
            }

            // Obtiene los datos JSON del body
            $json = file_get_contents('php://input');
            $datos = json_decode($json, true);

            // Log para debug
            error_log('[PrincipalController] guardarBroker() - Datos recibidos: ' . print_r($datos, true));

            // Validación básica
            if (empty($datos['nombreBroker'])) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'error' => 'El nombre del broker es obligatorio'
                ]);
                exit;
            }

            // Sanitiza y valida los datos
            $broker = [
                'nombreBroker' => trim($datos['nombreBroker']),
                'comisionCompra' => floatval($datos['comisionCompra'] ?? 0),
                'derechoMercado' => floatval($datos['derechoMercado'] ?? 0),
                'ivaImpuesto' => floatval($datos['ivaImpuesto'] ?? 0),
                'activo' => isset($datos['activo']) ? intval($datos['activo']) : 1,
                'fec_registro' => date('Y-m-d H:i:s')
            ];

            $brokersModel = new BrokersModel();

            if (isset($datos['id']) && !empty($datos['id'])) {
                // Actualizar
                $broker['id'] = intval($datos['id']);
                $resultado = $brokersModel->actualizar($broker);
                error_log('[PrincipalController] guardarBroker() - Actualizando broker id: ' . $broker['id']);
            } else {
                // Insertar nuevo
                $id = $brokersModel->insertar($broker);
                $broker['id'] = $id;
                error_log('[PrincipalController] guardarBroker() - Insertando nuevo broker, id generado: ' . $id);
            }

            echo json_encode([
                'success' => true,
                'message' => 'Broker guardado exitosamente',
                'data' => $broker
            ]);
            exit;
        } catch (\Exception $e) {
            error_log('[PrincipalController] guardarBroker() - ERROR: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => 'Error al guardar el broker',
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }

    /**
     * POST /Principal/cambiarEstado
     * Cambia el estado (activo/inactivo) de un broker
     */
    public function cambiarEstado()
    {
        error_log('[PrincipalController] Ingresó a: cambiarEstado()');
        try {
            header('Content-Type: application/json; charset=utf-8');

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Método no permitido');
            }

            $json = file_get_contents('php://input');
            $datos = json_decode($json, true);

            if (empty($datos['id']) || !isset($datos['activo'])) {
                throw new \Exception('Datos incompletos');
            }

            $brokersModel = new BrokersModel();
            $resultado = $brokersModel->actualizarEstado($datos['id'], $datos['activo']);

            if ($resultado) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No se pudo actualizar']);
            }
        } catch (\Exception $e) {
            error_log('[PrincipalController] cambiarEstado() - ERROR: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * POST /Principal/guardarTransaccion
     * Guarda una nueva operación en la base de datos
     */
    public function guardarTransaccion()
    {
        error_log('[PrincipalController] Ingresó a: guardarTransaccion()');
        try {
            header('Content-Type: application/json; charset=utf-8');

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Método no permitido');
            }

            $json = file_get_contents('php://input');
            $datos = json_decode($json, true);

            // Log para debug
            error_log('[PrincipalController] guardarTransaccion() - Datos recibidos: ' . print_r($datos, true));

            // Ajuste para acceder a 'transaccion' si viene envuelto
            if (isset($datos['accion']) && $datos['accion'] === 'guardarTransaccion' && isset($datos['transaccion'])) {
                $datos = $datos['transaccion'];
                error_log('[PrincipalController] guardarTransaccion() - Datos desenvueltos de transaccion');
            }

            // Mapeo de datos del frontend a columnas de la base de datos
            $operacion = [
                'tasa_banco' => isset($datos['tna']) ? floatval($datos['tna']) : 0,
                'tn_365' => isset($datos['tnaDiaria365']) ? floatval($datos['tnaDiaria365']) : 0,
                'tn_260' => isset($datos['tnaDiaria260']) ? floatval($datos['tnaDiaria260']) : 0,
                'broker_id' => $datos['broker_id'] ?? $this->obtenerBrokerIdPorNombre($datos['nombreBroker']),
                'nombre_accion' => $datos['nombreAccion'],
                'cantidad_acciones' => $datos['cantidad'],
                'valor_neto_compra' => $datos['valorNeto'],
                'valor_comision_compra' => $datos['comisionCompra'],
                'derecho_mercado_compra' => $datos['derechoMercadoCompra'],
                'iva_compra' => $datos['ivaCompra'],
                'valor_bruto_compra' => $datos['valorBrutoCompra'],
                // Nuevos campos de porcentajes
                'comision_porcentaje' => $datos['comisionPorcentaje'] ?? 0,
                'derecho_mercado_porcentaje' => $datos['derechoMercadoPorcentaje'] ?? 0,
                'iva_porcentaje' => $datos['ivaPorcentaje'] ?? 0,
                'ganancia_proyectada_porcentaje' => $datos['PorcGanProy'] ?? 0,
                'ganancia_neta_por_accion' => $datos['gananciaProyectadaValor'] / (($datos['cantidad'] > 0) ? $datos['cantidad'] : 1),
                'precio_neto_venta' => $datos['precioNetoVenta'],
                'valor_comision_venta' => $datos['comisionVenta'],
                'derecho_mercado_venta' => $datos['derechoMercadoVenta'],
                'iva_venta' => $datos['ivaVenta'],
                'precio_bruto_venta' => $datos['precioBrutoVenta'],
                'ganancia_neta_total' => $datos['gananciaNetaTotal'],
                'fecha_operacion_venta' => date('Y-m-d'),
                'vigente' => 1
            ];

            $operacionesModel = new OperacionesModel();
            $id = $operacionesModel->insertar($operacion);
            error_log('[PrincipalController] guardarTransaccion() - Operación insertada con id: ' . $id);

            echo json_encode([
                'success' => true,
                'message' => 'Operación guardada exitosamente',
                'id' => $id
            ]);
        } catch (\Exception $e) {
            error_log('[PrincipalController] guardarTransaccion() - ERROR: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * GET /Principal/historialOperaciones
     * Obtiene el historial de operaciones actualizado
     */
    public function historialOperaciones()
    {
        error_log('[PrincipalController] Ingresó a: historialOperaciones()');
        try {
            header('Content-Type: application/json; charset=utf-8');

            $operacionesModel = new OperacionesModel();
            $historial = $operacionesModel->obtenerTodas();

            echo json_encode([
                'success' => true,
                'data' => $historial
            ]);
        } catch (\Exception $e) {
            error_log('[PrincipalController] historialOperaciones() - ERROR: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * POST /Principal/cambiarEstadoOperacion
     * Cambia el estado vigente de una operación
     */
    public function cambiarEstadoOperacion()
    {
        error_log('[PrincipalController] Ingresó a: cambiarEstadoOperacion()');
        try {
            header('Content-Type: application/json; charset=utf-8');

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Método no permitido');
            }

            $json = file_get_contents('php://input');
            $datos = json_decode($json, true);

            if (empty($datos['id']) || !isset($datos['vigente'])) {
                throw new \Exception('Datos incompletos');
            }

            $operacionesModel = new OperacionesModel();
            $resultado = $operacionesModel->actualizarEstado($datos['id'], $datos['vigente']);

            if ($resultado) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No se pudo actualizar']);
            }
        } catch (\Exception $e) {
            error_log('[PrincipalController] cambiarEstadoOperacion() - ERROR: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * POST /Principal/eliminarOperacion
     * Elimina una operación de la BD
     */
    public function eliminarOperacion()
    {
        error_log('[PrincipalController] Ingresó a: eliminarOperacion()');
        try {
            header('Content-Type: application/json; charset=utf-8');

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                throw new \Exception('Método no permitido');
            }

            $json = file_get_contents('php://input');
            $datos = json_decode($json, true);

            if (empty($datos['id'])) {
                throw new \Exception('ID requerido');
            }

            $operacionesModel = new OperacionesModel();
            $resultado = $operacionesModel->eliminar($datos['id']);

            if ($resultado) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'No se pudo eliminar']);
            }
        } catch (\Exception $e) {
            error_log('[PrincipalController] eliminarOperacion() - ERROR: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // Auxiliar para buscar ID de broker por nombre
    private function obtenerBrokerIdPorNombre($nombreBroker)
    {
        error_log('[PrincipalController] Ingresó a: obtenerBrokerIdPorNombre() - Buscando: ' . $nombreBroker);
        $brokersModel = new BrokersModel();
        $todos = $brokersModel->obtenerTodos();
        foreach ($todos as $b) {
            if ($b['nombreBroker'] === $nombreBroker) {
                return $b['id'];
            }
        }
        return null;
    }

    protected function renderView(string $viewPath, array $data = [])
    {
        error_log('[PrincipalController] Ingresó a: renderView() - Vista: ' . $viewPath);
        // Extrae los datos del array como variables individuales
        extract($data);

        // Construye la ruta completa del archivo de vista
        $viewFile = APP_PATH . '/Views/' . $viewPath . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            http_response_code(404);
            echo "Error: Archivo de vista '{$viewFile}' no encontrado.";
        }
    }
}
