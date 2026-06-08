document.querySelectorAll('[data-toggle-password]').forEach((toggle) => {
    toggle.addEventListener('click', (event) => {
        event.preventDefault();

        const input = toggle.closest('.input-group')?.querySelector('input[type="password"], input[type="text"]');

        if (!input) {
            return;
        }

        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';

        const icon = toggle.querySelector('.ti');
        if (icon) {
            icon.classList.toggle('ti-eye', !isHidden);
            icon.classList.toggle('ti-eye-off', isHidden);
        }
    });
});