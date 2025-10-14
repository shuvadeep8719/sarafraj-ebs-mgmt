// ============================
// Business Form Validator
// ============================

export function businessValidator(form) {
    const errors = [];

    const gst = form.querySelector('[name="gst_no"]');
    if (gst && !/^[0-9A-Z]{15}$/.test(gst.value.trim())) {
        errors.push("GST number must be 15 alphanumeric characters.");
    }

    const firmName = form.querySelector('[name="firm_name"]');
    if (firmName && firmName.value.trim().length < 3) {
        errors.push("Firm name must be at least 3 characters long.");
    }

    return errors;
}
