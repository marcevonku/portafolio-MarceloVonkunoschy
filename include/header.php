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
    <link rel="stylesheet" href="assets/css/styles.css">
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
                <li><a href="about.php">Sobre mi</a></li>
                <li><a href="proyectos.php">Proyectos</a></li>
                <!--<li><a href="certificados.php">Otros Cert.</a></li>-->
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </nav>