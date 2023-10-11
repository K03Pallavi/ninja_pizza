<?php 

session_start();

//$_SESSION['name'] = 'mario';

if($_SERVER['QUERY_STRING'] == 'noname'){
  //unset($_SESSION['name']);
  session_unset();
}

//this name or this
//if there is no name it will say hello guest
$name = $_SESSION['name'] ?? 'Guest';
    
//get cookie
$gender = $_COOKIE['gender'] ?? 'unknown';
?>



<head>
    <title>Ninja Pizza</title>
    <!-- Compiled and minified CSS -->
    <!--this cdn link is for the whole page you dont have to include it in every file-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--to add more importance to a property/value than normal. In fact, if you use the !important rule, it will override ALL previous styling rules for that specific property on that element!-->
    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }
        .brand-text{
            color: #cbb09c !important;
        }

        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
        .pizza{
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position: relative;
            top: -30px;

        }
    </style>
</head>

<body class="grey lighten-4">
    <!--z-depth-0= takes away the deop shadow-->
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Ninja Pizza</a>
            <!--responsive-->
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li class="grey-text">Hello <?php echo htmlspecialchars($name); ?></li>
                <li class="grey-text">(<?php echo htmlspecialchars($gender); ?>)</li>

                <li><a href="add.php" class="btn brand z-dept-0">Add a Pizza</a></li>
            </ul>
        </div>
    </nav>

    
