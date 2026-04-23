import React from "react";

function Separador(props) {
  // Desestructura el prop "titulo"
  const { title } = props;
  const {id} = props;
  // const todo = props;

  return (
    <>
      <div className="content">
        <div
          className="bg-black border-bottom border-light border-top border-light"
          style={{
            paddingLeft: "3%",
            color: "white",
          }}
        >
          <h3 className="title" id={id}>{title}</h3>
          {/* <h5>{todo.title},  {todo.id}</h5> */}
        </div>
      </div>
    </>
  );
}

export default Separador;
