import React from "react";
import "./app.css";
import "bootstrap/dist/css/bootstrap.min.css";
import BackGround from "./components/bg.jsx";
// import NavBasic from "./components/navbasic.jsx"
import Separador from "./components/separador.jsx";
import MuroUno from './img-fondo/murouno.jpg';
import marco_outfitUno from './img-fondo/marco_outfituno.jpg';
import imgfiesta2 from './img-fondo/imgfiesta2.jpg';
import marco_parqueUno from './img-fondo/marco_parqueuno.jpg';
import Footer from "./components/footer.jsx";
import Carrusel from "./components/carrusel";
import NavBasic1 from "./components/navcasic1.jsx";

function App() {

  return (
    <>
      <NavBasic1 />
      <div className="clearfix" id="inicio"></div>
      <BackGround 
        text1="SESION UNO - MARCO VONKU DJ"
        fondo={MuroUno}//Aqui indico que imagen cargar en el background
        logoIn={true}// aqui indico que esta sección llevará componente logo girando
        logoType={1}// indico que diseño de logo incluir
        buttonIn={true} // incluya un componente button
        title={3} // indica número de canción al dar play
        val={1} // indica que se debe incluir un componente texto
        text2="SESION DOS - MARCO VONKU DJ"
        logoIn2={true}
        logoType2={1}
        title2={4}
        val2={1}
      />
      <div className="clearfix"></div>
      <Separador title="Servicio: BAR && MUSIC HOUSE" id="resto/3.1"/>
      <div className="clearfix"></div>
      <BackGround
        fondo={imgfiesta2}
        val={2}
        text1="SESION TRES - MARCO VONKU DJ"
        logoIn={true}
        logoType={2}
        buttonIn={true}
        title={5}
        text2="SESION CUATRO - MARCO VONKU DJ"
        logoIn2={true}
        logoType2={2}
        title2={6}
        val2={2}
      />
      <div className="clearfix"></div>
      <Separador title="Servicio: DISCO && DRINKS" id="bares/3.2"/>
      <div className="clearfix"></div>
      <BackGround 
        fondo={marco_outfitUno}
        val={3}
        text1="SESION CINCO - MARCO VONKU DJ"
        logoIn={true}
        logoType={1}
        buttonIn={true}
        title={7}
        text2="SESION SEIS - MARCO VONKU DJ"
        logoIn2={true}
        logoType2={1}
        title2={8}
        val2={3}
      />
      <div className="clearfix"></div>
      <Separador title="Servicio: DISC ALL NIGHT" id="boliches/3.3" />
      <div className="clearfix"></div>
      <BackGround 
        fondo={marco_parqueUno}
        val={4} />
      <Separador title="GALERIA DE FOTOS" id="galeria/3.4" />
      <div className="clearfix"></div>
      <Carrusel />
      <Separador title="EMPRESAS QUE ENTIENDEN" id="empresas/3.5" />
      <div className="clearfix"></div>
      <BackGround fondo={"empresas"} />
      <div className="clearfix"></div>
      <Separador title="  Quieres llevar tu fiesta al próximo nivel...!!!  ***  Envíame un mensaje" id="contacto/3.6"/>
      <div className="clearfix"></div>
      <BackGround fondo={"color"} />
      <Footer />
    </>
  );
}

export default App;


// "homepage": "https://marcevonku.github.io/marcovonkudj",