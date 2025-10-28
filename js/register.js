// Password strength checker
function checkPasswordStrength(password) {
  let strength = 0;
  if (password.length >= 8) strength++;
  if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
  if (/\d/.test(password)) strength++;
  if (/[^a-zA-Z\d]/.test(password)) strength++;
  return strength;
}

// Update visual strength indicator
const passwordInput = document.getElementById('password');
const confirmInput = document.getElementById('confirm_password');
const strengthBar = document.getElementById('password-strength');

passwordInput.addEventListener('input', () => {
  const strength = checkPasswordStrength(passwordInput.value);
  strengthBar.className = 'password-strength'; // reset classes

  if (passwordInput.value.length === 0) return;
  if (strength <= 1) strengthBar.classList.add('weak');
  else if (strength === 2) strengthBar.classList.add('medium');
  else strengthBar.classList.add('strong');
});

// Floating label effect
document.querySelectorAll('.form-row input').forEach(input => {
  input.addEventListener('focus', () => {
    input.parentElement.classList.add('focused');
  });
  input.addEventListener('blur', () => {
    if (!input.value) {
      input.parentElement.classList.remove('focused');
    }
  });
});

// Validate before submitting
document.getElementById('register-form').addEventListener('submit', e => {
  const password = passwordInput.value;
  const confirmPassword = confirmInput.value;
  const handle = document.getElementById('handle').value;
  const errors = [];

  if (password !== confirmPassword) errors.push('Passwords do not match!');
  if (password.length < 6) errors.push('Password must be at least 6 characters long.');
  if (!/^[a-zA-Z0-9_-]+$/.test(handle)) errors.push('Username can only contain letters, numbers, underscores, and hyphens.');
  if (checkPasswordStrength(password) <= 2) errors.push('Please use a stronger password (mix uppercase, lowercase, numbers, and symbols).');

  if (errors.length > 0) {
    e.preventDefault();
    document.querySelector('.error-msg')?.remove();

    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-msg';
    errorDiv.innerHTML = errors.join('<br>');
    document.querySelector('.lead').insertAdjacentElement('afterend', errorDiv);
  }
});
