<?php
session_start();
include "dbconnect.php";
if (isset($_GET['Message'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "login") {
        $username = $_POST['login_username'];
        $password = $_POST['login_password'];
        $query = "SELECT * from users where UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con, $query) or die();
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user'] = $row['UserName'];
            $_SESSION['role'] = $row['Role'];
            print '
                <script type="text/javascript">alert("successfully logged in!!!");</script>
                  ';
        } else {
            print '
              <script type="text/javascript">alert("Incorrect Username Or Password!!");</script>
                  ';
        }
    } else if ($_POST['submit'] == "register") {
        $username = $_POST['register_username'];
        $password = $_POST['register_password'];
        $query = "select * from users where UserName = '$username'";
        $result = mysqli_query($con, $query) or die();
        if (mysqli_num_rows($result) > 0) {
            print '
               <script type="text/javascript">alert("username is taken");</script>
                    ';
        } else {
            $query = "INSERT INTO users VALUES ('$username','$password')";
            $result = mysqli_query($con, $query);
            print '
                <script type="text/javascript">
                 alert("Successfully Registered!!!");
                </script>
               ';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Shivangi Gupta">
    <title>Online Bookstore</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
    .modal-header {
        background: #D67B22;
        color: #fff;
        font-weight: 800;
    }

    .modal-body {
        font-weight: 800;
    }

    .modal-body ul {
        list-style: none;
    }

    .modal .btn {
        background: #D67B22;
        color: #fff;
    }

    .modal a {
        color: #D67B22;
    }

    .modal-backdrop {
        position: inherit !important;
    }

    #login_button,
    #register_button {
        background: none;
        color: #D67B22 !important;
    }

    #query_button {
        position: fixed;
        right: 0px;
        bottom: 0px;
        padding: 10px 80px;
        background-color: #D67B22;
        color: #fff;
        border-color: #f05f40;
        border-radius: 2px;
    }

    @media(max-width:767px) {
        #query_button {
            padding: 5px 20px;
        }
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="padding: 1px;"><img class="img-responsive" alt="Brand"
                        src="img/logo.jpg" style="width: 147px;margin: 0px;"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (!isset($_SESSION['user'])) {
                        echo '
            <li>
                <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Login</button>
                  <div id="login" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Login Form</h4>
                            </div>
                            <div class="modal-body">
                                          <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                              <div class="form-group">
                                                  <label class="sr-only" for="username">Username</label>
                                                  <input type="text" name="login_username" class="form-control" placeholder="Username" required>
                                              </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="password">Password</label>
                                                  <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" name="submit" value="login" class="btn btn-block">
                                                      Sign in
                                                  </button>
                                              </div>
                                          </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                  </div>
            </li>
            <li>
              <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Sign Up</button>
                <div id="register" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title text-center">Member Registration Form</h4>
                          </div>
                          <div class="modal-body">
                                        <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="username">Username</label>
                                                <input type="text" name="register_username" class="form-control" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="fullname">Full Name</label>
                                                <input type="text" name="register_fullname" class="form-control"  placeholder="FullName" required>
                                            </div>
                                            <div class="form-group">
                                            <label class="sr-only" for="gender">Gender</label>
                                                <select id="gender" name="register_gender" class="form-control">
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="dob">Day of Birth</label>
                                                <input type="date" name="register_dob" class="form-control"  placeholder="Day of Birth" required>
                                            </div>
                                            div class="form-group">
                                                <label class="sr-only" for="email">Email</label>
                                                <input type="email" name="register_email" class="form-control"  placeholder="Email" required>
                                            </div>
                                            div class="form-group">
                                                <label class="sr-only" for="address">Address</label>
                                                <input type="text" name="register_address" class="form-control"  placeholder="Address" required>
                                            </div>
                                            div class="form-group">
                                                <label class="sr-only" for="phonenumber">Phone Number</label>
                                                <input type="number" name="register_phonenumber" class="form-control"  placeholder="Phone Number" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="register" class="btn btn-block">
                                                    Sign Up
                                                </button>
                                            </div>
                                        </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                  </div>
                </div>
            </li>';
                    } else {
                        echo ' 
            // <li> <a href="#" class="btn btn-lg"> Hello ' . $_SESSION['user'] . '.</a></li>
                    <li> <a href="cart.php" class="btn btn-lg">Gi??? h??ng</a> </li>; 
                    <li> <a href="destroy.php" class="btn btn-lg">????ng xu???t</a> </li>';
                    }
                    ?>

                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div id="top">
        <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
            <div>
                <form role="search" method="POST" action="Result.php">
                    <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;"
                        placeholder="T??m ki???m theo t??n s??ch, t??c gi???, ho???c danh m???c">
                </form>
            </div>
        </div>

        <div class="container-fluid" id="header">
            <div class="row">
                <div class="col-md-3 col-lg-3" id="category">
                    <div style="background:#D67B22;color:#fff;font-weight:800;border:none;padding:15px;">DANH M???C S??CH
                    </div>
                    <ul>
                        <li> <a href="Product.php?value=entrance%20exam"> Entrance Exam </a> </li>
                        <li> <a href="Product.php?value=Literature%20and%20Fiction"> Literature & Fiction </a> </li>
                        <li> <a href="Product.php?value=Academic%20and%20Professional"> Academic & Professional </a>
                        </li>
                        <li> <a href="Product.php?value=Biographies%20and%20Auto%20Biographies"> Biographies & Auto
                                Biographies </a> </li>
                        <li> <a href="Product.php?value=Children%20and%20Teens"> Children & Teens </a> </li>
                        <li> <a href="Product.php?value=Regional%20Books"> Regional Books </a> </li>
                        <li> <a href="Product.php?value=Business%20and%20Management"> Business & Management </a> </li>
                        <li> <a href="Product.php?value=Health%20and%20Cooking"> Health and Cooking </a> </li>

                    </ul>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                            <li data-target="#myCarousel" data-slide-to="5"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img class="img-responsive" src="img/carousel/1.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive " src="img/carousel/2.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive" src="img/carousel/3.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive" src="img/carousel/4.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive" src="img/carousel/5.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive" src="img/carousel/6.jpg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3" id="offer">
                    <a href="Product.php?value=Regional%20Books"> <img class="img-responsive center-block"
                            src="img/offers/1.png"></a>
                    <a href="Product.php?value=Health%20and%20Cooking"> <img class="img-responsive center-block"
                            src="img/offers/2.png"></a>
                    <a href="Product.php?value=Academic%20and%20Professional"> <img class="img-responsive center-block"
                            src="img/offers/3.png"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center" id="new">
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="description.php?ID=NEW-1&category=new">
                    <div class="book-block">
                        <div class="tag">M???i</div>
                        <div class="tag-side"><img src="img/tag.png"></div>
                        <img class="book block-center img-responsive" src="img/new/1.jpg">
                        <hr>
                        Like A Love Song <br>
                        VND 113 &nbsp
                        <span style="text-decoration:line-through;color:#828282;"> 175 </span>
                        <span class="label label-warning">35%</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="description.php?ID=NEW-2&category=new">
                    <div class="book-block">
                        <div class="tag">M???i</div>
                        <div class="tag-side"><img src="img/tag.png"></div>
                        <img class="block-center img-responsive" src="img/new/2.jpg">
                        <hr>
                        General Knowledge 2017 <br>
                        VND 68 &nbsp
                        <span style="text-decoration:line-through;color:#828282;"> 120 </span>
                        <span class="label label-warning">43%</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="description.php?ID=NEW-3&category=new">
                    <div class="book-block">
                        <div class="tag">M???i</div>
                        <div class="tag-side"><img src="img/tag.png"></div>
                        <img class="block-center img-responsive" src="img/new/3.png">
                        <hr>
                        Indian Family Bussiness Mantras <br>
                        VND 400 &nbsp
                        <span style="text-decoration:line-through;color:#828282;"> 595 </span>
                        <span class="label label-warning">33%</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="description.php?ID=NEW-4&category=new">
                    <div class="book-block">
                        <div class="tag">M???i</div>
                        <div class="tag-side"><img src="img/tag.png"></div>
                        <img class="block-center img-responsive" src="img/new/4.jpg">
                        <hr>
                        Kiran s SSC Mathematics Chapterwise Solutions <br>
                        VND 289 &nbsp
                        <span style="text-decoration:line-through;color:#828282;"> 435 </span>
                        <span class="label label-warning">33%</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="author">
        <h3 style="color:#D67B22;">NH???NG T??C GI??? N???I TI???NG</h3>
        <div class="row">
            <div class="col-sm-5 col-md-3 col-lg-3">
                <a href="Author.php?value=Durjoy%20Datta"><img class="img-responsive center-block"
                        src="img/popular-author/0.jpg"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Chetan%20Bhagat"><img class="img-responsive center-block"
                        src="img/popular-author/1.jpg"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Dan%20Brown"><img class="img-responsive center-block"
                        src="img/popular-author/2.jpg"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Ravinder%20Singh"><img class="img-responsive center-block"
                        src="img/popular-author/3.jpg"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-3 col-lg-3">
                <a href="Author.php?value=Jeffrey%20Archer"><img class="img-responsive center-block"
                        src="img/popular-author/4.jpg"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Salman%20Rushdie"><img class="img-responsive center-block"
                        src="img/popular-author/5.jpg"><a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=J%20K%20Rowling"><img class="img-responsive center-block"
                        src="img/popular-author/6.jpg"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Subrata%20Roy"><img class="img-responsive center-block"
                        src="img/popular-author/7.jpg"></a>
            </div>
        </div>
    </div>

    <footer style="margin-left:-6%;margin-right:-6%;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-1">
                </div>
                <div class="col-sm-7 col-md-5 col-lg-5">
                    <div class="row text-center">
                        <h2>Book Bird</h2>
                        <hr class="primary">
                        <p>Ch???p c??ch cho hy v???ng, bay l??n nh???ng ?????c m??</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <span class="glyphicon glyphicon-earphone"></span>
                            <p>123-456-6789</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <span class="glyphicon glyphicon-envelope"></span>
                            <p>chiryu.vu@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="hidden-sm-down col-md-2 col-lg-2">
                </div>
                <div class="col-sm-4 col-md-3 col-lg-3 text-center">
                    <h2 style="color:#D67B22;">Follow Us At</h2>
                    <div>
                        <a href="https://twitter.com/strandbookstore">
                            <img title="Twitter" alt="Twitter" src="img/social/twitter.png" width="35" height="35" />
                        </a>
                        <a href="https://www.linkedin.com/company/strand-book-store">
                            <img title="LinkedIn" alt="LinkedIn" src="img/social/linkedin.png" width="35" height="35" />
                        </a>
                        <a href="https://www.facebook.com/strandbookstore/">
                            <img title="Facebook" alt="Facebook" src="img/social/facebook.png" width="35" height="35" />
                        </a>
                        <a href="https://plus.google.com/111917722383378485041">
                            <img title="google+" alt="google+" src="img/social/google.jpg" width="35" height="35" />
                        </a>
                        <a href="https://www.pinterest.com/strandbookstore/">
                            <img title="Pinterest" alt="Pinterest" src="img/social/pinterest.jpg" width="35"
                                height="35" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>