import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import LogoMarco4 from "../img-fondo/LogoMarco4.jpg"

function NavBasic1() {
  return (
    <Navbar bg="dark" data-bs-theme="dark" className='fixed-top'
    style={{
    height: "45px"}}
    >
     <Container>
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
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            {/* <Nav.Link href="#inicio">Home</Nav.Link> */}
            {/* <Nav.Link href="#contacto">Link</Nav.Link> */}
            <NavDropdown title="Negocio" id="basic-nav-dropdown">
              <NavDropdown.Item href="#resto/3.1">Resto</NavDropdown.Item>
              <NavDropdown.Item href="#bares/3.2">Bares</NavDropdown.Item>
              <NavDropdown.Item href="#boliches/3.3">Boliches</NavDropdown.Item>
              <NavDropdown.Item href='#galeria/3.4'>Galería</NavDropdown.Item>
              <NavDropdown.Divider />
              <NavDropdown.Item href="#empresas/3.5">Empresas</NavDropdown.Item>
              <NavDropdown.Item href="#contacto/3.6">Contactame</NavDropdown.Item>
            </NavDropdown>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default NavBasic1;