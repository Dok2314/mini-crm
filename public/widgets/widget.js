document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('widget-form');
    const responseDiv = document.getElementById('widget-response');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        try {
            const res = await fetch(form.dataset.apiUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                },
            });

            const text = await res.text();
            let data;
            try {
                data = JSON.parse(text);
            } catch(err) {
                console.error('Server response is not JSON:', text);
                responseDiv.innerText = 'Ошибка на сервере';
                responseDiv.classList.add('error');
                return;
            }

            if (!res.ok) {
                responseDiv.innerText = data?.message || 'Ошибка при отправке';
                responseDiv.classList.add('error');
            } else {
                responseDiv.innerText = data?.message || 'Заявка отправлена!';
                responseDiv.classList.remove('error');
                form.reset();
            }
        } catch(err) {
            console.error(err);
            responseDiv.innerText = 'Произошла ошибка. Попробуйте позже.';
            responseDiv.classList.add('error');
        }
    });
});
