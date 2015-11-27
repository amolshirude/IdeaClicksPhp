<html>
<head>
    <style>
    header {
        background-color:#068097;
        color:white;
        text-align:center;
        padding:1px; 
    }
    footer {
                 background-color:#068097;
                color:white;
                text-align:left;
                padding:1px; 
            }
    </style>
    <title></title>
</head>
<body>
<div><header><h3>Forgot Password</h3>
            <?php echo $this->element('../Pages/header2'); ?>
        </header>  </div><br>
<div>
    <form name="forgotpassword" action="forgotPassword" method="post">
        <label>Email Id:</label><br><input type="email" name="email" required>
        <input type="submit" value="Submit">
    </form>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <footer>
            <?php echo $this->element('../Pages/footer2'); ?>
        </footer>
</body>
</html>