function handleSubmit(event) {
      event.preventDefault();
      const email = document.getElementById('email').value;
      const submitBtn = document.getElementById('submitBtn');
      
      submitBtn.disabled = true;
      submitBtn.textContent = 'Signing in...';

      setTimeout(() => {
        alert(`Login with ${email}`);
        submitBtn.disabled = false;
        submitBtn.textContent = 'Sign In';
      }, 1000);
    }

    function handleGoogleClick() {
      alert('Google login would be handled here');
    }