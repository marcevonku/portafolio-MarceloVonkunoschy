<?php include 'include/header.php'; ?>
<main class="container contact-section">
    <section class="hero">
        <h1>Contacto</h1>
        <h2>¿Querés ponerte en contacto conmigo?</h2>
        <div class="bio-card contact-card">
            <?php if (isset($_GET['enviado']) && $_GET['enviado'] === '1'): ?>
                <p class="form-ok">✅ ¡Mensaje enviado! Te responderé a la brevedad.</p>
            <?php elseif (isset($_GET['enviado'])): ?>
                <p class="form-error">⚠️ No se pudo enviar el mensaje. Revisá los campos e intentá de nuevo, o escribime directo a marcevonku@gmail.com.</p>
            <?php endif; ?>
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
        </div>
    </section>
</main>
<?php include 'include/footer.php'; ?>