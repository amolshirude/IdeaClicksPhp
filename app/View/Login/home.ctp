<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../app/webroot/css/home.css">
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
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td width="30%" >
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img id="like" src="../app/webroot/img/logo.png"/>
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
                        <?php echo $this->element('../Pages/header2'); ?> 
                    </header>
                </td>
            </tr>
        </table> 
    <br>

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
            </a>.
        </div>
    </div>
<br>
    <div align="center">
        <a  class="myButton" role="button" href="./Admin/create_group"><b>Inviting Ideas</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a  class="myButton" role="button" href="./User/user_registration"><b>Submitting Ideas</b></a>
    </div>
    <br>
    <footer>
        <?php echo $this->element('../Pages/footer2'); ?>
    </footer>
</body>
</html>