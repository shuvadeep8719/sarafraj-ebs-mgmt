// ============================
// Customer Form Validator
// ============================

export function customerValidator(form) {
    const errors = [];

    const accountNo = form.querySelector('[name="account_no"]');
    const mobile = form.querySelector('[name="mobile_no"]');
    const altMobile = form.querySelector('[name="alternate_no"]');

    if (accountNo && !/^\d{9,18}$/.test(accountNo.value.trim())) {
        errors.push("Account number must be 9–18 digits.");
    }

    if (mobile && !/^\d{10}$/.test(mobile.value.trim())) {
        errors.push("Mobile number must be exactly 10 digits.");
    }

    if (altMobile && altMobile.value.trim() !== "" && altMobile.value === mobile.value) {
        errors.push("Alternate mobile cannot be the same as mobile.");
    }

    return errors;
}
