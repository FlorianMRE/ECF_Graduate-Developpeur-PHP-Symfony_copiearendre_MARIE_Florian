imgShow = document.querySelector('.product-img-show')
carouselImg = document.querySelectorAll('img.product-img-show-carousel')


carouselImg.forEach((item) => {
    item.addEventListener('click', () => {
        imgShow.src = item.src
    })
})