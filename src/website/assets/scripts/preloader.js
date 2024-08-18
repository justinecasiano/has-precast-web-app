const wrapper = document.querySelector('.wrapper');
const preloader = document.querySelector('.preloader-wrapper');

if (sessionStorage.getItem('preloaded')) {
  wrapper.style.overflow = 'none';
  preloader.style.display = 'none';
} else {
  wrapper.style.overflow = 'hidden';
  preloader.style.display = 'block';
  sessionStorage.setItem('preloaded', true);
}