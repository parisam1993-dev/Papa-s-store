const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

let currentSlide = 0;
const slideIntervalTime = 5000;
let slideInterval;

function showSlide(index) {
  slides.forEach((slide) => slide.classList.remove('active'));
  dots.forEach((dot) => dot.classList.remove('active'));

  slides[index].classList.add('active');
  dots[index].classList.add('active');
  currentSlide = index;
}

function nextSlide() {
  let next = (currentSlide + 1) % slides.length;
  showSlide(next);
}

function prevSlide() {
  let prev = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(prev);
}

// دکمه‌ها
nextBtn.addEventListener('click', () => {
  nextSlide();
  resetAutoSlide();
});

prevBtn.addEventListener('click', () => {
  prevSlide();
  resetAutoSlide();
});

// دات‌ها
dots.forEach((dot) => {
  dot.addEventListener('click', (e) => {
    const index = parseInt(e.target.getAttribute('data-index'));
    showSlide(index);
    resetAutoSlide();
  });
});

// اسلاید خودکار
function startAutoSlide() {
  slideInterval = setInterval(nextSlide, slideIntervalTime);
}

function resetAutoSlide() {
  clearInterval(slideInterval);
  startAutoSlide();
}

startAutoSlide();