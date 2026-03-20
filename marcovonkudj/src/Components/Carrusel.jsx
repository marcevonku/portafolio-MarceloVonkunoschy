import React, { Component } from 'react';
import {
  Carousel,
  CarouselItem,
  CarouselControl,
  CarouselIndicators,
  CarouselCaption
} from 'reactstrap';
import "bootstrap/dist/css/bootstrap.min.css";

const items = [
  { src: require('../img-fondo/marco_1.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/Logo8.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_2.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo1.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_22.webp'), altText: '', caption: '' },
  { src: require('../img-fondo/logo10.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_3.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo11.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_4.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo12.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_5.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo2.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_6.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo3.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_7.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo4.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_8.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo5.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_9.jpeg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo6.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_orange.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo7.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_outfit.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/Logo8.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_parque.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo3.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_senia.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo5.png'), altText: '', caption: '' },
  { src: require('../img-fondo/marco_white.jpg'), altText: '', caption: '' },
  { src: require('../img-fondo/logo6.png'), altText: '', caption: '' },
];

class Carrusel extends Component {
  constructor(props) {
    super(props);
    this.state = { activeIndex: 0 };
    this.next = this.next.bind(this);
    this.previous = this.previous.bind(this);
    this.goToIndex = this.goToIndex.bind(this);
    this.onExiting = this.onExiting.bind(this);
    this.onExited = this.onExited.bind(this);
  }

  onExiting() {
    this.animating = true;
  }

  onExited() {
    this.animating = false;
  }

  next() {
    if (this.animating) return;
    const nextIndex = this.state.activeIndex === items.length - 1 ? 0 : this.state.activeIndex + 1;
    this.setState({ activeIndex: nextIndex });
  }

  previous() {
    if (this.animating) return;
    const nextIndex = this.state.activeIndex === 0 ? items.length - 1 : this.state.activeIndex - 1;
    this.setState({ activeIndex: nextIndex });
  }

  goToIndex(newIndex) {
    if (this.animating) return;
    this.setState({ activeIndex: newIndex });
  }

  render() {
    const { activeIndex } = this.state;

    const slides = items.map((item) => {
      return (
        <CarouselItem
          onExiting={this.onExiting}
          onExited={this.onExited}
          key={item.src}
        >
          <img src={item.src} alt={item.altText} className="d-block w-100 carrusel-img" />
          <CarouselCaption captionText={item.caption} captionHeader={item.caption} />
        </CarouselItem>
      );
    });

    return (
      <Carousel
        activeIndex={activeIndex}
        next={this.next}
        previous={this.previous}
      >
        <CarouselIndicators items={items} activeIndex={activeIndex} onClickHandler={this.goToIndex} />
        {slides}
        <CarouselControl direction="prev" directionText="Previous" onClickHandler={this.previous} />
        <CarouselControl direction="next" directionText="Next" onClickHandler={this.next} />
      </Carousel>
    );
  }
}


export default Carrusel;