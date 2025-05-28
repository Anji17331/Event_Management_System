// Utility: delays function execution to avoid rapid calls (debounce)
function debounce(fn, delay = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), delay);
    };
}

// Check if username is valid and available
function validateUsername() {
    const input = document.querySelector('input[name="username"]');
    const msgEl = document.getElementById('username_availability');
    if (!input || !msgEl) return;

    const value = input.value.trim();

    // Hide message if field is empty
    if (!value) {
        msgEl.style.display = 'none';
        return;
    }

    // Basic username format check
    const rx = /^\w{3,20}$/;
    if (!rx.test(value)) {
        msgEl.textContent = 'Username must be 3–20 letters, numbers, or underscores';
        msgEl.style.color = 'orange';
        msgEl.style.display = 'block';
        return;
    }

    // Send AJAX request to check username availability
    fetch('../admin/register_validation.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `field=username&value=${encodeURIComponent(value)}`
    })
        .then(res => res.ok ? res.json() : Promise.reject(res.statusText))
        .then(data => {
            msgEl.textContent = data.exists ? 'Username already taken' : 'Username available';
            msgEl.style.color = data.exists ? 'red' : 'green';
            msgEl.style.display = 'block';
        })
        .catch(err => {
            console.error('Validation error:', err);
            msgEl.textContent = 'Validation service unavailable';
            msgEl.style.color = 'gray';
            msgEl.style.display = 'block';
        });
}

// Setup event listeners after page loads
document.addEventListener('DOMContentLoaded', () => {
    const usernameInput = document.querySelector('input[name="username"]');
    const form = document.querySelector('form');

    // Validate username on blur, with delay
    if (usernameInput) {
        usernameInput.addEventListener('blur', debounce(validateUsername, 400));
    }

    // Basic client-side password match check before form submission
    if (form) {
        form.addEventListener('submit', e => {
            const pw = document.querySelector('input[name="password"]').value.trim();
            const cpw = document.querySelector('input[name="confirm_password"]').value.trim();

            if (!pw || !cpw) {
                e.preventDefault();
                alert('Please enter and confirm the password.');
            } else if (pw !== cpw) {
                e.preventDefault();
                alert('Passwords do not match!');
            }
        });
    }
});
