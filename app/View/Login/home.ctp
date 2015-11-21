<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <title>login</title>
        <style>
            header {
                background-color:#819FF7;
                color:white;
                text-align:right;
                padding:2px; 
            }    
        </style>
    </head>
    <body>
        <div>
            <table border="1" style="width:100%">
                <tr>
                    <td bgcolor="#819FF7" align="right" height="10%" width="100%">
                        <div>
                            <form name="login" action="postLogin" method="post">
                                <input type="email" name="email" placeholder="email Id" required>
                                <input type="password" name="password" placeholder="password" required>
                                <input type="submit" value="login">
                            </form>
                            <?php
                            $message = $this->Session->consume('login_message');
                            echo '<h4 style="color: #FF0000">';
                            echo $message;
                            echo '</h4>';
                            ?>
                        </div>
                        <a href="../Pages/about_us"><b style="color: #ffffff">About Us</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="../Pages/contact_us"><b style="color: #ffffff">Contact Us</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="../Password/forget_password"><b style="color: #ffffff">Forgot password ?</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div>
            <table border="1" align="center">
                <tr>
                    <td bgcolor="#819FF7" align="center" height="220" width="30%">
                        <h3>I am interested in :</h3>
                        <a  class="btn btn-info" role="button" href="../Admin/create_group"><b style="color: #ffffff" >Inviting Ideas</b></a>
                        <a  class="btn btn-info" role="button" href="../User/user_registration"><b style="color: #ffffff" >Submitting Ideas</b></a>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>