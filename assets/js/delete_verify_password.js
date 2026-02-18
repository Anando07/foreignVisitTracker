function confirmDeleteVisit(id) {

    /* =========================
       STEP 1: PASSWORD CHECK
    ========================= */
    Swal.fire({
        title: 'Confirm Password',
        html: `
            <div style="position:relative;">
                <input type="password" id="swal-password"
                       class="swal2-input"
                       placeholder="Enter your password"
                       style="padding-right:40px;">
                <span id="togglePassword"
                      style="position:absolute; right:12px; top:50%;
                             transform:translateY(-50%);
                             cursor:pointer; font-size:18px;">
                    👁️
                </span>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Verify',
        showLoaderOnConfirm: true,
        focusConfirm: false,

        didOpen: () => {
            const passwordInput = document.getElementById('swal-password');
            const toggleIcon = document.getElementById('togglePassword');

            toggleIcon.addEventListener('click', () => {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                toggleIcon.textContent = type === 'password' ? '👁️' : '🙈';
            });
        },

        preConfirm: () => {
            const password = document.getElementById('swal-password').value;

            if (!password) {
                Swal.showValidationMessage('Password is required');
                return false;
            }

            return fetch('auth/verify_password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'password=' + encodeURIComponent(password)
            })
            .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message);
                }
                return true;
            })
            .catch(err => {
                Swal.showValidationMessage(err.message);
            });
        },

        allowOutsideClick: () => !Swal.isLoading()
    })

    /* =========================
       STEP 2: FINAL DELETE CONFIRM
    ========================= */
    .then((result) => {
        if (!result.isConfirmed) return;

        Swal.fire({
            title: 'Are you sure?',
            text: 'This record and all related files will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((finalResult) => {
            if (finalResult.isConfirmed) {
                window.location.href = "../action_page.php?delete=" + id;
            }
        });
    });
}
