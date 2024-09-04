let currentSlide = 0;
const slides = document.querySelectorAll('.carousel-item');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove('active', 'prev', 'next', 'fade-out', 'fade-in');
        
        if (i === index) {
            slide.classList.add('active', 'fade-in');
        } else if (i === currentSlide) {
            slide.classList.add('prev', 'fade-out');
        } else if (i === (currentSlide + 1) % slides.length) {
            slide.classList.add('next');
        }
    });
    currentSlide = index;
}

function nextSlide() {
    const nextIndex = (currentSlide + 1) % slides.length;
    showSlide(nextIndex);
}

function prevSlide() {
    const prevIndex = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(prevIndex);
}

showSlide(currentSlide);

var intervalID = window.setInterval(function(){}, 99999);
for (var i = 0; i < intervalID; i++) {
    window.clearInterval(i);
}

// intervalo de 10 segundos
setInterval(nextSlide, 10000); 

console.log('Script carregado');
