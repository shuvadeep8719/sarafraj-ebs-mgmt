// ============================
// Query Form Validator
// ============================

export function queryValidator(form) {
    const errors = [];

    const email = form.querySelector('[name="email"]');
    const message = form.querySelector('[name="message"]');

    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
        errors.push("Please enter a valid email address.");
    }

    if (message && message.value.trim().length < 10) {
        errors.push("Message must be at least 10 characters long.");
    }

    return errors;
}
