import React, { useState } from 'react';

function EnvioForm() {
  // Inicializa el estado con useState
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    fono: '',
    message: '',
  });

  // Manejador de cambios en los inputs
  const handleInputChange = (event) => {
    const { name, value } = event.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  // Manejador del envío del formulario
  const handleSubmit = (event) => {
    event.preventDefault();

    // Preparación de los datos para ser enviados
    const form = event.target;
    const dataToSend = new FormData(form);

    fetch(form.action, {
      method: form.method,
      body: dataToSend,
    })
    .then(response => {
      console.log('Respuesta del formulario:', response);
      // Restablecer el estado para limpiar el formulario
      setFormData({
        name: '',
        email: '',
        fono: '',
        message: '',
      });
    })
    .catch(error => {
      console.error('Error al enviar el formulario:', error);
    });
  };

  return (
    <div className='voxContact' style={{background: "rgba(233, 21, 230, 0.742)"}}>  
      <form 
        id="miFormulario" 
        action="https://formsubmit.co/2deef16274ca80a0e1ceac41d64b8913" 
        method="POST"
        onSubmit={handleSubmit}
      >
        <span>Nombre</span><br />
        <input 
          name="name" 
          value={formData.name}
          onChange={handleInputChange}
        /><br />
        <span>Email</span><br />
        <input 
          type="email" 
          name="email" 
          value={formData.email}
          onChange={handleInputChange}
        /><br />
        <span>WhatsApp</span><br />
        <input 
          type="tel" 
          name="fono" 
          value={formData.fono}
          onChange={handleInputChange}
        /><br />
        <span>Mensaje</span><br />
        <textarea 
          name="message" 
          value={formData.message}
          onChange={handleInputChange}
        /><br />
        <button 
          className="btn btn-secondary" 
          type="submit"
          style={{ border: "2px solid black" }}
        >
          ENVIAR
        </button>
      </form>
    </div>
  );
}

export default EnvioForm;