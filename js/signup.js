// Basic client-side password confirmation check
document.getElementById("signupForm").addEventListener("submit", function(e) {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    if(password !== confirmPassword) {
        e.preventDefault();
        alert("Passwords do not match!");
        return false;
    }
});
