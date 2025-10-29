// app.js
// Global Variables
let currentUser = null;


// Initialize Application
function initializeApp() {
    // Initialize DataTables


    $('#businessTable').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[0, 'asc']]
    });

    $('#queryTable').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[0, 'asc']]
    });

    // Initialize dropdown submenus
    initializeDropdowns();
}

// Page Navigation
function showPage(pageId) {
    // Hide all pages
    document.querySelectorAll('.page-section').forEach(page => {
        page.classList.remove('active');
    });

    // Show selected page
    document.getElementById(pageId).classList.add('active');

    // Update sidebar active state
    document.querySelectorAll('.sidebar .nav-link').forEach(link => {
        link.classList.remove('active');
    });
    event.target.classList.add('active');

    // Add animation
    document.getElementById(pageId).classList.add('animate-fade-in');
}

// Customer Form Functions
function showCustomerForm() {
    document.getElementById('customerForm').style.display = 'block';
    document.getElementById('customerForm').scrollIntoView({ behavior: 'smooth' });
}

function hideCustomerForm() {
    document.getElementById('customerForm').style.display = 'none';
}

function toggleDate(selectElement, targetId) {
    const target = document.getElementById(targetId);
    if (selectElement.value === 'active' || selectElement.value === 'closed') {
        target.style.display = 'block';
    } else {
        target.style.display = 'none';
    }
}

// Business Form Functions
function showBusinessForm() {
    document.getElementById('businessForm').style.display = 'block';
    document.getElementById('businessForm').scrollIntoView({ behavior: 'smooth' });
}

function hideBusinessForm() {
    document.getElementById('businessForm').style.display = 'none';
}

function toggleInvestorType(selectElement) {
    const existingCustomer = document.getElementById('existingCustomer');
    const newCustomerFields = document.getElementById('newCustomerFields');

    if (selectElement.value === 'existing') {
        existingCustomer.style.display = 'block';
        newCustomerFields.style.display = 'none';
    } else if (selectElement.value === 'new') {
        existingCustomer.style.display = 'none';
        newCustomerFields.style.display = 'block';
    } else {
        existingCustomer.style.display = 'none';
        newCustomerFields.style.display = 'none';
    }
}

// Query Form Functions
function showQueryForm() {
    document.getElementById('queryForm').style.display = 'block';
    document.getElementById('queryForm').scrollIntoView({ behavior: 'smooth' });
}

function hideQueryForm() {
    document.getElementById('queryForm').style.display = 'none';
}

function fillCustomerDetails(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const accountNo = selectedOption.getAttribute('data-account');
    const phoneNo = selectedOption.getAttribute('data-phone');

    document.getElementById('queryAccountNo').value = accountNo || '';
    document.getElementById('queryPhoneNo').value = phoneNo || '';
}

// Invoice Functions
function generateInvoice() {
    // In a real application, this would generate a new invoice
    alert('Invoice generated successfully! Invoice #INV-2024-' + String(Math.floor(Math.random() * 1000)).padStart(3, '0'));
}

// Dropdown Submenus
function initializeDropdowns() {
    // Handle dropdown submenus
    document.querySelectorAll('.dropdown-submenu a.dropdown-toggle').forEach(function (element) {
        element.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const submenu = this.nextElementSibling;
            if (submenu) {
                submenu.classList.toggle('show');
            }
        });
    });

    // Close submenus when clicking outside
    document.addEventListener('click', function () {
        document.querySelectorAll('.dropdown-submenu .dropdown-menu').forEach(function (submenu) {
            submenu.classList.remove('show');
        });
    });
}

// Logout Function
function logout() {
    currentUser = null;
    document.getElementById('mainApp').style.display = 'none';
    document.getElementById('loginPage').style.display = 'flex';

    // Reset form
    document.getElementById('loginForm').reset();
}

// Form Validation
/*document.addEventListener('DOMContentLoaded', function () {
    // Add form validation to all forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            } else {
                e.preventDefault(); // Prevent actual submission for demo
                alert('Form submitted successfully!');

                // Hide forms after successful submission
                const formContainers = ['customerForm', 'businessForm', 'queryForm'];
                formContainers.forEach(containerId => {
                    const container = document.getElementById(containerId);
                    if (container && container.style.display !== 'none') {
                        container.style.display = 'none';
                    }
                });

                // Reset form
                form.reset();
            }
            form.classList.add('was-validated');
        });
    });
});*/

// Utility Functions
function formatCurrency(amount) {
    return new Intl.NumberFormat('en-IN', {
        style: 'currency',
        currency: 'INR'
    }).format(amount);
}

function formatDate(date) {
    return new Intl.DateTimeFormat('en-IN').format(new Date(date));
}

// Export Functions for Download
function exportToCSV(tableId, filename) {
    const table = document.getElementById(tableId);
    const rows = table.querySelectorAll('tr');
    let csvContent = '';

    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const rowData = Array.from(cols).map(col =>
            '"' + col.textContent.replace(/"/g, '""') + '"'
        ).join(',');
        csvContent += rowData + '\n';
    });

    downloadFile(csvContent, filename + '.csv', 'text/csv');
}

function exportToPDF() {
    window.print();
}

function downloadFile(content, fileName, contentType) {
    const a = document.createElement('a');
    const file = new Blob([content], { type: contentType });
    a.href = URL.createObjectURL(file);
    a.download = fileName;
    a.click();
    URL.revokeObjectURL(a.href);
}

// Search and Filter Functions
function searchTable(inputId, tableId) {
    const input = document.getElementById(inputId);
    const table = $('#' + tableId).DataTable();

    input.addEventListener('keyup', function () {
        table.search(this.value).draw();
    });
}

// Notification System
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = `
                top: 20px; 
                right: 20px; 
                z-index: 9999; 
                min-width: 300px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;

    notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

    document.body.appendChild(notification);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 5000);
}

// Theme Toggle (Optional Enhancement)
function toggleTheme() {
    const body = document.body;
    const isDark = body.classList.contains('dark-theme');

    if (isDark) {
        body.classList.remove('dark-theme');
        localStorage.setItem('theme', 'light');
    } else {
        body.classList.add('dark-theme');
        localStorage.setItem('theme', 'dark');
    }
}

// Load saved theme
document.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
    }
});

// Advanced Features

// Auto-save form data (using memory storage)
const formDataStorage = {};

function autoSaveForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    const inputs = form.querySelectorAll('input, select, textarea');
    inputs.forEach(input => {
        input.addEventListener('input', function () {
            if (!formDataStorage[formId]) {
                formDataStorage[formId] = {};
            }
            formDataStorage[formId][input.name || input.id] = input.value;
        });
    });
}

function loadFormData(formId) {
    const savedData = formDataStorage[formId];
    if (!savedData) return;

    Object.keys(savedData).forEach(key => {
        const input = document.querySelector(`#${formId} [name="${key}"], #${formId} #${key}`);
        if (input) {
            input.value = savedData[key];
        }
    });
}

// Real-time validation
function addRealTimeValidation() {
    const inputs = document.querySelectorAll('input[required], select[required], textarea[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', function () {
            validateField(this);
        });
    });
}

function validateField(field) {
    const isValid = field.checkValidity();
    const feedback = field.parentNode.querySelector('.invalid-feedback') ||
        field.parentNode.querySelector('.valid-feedback');

    if (isValid) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        if (feedback) {
            feedback.style.display = 'none';
        }
    } else {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
        if (feedback) {
            feedback.style.display = 'block';
        }
    }
}

// Advanced DataTable configurations
function initializeAdvancedDataTables() {
    // Customer Table with advanced features
    if ($.fn.DataTable.isDataTable('#customerTable')) {
        $('#customerTable').DataTable().destroy();
    }

    $('#customerTable').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[0, 'asc']],
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fas fa-download me-1"></i>CSV',
                action: function () {
                    exportToCSV('customerTable', 'customers');
                },
                className: 'btn btn-sm btn-outline-primary'
            },
            {
                text: '<i class="fas fa-file-pdf me-1"></i>PDF',
                action: function () {
                    exportToPDF();
                },
                className: 'btn btn-sm btn-outline-danger'
            }
        ],
        columnDefs: [
            { targets: -1, orderable: false } // Disable sorting on Actions column
        ]
    });
}

// Enhanced form submissions with progress indication
function enhancedFormSubmit(formElement) {
    const submitBtn = formElement.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;

    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';

    // Simulate processing time
    setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
        showNotification('Form submitted successfully!', 'success');
    }, 2000);
}

// Keyboard shortcuts
document.addEventListener('keydown', function (e) {
    // Ctrl/Cmd + K for search
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        const searchInput = document.querySelector('.dataTables_filter input');
        if (searchInput) {
            searchInput.focus();
        }
    }

    // Ctrl/Cmd + N for new customer
    if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
        e.preventDefault();
        if (document.getElementById('customers').classList.contains('active')) {
            showCustomerForm();
        }
    }

    // Escape to close forms
    if (e.key === 'Escape') {
        hideCustomerForm();
        hideBusinessForm();
        hideQueryForm();
    }
});

// Initialize enhanced features
document.addEventListener('DOMContentLoaded', function () {
    debugger;
    // Add auto-save to forms
    ['customerForm', 'businessForm', 'queryForm'].forEach(formId => {
        autoSaveForm(formId);
    });

    // Add real-time validation
    addRealTimeValidation();

    // Initialize advanced DataTables after a short delay
    setTimeout(initializeAdvancedDataTables, 1000);
});

// Print specific sections
function printSection(sectionId) {
    const section = document.getElementById(sectionId);
    const printWindow = window.open('', '_blank');

    printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Print - ${section.querySelector('h2')?.textContent || 'Document'}</title>
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .no-print { display: none !important; }
                        @media print {
                            .card { box-shadow: none !important; border: 1px solid #ddd; }
                        }
                    </style>
                </head>
                <body>
                    ${section.innerHTML}
                </body>
                </html>
            `);

    printWindow.document.close();
    printWindow.print();
}

// Dynamic content loading simulation
function loadDynamicContent(contentType) {
    showNotification('Loading ' + contentType + '...', 'info');

    setTimeout(() => {
        showNotification(contentType + ' loaded successfully!', 'success');
    }, 1500);
}

// Responsive design helpers
function checkMobileView() {
    return window.innerWidth <= 768;
}

window.addEventListener('resize', function () {
    if (checkMobileView()) {
        // Adjust UI for mobile
        document.querySelectorAll('.table-responsive').forEach(table => {
            table.style.fontSize = '0.85rem';
        });
    } else {
        // Reset for desktop
        document.querySelectorAll('.table-responsive').forEach(table => {
            table.style.fontSize = '';
        });
    }
});

// Initialize tooltips and popovers
function initializeTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Call initialization functions
document.addEventListener('DOMContentLoaded', function () {
    initializeTooltips();
});