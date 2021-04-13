import { gsap } from "gsap";

export default function menu() {

    // Need to streamline all of this into one function, but I'm too hazy to do it right now because of the vaccine
    // ****************** Main Menu ***************************
    const mobilePanel = document.querySelector('.mobile-panel');
    const hamburger = document.querySelector('a.hamburger');

    var mobileMove = gsap.to(mobilePanel, {
        x: '0%',
        duration: 0.3,
    });

    mobileMove.reversed(true)
    function toggleMobile() {
        mobileMove.reversed() ? mobileMove.play() : mobileMove.reverse();
    }

    hamburger.addEventListener('click', () => {
        toggleMobile();
    })


    // ****************** Filter Panel *************************
    const filterButton = document.querySelector('.filter-button a');
    const filterPanel = document.querySelector('.filter-panel');

    var filterMove = gsap.to(filterPanel, {
        x: '0%',
        duration: 0.3,
    });
    
    filterMove.reversed(true);

    function toggleSlide() {
        filterMove.reversed() ? filterMove.play() : filterMove.reverse();
    }

    filterButton.addEventListener('click', () => {
        toggleSlide();
    })

}
