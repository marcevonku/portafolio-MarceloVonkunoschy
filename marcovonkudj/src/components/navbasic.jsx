import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import LogoMarco4 from "../img-fondo/LogoMarco4.jpg"

function NavBasic() {
  return (
    <>
      <Navbar bg="dark" data-bs-theme="dark" className='fixed-top'>
        <Container             
            style={{marginTop:"0px",
                    paddingTop: "0px",
                    marginBottom: "0px",
                    paddingBottom: "0px",
                    height: "25px"}}>
          <Navbar.Brand href="#inicio" 
            style={{marginTop:"0px",
                    paddingTop: "0px",
                    marginBottom: "0px",
                    paddingBottom: "0px",}}>
          <img 
                        src={LogoMarco4} 
                        alt="Logo de Marco" 
                        style={{
                            width: '35px',
                            float: 'left',
                            marginTop:"0px",
                            paddingTop: "0px"
                        }}
                    />MarcoVonkuDJ</Navbar.Brand>
          <Nav className="me-auto">
            <Nav.Link href="#eventos">Eventos</Nav.Link>
            <Nav.Link href="#galeria">Galeria</Nav.Link>
            <Nav.Link href="#empresas">Empresas</Nav.Link>
            <Nav.Link href="#contacto">Contacto</Nav.Link>
          </Nav>
        </Container>
      </Navbar>
      <br />
    </>
  );
}

export default NavBasic;