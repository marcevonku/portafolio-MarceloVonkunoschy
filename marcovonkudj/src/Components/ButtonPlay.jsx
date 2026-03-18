import React, { useState, useEffect } from 'react';
import "bootstrap/dist/css/bootstrap.min.css";
import useSound from 'use-sound';
import elcirco from '../aud/elcirco.mp3';
import Rizzla from '../aud/Rizzla.mp3';
import sesion_one from '../aud/sesion_one.mp3';
import sesion_two from '../aud/sesion_two.mp3';
import sesion_three from '../aud/sesion_three.mp3';
import sesion_four from '../aud/sesion_four.mp3';
import sesion_five from '../aud/sesion_five.mp3';
import sesion_six from '../aud/sesion_six.mp3';

function ButtonPlay(props) {
  let tema;
  if (props.title === 1) {
    tema = elcirco;
  } else if (props.title === 2) {
    tema = Rizzla;
  } else if (props.title === 3) {
    tema = sesion_one;
  } else if (props.title === 4) {
    tema = sesion_two;
  } else if (props.title === 5) {
    tema = sesion_three;
  } else if (props.title === 6) {
    tema = sesion_four;
  } else if (props.title === 7) {
    tema = sesion_five;
  } else if (props.title === 8) {
    tema = sesion_six;
  }

  const [play, { stop }] = useSound(tema);
  const [isPlaying, setIsPlaying] = useState(false);

  useEffect(() => {
    if (isPlaying) {
      play();
    } else {
      stop();
    }
  }, [isPlaying, play, stop]);

  const handleClick = () => {
    setIsPlaying((prevIsPlaying) => !prevIsPlaying);
  };

  return (
    <>
      <div
        style={{
          margin: '1%',
          textAlign: 'center',
        }}
      >
        <button
          type="button"
          className={`btn ${isPlaying ? 'btn-danger' : 'btn-success'}`}
          onClick={handleClick}
          style={{
            backgroundColor: 'purple',
            border: '4px solid black',

          }}
        >{isPlaying ? 'STOP MUSIC' : 'PLAY MUSIC'}
        </button>
      </div>
    </>
  );
}

export default ButtonPlay;