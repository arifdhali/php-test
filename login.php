<?php
include("./includes/header.php");
?>

<div>
    <form action="./login_process.php" class="form" method="post">
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" name="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="text" id="password" name="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
        <div>
            <p>Don't have account ? Create <a href="./register.php">new</a> </p>
        </div>

    </form>
</div>



<?php
include("./includes/footer.php");
?>