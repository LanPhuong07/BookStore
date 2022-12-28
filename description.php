<?php
session_start();
include "dbconnect.php";
if (!isset($_SESSION['user']))
    header("location: index.php?Message=Login To Continue");
if (isset($_POST['rating']) && isset($_POST['keyword'])) {
    $rating = $_POST['rating'];
    $keyword = $_POST['keyword'];
    $PID = $_GET['ID'];
    $user = $_SESSION['user'];
    $sql = "INSERT INTO review (PID,username,rating,review,time) VALUES ('$PID','$user','$rating','$keyword',NOW())";
    $result = mysqli_query($con, $sql);
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
    <title> Online Bookstore</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <link rel='stylesheet'
        href='https://raw.githubusercontent.com/kartik-v/bootstrap-star-rating/master/css/star-rating.min.css'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
    <script src=rating.js></script>
    <style>
    @media only screen and (width: 768px) {
        body {
            margin-top: 150px;
        }
    }

    @media only screen and (max-width: 760px) {
        #books .row {
            margin-top: 10px;
        }
    }

    .tag {
        display: inline;
        float: left;
        padding: 2px 5px;
        width: auto;
        background: #F5A623;
        color: #fff;
        height: 23px;
    }

    .tag-side {
        display: inline;
        float: left;
    }

    #books {
        border: 1px solid #DEEAEE;
        margin-bottom: 20px;
        padding-top: 30px;
        padding-bottom: 20px;
        background: #fff;
        margin-left: 10%;
        margin-right: 10%;
    }

    #description {
        border: 1px solid #DEEAEE;
        margin-bottom: 20px;
        padding: 20px 50px;
        background: #fff;
        margin-left: 10%;
        margin-right: 10%;
    }

    #description hr {
        margin: auto;
    }

    #service {
        background: #fff;
        padding: 20px 10px;
        width: 112%;
        margin-left: -6%;
        margin-right: -6%;
    }

    .glyphicon {
        color: #D67B22;
    }

    .checked {
        color: orange;
    }

    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    /*reset css*/
    div,
    label {
        margin: 0;
        padding: 0;
    }

    body {
        margin: 20px;
    }

    h1 {
        font-size: 1.5em;
        margin: 10px;
    }

    /****** Style Star Rating Widget *****/
    #rating {
        border: none;
        float: left;
    }

    #rating>input {
        display: none;
    }

    /*ẩn input radio - vì chúng ta đã có label là GUI*/
    #rating>label:before {
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }

    /*1 ngôi sao*/
    #rating>.half:before {
        content: "\f089";
        position: absolute;
    }

    /*0.5 ngôi sao*/
    #rating>label {
        color: #ddd;
        float: right;
    }

    /*float:right để lật ngược các ngôi sao lại đúng theo thứ tự trong thực tế*/
    /*thêm màu cho sao đã chọn và các ngôi sao phía trước*/
    #rating>input:checked~label,
    #rating:not(:checked)>label:hover,
    #rating:not(:checked)>label:hover~label {
        color: #FFD700;
    }

    /* Hover vào các sao phía trước ngôi sao đã chọn*/
    #rating>input:checked+label:hover,
    #rating>input:checked~label:hover,
    #rating>label:hover~input:checked~label,
    #rating>input:checked~label:hover~label {
        color: #FFED85;
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
                <a class="navbar-brand" href="index.php"><img alt="Brand" src="img/logo.jpg"
                        style="width: 118px;margin-top: -7px;margin-left: -10px;"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '
                    <li><a href="cart.php" class="btn btn-md"><span class="glyphicon glyphicon-shopping-cart">Giỏ hàng</span></a></li>
                    <li><a href="destroy.php" class="btn btn-md"> <span class="glyphicon glyphicon-log-out">Đăng xuất</span></a></li>
                         ';
                    }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div id="top">
        <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;"><br><br>
            <div>
                <form role="search" action="Result.php" method="post">
                    <input type="text" name="keyword" class="form-control" placeholder=""
                        style="width:80%;margin:20px 10% 20px 10%;">
                </form>
            </div>
        </div>
    </div>


    <?php

    $PID = $_GET['ID'];
    $query = "SELECT * FROM products WHERE PID='$PID'";
    $result = mysqli_query($con, $query) or die();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $path = "img/books/" . $row['PID'] . ".jpg";
            $target = "cart.php?ID=" . $PID . "&";
            echo '
  <div class="container-fluid" id="books">
    <div class="row">
      <div class="col-sm-10 col-md-6">
                          <div class="tag">' . $row["Discount"] . '%OFF</div>
                              <div class="tag-side"><img src="img/orange-flag.png">
                          </div>
                         <img class="center-block img-responsive" src="' . $path . '" height="550px" style="padding:20px;">
      </div>
      <div class="col-sm-10 col-md-4 col-md-offset-1">
        <h2> ' . $row["Title"] . '</h2>
                                <span style="color:#00B9F5;">
                                 #' . $row["Author"] . '&nbsp &nbsp #' . $row["Publisher"] . '
                                </span>
        <hr>            
                                <span style="font-weight:bold;"> Quantity : </span>';
            echo '<select id="quantity">';
            for ($i = 1; $i <= $row['Available']; $i++)
                echo '<option value="' . $i . '">' . $i . '</option>';
            echo ' </select>';
            echo '                           <br><br><br>
                                <a id="buyLink" href="' . $target . '" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;"> 
                                    Thêm vào giỏ hàng ' . $row["Price"] . ' <br>
                                    <span style="text-decoration:line-through;"> VND' . $row["MRP"] . '</span> 
                                    | ' . $row["Discount"] . '% discount
                                 </a> 

      </div>
    </div>
          </div>
     ';
            // Description
            echo '
          <div class="container-fluid" id="description">
    <div class="row">
      <h2>Mô tả</h2> 
                        <p>' . $row['Description'] . '</p>
                        <pre style="background:inherit;border:none;">
   Mã sách        ' . $row["PID"] . '   <hr> 
   Tiêu đề        ' . $row["Title"] . ' <hr> 
   Tác giả        ' . $row["Author"] . ' <hr>
   Còn lại        ' . $row["Available"] . ' <hr> 
   Nhà xuất bản   ' . $row["Publisher"] . ' <hr> 
   Tái bản        ' . $row["Edition"] . ' <hr>
   Ngôn ngữ       ' . $row["Language"] . ' <hr>
   Số trang       ' . $row["page"] . ' <hr>
   Khối lượng     ' . $row["weight"] . ' <hr>
                        </pre>
    </div>
  </div>
';
            echo '
<div class="container-fluid" id="description">
    <div class="row">
    <h2>Đánh giá</h2> 
      </div>
      <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST" id="review" >
      <div class="star-rating">
      <div id="rating">
    <input type="radio" id="star5" name="rating" value="5" />
    <label class = "full" for="star5" title="Awesome - 5 stars"></label>
 
    <input type="radio" id="star4" name="rating" value="4" />
    <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
 
    <input type="radio" id="star3" name="rating" value="3" />
    <label class = "full" for="star3" title="Meh - 3 stars"></label>
 
    <input type="radio" id="star2" name="rating" value="2" />
    <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
 
    <input type="radio" id="star1" name="rating" value="1" />
    <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
</div>
<input type="text" name="keyword" class="form-control" placeholder="Đánh giá tác phẩm" style="width:80%;margin:20px 10% 20px 10%;">
          <div class="btn">
          <a href="javascript:{}" onclick="document.getElementById(\'review\').submit();" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;"> 
          Gửi đánh giá
          </a>
          </div>
        </form>
      </div>
    </div>
';

            // Reviews
            $query = mysqli_query($con, "SELECT AVG(rating) as AVGRATE from review WHERE PID =  '$PID'");
            $row = mysqli_fetch_array($query);
            $AVGRATE = $row['AVGRATE'];
            $rating = mysqli_query($con, "SELECT count(*) as Total,rating from review WHERE PID =  '$PID' group by rating order by rating desc"); ?>

    <div class="container-fluid" id="description">

        <div class="col-md-6">
            <h3 align="center"><b><?php echo round($AVGRATE, 1); ?></b> <i class="fa fa-star" data-rating="2"
                    style="font-size:20px;color:#ff9f00;"></i></h3>

        </div>
        <div class="col-md-6">
            <?php
                    while ($db_rating = mysqli_fetch_array($rating)) {
                    ?>
            <h4 align="center"><?= $db_rating['rating']; ?> <i class="fa fa-star" data-rating="2"
                    style="font-size:20px;color:#ff9f00;"></i> Total <?= $db_rating['Total']; ?></h4>


            <?php
                    }

                    ?>
        </div>
    </div>
    <?php
            $sql = "SELECT * FROM review WHERE PID =  '$PID' ORDER BY Time DESC";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
<div class="container-fluid" id="description">
    <div class="row">
    <h2>Đánh giá</h2> 
      </div>
      ' . $row['rating'] . '<i class="fa fa-star" data-rating="2" style="font-size:20px;color:#ff9f00;"></i> by ' . $row['UserName'] . '
      <h4>' . $row['review'] . '</h4>
    </div>
';
                }
            }
        }
    }
    echo '</div>';
    ?>
    <div class="container-fluid" id="service">
        <div class="row">
            <div class="col-sm-6 col-md-3 text-center">
                <span class="glyphicon glyphicon-heart"></span> <br>
                PTIT<br>
                Khoan An toàn thông tin
            </div>
            <div class="col-sm-6 col-md-3 text-center">
                <span class="glyphicon glyphicon-heart"></span> <br>
                Lập trình web <br>
                Giảng viên: Nguyễn Hải Dũng
            </div>
            <div class="col-sm-6 col-md-3 text-center">
                <span class="glyphicon glyphicon-ok"></span> <br>
                Sinh viên <br>
                Vũ Lan Phương - B19DCAT142
            </div>
            <div class="col-sm-6 col-md-3 text-center">
                <span class="glyphicon glyphicon-check"></span> <br>
                Bài tập lớn 2 <br>
                Cửa hàng sách
            </div>
        </div>
    </div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script>
    $(function() {
        var link = $('#buyLink').attr('href');
        $('#buyLink').attr('href', link + 'quantity=' + $('#quantity option:selected').val());
        $('#quantity').on('change', function() {
            $('#buyLink').attr('href', link + 'quantity=' + $('#quantity option:selected').val());
        });
    });
    </script>
</body>

</html>