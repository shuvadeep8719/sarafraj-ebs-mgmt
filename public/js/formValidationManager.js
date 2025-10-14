// ============================
// FORM VALIDATION MANAGER
// ============================

// Import form-specific validators
import { customerValidator } from './forms/customerValidator.js';
import { businessValidator } from './forms/businessValidator.js';
import { queryValidator } from './forms/queryValidator.js';

// Map form IDs to validator functions
const formValidators = {
    customerForm: customerValidator,
    businessForm: businessValidator,
    queryForm: queryValidator,
};

// ---- Shared error display ----
function showErrors(errors) {
    if (errors.length > 0) {
        alert("Please fix the following errors:\n\n" + errors.join("\n"));
    }
}

// ---- Shared post-success behavior ----
function handleSuccess(form) {
    // Optional: confirmation / toast
    console.log('✅ Form validation successful, submitting...');

    // ---- Option 1: Use native form submit (recommended)
    // Remove any 'preventDefault' effect and submit normally
    form.classList.remove('was-validated');

    // Optional visual feedback
    form.querySelectorAll('button[type="submit"]').forEach(btn => {
        btn.disabled = true;
        btn.textContent = 'Submitting...';
    });

    // Submit form via normal HTTP POST (non-AJAX)
    form.submit();
}

// ---- Centralized form validation ----
function validateForm(e) {
    debugger;
    const form = e.target;
    const formId = form.getAttribute('id');
    const validatorFn = formValidators[formId];

    const nativeValid = form.checkValidity();
    const customErrors = validatorFn ? validatorFn(form) : [];
    const hasErrors = !nativeValid || customErrors.length > 0;

    if (hasErrors) {
        e.preventDefault();
        e.stopPropagation();
        showErrors(customErrors);
        form.classList.add('was-validated');
    } else {
        e.preventDefault(); // Remove this line when connecting to backend
        handleSuccess(form);
    }
}

// ---- Initialize all forms ----
document.addEventListener('DOMContentLoaded', function () {
    debugger;
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', validateForm);
    });
    //real-time input validation for account number input
    // Validate bank account number in realtime
    const accountInput = document.querySelector('#account_no');
    const errorEl = document.getElementById('acc-error');

    if (accountInput) {
        accountInput.addEventListener('input', () => {
            clearTimeout(window._accCheckTimer);

            const value = accountInput.value.trim();
            errorEl.textContent = '';

            // Debounce to avoid hitting backend too frequently
            window._accCheckTimer = setTimeout(() => {
                if (value.length > 0) {
                    // ✅ Get the CSRF token directly from this form
                    const csrfTokenInput = customerForm.querySelector('input[name="_token"]');
                    const csrfToken = csrfTokenInput ? csrfTokenInput.value : null;
                    if (!csrfToken) {
                        console.error('CSRF token not found in form!');
                        return;
                    }
                    fetch(window.appRoutes.validateBank, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ account_no: value })
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (!data.valid) {
                                errorEl.textContent = data.errors;
                                accountInput.classList.add('is-invalid');
                            } else {
                                accountInput.classList.remove('is-invalid');
                            }
                        })
                        .catch(err => console.error('Validation error:', err));
                }
            }, 400);
        });
    }

    // Check if mobile and alternate mobile are same (live)
    const mobile = document.getElementById('mobile_no');
    const altMobile = document.getElementById('alternate_no');
    const altError = document.getElementById('alt-error');

    function checkMobiles() {
        if (mobile.value && altMobile.value && mobile.value === altMobile.value) {
            altError.textContent = 'Alternate mobile number must not be the same.';
        } else {
            altError.textContent = '';
        }
    }

    mobile.addEventListener('input', checkMobiles);
    altMobile.addEventListener('input', checkMobiles);
});
