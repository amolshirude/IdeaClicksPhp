<?php echo $this->element('../Pages/init'); ?>       
        <script type="text/javascript">
            
            $(document).ready(function () {
       
                $("#submit").click(function () {
                    alert("hello");
                });
            });
    
        </script>
        <title>change password</title>
    </head>
    <body>
        
        <header>
            <h3>Contact Us</h3>
            <?php echo $this->element('../Pages/header3'); ?>  
        </header>        
        <br>
        <div>
            <h3>Contact Us:</h3>
            <h4>
                <p> IdeaClicks </p>

                <p> Bavdhan Pune </p>

                <p> Email Id : team.ideaclicks@gmail.com </p>

                <p> Contact No:+91 702 802 0321 </p>
                
                <p> Please feel free to reach us at : team.ideaclicks@gmail.com</p>

                <p> Happy innovation !</p></font></h4>
        </div>
        <br><br><br><br><br><br><br>
        <footer>
            <?php echo $this->element('../Pages/footer2'); ?>
        </footer>
</body>
</html>