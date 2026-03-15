import MarcoLogo3 from '../img-fondo/MarcoLogo3.jpg'
import LogoMarco4 from '../img-fondo/LogoMarco4.jpg';
import 'bootstrap/dist/css/bootstrap.min.css';  // Asegúrate de importar la hoja de estilos de Bootstrap

function LogoBody(props) {

  if(props.logoType === 1){
    return (
      <div className="">
        <div className="row">
          <div className="content fluid d-flex align-items-center justify-content-center">
            <div className="logo">
              <img src={LogoMarco4} alt="logo dj"/>
            </div>
          </div>
        </div>
      </div>
  )}else if(props.logoType === 2){
    return (
      <div className="body">
        <div className="row">
          <div className="content fluid d-flex align-items-center justify-content-center">
            <div className="logo">
              <img 
                src={MarcoLogo3} 
                alt="logo dj"
                style={{
                  border: "7px solid purple"
                }}/>
            </div>
          </div>
        </div>
      </div>
  )};
}

export default LogoBody;
