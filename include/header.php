<?php
// Detecta el nombre del archivo actual, sin extensión .php
$page = basename($_SERVER['PHP_SELF'], ".php");
?>
<!-- @format html -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio | Marcelo Vonkunoschy</title>
    <meta name="description" content="Desarrollador PHP Sr. en Mendoza, Argentina. Sistemas de gestión, integraciones de pago (Payway, MercadoPago) y modernización de sistemas legados.">

    <!-- Open Graph: vista previa al compartir en LinkedIn, WhatsApp, etc. -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Portafolio de Marcelo Vonkunoschy">
    <meta property="og:title" content="Marcelo Vonkunoschy · Desarrollador PHP Sr.">
    <meta property="og:description" content="Sistemas de gestión, integraciones de pago (Payway, MercadoPago) y modernización de sistemas legados. Código que sigue funcionando años después de entregado.">
    <meta property="og:url" content="https://portafolio-marcelo.vonkunoschy.fednet.ar/<?php echo htmlspecialchars($page); ?>.php">
    <meta property="og:image" content="https://portafolio-marcelo.vonkunoschy.fednet.ar/assets/images/fondo1.jpg">
    <meta property="og:image:width" content="996">
    <meta property="og:image:height" content="664">
    <meta property="og:locale" content="es_AR">

    <!-- Twitter Card (también la usan otras plataformas como fallback) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Marcelo Vonkunoschy · Desarrollador PHP Sr.">
    <meta name="twitter:description" content="Sistemas de gestión, integraciones de pago y modernización de sistemas legados.">
    <meta name="twitter:image" content="https://portafolio-marcelo.vonkunoschy.fednet.ar/assets/images/fondo1.jpg">

    <link rel="stylesheet" href="assets/css/styles.css?v=<?php echo time(); ?>">
</head>

<body class="<?php echo $page; ?>">
    <nav class="site-header">
        <nav class="nav">
            <div class="logo">Marcelo Vonkunoschy &nbsp;&nbsp;Dev.</div>
            <button class="nav-toggle" aria-expanded="false" aria-controls="nav-links">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-links" id="nav-links">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="about.php">Sobre mí</a></li>
                <li><a href="proyectos.php">Proyectos</a></li>
                <!--<li><a href="certificados.php">Otros Cert.</a></li>-->
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </nav>