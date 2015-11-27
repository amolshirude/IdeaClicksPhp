<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <title>login</title>
        <style>
            header {
                margin-right: 7%;
                color:black;
                text-align:right;
                padding:2px; 
            }
            footer {
                margin-right: 4%;
                margin-left : 4%;
                background-color:#068097;
                color:white;
                text-align:left;
                padding:1px; 
            }
            .carousel-inner > .item > img,
            .carousel-inner > .item > a > img {
                width: 100%;
                height:50%;
                margin: auto;
            }
            .textbox {
                background-color: #ffffff;
                border:2px solid #456879;
                height: 22px;
                width: 200px;
            }
            .buttonclass {
                border-top: 1px solid #96d1f8;
                background: #65a9d7;
                background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
                background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
                background: -moz-linear-gradient(top, #3e779d, #65a9d7);
                background: -ms-linear-gradient(top, #3e779d, #65a9d7);
                background: -o-linear-gradient(top, #3e779d, #65a9d7);
                padding: 5px 10px;
                -webkit-border-radius: 7px;
                -moz-border-radius: 7px;
                border-radius: 7px;
                -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
                -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
                box-shadow: rgba(0,0,0,1) 0 1px 0;
                text-shadow: rgba(0,0,0,.4) 0 1px 0;
                color: white;
                font-size: 10px;
                font-family: Georgia, serif;
                text-decoration: none;
                vertical-align: middle;
            }
            .button:hover {
                border-top-color: #28597a;
                background: #28597a;
                color: #ccc;
            }
            .button:active {
                border-top-color: #1b435e;
                background: #1b435e;
            }
            .myButton {
                -moz-box-shadow:inset 0px 9px 9px 3px #91b8b3;
                -webkit-box-shadow:inset 0px 9px 9px 3px #91b8b3;
                box-shadow:inset 0px 9px 9px 3px #91b8b3;
                background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #067f97), color-stop(1, #6c7c7c));
                background:-moz-linear-gradient(top, #067f97 5%, #6c7c7c 100%);
                background:-webkit-linear-gradient(top, #067f97 5%, #6c7c7c 100%);
                background:-o-linear-gradient(top, #067f97 5%, #6c7c7c 100%);
                background:-ms-linear-gradient(top, #067f97 5%, #6c7c7c 100%);
                background:linear-gradient(to bottom, #067f97 5%, #6c7c7c 100%);
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#067f97', endColorstr='#6c7c7c',GradientType=0);
                background-color:#067f97;
                -moz-border-radius:16px;
                -webkit-border-radius:16px;
                border-radius:16px;
                border:1px solid #566963;
                display:inline-block;
                cursor:pointer;
                color:#ffffff;
                font-family:Arial;
                font-size:15px;
                padding:19px 13px;
                text-decoration:none;
                text-shadow:0px 0px 0px #2b665e;
            }
            .myButton:hover {
                background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #6c7c7c), color-stop(1, #067f97));
                background:-moz-linear-gradient(top, #6c7c7c 5%, #067f97 100%);
                background:-webkit-linear-gradient(top, #6c7c7c 5%, #067f97 100%);
                background:-o-linear-gradient(top, #6c7c7c 5%, #067f97 100%);
                background:-ms-linear-gradient(top, #6c7c7c 5%, #067f97 100%);
                background:linear-gradient(to bottom, #6c7c7c 5%, #067f97 100%);
                filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#6c7c7c', endColorstr='#067f97',GradientType=0);
                background-color:#6c7c7c;
            }
            .myButton:active {
                position:relative;
                top:1px;
            }

        </style>
    </head>
    <body>
    <frameset rows="25%,*,25%">
        <frame>
            <table style="width:100%">
                <tr>
                    <td width="30%" >
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="like" src="../app/webroot/img/logo.png"/>
                    </td>
                    <td width="70%">
                        <header>
                            <div>
                                <form name="login" action="postLogin" method="post">
                                    <input class="textbox" type="email" name="email" placeholder="Email Id" required>
                                    <input class="textbox" type="password" name="password" placeholder="Password" required>
                                    <input class="buttonclass" type="submit" style="background-color: #068097"value="login">
                                </form>
                                <?php
                                $message = $this->Session->consume('login_message');
                                echo '<h4 style="color: #FF0000">';
                                echo $message;
                                echo '</h4>';
                                ?>
                            </div>
                            <a href="../Pages/about_us"><b style="color: #068097">About Us</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="../Pages/contact_us"><b style="color: #068097">Contact Us</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="../Password/forget_password"><b style="color: #068097">Forgot password ?</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </header>
                    </td>
                </tr>
            </table>
        </frame>
        <br>
        <frame>
            <div class="container">
                <div id="myCarousel" style="background-color: #ffffff" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="../app/webroot/img/header.jpg" alt="Chania" width="100%" height="345">
                        </div>

                        <div class="item">
                            <img src="../app/webroot/img/carousel1.png" alt="Chania" width="100%" height="345">
                        </div>

                        <div class="item">
                            <img src="../app/webroot/img/carousel2.png" alt="Flower" width="100%" height="345">
                        </div>

                        <div class="item">
                            <img src="../app/webroot/img/carousel3.jpg" alt="Flower" width="100%" height="345">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </frame>
        <br>
        <frame>
            <div align="center">
                <a  class="myButton" role="button" href="../Admin/create_group"><b>Inviting Ideas</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a  class="myButton" role="button" href="../User/user_registration"><b>Submitting Ideas</b></a>
            </div>
            <br>
            <footer>
                <?php echo $this->element('../Pages/footer2'); ?>
            </footer>
        </frame>
    </frameset>

</body>
</html>