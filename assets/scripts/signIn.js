document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const formData = new FormData(this);
    const action = this.action;
    fetch(action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.headers.get('content-type')?.includes('application/json')) {
            return response.json().then(data => ({isJson: true, data}));
        } else {
            return {isJson: false};
        }
    })
    .then(result => {
        console.log(result)
        if (result.isJson) {
            if (!result.data.success) {
                document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                for (const [field, message] of Object.entries(result.data.errors)) {
                    const input = document.getElementById(field);
                    if (input) {
                        input.classList.add('is-invalid');
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = message;
                        input.parentNode.appendChild(errorDiv);
                    }
                }
            }
        } else {
            window.location.href = '/profile';
        }
    })
    .catch(error => console.error('Ошибка:', error));
});

document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const formData = new FormData(this);
    const action = this.action;
    fetch(action, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.headers.get('content-type')?.includes('application/json')) {
            return response.json().then(data => ({isJson: true, data}));
        } else {
            return {isJson: false};
        }
    })
    .then(result => {

        if (result.isJson) {
            if (!result.data.success) {
                document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                for (const [field, message] of Object.entries(result.data.errors)) {
                    const input = document.getElementById(field);
                    if (input) {
                        input.classList.add('is-invalid');
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = message;
                        input.parentNode.appendChild(errorDiv);
                    }
                }
            }
        } else {
            window.location.href = '/signIn';
        }
    })
    .catch(error => console.error('Ошибка:', error));
});