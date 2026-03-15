<?php
// Definir base url para usar en el javascript
$baseUrl = '/calculator_scalping';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Trading / Scalping -> Acciones y CEDEARs</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h4>Calculadora de Trading - Acciones y CEDEARS</h4>
        </div>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#solapa1">📋 Historial de Operaciones</a></li>
            <li><a data-toggle="tab" href="#solapa2">📈 Calculos de Operaciones</a></li>
            <li><a data-toggle="tab" href="#solapa3"> 📈 Datos de Brokers</a></li>
            <li><a data-toggle="tab" href="#solapa4"> 📈 Ayuda</a></li>
        </ul>

        <div class="tab-content">
            <div id="solapa1" class="tab-pane active">
                <div class="section">
                    <div class="section-header">
                        <h4>📋 Historial de Operaciones Abiertas - Cerradas</h4>
                    </div>
                    <div class="section-content">
                        <div id="transaccionesContainer">
                            <p style="text-align: center; color: #6c757d; padding: 20px;">
                                No hay transacciones guardadas. Realiza tu primera operación arriba.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="solapa2" class="tab-pane">
                <div class="section">
                    <div class="section-header">
                        <h4>📈 Datos de Comparación: Brokers, Porcentajes, Proyección, Punto Equilibrio, Bruto Compra,
                            Bruto Venta
                        </h4>
                    </div>
                    <div class="section-content">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="tnaBancaria">TNA Bancaria / Billeteras virtuales (%) HOY</label>
                                <input type="number" id="tnaBancaria" value=" " step="0.001"
                                    oninput="calcularTNA(); calcularCoeficienteBase()">
                            </div>
                            <div class="info-card">
                                <label for="tnaDiaria365">TNA Diaria (365 días)</label>
                                <div class="value" id="tnaDiaria365">0.000000%</div>
                            </div>
                            <div class="info-card">
                                <label for="tnaDiaria260">TNA Diaria (260 días)</label>
                                <div class="value" id="tnaDiaria260">0.000000%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div class="section-header">
                        <h4>📝 Configuración de Operación</h4>
                    </div>
                    <div class="section-content">
                        <form id="brokerConfigForm">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nombreBroker">Seleccione del Broker</label>
                                    <select id="selectBrokerOperacion" class="form-control"
                                        onchange="actualizarDatosBroker()" required>
                                        <option value="" disabled selected>Seleccione un Broker</option>
                                    </select>
                                    <input type="hidden" id="nombreBrokerHidden" value="">
                                </div>
                                <div class="form-group">
                                    <label for="calc_comisionCompra">Comisión sobre Compra (%)</label>
                                    <input type="number" id="calc_comisionCompra" value="0.0" step="0.001"
                                        oninput="calcularCoeficienteBase()">
                                </div>
                                <div class="form-group">
                                    <label for="calc_derechoMercado">Derecho a Mercado (%)</label>
                                    <input type="number" id="calc_derechoMercado" value="0.0" step="0.001"
                                        oninput="calcularCoeficienteBase()">
                                </div>
                                <div class="form-group">
                                    <label for="calc_ivaImpuesto">IVA (%)</label>
                                    <input type="number" id="calc_ivaImpuesto" value="0" step="0.01"
                                        oninput="calcularCoeficienteBase()">
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nombreAccion">Nombre / Sigla de la Acción</label>
                                    <input type="text" id="nombreAccion" placeholder="AAPL, etc." required>
                                </div>
                                <div class="form-group">
                                    <label for="valorNeto">Valor Neto (precio por acción)</label>
                                    <input type="number" id="valorNeto" step="0.01" oninput="calcularCoeficienteBase()">
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <p>Suma porcentual total de tasas de compra</p>
                                    <label for="ganciaProyectada">Coef Base Compra (%)</label>
                                    <div class="value" id="coeficienteBase">0.000000%</div>
                                </div>
                                <div class="form-group">
                                    <p>Valor tasa de equilibrio entre compra y venta
                                        a aplicar para recuperar misma inversión luego de pagar todos los aranceles</p>
                                    <label for="ganciaProyectada">Punto Equilibrio (%)</label>
                                    <div class="value" id="puntoEquilibrio">0.000000%</div>
                                </div>
                                <div class="form-group">
                                    <p>Valor tasa para no perder contra tasa bancos x 365 días</p>
                                    <label for="ganciaProyectada">TNA 365 + P.Equilibrio (%)</label>
                                    <div class="value" id="tna365pe">0.000000%</div>
                                </div>
                                <div class="form-group">
                                    <p>Valor tasa para no perder contra tasa bancos x 260 días</p>
                                    <label for="ganciaProyectada">TNA 260 + P.Equilibrio (%)</label>
                                    <div class="value" id="tna260pe">0.000000%</div>
                                </div>

                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="vbcompra">Valor Bruto (precio por acción) ($)</label>
                                    <div class="value" id="vbcompra">0.000000%</div>
                                </div>
                                <div class="form-group">
                                    <label for="precioBrutoVenta">Precio Punto Equilibrio ($)</label>
                                    <div class="value" id="precioPuntoEquilibrio">0.000000%</div>
                                </div>
                                <div class="form-group">
                                    <label for="pbvtna365">Prec.Bruto Venta | P.E. + TNA365 ($)</label>
                                    <div class="value" id="pbvtna365">0.000000%</div>
                                </div>
                                <div class="form-group">
                                    <label for="pbvtna260">Prec.Bruto Venta | P.E. + TNA260 ($)</label>
                                    <div class="value" id="pbvtna260">0.000000%</div>
                                </div>
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="PorcGanProy">Proyección Ganancia (%)</label>
                                    <input type="number" id="PorcGanProy" value="0" step="0.000001"
                                        oninput="calcularCoeficienteBase(true)">
                                </div>
                                <div class="form-group">
                                    <label for="vbventa">Valor bruto venta ($)</label>
                                    <div class="value" id="vbventa">0.000000%</div>
                                </div>
                                <div class="form-group">
                                    <label for="cantidadAcciones">Cantidad de Acciones</label>
                                    <input type="number" id="cantidadAcciones" value="1" min="1"
                                        oninput="calcularOperacion()">
                                </div>
                            </div>
                        </form>

                        <div style="margin-top: 20px; text-align: center;">
                            <button type="button" class="btn btn-success" onclick="cargarPrevisualizacion()">
                                💾 Cargar Pre Visualización
                            </button>
                            <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">
                                🔄 Calcular Nueva Operación
                            </button>
                        </div>


                        <div class="table-container" id="contenedorPrevisualizacion" style="display: none;">
                            <table class="calculation-table">
                                <thead>
                                    <tr>
                                        <th>Concepto</th>
                                        <th>Valor por Acción</th>
                                        <th>Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>COMPRA</strong></td>
                                        <td colspan="2" style="background: #f8f9fa; font-weight: bold;"></td>
                                    </tr>
                                    <tr>
                                        <td>Valor Neto</td>
                                        <td><input type="text" id="valorNetoDisplay" class="readonly" readonly></td>
                                        <td><input type="text" id="valorNetoTotal" class="readonly" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Comisión Compra</td>
                                        <td><input type="text" id="comisionCompraDisplay" class="readonly" readonly>
                                        </td>
                                        <td><input type="text" id="comisionCompraTotal" class="readonly" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Derecho Mercado</td>
                                        <td><input type="text" id="derechoMercadoDisplay" class="readonly" readonly>
                                        </td>
                                        <td><input type="text" id="derechoMercadoTotal" class="readonly" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>IVA</td>
                                        <td><input type="text" id="ivaCompraDisplay" class="readonly" readonly></td>
                                        <td><input type="text" id="ivaCompraTotal" class="readonly" readonly></td>
                                    </tr>
                                    <tr style="background: #e8f4fd;">
                                        <td><strong>Valor Bruto Compra</strong></td>
                                        <td><input type="text" id="valorBrutoCompra" class="readonly" readonly
                                                style="font-weight: bold;"></td>
                                        <td><input type="text" id="valorBrutoCompraTotal" class="readonly" readonly
                                                style="font-weight: bold;"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>VENTA</strong></td>
                                        <td colspan="2" style="background: #f8f9fa; font-weight: bold;"></td>
                                    </tr>
                                    <tr>
                                        <td>Ganancia Proyectada</td>
                                        <td><input type="text" id="gananciaProyectadaDisplay" class="readonly" readonly>
                                        </td>
                                        <td><input type="text" id="gananciaProyectadaTotal" class="readonly" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Precio Neto Venta</td>
                                        <td><input type="text" id="precioNetoVenta" class="readonly" readonly></td>
                                        <td><input type="text" id="precioNetoVentaTotal" class="readonly" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Comisión Venta</td>
                                        <td><input type="text" id="comisionVentaDisplay" class="readonly" readonly></td>
                                        <td><input type="text" id="comisionVentaTotal" class="readonly" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Derecho Mercado Venta</td>
                                        <td><input type="text" id="derechoMercadoVentaDisplay" class="readonly"
                                                readonly>
                                        </td>
                                        <td><input type="text" id="derechoMercadoVentaTotal" class="readonly" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>IVA Venta</td>
                                        <td><input type="text" id="ivaVentaDisplay" class="readonly" readonly></td>
                                        <td><input type="text" id="ivaVentaTotal" class="readonly" readonly></td>
                                    </tr>
                                    <tr style="background: #e8f5e8;">
                                        <td><strong>Precio Bruto Venta</strong></td>
                                        <td><input type="text" id="precioBrutoVenta" class="readonly" readonly
                                                style="font-weight: bold;"></td>
                                        <td><input type="text" id="precioBrutoVentaTotal" class="readonly" readonly
                                                style="font-weight: bold;"></td>
                                    </tr>
                                    <tr style="background: #fff3cd;">
                                        <td><strong>Ganancia Neta Total</strong></td>
                                        <td><input type="text" id="gananciaNeta" class="readonly" readonly
                                                style="font-weight: bold;">
                                        </td>
                                        <td><input type="text" id="gananciaNetaTotal" class="readonly" readonly
                                                style="font-weight: bold;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>


                            <div id="botonesOperacion" style="margin-top: 20px; text-align: center; display: none;">
                                <button type="button" class="btn btn-success" onclick="guardarTransaccion()">
                                    💾 Guardar Operación
                                </button>
                                <button type="button" class="btn btn-warning" onclick="limpiarFormulario()">
                                    🔄 Limpiar Pre Visualización
                                </button>
                            </div>
                        </div>
                        <br>
                    </div> <!-- Cierre section-content -->
                </div> <!-- Cierre section -->


            </div>

            <div id="solapa3" class="tab-pane">
                <div class="section">
                    <div class="section-header">
                        <h4>📈 Datos de Brokers - Aranceles - Comisiones - Impuestos</h4>
                    </div>
                    <div class="section-content">
                        <div class="form-grid">
                            <div class="form-group">
                                <input type="hidden" id="brokerId" value="">
                                <label for="nombreBroker">Nombre del Broker</label>
                                <input type="text" id="nombreBroker" value="" placeholder="Ej. Bull Market" required>
                            </div>
                            <div class="form-group">
                                <label for="comisionCompra">Comisión sobre Movimiento (%)</label>
                                <input type="number" id="comisionCompra" value="0.00" step="0.001" oninput="">
                            </div>
                            <div class="form-group">
                                <label for="derechoMercado">Derecho a Mercado (%)</label>
                                <input type="number" id="derechoMercado" value="0.00" step="0.001" oninput="">
                            </div>
                            <div class="form-group">
                                <label for="ivaImpuesto">IVA (%)</label>
                                <input type="number" id="ivaImpuesto" value="0" step="0.01" oninput="">
                            </div>
                        </div>

                        <div style="margin-top: 20px; text-align: center;">
                            <button type="button" class="btn btn-success" onclick="guardarBroker()">
                                💾 Guardar Broker
                            </button>
                            <button type="button" class="btn btn-warning" onclick="nuevoBroker()">
                                🔄 Nuevo Broker
                            </button>
                        </div>
                        <br>
                    </div>
                </div>

                <br>

                <div class="section">
                    <div class="section-header">
                        📋 Historial de Brokers y Comisiones
                    </div>
                    <div class="section-content">
                        <div id="brokersContainer">
                            <p style="text-align: center; color: #6c757d; padding: 20px;">
                                No hay brokers guardados. Realiza tu primera carga de Broker.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="solapa4" class="tab-pane">
                <div class="section">
                    <div class="section-header">
                        📋 Ayuda
                    </div>
                    <div class="section-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                            📋 Solapa 1: Historial de Operaciones
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <p>En esta sección se centraliza el <strong>registro histórico y activo de sus transacciones</strong>. Es su bitácora de vuelo para el scalping.</p>
                                        <ul>
                                            <li><strong>Registro de Entrada:</strong> Guarda automáticamente los parámetros exactos con los que inició cada operación (Precio, Cantidad, Comisiones vigentes, TNA de referencia).</li>
                                            <li><strong>Evolución y Control:</strong> Permite comparar el rendimiento real de la operación frente a las proyecciones iniciales.</li>
                                            <li><strong>Análisis de Costo de Oportunidad:</strong> Cada registro mantiene el dato de la TNA (Tasa Nominal Anual) del momento, permitiéndole evaluar si su estrategia de scalping superó o no el rendimiento pasivo.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                            📈 Solapa 2: Cálculos de Operaciones
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Este es el <strong>panel principal de toma de decisiones</strong>. Aquí se procesa la lógica financiera para determinar la viabilidad de un trade.</p>
                                        
                                        <h4>🔧 Funcionalidades Clave:</h4>
                                        <ul>
                                            <li><strong>Cálculo de Punto de Equilibrio (Break-Even):</strong> El sistema calcula cuánto debe subir la acción solo para cubrir comisiones e impuestos. <em>Si vende por debajo de este valor, pierde dinero.</em></li>
                                            <li><strong>Comparativa de Costo de Oportunidad (TNA):</strong> Integra la TNA de neobancos para calcular cuánto debería rendir su operación para "empatar" con el rendimiento pasivo.
                                                <ul>
                                                    <li><strong>TNA 365:</strong> Comparativa anualizada estándar.</li>
                                                    <li><strong>TNA 260:</strong> Comparativa sobre días hábiles operativos.</li>
                                                </ul>
                                            </li>
                                        </ul>

                                        <h4>⚠️ Sistema de Alertas Inteligentes:</h4>
                                        <p>Al proyectar su ganancia, el sistema le avisará sobre la calidad del trade:</p>
                                        <ul class="list-group">
                                            <li class="list-group-item list-group-item-danger"><strong>🔴 ALERTA CRÍTICA:</strong> Proyección inferior a costos. <strong>No rentable.</strong></li>
                                            <li class="list-group-item list-group-item-warning"><strong>🟡 ALERTA MEDIA:</strong> Ganancia inferior al rendimiento pasivo (TNA). <strong>Riesgo innecesario.</strong></li>
                                            <li class="list-group-item list-group-item-success"><strong>🟢 ÓPTIMA:</strong> Supera costos y referencia pasiva. <strong>Luz verde.</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                            🏢 Solapa 3: Datos de Brokers
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>El scalping depende de los márgenes finos. Aquí se configuran los <strong>Estructuras de Costos</strong> de cada broker.</p>
                                        <ul>
                                            <li><strong>Impacto Directo:</strong> Un broker con comisiones altas puede hacer inviable una estrategia de scalping.</li>
                                            <li><strong>Configuración:</strong> Debe cargar con precisión la Comisión (%), Derechos de Mercado (%) e IVA.</li>
                                            <li><strong>Automatización:</strong> Al seleccionar un broker en la Solapa 2, el sistema "importa" automáticamente estos costos para recalcular todos los puntos de equilibrio y alertas al instante.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        // Variables globales
        let transacciones = JSON.parse(localStorage.getItem('transacciones')) || [];
        let configuracion = JSON.parse(localStorage.getItem('configuracion')) || {
            tna: 0.0,
            tnaDiaria260: 0.0,
            tnaDiaria365: 0.0,
            nombreBroker: '',
            comisionCompra: 0.0,
            mercadoCompra: 0.0,
            ivaCompra: 0.0,
            tna: 0.0,
            tnaDiaria260: 0.0,
            tnaDiaria365: 0.0,
            gananciaProyectada: 0.0,
            valorNetoCompra: 0.0,
            PorcGanProy: 0.0,
            ivaBaseCompra: 0.0,
            coeficienteBase: 0.0,
            puntoEquilibrioCalc: 0.0,
            precioBrutoVenta: 0.0,
            tna365pe: 0.0,
            tna260pe: 0.0,
            pbvtna365: 0.0,
            pbvtna260: 0.0,
            pbcompra: 0.0,
            pbventa: 0.0
        };

        // Función para mostrar alertas
        function mostrarAlerta(mensaje, tipo) {
            // Puedes usar un alert simple o una implementación más sofisticada
            // Por simplicidad y compatibilidad rápida:
            if (tipo === 'error') {
                alert('❌ ' + mensaje);
            } else {
                alert('✅ ' + mensaje);
            }
        }

        function calcularTNA() {
            // Obtiene el valor del elemento HTML con id 'tnaBancaria', lo convierte a número decimal
            // Si el valor está vacío o no es válido, usa 0 como valor por defecto
            configuracion.tna = parseFloat(document.getElementById('tnaBancaria').value) || 0;

            // Calcula la TNA diaria dividiendo por 365 días del año calendario
            // toFixed(6) redondea el resultado a 6 decimales para mayor precisión
            configuracion.tnaDiaria365 = (configuracion.tna / 365).toFixed(6); // 365 días del año

            // Calcula la TNA diaria dividiendo por 260 días hábiles aproximados por año
            // (excluyendo fines de semana y feriados bancarios)
            // toFixed(6) redondea el resultado a 6 decimales para mayor precisión
            configuracion.tnaDiaria260 = (configuracion.tna / 260).toFixed(6); // 260 días hábiles aproximados por año

            // Actualiza el contenido del elemento HTML con id 'tnaDiaria365'
            // Muestra el resultado con el símbolo de porcentaje
            document.getElementById('tnaDiaria365').textContent = configuracion.tnaDiaria365 + '%';

            // Actualiza el contenido del elemento HTML con id 'tnaDiariaHabiles'
            // Muestra el resultado con el símbolo de porcentaje
            document.getElementById('tnaDiaria260').textContent = configuracion.tnaDiaria260 + '%';

            // Retornar los valores para uso en otras funciones
            return {
                tna: configuracion.tna,
                tnaDiaria365: parseFloat(configuracion.tnaDiaria365),
                tnaDiaria260: parseFloat(configuracion.tnaDiaria260)
            };

        }

        function calcularCoeficienteBase(mostrarAlerta = false) {

            configuracion.comisionCompra = parseFloat(document.getElementById('calc_comisionCompra').value);
            configuracion.mercadoCompra = parseFloat(document.getElementById('calc_derechoMercado').value);
            configuracion.ivaCompra = parseFloat(document.getElementById('calc_ivaImpuesto').value);
            configuracion.valorNetoCompra = parseFloat(document.getElementById('valorNeto').value) || 0;
            configuracion.tna = parseFloat(document.getElementById('tnaBancaria').value);
            configuracion.PorcGanProy = parseFloat(document.getElementById('PorcGanProy').value);


            configuracion.ivaBaseCompra = ((((configuracion.comisionCompra / 100) + (configuracion.mercadoCompra / 100)) * (configuracion.ivaCompra / 100))) * 100;
            //suma porcentual total de tasas de compra
            configuracion.coeficienteBase = configuracion.comisionCompra + configuracion.mercadoCompra + configuracion.ivaBaseCompra;
            //coeficiente multiplicador para aplicar las tasas del coeficiente base
            const costoTotal = configuracion.coeficienteBase / 100;
            //valor tasa de equilibrio entre compra y venta aplicado para recuperar misma inversión luego de pagar todos los aranceles
            configuracion.puntoEquilibrioCalc = (((1 + costoTotal) / (1 - costoTotal)) - 1) * 100;
            //valor bruto de venta luego de aplicar coeficiente de punto de equilibrio
            configuracion.precioBrutoVenta = configuracion.valorNetoCompra * ((1 + costoTotal) / (1 - costoTotal));
            //tasa de 365 mas P.E.
            configuracion.tna365pe = (configuracion.tna / 365) + configuracion.puntoEquilibrioCalc;
            //tasa de 260 mas P.E.
            configuracion.tna260pe = (configuracion.tna / 260) + configuracion.puntoEquilibrioCalc;
            //Precio bruto venta obtenido con tna 365 + PE
            configuracion.pbvtna365 = configuracion.valorNetoCompra * (1 + (configuracion.tna365pe / 100));
            //precio bruto venta obtenido con tna 260 + PE
            configuracion.pbvtna260 = configuracion.valorNetoCompra * (1 + (configuracion.tna260pe / 100));
            //precio bruto compra obtenido 
            configuracion.pbcompra = configuracion.valorNetoCompra * (1 + (configuracion.coeficienteBase / 100));
            //precio bruto venta aplicando el porcentaje de ganancia que coloca el operador
            configuracion.pbventa = configuracion.valorNetoCompra * (1 + (configuracion.PorcGanProy / 100));

            // Aplica .toFixed() solo al mostrar
            // Aplica .toFixed() solo al mostrar
            document.getElementById('coeficienteBase').textContent = configuracion.coeficienteBase.toFixed(8) + '%';
            document.getElementById('puntoEquilibrio').textContent = configuracion.puntoEquilibrioCalc.toFixed(8) + '%';
            document.getElementById('tna365pe').textContent = configuracion.tna365pe.toFixed(8) + '%';
            document.getElementById('tna260pe').textContent = configuracion.tna260pe.toFixed(8) + '%';

            // Corrección de IDs y Variables para Sección Compra/Venta
            // Valor Bruto (precio por acción) ($) -> ID vbcompra
            document.getElementById('vbcompra').textContent = configuracion.pbcompra.toFixed(6);

            // Precio Punto Equilibrio ($) -> ID precioPuntoEquilibrio (renombrado para evitar duplicado)
            // Utiliza la logica de precioBrutoVenta (Calculo de PE)
            document.getElementById('precioPuntoEquilibrio').textContent = configuracion.precioBrutoVenta.toFixed(6);

            document.getElementById('pbvtna365').textContent = configuracion.pbvtna365.toFixed(6);
            document.getElementById('pbvtna260').textContent = configuracion.pbvtna260.toFixed(6);

            // Valor bruto venta ($) -> ID vbventa
            // Utiliza configuracion.pbventa (Precio Bruto Venta con Ganancia)
            document.getElementById('vbventa').textContent = configuracion.pbventa.toFixed(6);

            // CONDICIONAL CORREGIDO - Mostrar alerta si se especifica y hay un valor en PorcGanProy
            if (mostrarAlerta && !isNaN(configuracion.PorcGanProy)) {
                let mensaje = "";

                // Orden correcto: de menor a mayor comparación (más específico primero)
                if (configuracion.PorcGanProy < configuracion.coeficienteBase) {
                    mensaje = "⚠️ ALERTA BAJA: La proyección (" + configuracion.PorcGanProy.toFixed(8) + "%) es menor al coeficiente base (" + configuracion.coeficienteBase.toFixed(8) + "%)";
                } else if (configuracion.PorcGanProy < configuracion.puntoEquilibrioCalc && configuracion.PorcGanProy > configuracion.coeficienteBase) {
                    mensaje = "⚠️ ALERTA MEDIA: La proyección (" + configuracion.PorcGanProy.toFixed(8) + "%) es menor al punto de equilibrio calculado (" + configuracion.puntoEquilibrioCalc.toFixed(8) + "%)";
                } else if (configuracion.PorcGanProy < configuracion.tna365pe && configuracion.PorcGanProy > configuracion.puntoEquilibrioCalc) {
                    mensaje = "⚠️ ALERTA ALTA: La proyección (" + configuracion.PorcGanProy.toFixed(8) + "%) es menor a punto de equilibrio más la TNA de las billeteras 365 días (" + configuracion.tna365pe.toFixed(8) + "%)";
                } else if (configuracion.PorcGanProy < configuracion.tna260pe && configuracion.PorcGanProy > configuracion.tna365pe) {
                    mensaje = "⚠️ ALERTA CRÍTICA: La proyección (" + configuracion.PorcGanProy.toFixed(8) + "%) es menor a punto de equilibrio más la TNA de las billeteras 260 días (" + configuracion.tna260pe.toFixed(8) + "%)";
                } else {
                    mensaje = "✅ PROYECCIÓN ÓPTIMA: La proyección (" + configuracion.PorcGanProy.toFixed(8) + "%) está por encima de todos los parámetros de referencia";
                }

                // Mostrar alerta inmediata
                alert(mensaje);
            }

            return {
                coeficienteBase: configuracion.coeficienteBase,
                puntoEquilibrio: configuracion.puntoEquilibrioCalc,
                tna365pe: configuracion.tna365pe,
                tna260pe: configuracion.tna260pe,
                precioBrutoVenta: configuracion.precioBrutoVenta,
                pbvtna365: configuracion.pbvtna365,
                pbvtna260: configuracion.pbvtna260,
                vbcompra: configuracion.vbcompra,
                vbventa: configuracion.vbventa
            };

            // Función específica para cuando se cambia PorcGanProy
            function onPorcGanProyChange() {
                calcularCoeficienteBase(true);
            }
        }

        function calcularOperacion() {
            const cantidad = parseInt(document.getElementById('cantidadAcciones').value) || 0;
            const valorNeto = parseFloat(document.getElementById('valorNeto').value) || 0;
            const PorcGanProy = parseFloat(document.getElementById('PorcGanProy').value) || 0;
            // Cálculos de compra
            const comisionCompra = valorNeto * (configuracion.comisionCompra / 100);
            const derechoMercadoCompra = valorNeto * (configuracion.mercadoCompra / 100);
            const ivaCompra = (comisionCompra + derechoMercadoCompra) * (configuracion.ivaCompra / 100);
            const valorBrutoCompra = valorNeto + comisionCompra + derechoMercadoCompra + ivaCompra;

            // Imprimir cada variable individualmente
            console.log('Cantidad:', cantidad);
            console.log('Valor Neto:', valorNeto);
            console.log('Porcentaje Ganancia Proyectada:', PorcGanProy);
            console.log('Comision compra:', comisionCompra);
            console.log('Derecho mercado compra:', derechoMercadoCompra);
            console.log('Iva compra:', ivaCompra);

            if (valorNeto <= 0 || cantidad <= 0) {
                limpiarCalculos();
                return;
            }


            // Cálculos de venta
            const gananciaProyectadaValor = valorBrutoCompra * (PorcGanProy / 100);
            const precioNetoVenta = valorBrutoCompra + gananciaProyectadaValor;
            const comisionVenta = precioNetoVenta * (configuracion.comisionCompra / 100);
            const derechoMercadoVenta = precioNetoVenta * (configuracion.mercadoCompra / 100);
            const ivaVenta = (comisionVenta + derechoMercadoVenta) * (configuracion.ivaCompra / 100);
            const precioBrutoVenta = precioNetoVenta + comisionVenta + derechoMercadoVenta + ivaVenta;

            // Ganancia neta
            const gananciaNeta = gananciaProyectadaValor;

            // Mostrar valores por acción
            document.getElementById('valorNetoDisplay').value = formatearMoneda(valorNeto);
            document.getElementById('comisionCompraDisplay').value = formatearMoneda(comisionCompra);
            document.getElementById('derechoMercadoDisplay').value = formatearMoneda(derechoMercadoCompra);
            document.getElementById('ivaCompraDisplay').value = formatearMoneda(ivaCompra);
            document.getElementById('valorBrutoCompra').value = formatearMoneda(valorBrutoCompra);
            document.getElementById('gananciaProyectadaDisplay').value = formatearMoneda(gananciaProyectadaValor);
            document.getElementById('precioNetoVenta').value = formatearMoneda(precioNetoVenta);
            document.getElementById('comisionVentaDisplay').value = formatearMoneda(comisionVenta);
            document.getElementById('derechoMercadoVentaDisplay').value = formatearMoneda(derechoMercadoVenta);
            document.getElementById('ivaVentaDisplay').value = formatearMoneda(ivaVenta);
            document.getElementById('precioBrutoVenta').value = formatearMoneda(precioBrutoVenta);
            document.getElementById('gananciaNeta').value = formatearMoneda(gananciaNeta);

            // Mostrar valores totales
            document.getElementById('valorNetoTotal').value = formatearMoneda(valorNeto * cantidad);
            document.getElementById('comisionCompraTotal').value = formatearMoneda(comisionCompra * cantidad);
            document.getElementById('derechoMercadoTotal').value = formatearMoneda(derechoMercadoCompra * cantidad);
            document.getElementById('ivaCompraTotal').value = formatearMoneda(ivaCompra * cantidad);
            document.getElementById('valorBrutoCompraTotal').value = formatearMoneda(valorBrutoCompra * cantidad);

            document.getElementById('gananciaProyectadaTotal').value = formatearMoneda(gananciaProyectadaValor * cantidad);
            document.getElementById('precioNetoVentaTotal').value = formatearMoneda(precioNetoVenta * cantidad);
            document.getElementById('comisionVentaTotal').value = formatearMoneda(comisionVenta * cantidad);
            document.getElementById('derechoMercadoVentaTotal').value = formatearMoneda(derechoMercadoVenta * cantidad);
            document.getElementById('ivaVentaTotal').value = formatearMoneda(ivaVenta * cantidad);
            document.getElementById('precioBrutoVentaTotal').value = formatearMoneda(precioBrutoVenta * cantidad);
            document.getElementById('gananciaNetaTotal').value = formatearMoneda(gananciaNeta * cantidad);
        }

        function formatearMoneda(valor) {
            return new Intl.NumberFormat('es-AR', {
                style: 'currency',
                currency: 'ARS',
                minimumFractionDigits: 2,
                maximumFractionDigits: 6
            }).format(valor);
        }

        function limpiarCalculos() {
            // No tocamos tnaBancaria
            const ids = [
                'coeficienteBase', 'puntoEquilibrio', 'tna365pe', 'tna260pe',
                'vbcompra', 'precioPuntoEquilibrio', 'pbvtna365', 'pbvtna260', 'vbventa'
            ];
            ids.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = (id.includes('vbcompra') || id.includes('precio') || id.includes('pbv') || id.includes('vbventa')) ? '$0.000000' : '0.000000%';
            });
            // Limpiar inputs de la tabla
            const tableInputs = document.querySelectorAll('#contenedorPrevisualizacion input');
            tableInputs.forEach(input => input.value = '');
        }

        function guardarTransaccion() {

            const nombreAccion = document.getElementById('nombreAccion').value;
            const cantidad = parseInt(document.getElementById('cantidadAcciones').value) || 0;
            const valorNeto = parseFloat(document.getElementById('valorNeto').value) || 0;
            const selectBroker = document.getElementById('selectBrokerOperacion');

            if (!nombreAccion || cantidad <= 0 || valorNeto <= 0) {
                mostrarAlerta('Por favor complete todos los campos requeridos', 'error');
                return;
            }

            // Obtener valores calculados de la tabla
            const valorBrutoCompraTotal = parseFloat(document.getElementById('valorBrutoCompraTotal').value.replace(/[^\d.-]/g, '')) || 0;
            const gananciaNetaTotal = parseFloat(document.getElementById('gananciaNetaTotal').value.replace(/[^\d.-]/g, '')) || 0;
            const gananciaProyectada = parseFloat(document.getElementById('PorcGanProy').value) || 0;
            // Cálculos de compra
            const comisionCompra = valorNeto * (configuracion.comisionCompra / 100);
            const derechoMercadoCompra = valorNeto * (configuracion.mercadoCompra / 100);
            const ivaCompra = (comisionCompra + derechoMercadoCompra) * (configuracion.ivaCompra / 100);
            const valorBrutoCompra = valorNeto + comisionCompra + derechoMercadoCompra + ivaCompra;



            // Cálculos de venta
            const gananciaProyectadaValor = valorBrutoCompra * (gananciaProyectada / 100);
            const precioNetoVenta = valorBrutoCompra + gananciaProyectadaValor;
            const comisionVenta = precioNetoVenta * (configuracion.comisionCompra / 100);
            const derechoMercadoVenta = precioNetoVenta * (configuracion.mercadoCompra / 100);
            const ivaVenta = (comisionVenta + derechoMercadoVenta) * (configuracion.ivaCompra / 100);
            const precioBrutoVenta = precioNetoVenta + comisionVenta + derechoMercadoVenta + ivaVenta;
            const gananciaNetaTotalCalculada = gananciaProyectadaValor * cantidad;

            // Crear objeto transacción
            const transaccion = {
                //datos de identificación de la transacción
                id: Date.now(),
                fecha: new Date().toLocaleDateString('es-AR'),
                hora: new Date().toLocaleTimeString('es-AR'),
                // TNA y Tasas
                tna: configuracion.tna || 0,
                tnaDiaria365: configuracion.tnaDiaria365 || 0,
                tnaDiaria260: configuracion.tnaDiaria260 || 0,
                // PORCENTAJES DE CONFIGURACIÓN (desde HTML) // datos de plataforma o broker
                'broker_id': selectBroker.value,
                'nombreBroker': selectBroker.options[selectBroker.selectedIndex].text,
                'broker': configuracion.nombreBroker,
                comisionPorcentaje: parseFloat(document.getElementById('calc_comisionCompra').value), // % de comisión
                derechoMercadoPorcentaje: parseFloat(document.getElementById('calc_derechoMercado').value), // % derecho mercado
                ivaPorcentaje: parseFloat(document.getElementById('calc_ivaImpuesto').value), // % IVA
                PorcGanProy: parseFloat(document.getElementById('PorcGanProy').value) || 0, // % Ganancia Proyectada
                // VALORES MONETARIOS CALCULADOS DE COMPRA
                nombreAccion: nombreAccion,
                cantidad: cantidad,
                valorNeto: valorNeto,
                comisionCompra: comisionCompra, // Valor en dinero
                derechoMercadoCompra: derechoMercadoCompra, // Valor en dinero
                ivaCompra: ivaCompra, // Valor en dinero
                valorBrutoCompra: valorBrutoCompra, // Valor en dinero                
                valorBrutoCompraTotal: valorBrutoCompra * cantidad,
                // VALORES MONETARIOS CALCULADOS DE VENTA
                gananciaProyectadaPorcentaje: parseFloat(document.getElementById('PorcGanProy').value), // % ganancia
                gananciaProyectadaValor: gananciaProyectadaValor, // Valor en dinero
                precioNetoVenta: precioNetoVenta,
                comisionVenta: comisionVenta,
                derechoMercadoVenta: derechoMercadoVenta,
                ivaVenta: ivaVenta,
                precioBrutoVenta: precioBrutoVenta,
                gananciaNetaTotal: gananciaNetaTotalCalculada,
            };

            //console.table(transaccion);

            // Agregar a la lista de transacciones
            transacciones.unshift(transaccion); // unshift para agregar al principio

            // Enviar al servidor
            fetch('<?php echo $baseUrl; ?>/Principal/guardarTransaccion', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    accion: 'guardarTransaccion',
                    transaccion: transaccion
                })
            })
                .then(response => response.text())
                .then(text => {
                    console.log("Server response:", text);
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        throw new Error("Respuesta del servidor no válida: " + text.substring(0, 100));
                    }
                })
                .then(data => {
                    if (data.success) {
                        mostrarAlerta('Transacción guardada exitosamente', 'success');

                        // Actualizar el historial desde el servidor
                        obtenerHistorialDesdeServidor();

                        // Limpiar previsualización (ocultar)
                        document.getElementById('contenedorPrevisualizacion').style.display = 'none';
                        document.getElementById('botonesOperacion').style.display = 'none';
                        // Opcional: Limpiar formulario para nueva carga inmediata?
                        // El usuario dijo "Además se debe limpiar la previsualización", no dijo limpiar el formulario.
                        // Pero "calcular nueva operación" limpia el formulario. "guardar operación" guarda y limpia previsualización.
                    } else {
                        mostrarAlerta('Error al guardar transacción: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    mostrarAlerta('Error de conexión al guardar transacción', 'error');
                });
        }

        const BASE_URL = '/calculator_scalping/Principal';

        // Función para mostrar datos
        async function mostrar_datos(parametro) {
            if (parametro === 'Brokers') {
                try {
                    const response = await fetch(`${BASE_URL}/Brokers`);

                    if (!response.ok) {
                        throw new Error(`Error HTTP: ${response.status}`);
                    }

                    const datosRecibidos = await response.json();

                    if (!datosRecibidos.success) {
                        throw new Error(datosRecibidos.error || 'Error desconocido del servidor');
                    }

                    // Manejo flexible de la respuesta (array directo o envuelto en data)
                    const brokers = datosRecibidos.data;
                    window.listaBrokers = brokers; // Guardar globalmente

                    dibujarBrokers(brokers);
                    cargarSelectBrokers();

                } catch (error) {
                    console.error("Error al obtener datos:", error);
                    document.getElementById('brokersContainer').innerHTML =
                        `<p style="text-align: center; color: #dc3545; padding: 20px;">
                            ❌ Error al cargar los brokers: ${error.message}
                        </p>`;
                }
            }
        }

        // Función para dibujar la tabla de brokers
        function dibujarBrokers(datos) {
            let html = '<div class="table-responsive"><table class="table table-striped table-bordered table-hover">';
            html += '<thead class="thead-dark"><tr>' +
                '<th>ID</th>' +
                '<th>Activo</th>' +
                '<th>Broker</th>' +
                '<th>Comisión %</th>' +
                '<th>Derecho %</th>' +
                '<th>IVA %</th>' +
                '<th>Fecha Creación</th>' +
                '<th>Fecha Modificado</th>' +
                '<th>Acciones</th>' +
                '</tr></thead><tbody>';

            if (Array.isArray(datos) && datos.length > 0) {
                datos.forEach(broker => {
                    const checked = broker.activo == 1 ? 'checked' : '';
                    const brokerJson = JSON.stringify(broker).replace(/"/g, '&quot;');

                    html += `<tr>
                        <td>${broker.id}</td>
                        <td class="text-center">
                            <input type="checkbox" ${checked} onchange="cambiarEstado(${broker.id}, this)">
                        </td>
                        <td>${broker.nombreBroker}</td>
                        <td>${broker.comisionCompra}</td>
                        <td>${broker.derechoMercado}</td>
                        <td>${broker.ivaImpuesto}</td>
                        <td>${broker.fec_registro}</td>
                        <td>${broker.fec_modificado || '-'}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="editarBroker(${brokerJson})">
                                ✏️ Editar
                            </button>
                        </td>
                    </tr>`;
                });
            } else {
                html += '<tr><td colspan="9" class="text-center">No hay brokers registrados</td></tr>';
            }

            html += '</tbody></table></div>';
            document.getElementById('brokersContainer').innerHTML = html;
        }

        // Función para cargar datos en el formulario para editar
        function editarBroker(broker) {
            document.getElementById('brokerId').value = broker.id;
            document.getElementById('nombreBroker').value = broker.nombreBroker;
            document.getElementById('comisionCompra').value = broker.comisionCompra;
            document.getElementById('derechoMercado').value = broker.derechoMercado;
            document.getElementById('ivaImpuesto').value = broker.ivaImpuesto;

            // Scroll al formulario
            document.getElementById('nombreBroker').focus();
        }

        // Función para cambiar estado activo/inactivo
        async function cambiarEstado(id, checkbox) {
            const estado = checkbox.checked ? 1 : 0;

            try {
                const response = await fetch(`${BASE_URL}/cambiarEstado`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id, activo: estado })
                });

                const result = await response.json();

                if (!result.success) {
                    alert('❌ Error al actualizar estado: ' + (result.error || 'Error desconocido'));
                    checkbox.checked = !checkbox.checked; // Revertir cambio
                }
            } catch (error) {
                console.error('Error:', error);
                alert('❌ Error de conexión');
                checkbox.checked = !checkbox.checked; // Revertir cambio
            }
        }

        // Función para guardar broker
        async function guardarBroker() {
            const data = {
                id: document.getElementById('brokerId').value,
                nombreBroker: document.getElementById('nombreBroker').value,
                comisionCompra: document.getElementById('comisionCompra').value,
                derechoMercado: document.getElementById('derechoMercado').value,
                ivaImpuesto: document.getElementById('ivaImpuesto').value
            };

            if (!data.nombreBroker) {
                alert('Por favor ingrese el nombre del broker');
                return;
            }

            try {
                const response = await fetch(`${BASE_URL}/guardarBroker`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                const text = await response.text();
                console.log('Raw Server Response:', text);

                try {
                    var result = JSON.parse(text);
                } catch (e) {
                    console.error('JSON Parse Error:', e);
                    alert('❌ Error del servidor: Respueta no válida (mira la consola)');
                    return;
                }

                if (result.success) {
                    alert('✅ ' + result.message);
                    mostrar_datos('Brokers'); // Recargar lista
                    nuevoBroker(); // Limpiar formulario
                } else {
                    alert('❌ Error: ' + (result.error || 'Error desconocido'));
                }
            } catch (error) {
                console.error('Fetch Error:', error);
                alert('❌ Error de conexión: ' + error.message);
            }
        }

        // Función para limpiar el formulario
        function nuevoBroker() {
            document.getElementById('brokerId').value = '';
            document.getElementById('nombreBroker').value = '';
            document.getElementById('comisionCompra').value = '0.00';
            document.getElementById('derechoMercado').value = '0.00';
            document.getElementById('ivaImpuesto').value = '0';
            document.getElementById('nombreBroker').focus();
        }

        // Inicialización
        document.addEventListener('DOMContentLoaded', function () {
            mostrar_datos('Brokers');
            // Cargar historial inicial si viene de PHP (opcional, o llamar a fetch)
            obtenerHistorialDesdeServidor();
        });

        function obtenerHistorialDesdeServidor() {
            fetch('<?php echo $baseUrl; ?>/Principal/historialOperaciones')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarTransacciones(data.data);
                    }
                })
                .catch(error => console.error('Error cargando historial:', error));
        }

        function mostrarTransacciones(listado = []) {
            let html = '<div class="table-responsive"><table class="table table-striped table-bordered transactions-table">';
            html += '<thead class="thead-dark"><tr>' +
                '<th>Fecha</th>' +
                '<th>Broker</th>' +
                '<th>Acción</th>' +
                '<th>Cant.</th>' +
                '<th>Compra Total</th>' +
                '<th>Venta Total</th>' +
                '<th>Ganancia Neta</th>' +
                '<th>Acciones</th>' +
                '</tr></thead><tbody>';

            if (listado.length > 0) {
                listado.forEach(t => {
                    // Asegurar que los valores sean numéricos para formatear
                    // Nota: los nombres de campos pueden venir diferentes de la DB (snake_case)
                    // Ajustar mapeo si es necesario
                    const fecha = t.fecha_operacion_venta || t.fecha;
                    const nombreBroker = t.nombreBroker || t.nombre_broker || '-';
                    const nombreAccion = t.nombre_accion || t.nombreAccion;
                    const cantidad = t.cantidad_acciones || t.cantidad;
                    const idOp = t.id;
                    const vigenteVal = (t.vigente == 1);

                    const compra = parseFloat(t.valor_bruto_compra || t.valorBrutoCompraTotal || 0);
                    const venta = parseFloat(t.precio_bruto_venta || t.precioBrutoVentaTotal || 0);
                    const ganancia = parseFloat(t.ganancia_neta_total || t.gananciaNetaTotal || 0);

                    // Datos completos para el modal (los guardamos en un atributo data o los pasamos)
                    // Para simplificar, pasamos el objeto entero encodeado
                    const dataObj = encodeURIComponent(JSON.stringify(t));

                    html += `<tr>
                        <td>${fecha}</td>
                        <td>${nombreBroker}</td>
                        <td>${nombreAccion}</td>
                        <td>${cantidad}</td>
                        <td>${formatearMoneda(compra)}</td>
                        <td>${formatearMoneda(venta)}</td>
                        <td style="font-weight:bold; color:${ganancia >= 0 ? '#155724' : '#721c24'}">
                            ${formatearMoneda(ganancia)}
                        </td>
                        <td style="text-align:center; display:flex; gap:10px; justify-content:center;">
                            <button class="btn btn-info btn-sm" onclick="verDetalle('${dataObj}')" title="Ver Detalle">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </button>
                            <label class="switch-ph" title="Vigente">
                                <input type="checkbox" ${vigenteVal ? 'checked' : ''} onchange="toggleVigencia(${idOp}, this)">
                                <span class="slider-ph"></span>
                            </label>
                            <button class="btn btn-danger btn-sm" onclick="eliminarOperacion(${idOp})" title="Eliminar">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </td>
                    </tr>`;
                });
            } else {
                html += '<tr><td colspan="8" class="text-center">No hay transacciones guardadas.</td></tr>';
            }
            html += '</tbody></table></div>';

            const container = document.getElementById('transaccionesContainer');
            if (container) {
                container.innerHTML = html;
            }
        }

        function verDetalle(encodedObj) {
            const t = JSON.parse(decodeURIComponent(encodedObj));

            // Datos generales
            const fecha = t.fecha_operacion_venta || t.fecha;
            const hora = t.hora || '';
            document.getElementById('m_fecha').textContent = fecha + (hora ? ' ' + hora : '');
            document.getElementById('m_broker').textContent = t.nombreBroker || t.nombre_broker;
            document.getElementById('m_accion').textContent = t.nombre_accion || t.nombreAccion;
            document.getElementById('m_cantidad').textContent = t.cantidad_acciones || t.cantidad || 0;

            // Tasas
            document.getElementById('m_tna').textContent = (t.tasa_banco || t.tna || 0) + '%';
            document.getElementById('m_tna365').textContent = (t.tn_365 || t.tnaDiaria365 || 0) + '%';
            document.getElementById('m_tna260').textContent = (t.tn_260 || t.tnaDiaria260 || 0) + '%';

            // Porcentajes Configuración (Si no están guardados en la op, usar defaults o 0)
            const comisionPorc = t.valor_comision_compra_porc || t.comisionPorcentaje || 0; // Ojo: hay que ver si guardamos esto. Si no, calculamos o mostramos ???
            // Revisando `guardarTransaccion`: guardamos `comisionPorcentaje`, `derechoMercadoPorcentaje`, `ivaPorcentaje` en JSON, 
            // pero en la DB aplanar en columnas específicas? 
            // En `PrincipalController` no mapeamos los porcentajes a columnas individuales, solo los montos.
            // PERO el objeto JSON 't' viene de la DB o del localStorage ? 
            // Viene de DB (`obtenerTodas`). `OperacionesModel` hace `select *`.
            // Si la columna no existe en DB, no vendrá.
            // Solución: Usar los valores monetarios para deducir o mostrar "-" si no tenemos el % exacto, 
            // O bien, confiar en que el JSON `t` tenga las propiedades si las agregamos al controller.

            // Re-mapeo rápido de valores numéricos
            const q = parseFloat(t.cantidad_acciones || t.cantidad || 1);

            // Valores Unitarios (Si en DB guardamos totales, dividimos por Q. Si guardamos unitarios, usamos directos)
            // Model: `valor_neto_compra` (unitario?), `valor_comision_compra` (monto total o unitario?)
            // Revisar controller: 
            // 'valor_neto_compra' => $datos['valorNeto'], (Unitario)
            // 'valor_comision_compra' => $datos['comisionCompra'], (Unitario, pues en JS es `valorNeto * %`)

            const vNeto = parseFloat(t.valor_neto_compra || t.valorNeto || 0);
            const comCompra = parseFloat(t.valor_comision_compra || t.comisionCompra || 0);
            const derCompra = parseFloat(t.derecho_mercado_compra || t.derechoMercadoCompra || 0);
            const ivaCompra = parseFloat(t.iva_compra || t.ivaCompra || 0);
            const vBrutoCompra = parseFloat(t.valor_bruto_compra || t.valorBrutoCompra || 0);

            // PORCENTAJES (Desde DB o calculados para operaciones viejas)
            // Priorizamos lo guardado en DB
            let pComision = parseFloat(t.comision_porcentaje || t.comisionPorcentaje || 0);
            let pDerecho = parseFloat(t.derecho_mercado_porcentaje || t.derechoMercadoPorcentaje || 0);
            let pIva = parseFloat(t.iva_porcentaje || t.ivaPorcentaje || 0);

            // Fallback para operaciones viejas sin porcentaje guardado: CALCULAR
            if (pComision === 0 && pDerecho === 0 && vNeto > 0) {
                if (comCompra > 0) pComision = (comCompra / vNeto) * 100;
                if (derCompra > 0) pDerecho = (derCompra / vNeto) * 100;
                const baseIva = comCompra + derCompra;
                if (baseIva > 0 && ivaCompra > 0) {
                    pIva = (ivaCompra / baseIva) * 100;
                }
            }

            // Valores Venta
            // Ganancia Proyectada (Monto) - OJO: en DB guardamos `ganancia_neta_por_accion` y `ganancia_neta_total`
            // Pero en JS `gananciaProyectadaValor` es el monto de ganancia sobre el bruto compra.
            // `ganancia_neta_por_accion` debería ser eso.
            const gananciaUnit = parseFloat(t.ganancia_neta_por_accion || 0);
            // Porcentaje Ganancia: Preferir guardado, sino calcular
            let gananciaPorc = parseFloat(t.ganancia_proyectada_porcentaje || t.PorcGanProy || 0);
            if (gananciaPorc === 0 && vBrutoCompra > 0 && gananciaUnit > 0) {
                gananciaPorc = (gananciaUnit / vBrutoCompra) * 100;
            }

            const vNetoVenta = parseFloat(t.precio_neto_venta || t.precioNetoVenta || 0);
            const comVenta = parseFloat(t.valor_comision_venta || t.comisionVenta || 0);
            const derVenta = parseFloat(t.derecho_mercado_venta || t.derechoMercadoVenta || 0);
            const ivaVenta = parseFloat(t.iva_venta || t.ivaVenta || 0);
            const vBrutoVenta = parseFloat(t.precio_bruto_venta || t.precioBrutoVenta || 0);

            // Elementos DOM
            document.getElementById('m_valorNeto').textContent = formatearMoneda(vNeto);
            document.getElementById('m_valorNetoTotal').textContent = formatearMoneda(vNeto * q);

            // Asignar Porcentajes (usando las variables resueltas pComision, pDerecho, etc.)
            document.getElementById('m_comisionPorc').textContent = pComision.toFixed(3) + '%';
            document.getElementById('m_derechoPorc').textContent = pDerecho.toFixed(3) + '%';
            document.getElementById('m_ivaPorc').textContent = pIva.toFixed(2) + '%';

            document.getElementById('m_comisionCompra').textContent = formatearMoneda(comCompra);
            document.getElementById('m_comisionCompraTotal').textContent = formatearMoneda(comCompra * q);

            document.getElementById('m_derechoCompra').textContent = formatearMoneda(derCompra);
            document.getElementById('m_derechoCompraTotal').textContent = formatearMoneda(derCompra * q);

            document.getElementById('m_ivaCompra').textContent = formatearMoneda(ivaCompra);
            document.getElementById('m_ivaCompraTotal').textContent = formatearMoneda(ivaCompra * q);

            document.getElementById('m_valorBrutoCompra').textContent = formatearMoneda(vBrutoCompra);
            document.getElementById('m_valorBrutoCompraTotal').textContent = formatearMoneda(vBrutoCompra * q);

            // Venta
            // Ganancia % 
            document.getElementById('m_gananciaProyPorc').textContent = gananciaPorc.toFixed(2) + '%';
            document.getElementById('m_gananciaProy').textContent = formatearMoneda(gananciaUnit);
            document.getElementById('m_gananciaProyTotal').textContent = formatearMoneda(gananciaUnit * q);

            document.getElementById('m_precioNetoVenta').textContent = formatearMoneda(vNetoVenta);
            document.getElementById('m_precioNetoVentaTotal').textContent = formatearMoneda(vNetoVenta * q);

            document.getElementById('m_comisionVentaPorc').textContent = pComision.toFixed(3) + '%';
            document.getElementById('m_comisionVenta').textContent = formatearMoneda(comVenta);
            document.getElementById('m_comisionVentaTotal').textContent = formatearMoneda(comVenta * q);

            document.getElementById('m_derechoVentaPorc').textContent = pDerecho.toFixed(3) + '%';
            document.getElementById('m_derechoVenta').textContent = formatearMoneda(derVenta);
            document.getElementById('m_derechoVentaTotal').textContent = formatearMoneda(derVenta * q);

            document.getElementById('m_ivaVentaPorc').textContent = pIva.toFixed(2) + '%';
            document.getElementById('m_ivaVenta').textContent = formatearMoneda(ivaVenta);
            document.getElementById('m_ivaVentaTotal').textContent = formatearMoneda(ivaVenta * q);



            document.getElementById('m_precioBrutoVenta').textContent = formatearMoneda(vBrutoVenta);
            document.getElementById('m_precioBrutoVentaTotal').textContent = formatearMoneda(vBrutoVenta * q);

            const gananciaNetaTotal = parseFloat(t.ganancia_neta_total || t.gananciaNetaTotal || (gananciaUnit * q));
            const elGanancia = document.getElementById('m_gananciaNeta');
            const elGananciaTotal = document.getElementById('m_gananciaNetaTotal');

            elGanancia.textContent = formatearMoneda(gananciaUnit);
            elGananciaTotal.textContent = formatearMoneda(gananciaNetaTotal);

            const color = gananciaNetaTotal >= 0 ? '#155724' : '#721c24';
            elGanancia.style.color = color;
            elGananciaTotal.style.color = color;

            $('#modalDetalleOperacion').modal('show');
        }

        function toggleVigencia(id, checkbox) {
            const nuevoEstado = checkbox.checked ? 1 : 0;

            fetch('<?php echo $baseUrl; ?>/Principal/cambiarEstadoOperacion', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, vigente: nuevoEstado })
            })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        alert('Error al actualizar estado: ' + (data.error || 'Desconocido'));
                        checkbox.checked = !checkbox.checked; // Revertir
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Error de conexión');
                    checkbox.checked = !checkbox.checked;
                });
        }

        function eliminarOperacion(id) {
            if (!confirm('¿Está seguro de que desea eliminar esta operación? Esta acción no se puede deshacer.')) return;

            fetch('<?php echo $baseUrl; ?>/Principal/eliminarOperacion', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Asumiendo que tienes una función para mostrar alertas
                        // mostrarAlerta('Operación eliminada', 'success');
                        alert('✅ Operación eliminada correctamente.');
                        obtenerHistorialDesdeServidor(); // Recargar tabla
                    } else {
                        alert('❌ Error al eliminar: ' + (data.error || 'Desconocido'));
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('❌ Error de conexión');
                });
        }

        function cargarSelectBrokers() {
            const select = document.getElementById('selectBrokerOperacion');
            if (!select) return;

            // Limpiar opciones excepto la primera
            select.innerHTML = '<option value="" disabled selected>Seleccione un Broker</option>';

            if (window.listaBrokers && Array.isArray(window.listaBrokers)) {
                window.listaBrokers.forEach(broker => {
                    const option = document.createElement('option');
                    option.value = broker.id;
                    option.textContent = broker.nombreBroker;
                    option.dataset.comision = broker.comisionCompra;
                    option.dataset.derecho = broker.derechoMercado;
                    option.dataset.iva = broker.ivaImpuesto;
                    select.appendChild(option);
                });
            }
        }

        function actualizarDatosBroker() {
            const select = document.getElementById('selectBrokerOperacion');
            const selectedOption = select.options[select.selectedIndex];

            if (selectedOption && selectedOption.value) {
                // Función auxiliar para asignar valores seguros
                const asignarValor = (id, valor) => {
                    const el = document.getElementById(id);
                    if (el) {
                        // Asegurar formato con punto para input number
                        let safeVal = (valor !== undefined && valor !== null) ? valor.toString() : '0';
                        safeVal = safeVal.replace(',', '.');
                        el.value = safeVal;
                    }
                };

                asignarValor('calc_comisionCompra', selectedOption.dataset.comision);
                asignarValor('calc_derechoMercado', selectedOption.dataset.derecho);
                asignarValor('calc_ivaImpuesto', selectedOption.dataset.iva);

                // Actualizar nombreBroker hidden si es necesario para compatibilidad
                if (document.getElementById('nombreBrokerHidden')) {
                    document.getElementById('nombreBrokerHidden').value = selectedOption.textContent;
                }

                // Recalcular
                calcularCoeficienteBase();
            }
        }
        // Función para validar y cargar previsualización
        function cargarPrevisualizacion() {
            let errores = [];

            // 1. Validar TNA Bancaria
            const tna = parseFloat(document.getElementById('tnaBancaria').value) || 0;
            if (tna <= 0) {
                errores.push("Debe cargar la TNA Bancaria de hoy.");
            }

            // 2. Validar Broker seleccionado
            const selectBroker = document.getElementById('selectBrokerOperacion');
            if (!selectBroker.value || selectBroker.value === "") {
                errores.push("Debe seleccionar un Broker.");
            }

            // 3. Validar Nombre/Sigla de la Acción
            const nombreAccion = document.getElementById('nombreAccion').value.trim();
            if (nombreAccion === "") {
                errores.push("Debe cargar el Nombre / Sigla de la Acción.");
            }

            // 4. Validar Valor Neto
            const valorNeto = parseFloat(document.getElementById('valorNeto').value) || 0;
            if (valorNeto <= 0) {
                errores.push("Debe cargar el Valor Neto (precio por acción).");
            }

            // 5. Validar Proyección de Ganancia
            const porcGanProy = parseFloat(document.getElementById('PorcGanProy').value) || 0;
            if (porcGanProy <= 0) {
                errores.push("Debe cargar el porcentaje de Proyección de ganancia.");
            }

            // 6. Validar Cantidad de acciones
            const cantidad = parseInt(document.getElementById('cantidadAcciones').value) || 0;
            if (cantidad <= 0) {
                errores.push("Debe cargar la Cantidad de acciones.");
            }

            if (errores.length > 0) {
                alert("Errores de validación:\n\n" + errores.join("\n"));
                return;
            }

            // Si pasa todas las validaciones
            document.getElementById('contenedorPrevisualizacion').style.display = 'block';
            document.getElementById('botonesOperacion').style.display = 'block';

            // Calcular y mostrar datos
            calcularCoeficienteBase();
            calcularOperacion();

            // Scroll hacia la previsualización
            document.getElementById('contenedorPrevisualizacion').scrollIntoView({ behavior: 'smooth' });
        }

        function limpiarFormulario() {
            document.getElementById('brokerConfigForm').reset();
            limpiarCalculos();
            document.getElementById('contenedorPrevisualizacion').style.display = 'none';
            document.getElementById('botonesOperacion').style.display = 'none';
        }
    </script>
    <!-- Modal Detalle Operación -->
    <div id="modalDetalleOperacion" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detalle de Operación</h4>
                </div>
                <div class="modal-body" id="cuerpoModalDetalle">
                    <!-- Datos Generales -->
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary">Datos</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>Fecha:</strong> <span id="m_fecha"></span></li>
                                <li class="list-group-item"><strong>Broker:</strong> <span id="m_broker"></span></li>
                                <li class="list-group-item"><strong>Acción:</strong> <span id="m_accion"></span></li>
                                <li class="list-group-item"><strong>Cantidad:</strong> <span id="m_cantidad"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Tasas de Referencia</h5>
                            <ul class="list-group">
                                <li class="list-group-item"><strong>TNA Banco:</strong> <span id="m_tna"></span></li>
                                <li class="list-group-item"><strong>TNA 365:</strong> <span id="m_tna365"></span></li>
                                <li class="list-group-item"><strong>TNA 260:</strong> <span id="m_tna260"></span></li>
                            </ul>
                        </div>
                    </div>

                    <hr>

                    <!-- Tabla de Detalles Financieros -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th>Concepto</th>
                                    <th>% Config</th>
                                    <th>Valor Unitario</th>
                                    <th>Valor Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- COMPRA -->
                                <tr class="info">
                                    <td colspan="4"><strong>OPERACIÓN DE COMPRA</strong></td>
                                </tr>
                                <tr>
                                    <td>Valor Neto</td>
                                    <td>-</td>
                                    <td><span id="m_valorNeto"></span></td>
                                    <td><span id="m_valorNetoTotal"></span></td>
                                </tr>
                                <tr>
                                    <td>Comisión Compra</td>
                                    <td><span id="m_comisionPorc"></span></td>
                                    <td><span id="m_comisionCompra"></span></td>
                                    <td><span id="m_comisionCompraTotal"></span></td>
                                </tr>
                                <tr>
                                    <td>Derecho Mercado</td>
                                    <td><span id="m_derechoPorc"></span></td>
                                    <td><span id="m_derechoCompra"></span></td>
                                    <td><span id="m_derechoCompraTotal"></span></td>
                                </tr>
                                <tr>
                                    <td>IVA Compra</td>
                                    <td><span id="m_ivaPorc"></span></td>
                                    <td><span id="m_ivaCompra"></span></td>
                                    <td><span id="m_ivaCompraTotal"></span></td>
                                </tr>
                                <tr class="warning" style="font-weight:bold;">
                                    <td>VALOR BRUTO COMPRA</td>
                                    <td>-</td>
                                    <td><span id="m_valorBrutoCompra"></span></td>
                                    <td><span id="m_valorBrutoCompraTotal"></span></td>
                                </tr>

                                <!-- VENTA -->
                                <tr class="info">
                                    <td colspan="4"><strong>OPERACIÓN DE VENTA</strong></td>
                                </tr>
                                <tr>
                                    <td>Ganancia Proyectada</td>
                                    <td><span id="m_gananciaProyPorc"></span></td>
                                    <td><span id="m_gananciaProy"></span></td>
                                    <td><span id="m_gananciaProyTotal"></span></td>
                                </tr>
                                <tr>
                                    <td>Precio Neto Venta</td>
                                    <td>-</td>
                                    <td><span id="m_precioNetoVenta"></span></td>
                                    <td><span id="m_precioNetoVentaTotal"></span></td>
                                </tr>
                                <tr>
                                    <td>Comisión Venta</td>
                                    <td><span id="m_comisionVentaPorc"></span></td>
                                    <!-- Asumimos mismo % que compra si no se guardó distinto -->
                                    <td><span id="m_comisionVenta"></span></td>
                                    <td><span id="m_comisionVentaTotal"></span></td>
                                </tr>
                                <tr>
                                    <td>Derecho Mercado Venta</td>
                                    <td><span id="m_derechoVentaPorc"></span></td>
                                    <td><span id="m_derechoVenta"></span></td>
                                    <td><span id="m_derechoVentaTotal"></span></td>
                                </tr>
                                <tr>
                                    <td>IVA Venta</td>
                                    <td><span id="m_ivaVentaPorc"></span></td>
                                    <td><span id="m_ivaVenta"></span></td>
                                    <td><span id="m_ivaVentaTotal"></span></td>
                                </tr>
                                <tr class="warning" style="font-weight:bold;">
                                    <td>PRECIO BRUTO VENTA</td>
                                    <td>-</td>
                                    <td><span id="m_precioBrutoVenta"></span></td>
                                    <td><span id="m_precioBrutoVentaTotal"></span></td>
                                </tr>
                                <tr class="success" style="font-weight:bold; font-size:1.1em;">
                                    <td>GANANCIA NETA FINAL</td>
                                    <td>-</td>
                                    <td><span id="m_gananciaNeta"></span></td>
                                    <td><span id="m_gananciaNetaTotal"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap (si no están ya incluidos, necesarios para el modal) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>