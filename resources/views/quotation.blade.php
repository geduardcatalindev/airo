<!DOCTYPE html>
<html>

<head>
    <title>Quotation</title>
</head>

<body>
    <form id="quotation_form">
        <label for="age">Age</label>
        <input name="age" type="text">
        <br>
        <label for="currency_id">Currency id</label>
        <input name="currency_id" type="text">
        <br>
        <label for="start_date">Start date (format: yyyy-mm-dd)</label>
        <input name="start_date" type="text">
        <br>
        <label for="end_date">End date (format: yyyy-mm-dd)</label>
        <input name="end_date" type="text">
        <br>
        <input type="button" id="form-submit" value="Submit">
        <br>
        Result: <span id="result"></span>
    </form>
    <script>
        ;
        (function redirectIfNotAuthenticated() {
            const token = localStorage.getItem('token');
            if (!token) {
                window.location.href = '/login'
            }
        })();

        const submit = async function() {
            const form = document.getElementById('quotation_form');
            const result = document.getElementById('result');
            const body = {
                age: form.age.value,
                currency_id: form.currency_id.value,
                start_date: form.start_date.value,
                end_date: form.end_date.value,
            }
            const token = localStorage.getItem('token');
            const response = await fetch('/api/quotation', {
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": `Bearer ${token}`,
                    "Accept": "application/json",
                },
                method: 'POST',
                body: JSON.stringify(body),
            });
            const data = await response.json();
            if (data.status == "failed" || data.message == "Unauthenticated.") {
                alert(data.message);
            } else {
                result.innerText = data.total;
            }
        };

        const submitButton = document.getElementById('form-submit');
        submitButton.addEventListener('click', submit);
    </script>
</body>

</html>
