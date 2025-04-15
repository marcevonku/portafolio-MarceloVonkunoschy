<?php include 'include/header.php'; ?>
<main class="container contact-section">
    <div class="contact-content">
        <section class="hero">
            <h1>Contacto</h1>
            <h2>¿Querés ponerte en contacto conmigo?</h2>
            <p>Completá el formulario y te responderé a la brevedad.</p>
            <form action="enviar.php" method="post" class="contact-form">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="5" required></textarea>

                <button type="submit" class="btn">Enviar</button>
            </form>
        </section>


</main>
<?php include 'include/footer.php'; ?>