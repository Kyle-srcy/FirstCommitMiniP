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
        setTimeout(typeLetter, 20); // 50ms per letter, adjust speed here
    }
}

typeLetter();


