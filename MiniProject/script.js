/*  for dashboard click minimized*/
const toggleBtn = document.getElementById("toggleBtn");     
const dashboard = document.querySelector(".dashboard");

toggleBtn.addEventListener("click", () => {
  dashboard.classList.toggle("minimized");
});


/*    FOR DARK MODE USE   */
const darkToggle = document.getElementById('darkModeToggle');
const icon = darkToggle.querySelector('i');

// Load previous theme
if (localStorage.getItem('theme') === 'dark') {
  document.body.classList.add('dark-mode');
  icon.classList.replace('bx-moon', 'bx-sun');
}

// Toggle theme
darkToggle.addEventListener('click', () => {
  document.body.classList.toggle('dark-mode');

  const isDark = document.body.classList.contains('dark-mode');
  icon.classList.replace(isDark ? 'bx-moon' : 'bx-sun', isDark ? 'bx-sun' : 'bx-moon');

  localStorage.setItem('theme', isDark ? 'dark' : 'light');
});


/*    For typing effect on my DESC    */
const text = document.getElementById('typing').textContent;
document.getElementById('typing').textContent = '';

let i = 0;
function typeLetter() {
    if (i < text.length) {
        document.getElementById('typing').textContent += text.charAt(i);
        i++;
        setTimeout(typeLetter, 20); // 20ms per letter, adjust speed here
    }
}

typeLetter();


 // ⭐ Generate star ratings
    document.querySelectorAll('.stars').forEach(starDiv => {
      const rating = parseFloat(starDiv.dataset.rating);
      const fullStars = Math.floor(rating);
      const halfStar = rating % 1 >= 0.5;
      let starsHTML = '';
      for (let i = 0; i < fullStars; i++) starsHTML += '<i class="bx bxs-star"></i>';
      if (halfStar) starsHTML += '<i class="bx bxs-star-half"></i>';
      for (let i = fullStars + (halfStar ? 1 : 0); i < 5; i++) starsHTML += '<i class="bx bx-star"></i>';
      starDiv.innerHTML = starsHTML;
    });

    // 🕒 Real-time clock
  
  function updateDateTime() {
    const now = new Date();
    const formatted = now.toLocaleString('en-PH', {
      dateStyle: 'full',
      timeStyle: 'medium'
    });
    
    document.getElementById('dateTime').textContent = formatted;
  }

  setInterval(updateDateTime, 1000);
  updateDateTime();

  // ✨ Fade-in & glow animation for skill icons
window.addEventListener('scroll', () => {
  const icons = document.querySelectorAll('.skills-icons img, .skills-icons i');
  icons.forEach(icon => {
    const position = icon.getBoundingClientRect().top;
    const screenPosition = window.innerHeight / 1.2;

    if (position < screenPosition) {
      icon.classList.add('visible');
    }
  });
});

// Glow effect on skill icons
setInterval(() => {
  const icons = document.querySelectorAll('.skills-icons img, .skills-icons i');
  if (icons.length === 0) return;
  
  icons.forEach(icon => icon.classList.remove('glow'));
  const random = Math.floor(Math.random() * icons.length);
  icons[random].classList.add('glow');
}, 1000);

// Soft Fade in on Page Load
window.addEventListener('load', () => {
  document.body.classList.add('fade-in');
});
