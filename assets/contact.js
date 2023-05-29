input = document.querySelector('#hours_close_day')

input.addEventListener('change', (e) => {

    document.querySelectorAll('.hours-item').forEach((element) => {
        element.classList.toggle('none')
    })

})