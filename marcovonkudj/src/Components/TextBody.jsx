function TextBody(props) {

  if (props.value === 1) {
    return (<>
      <h3 style={{
        paddingTop: "5% ",
        paddingLeft: "3%",
        color: "white",
        textAlign: "left",

      }}>Tu evento como lo imaginás</h3>
      <p style={{
        paddingTop: "1% ",
        paddingLeft: "3%",
        paddingRight: "10%",
        color: "white",
        textAlign: "left",
        fontSize: "22px",
        fontWeight: 700,
        WebkitTextStroke: "0.7px black",

      }}>¡Bienvenido al mundo de la música que hace vibrar tu negocio!<br /> Soy MarcoVonkuDJ, tu socio en la creación de experiencias inolvidables. <br />Eleva la energía de tu local con ritmos irresistibles que mantendrán a tus clientes en movimiento toda la noche.</p>
    </>
    );
  } else if (props.value === 2) {
    return (<>
      <h3 style={{
        paddingTop: "5% ",
        paddingLeft: "3%",
        color: "white",
        textAlign: "left",

      }}>Personalización del Servicio</h3>
      <p style={{
        paddingTop: "1% ",
        paddingLeft: "3%",
        paddingRight: "10%",
        color: "white",
        textAlign: "left",
        fontSize: "22px",
        WebkitTextStroke: "0.5px black",

      }}>Como MarcoVonku DJ entiendo que cada lugar tiene su propio encanto. Me especializo en adaptar la música a la personalidad única de tu establecimiento. Desde boliches íntimos hasta discotecas de alta energía, generando la modulación sonora perfecta para cada espacio</p>
    </>
    );
  } else if (props.value === 3) {
    return (<>
      <h3 style={{
        paddingTop: "5% ",
        paddingLeft: "3%",
        color: "white",
        textAlign: "left",

      }}>Experiencia Profesional</h3>
      <p style={{
        paddingTop: "1% ",
        paddingLeft: "3%",
        paddingRight: "65%",
        color: "white",
        textAlign: "left",
        fontSize: "22px",
        WebkitTextStroke: "0.5px black",

      }}>Con años de experiencia en la escena musical, siendo DJ profesional he llevado la fiesta a numerosos lugares exitosos. Confía, te voy a ofrecer no solo música, sino una experiencia que mantendrá a tus clientes regresando por más</p>
    </>
    );
  } else if (props.value === 4) {
    return (<>
      <h3 style={{
        paddingTop: "5% ",
        paddingRight: "3%",
        paddingLeft: "3%",
        color: "orange",
        WebkitTextStroke: "1.3px black",
        // textAlign: "right",

      }}>Versatilidad Musical</h3>
      <p style={{
        paddingTop: "1% ",
        paddingLeft: "65%",
        paddingRight: "3%",
        color: "orange",
        textAlign: "left",
        fontSize: "22px",
        WebkitTextStroke: "1.1px black",

      }}>Desde los éxitos actuales a los clásicos que nunca pasan, mi repertorio es tan diverso como tu audiencia. Garantizo una mezcla perfecta que mantendrá a todos en la pista de baile, independientemente de sus gustos.</p>
    </>
    );
  }


}
export default TextBody;
