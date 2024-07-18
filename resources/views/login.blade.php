<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <form id="login_form">
        <label for="email">Email</label>
        <input name="email" type="text">
        <br>
        <label for="password">Password</label>
        <input name="password" type="password">
        <br>
        <input type="button" id="form-submit" value="Submit">
    </form>
    <script>
        const submit = async function() {
            const form = document.getElementById('login_form');
            const body = {
                email: form.email.value,
                password: form.password.value,
            }
            const response = await fetch('/api/auth/login', {
                headers: {
                    "Content-Type": "application/json",
                },
                method: 'POST',
                body: JSON.stringify(body),
            });
            const data = await response.json();
            console.log(data);
            if (data.error) {
                alert(data.error);
            } else {
                localStorage.setItem('token', data.access_token);
                window.location.href = '/quotation';
            }
        };

        const submitButton = document.getElementById('form-submit');
        submitButton.addEventListener('click', submit);
    </script>
</body>

</html>
