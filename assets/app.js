/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
// import './bootstrap';

const hamburgerMenu = document.querySelector('.hamburger-menu')
const itemsList = document.querySelector('.list-container')
const body = document.querySelector('body')

hamburgerMenu.addEventListener('click',  () => {

    hamburgerMenu.classList.toggle('active')


    itemsList.classList.toggle('active')
    if (itemsList.classList.contains('active')) {
        body.classList.toggle('no-scroll')
    } else {
        setTimeout(() => {
            body.classList.toggle('no-scroll')
        }, 500)
    }

})