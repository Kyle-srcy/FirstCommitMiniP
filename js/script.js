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

// Rating UI on Tech Icons
// For each tech icon (both <i> and boxicon-like divs) we create a small
// rating bar above the icon with 5 clickable stars. Hover previews the
// rating and click locks it (stored in the element's data-rating attribute).
function setupIconRatings() {
  document.querySelectorAll('.icons i, .icons div[class^="bx"]').forEach(icon => {
    // Avoid adding multiple rating containers if script runs twice
    if (icon.querySelector('.rating-stars')) return;

    const rating = document.createElement('div');
    rating.className = 'rating-stars';

    // create 5 star elements
    for (let s = 1; s <= 5; s++) {
      const st = document.createElement('span');
      st.className = 'star';
      st.dataset.value = s;
      st.textContent = '★';
      rating.appendChild(st);
    }

    // append rating container to icon (icon is position:relative)
    icon.appendChild(rating);

    // helper to update visual fill up to a possibly-fractional `value` (e.g., 3.5)
    function fillStars(value) {
      const full = Math.floor(value);
      const half = (value - full) >= 0.5;
      Array.from(rating.children).forEach((el, idx) => {
        const starIndex = idx + 1;
        el.classList.toggle('filled', starIndex <= full);
        el.classList.toggle('half', ! (starIndex <= full) && starIndex === full + 1 && half);
      });
    }

    // initial state from data attribute (if any) or from a default mapping
    // Priority: data-rating > data-proficiency > defaultRatings[title] > 0
    const defaultRatings = {
      'HTML': .5,
      'CSS': .5,
      'JavaScript': .5,
      'Java': .5,
      'C++': .5
    };

    let initial = 0;
    if (icon.dataset.rating) {
      initial = parseFloat(icon.dataset.rating);
    } else if (icon.dataset.proficiency) {
      initial = parseFloat(icon.dataset.proficiency);
      icon.dataset.rating = initial; // keep consistent
    } else if (icon.title && defaultRatings[icon.title]) {
      initial = defaultRatings[icon.title];
      icon.dataset.rating = initial;
    }
    fillStars(initial);

    // mousemove on rating previews (based on cursor position)
    rating.addEventListener('mousemove', e => {
      const rect = rating.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const stars = rating.children.length;
      const raw = (x / rect.width) * stars; // e.g., 2.3
      // Map to nearest half, biased so left half of a star shows .5 and right half shows full
      let hovered = Math.ceil(raw * 2) / 2;
      if (hovered < 0.5) hovered = 0.5;
      if (hovered > stars) hovered = stars;
      fillStars(hovered);
    });

    // mouseleave resets to saved rating
    rating.addEventListener('mouseleave', () => {
      const val = parseFloat(icon.dataset.rating) || 0;
      fillStars(val);
    });

    // click sets the rating (supports half values)
    rating.addEventListener('click', e => {
      const rect = rating.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const stars = rating.children.length;
      const raw = (x / rect.width) * stars;
      let selected = Math.ceil(raw * 2) / 2;
      if (selected < 0.5) selected = 0.5;
      if (selected > stars) selected = stars;
      icon.dataset.rating = selected;
      fillStars(selected);
      // You can add here an AJAX call to save the rating externally if desired
    });
  });
}

// Initialize ratings after DOM content is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', setupIconRatings);
} else {
  setupIconRatings();
}



// Soft Fade in on Page Load
window.addEventListener('load', () => {
  document.body.classList.add('fade-in');
});
