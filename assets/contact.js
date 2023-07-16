input = document.querySelector('#hours_close_day')

if (input.checked) {
    document.querySelectorAll('.hours-item-container').forEach((element) => {
        element.classList.add('none')
    })
}

input.addEventListener('change', (e) => {

    document.querySelectorAll('.hours-item-container').forEach((element) => {
        element.classList.toggle('none')
    })

})