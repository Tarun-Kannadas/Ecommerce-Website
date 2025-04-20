<?php
    session_start();
    
    include('includes/connect.php');
    
    if (isset($_SESSION['user_id'])) 
    {
        $user_id = $_SESSION['user_id'];
    
        // Query to fetch the user's image
        $img_query = "SELECT user_image FROM user_table WHERE user_id = $user_id";
        $img_result = mysqli_query($con, $img_query);
        $user_img_row = mysqli_fetch_assoc($img_result);
        $user_img = $user_img_row['user_image'];
    }

    if (isset($_POST['submit']))
    {
        $link = mysqli_connect("localhost", "root", "", "mystore");

        // Check connection
        if($link === false)
        {
            die("ERROR: Could not connect. ". mysqli_connect_error());
        }

        // Escape user inputs for security
        $un= mysqli_real_escape_string(
            $link, $_SESSION['user_id']);
        $m = mysqli_real_escape_string(
            $link, $_REQUEST['message_text']);
        date_default_timezone_set('Asia/Kolkata');
        $ts=date('d-m-y h:i A');

        // Attempt insert query execution
        $sql = "INSERT INTO messages (user_id, message_text, timestamp)
                VALUES ('$un', '$m', NOW())";
        if(mysqli_query($link, $sql))
        {
            ;
        } 
        else
        {
            echo "ERROR: Message not sent!!!";
        }
        // Close connection
        mysqli_close($link);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
?>
<html>
    <head>
        <!-- sweet alert js link -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- Bootstrap CSS link -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome CSS link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- css file -->
        <link rel ="stylesheet" href="styles.css">
        <link rel ="stylesheet" href="chatbot_styles.css">
    </head>
    <body onload="show_func()">
    <div class = "container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fw-bold bg-success">
            <!-- first child -->
            <div class="container-fluid">
                <img src="./Images/logo.png" alt="" class = "logo">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="build_pc.php">Build Your PC</a>
                        </li>
                        <?php
                            if(!isset($_SESSION['username'])) 
                            {
                                echo "<li class='nav-item'>
                                        <a class='nav-link text-light' href='./users_area/user_registration.php'>Register</a>
                                    </li>";
                            } 
                            else 
                            {
                                echo "<li class='nav-item'>
                                        <a class='nav-link text-light' href='./users_area/profile.php'>My Profile</a>
                                    </li>";
                            }
                        ?>
                    </ul>
                    <div class="d-flex justify-content-end">
                        <div class="ms-auto">
                            <img src="./users_area/user_images/<?php echo $user_img?>" alt="User Image" class = "user_img border-dark shadow-lg">
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <ul class="navbar-nav me-auto">
                <?php
                    if(!isset($_SESSION['username']))
                    {
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='#'> Welcome Guest </a>
                        </li>";
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='./users_area/user_login.php'> Login </a>
                        </li>";
                    }
                    else
                    {
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='#'> Welcome ".$_SESSION['username']." </a>
                        </li>";
                        echo "<li class = 'nav-item'>
                            <a class = 'nav-link text-light fw-bold' href='./users_area/logout.php'> Logout </a>
                        </li>";
                    }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center my-3">CREEDBOZ</h3>
            <p class="text-center mb-5">Acquiring and constructing a PC is an uncomplicated endeavor.</p>
        </div>
        <div id="container">
            <main>
            <header>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_star.png" alt="">
                <div>
                    <h2 class = "fw-bold">GROUP CHAT</h2>
                </div>
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/ico_star.png" alt="">
            </header>

        <script>
            function show_func()
            {

                var element = document.getElementById("chathist");
                element.scrollTop = element.scrollHeight;

            }
        </script>

        <form id="myform" action="" method="POST" >
            <div class="inner_div" id="chathist">
            <?php 
                global $con;

                $query = "SELECT messages.*, user_table.* 
                        FROM messages 
                        JOIN user_table ON messages.user_id = user_table.user_id";
                $run = $con->query($query); 
                $i=0;

                while($row = $run->fetch_array()) : 
                if($i==0){
                $i=5;
                $first=$row;
            ?>
            <div id="triangle1" class="triangle1"></div>
                <div id="message1" class="message1"> 
                    <span style="color:white;float:right; margin-bottom: 10px; padding-bottom: 10px;">
                        <?php echo $row['message_text']; ?>
                    </span> 
                    <br/>
                    <div>
                    <span style="color:black;float:left;font-size:10px;clear:both;">
                        <img src="./users_area/user_images/<?php echo $row['user_image']; ?>" alt="User Image" style="float: left; margin-right: 10px; border-radius: 50%; width: 30px; height: 30px;">
                        <?php echo $row['username']; ?>, 
                        <?php 
                            $timestamp = $row['timestamp'];
                            $date = date('d-m-Y', strtotime($row['timestamp']));
                            $time = date('H:i A', strtotime($row['timestamp']));
                            echo $date." ".$time; 
                        ?>
                    </span>
                </div>
            </div>
        <br/><br/>
        <?php
            }
            else
            {
                if($row['user_id']!=$first['user_id'])
                {
        ?>
                    <div id="triangle" class="triangle"></div>
                    <div id="message" class="message"> 
                        <span style="color:white;float:left; margin-bottom: 10px; padding-bottom: 10px;">
                            <?php echo $row['message_text']; ?>
                        </span> <br/>
                        <div>
                            <span style="color:black;float:right;font-size:10px;clear:both;">
                            <img src="./users_area/user_images/<?php echo $row['user_image']; ?>" alt="User Image" style="float: left; margin-right: 10px; border-radius: 50%; width: 30px; height: 30px;">
                                <?php echo $row['username']; ?>, 
                                <?php                             
                                    $timestamp = $row['timestamp'];
                                    $date = date('d-m-Y', strtotime($row['timestamp']));
                                    $time = date('H:i A', strtotime($row['timestamp']));
                                    echo $date." ".$time;  
                                ?>
                            </span>
                        </div>
                    </div>
                    <br/><br/>
        <?php
                } 
                else
                {
        ?>
                    <div id="triangle1" class="triangle1"></div>
                    <div id="message1" class="message1"> 
                        <span style="color:white;float:right; margin-bottom: 10px; padding-bottom: 10px;">
                            <?php echo $row['message_text']; ?>
                        </span> <br/>
                    <div>
                    <span style="color:black;float:left;
                            font-size:10px;clear:both;"> 
                    <img src="./users_area/user_images/<?php echo $row['user_image']; ?>" alt="User Image" style="float: left; margin-right: 10px; border-radius: 50%; width: 30px; height: 30px;">
                    <?php echo $row['username']; ?>, 
                        <?php
                            $timestamp = $row['timestamp'];
                            $date = date('d-m-Y', strtotime($row['timestamp']));
                            $time = date('H:i A', strtotime($row['timestamp']));
                            echo $date." ".$time; 
                        ?>
                    </span>
                    </div>
                    </div>
                    <br/><br/>
        <?php
                }
            }
            endwhile;
        ?>
        </div>
            <footer>
                <table>
                <tr>
                <th>
                    <input class="input1" type="text" id="user_id" name="user_id" placeholder="From" value = "<?php echo $_SESSION['username']; ?>">
                </th>
                <th>
                    <textarea id="message_text" name="message_text" rows='3' cols='50'placeholder="Type your message" required></textarea>
                </th>
                <th>
                    <input class="input2" type="submit" id="submit" name="submit" value="send">
                </th>			 
                </tr>
                </table>			 
            </footer>
        </form>
            </main> 
        </div>

        <!-- footer -->
        <br>
        <div class="bg-success p-3 text-light text-center">
            <p class="my-2"><strong>All Rights Reserved ©- Designed by CREEDBOZ-2024<strong></p>
        </div>
    </body>
</html>