import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import LogoBody from "./LogoBody";
import ButtonPlay from "./ButtonPlay";
import wirra from "../img-fondo/wirra.jpg";
import birrahouse from "../img-fondo/birrahouse.jpg";
import elfaro from "../img-fondo/elfaro.jpg";
import pecados from "../img-fondo/pecados.jpg";
import elbarcito from "../img-fondo/elbarcito.jpg";
import laboriqua from "../img-fondo/la boriqua.jpg";
import kahlo from "../img-fondo/kahlo.jpg";
import EnvioForm from "./FormSubmit.jsx";
import artemisa from "../img-fondo/artemisa.jpg";
import TextBody from "./TextBody.jsx";
import Contact from "./Contact.jsx";


function BackGround(props) {

  if (props.fondo === "color") {
    return (
      <div className="bgTres">
        <EnvioForm />
        <Contact />
      </div>
    );
  }
  if (props.fondo === "empresas") {
    return (
      <div className="bgUno">

        <div className="contentCorp">
          <img src={kahlo} alt="Logo Kahlo Disco Lavalle, Mendoza" />
        </div>

        <div className="contentCorp">
          <img src={wirra} alt="Logo de wirra" />
        </div>

        <div className="contentCorp">
          <img src={birrahouse} alt="Logo de birra house" />
        </div>

        <div className="contentCorp">
          <img src={elfaro} alt="Logo de El Faro Cerbeceria" />
        </div>

        <div className="contentCorp">
          <img src={artemisa} alt="Logo La Boriqua sunset" />
        </div>

        <div className="contentCorp">
          <img src={pecados} alt="Logo de Pecados Town Club" />
        </div>

        <div className="contentCorp">
          <img src={elbarcito} alt="Logo El Barcito Disco" />
        </div>

        <div className="contentCorp">
          <img src={laboriqua} alt="Logo La Boriqua sunset" />
        </div>

      </div>
    );
  } else {
    const fondo = props.fondo;
    const logoType = props.logoType;
    const title = props.title;
    const value = props.val;
    const text1 = props.text1;
    const text2 = props.text2;
    const val2 = props.val2;
    const logoType2 = props.logoType2;
    const title2 = props.title2;
    // --- NUEVAS VARIABLES PARA EL TERCER LOGO ---
    const logoIn3 = props.logoIn3;     // Para saber si se muestra el 3er logo
    const text3 = props.text3;         // El texto del 3er logo
    const logoType3 = props.logoType3; // El tipo de imagen para LogoBody
    const title3 = props.title3;       // El título para ButtonPlay
    return props.logoIn ? (
      <div className="bg" style={{ backgroundImage: `url(${fondo})` }}>
        <TextBody value={value} />
        <div className="d-flex justify-content-around align-items-center">
          <div className="text-center">
            <div style={{ color: 'white', fontFamily: 'Calibri', fontWeight: 900, textShadow: '2px 2px 0 black' }}>{text1}</div>
            <br />
            <LogoBody logoType={logoType} />
            <br />
            <ButtonPlay title={title} />
          </div>
          {props.logoIn2 && (
            <div className="text-center">
              <div style={{ color: 'white', fontFamily: 'Calibri', fontWeight: 900, textShadow: '2px 2px 0 black' }}>{text2}</div>
              <br />
              <LogoBody logoType={logoType2} />
              <br />
              <ButtonPlay title={title2} />
            </div>
          )}
          {props.logoIn3 && (
            <div className="text-center">
              <div style={{ color: 'white', fontFamily: 'Calibri', fontWeight: 900, textShadow: '2px 2px 0 black' }}>{text3}</div>
              <br />
              <LogoBody logoType={logoType3} />
              <br />
              <ButtonPlay title={title3} />
            </div>
          )}
        </div>
      </div>
    ) : (
      <div className="bg" style={{ backgroundImage: `url(${fondo})` }}>
        <TextBody value={value} />
      </div>
    );
  }
}

export default BackGround;

