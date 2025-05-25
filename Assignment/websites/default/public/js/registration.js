// Validate email input field on blur
function validateField(field) {
    const inputElement = document.querySelector(`input[name="${field}"]`);
    const value = inputElement.value.trim();
    if (!value) return;

    fetch('../Auth/register_validation.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `field=${field}&value=${encodeURIComponent(value)}`
    })
        .then(response => response.json())
        .then(data => {
            const availabilityElement = document.getElementById(`${field}_availability`);
            if (availabilityElement) {
                availabilityElement.innerHTML = data.exists
                    ? `${field.charAt(0).toUpperCase() + field.slice(1)} already taken`
                    : `${field.charAt(0).toUpperCase() + field.slice(1)} available`;
                availabilityElement.style.color = data.exists ? 'red' : 'green';
                availabilityElement.style.display = 'block';
            }
        })
        .catch(error => console.error('Error:', error));
}

// Attach "blur" event listener only for email
document.querySelector('input[name="email"]').addEventListener('blur', function () {
    validateField('email');
});

// Password confirmation check before form submit
document.querySelector('form').addEventListener('submit', function (event) {
    const password = document.querySelector('input[name="password"]').value.trim();
    const confirmPassword = document.querySelector('input[name="confirm_password"]').value.trim();

    if (password !== confirmPassword) {
        event.preventDefault();
        alert('Passwords do not match!');
    }
});

// Show/hide password functionality
function togglePasswordVisibility() {
    const passwordField = document.querySelector('input[name="password"]');
    const confirmPasswordField = document.querySelector('input[name="confirm_password"]');
    const passwordToggle = document.getElementById('password-toggle');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        confirmPasswordField.type = 'text';
        passwordToggle.textContent = 'Hide Passwords';
    } else {
        passwordField.type = 'password';
        confirmPasswordField.type = 'password';
        passwordToggle.textContent = 'Show Passwords';
    }
}
document.getElementById('password-toggle').addEventListener('click', togglePasswordVisibility);