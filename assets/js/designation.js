// designation.js

document.addEventListener('DOMContentLoaded', function() {
    const office = document.getElementById('office');
    const designation = document.getElementById('designation');
    const form = document.getElementById('foreignVisitForm');
    const selectedDesignation = designation.dataset.selected || "";

    // Load Designation dynamically based on selected office
    function loadDesignation() {
        if (!office.value) {
            designation.innerHTML = '<option value="">Select Office First</option>';
            return;
        }

        fetch(`../data/designation/${office.value}.txt`)
            .then(response => response.text())
            .then(text => {
                designation.innerHTML = '<option value="">Select</option>';
                text.split('\n').forEach(d => {
                    d = d.trim();
                    if (d) {
                        const option = document.createElement('option');
                        option.value = d;
                        option.textContent = d;
                        if (d === selectedDesignation) option.selected = true;
                        designation.appendChild(option);
                    }
                });
            })
            .catch(err => console.error("Failed to load designations:", err));
    }

    // Event listener for office change
    office.addEventListener('change', loadDesignation);

    // If editing, load designation initially
    if (selectedDesignation) {
        loadDesignation();
    }

    // Front-end validation for required fields
    form.addEventListener('submit', function(e) {
        let valid = true;
        let firstInvalid = null;

        form.querySelectorAll('[required]').forEach(function(input) {
            if (!input.value) {
                input.style.borderColor = 'red';
                if (!firstInvalid) firstInvalid = input;
                valid = false;
            } else {
                input.style.borderColor = '#ccc';
            }
        });

        if (!valid) {
            alert('Please fill all required fields.');
            if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            e.preventDefault();
        }
    });
});
