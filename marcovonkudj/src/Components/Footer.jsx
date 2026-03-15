import React from "react";
import LogoMarco6 from "../img-fondo/LogoMarco6.png"

function Footer(){
    return(
        <div className="row footer">
            
                <div className="col">
                    <img 
                        src={LogoMarco6} 
                        alt="Logo de Marco" 
                        style={{
                            width: '250px',
                            float: 'left',
                        }}
                    />
                </div>
                <div className="col">
                    <h4 style={{textAlign: 'center',
                        margin: '0 auto',
                        textAlignLast: "left",
                        color: "white",
                    }}>MarcoVonkuDJ</h4>
                </div>
                <div className="col" 
                    style={{
                        fontSize: '18px',
                        color: 'white',
                    }}>MarTreSA I. T.
                </div>

        <div className="row">
        <p style={{
            textAlign: 'center',
            color: 'white',
            
            }}>Copyright © 2024 MarcoVonkuDJ</p>
        </div>
        </div>
    );
}

export default Footer;