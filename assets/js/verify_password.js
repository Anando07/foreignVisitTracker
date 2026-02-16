function confirmEditVisit(visitId) {
    Swal.fire({
        title: 'Confirm Password',
        html: `
            <div style="position:relative;">
                <input type="password" id="swal-password"
                       class="swal2-input"
                       placeholder="Enter your password"
                       style="padding-right:40px;">
                <span id="togglePassword"
                      style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
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
                const type = passwordInput.getAttribute('type') === 'password'
                    ? 'text'
                    : 'password';

                passwordInput.setAttribute('type', type);
                toggleIcon.textContent = type === 'password' ? '👁️' : '🙈';
            });
        },

        preConfirm: () => {
            const password = document.getElementById('swal-password').value;

            if (!password) {
                Swal.showValidationMessage('Password is required');
                return false;
            }

            return fetch('../auth/verify_password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'password=' + encodeURIComponent(password)
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    throw new Error(data.message);
                }
                return true;
            })
            .catch(error => {
                Swal.showValidationMessage(error.message);
            });
        },

        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'base.php?page=NewEntry&edit=' + visitId;
        }
    });
}