<?php echo $this->element('../Pages/init'); ?>
        <script type="text/javascript">
            
            $(document).ready(function () {
       
                $("#submit").click(function () {
                    alert("hello");
                });
            });
    
        </script>
        <title>about us</title>
    </head>
    <body>
        <header>
          <h3>About Us</h3>
            <?php echo $this->element('../Pages/header3'); ?>  
        </header><br>
        <div>
            <h3>About Us:</h3>
            <h4>
                <p> We are a team of young innovators. We are striving hard to create a platform where any Organization whether IT / non-IT can innovate. </p>

                <p> We believe that each one of us have valuable ideas and these ideas can bring in positive change to the society. </p>

                <p> We feel proud about our initiative and stand tall in providing you all the necessary support in order to be successful. </p>

                <p> We are open for any hand holding that may be required initially and also participate in running the campaigns, creating the BUZZ, germinating ideas, arranging brainstorming sessions, Coffee sessions to discuss ideas with management etc. </p>

                <p> Please feel free to reach us at : team.ideaclicks@gmail.com</p>

                <p> Happy innovation !</p></font></h4>
        </div>       
        <br><br><br>
        <footer>
            <?php echo $this->element('../Pages/footer2'); ?>
        </footer>
    </body>
</html>