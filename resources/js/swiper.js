import Swiper, { Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';

const slider = document.querySelector('.slider');

document.addEventListener('livewire:init',() => {
    if(slider) {

        const opciones = {
            spaceBetween: 15,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 3
                },
                1280: {
                    slidesPerView: 4
                },
                1536: {
                    slidesPerView: 5
                }
            },
        }

        Swiper.use([Navigation])
        new Swiper('.slider', opciones)
    }
});
