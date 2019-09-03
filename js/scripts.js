/**
 * Smooth scrolling for anchor jump links
 * @source https://stackoverflow.com/questions/7717527/smooth-scrolling-when-clicking-an-anchor-link
 */
document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();

    document.querySelector(this.getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    });
  });
});

/**
 * Smooth scrolling for footer back to top button
 */
document.getElementById('footer-back-to-top').addEventListener('click', function (e) {
	e.preventDefault();

	document.querySelector('body').scrollIntoView({
		behavior: 'smooth'
	});
});