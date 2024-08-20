<?php
include("./config/database.php");

?>
<style>
    small {
        color: red;
    }

    label {
        display: block;
    }
</style>

<div class="form-container">
    <form id="registrationForm">
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <small id="error-name"></small>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
            <small id="error-email"></small>
        </div>
        <div>
            <label for="mobile">Mobile</label>
            <input type="text" id="mobile" name="mobile">
            <small id="error-mobile"></small>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <small id="error-password"></small>
        </div>
        <button type="submit">Register</button>
        <p>Already have an account? <a href="./login.php">Login</a></p>
    </form>
</div>

<script>
    document.getElementById('registrationForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('http://localhost/php/register_process.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);

                if (data.success) {
                    document.getElementById('registrationForm').reset();
                    document.querySelectorAll('small').forEach(el => el.textContent = '');
                } else {
                    for (const [field, message] of Object.entries(data.message)) {
                        document.getElementById('error-' + field).textContent = message;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>