document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profileForm');
    const office = document.getElementById('office');
    const designation = document.getElementById('designation');
    const selectedDesignation = designation.dataset.selected || "";

    // Function to populate designations based on selected office
    function loadDesignation() {
        if (!office.value) {
            designation.innerHTML = '<option value="">Select Office First</option>';
            return;
        }

        fetch(`data/designation/${office.value}.txt`)
            .then(response => {
                if (!response.ok) throw new Error("Network response was not ok");
                return response.text();
            })
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

    // Load designations on page load if office is already selected
    if (office.value) loadDesignation();

    // Load designations whenever office changes
    office.addEventListener('change', loadDesignation);
});