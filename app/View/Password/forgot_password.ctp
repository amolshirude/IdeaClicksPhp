<?php echo $this->element('../Pages/init'); ?>
    <title>Forgot Password</title>
</head>
<body>
<header>
    <h3>Forgot Password</h3>
            <?php echo $this->element('../Pages/header3'); ?>
        </header><br>
<div>
    <form name="forgotpassword" action="forgotPassword" method="post">
        <label>Email Id:</label><br><input type="email" name="email" required>
        <input type="submit" class="buttonclass" value="Submit">
    </form>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <footer>
            <?php echo $this->element('../Pages/footer2'); ?>
        </footer>
</body>
</html>