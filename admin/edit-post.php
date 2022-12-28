<?php
session_start();
include('includes/config.php');
error_reporting(0);
$postid = $_GET['pid'];
if ($_SESSION['role'] != 1) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];

        $mrp = $_POST['mrp'];
        $discount = $_POST['discount'];
        $price = ceil($mrp - $mrp * $discount / 100);
        $author = $_POST['author'];
        $decription = $_POST['description'];
        $available = $_POST['available'];
        $edition = $_POST['edition'];
        $language = $_POST['language'];
        $page = $_POST['page'];
        $publisher = $_POST['publisher'];
        $weight = $_POST['weight'];
        $query = mysqli_query($con, "update products set Title='$title',Category='$category',MRP='$mrp',Discount='$discount',Price='$price',Author='$author',Description='$decription',Available='$available',Edition='$edition',Language='$language',page='$page',Publisher='$publisher',weight='$weight' where PID='$postid'");
        if ($query) {
            $msg = "Post updated ";
        } else {
            $error = "Something went wrong . Please try again.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- App title -->
    <title>Newsportal | Add Post</title>

    <!-- Summernote css -->
    <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

    <!-- Select2 -->
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Jquery filer css -->
    <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
    <script src="assets/js/modernizr.min.js"></script>
    <script>

    </script>
</head>


<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <?php include('includes/topheader.php'); ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include('includes/leftsidebar.php'); ?>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <h4 class="page-title">Edit Post </h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="#">Admin</a>
                                    </li>
                                    <li>
                                        <a href="#"> Posts </a>
                                    </li>
                                    <li class="active">
                                        Add Post
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <!---Success Message--->
                            <?php if ($msg) { ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                            </div>
                            <?php } ?>

                            <!---Error Message--->
                            <?php if ($error) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                            </div>
                            <?php } ?>


                        </div>
                    </div>

                    <?php
                        $postid = $_GET['pid'];
                        $query = mysqli_query($con, "select * from products where PID='$postid' ");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="p-6">
                                <div class="">
                                    <form name="addpost" method="post">
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Tên sách</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['Title']); ?>" name="title"
                                                placeholder="Enter title" required>
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Thể loại</label>

                                            <select class="form-control" name="category" id="category"
                                                onChange="getSubCat(this.value);" required>
                                                <option value="<?php echo htmlentities($row['Category']); ?>">
                                                    <?php echo htmlentities($row['Category']); ?></option>
                                                <?php
                                                        // Feching active categories
                                                        $ret = mysqli_query($con, "select * from  tblcategory");
                                                        while ($result = mysqli_fetch_array($ret)) {
                                                        ?>
                                                <option value="<?php echo htmlentities($result['CategoryName']); ?>">
                                                    <?php echo htmlentities($result['CategoryName']); ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Tác giả</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['Author']); ?>" name="author"
                                                placeholder="Nhập tác giả" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Nhà xuất bản</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['Publisher']); ?>" name="publisher"
                                                placeholder="Nhập nhà xuất bản" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Lần tái bản</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['Edition']); ?>" name="edition"
                                                placeholder="Nhập lần tái bản" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Giá sách</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['Price']); ?>" name="mrp"
                                                placeholder="Nhập giá sách" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Khuyến mãi (%)</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['Discount']); ?>" name="discount"
                                                placeholder="Nhập giá sách" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Số lượng</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['Available']); ?>" name="available"
                                                placeholder="Nhập giá sách" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Số trang</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['page']); ?>" name="page"
                                                placeholder="Nhập giá sách" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Trọng lượng (gram)</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['weight']); ?>" name="weight"
                                                placeholder="Nhập giá sách" required>
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label for="exampleInputEmail1">Ngôn ngữ</label>
                                            <input type="text" class="form-control" id="posttitle"
                                                value="<?php echo htmlentities($row['Language']); ?>" name="language"
                                                placeholder="Nhập giá sách" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Mô tả</b></h4>
                                                    <textarea class="summernote" name="description"
                                                        required><?php echo htmlentities($row['Description']); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card-box">
                                                    <h4 class="m-b-30 m-t-0 header-title"><b>Ảnh bìa</b></h4>
                                                    <img src="../img/books/<?php echo htmlentities($postid) . '.jpg'; ?>"
                                                        width="300" />
                                                    <br />
                                                    <a href="change-image.php?pid=<?php echo htmlentities($postid); ?>">Update
                                                        Image</a>
                                                </div>
                                            </div>
                                        </div>

                                        <?php } ?>

                                        <button type="submit" name="update"
                                            class="btn btn-success waves-effect waves-light">Update </button>

                                </div>
                            </div> <!-- end p-20 -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->



                </div> <!-- container -->

            </div> <!-- content -->

            <?php include('includes/footer.php'); ?>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->



    <script>
    var resizefunc = [];
    </script>

    <!-- jQuery  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>
    <!-- Select 2 -->
    <script src="../plugins/select2/js/select2.min.js"></script>
    <!-- Jquery filer js -->
    <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>

    <!-- page specific js -->
    <script src="assets/pages/jquery.blog-add.init.js"></script>

    <!-- App js -->
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>

    <script>
    jQuery(document).ready(function() {

        $('.summernote').summernote({
            height: 240, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
        // Select2
        $(".select2").select2();

        $(".select2-limiting").select2({
            maximumSelectionLength: 2
        });
    });
    </script>
    <script src="../plugins/switchery/switchery.min.js"></script>

    <!--Summernote js-->
    <script src="../plugins/summernote/summernote.min.js"></script>



</body>

</html>
<?php } ?>