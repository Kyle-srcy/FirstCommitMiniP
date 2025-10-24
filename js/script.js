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


document.addEventListener("DOMContentLoaded", function() {
  const typingElement = document.getElementById('typing');
  const text = typingElement.textContent.trim();
  typingElement.textContent = ''; // clear text first

  let i = 0;
  function typeLetter() {
    if (i < text.length) {
      typingElement.textContent += text.charAt(i);
      i++;
      setTimeout(typeLetter, 20); // typing speed
    }
  }

  typeLetter();
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

// Starburst Effect on Icon Hover
document.querySelectorAll('.icons div').forEach(icon => {
  icon.addEventListener('mouseenter', e => {
    for (let i = 0; i < 8; i++) {
      const star = document.createElement('div');
      star.classList.add('star');
      star.innerHTML = '✦';
      document.body.appendChild(star);

      const x = e.clientX + (Math.random() - 0.5) * 80;
      const y = e.clientY + (Math.random() - 0.5) * 80;

      star.style.left = `${x}px`;
      star.style.top = `${y}px`;

      setTimeout(() => star.remove(), 1000);
    }
  });
});



// Soft Fade in on Page Load
window.addEventListener('load', () => {
  document.body.classList.add('fade-in');
});
