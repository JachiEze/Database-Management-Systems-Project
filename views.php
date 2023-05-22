<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>views</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Views</h3>
   <p> <a href="home.php">home</a> / orders </p>
</div>

<section class="placed-orders">

   <h1 class="title"> 
      <form method="POST" action="">
         <select name="view" id="viewOption" onchange="this.form.submit()">
            <option value="0">Select a view</option>
            <option value="1">View 1</option>
            <option value="2">View 2</option>
            <option value="3">View 3</option>
            <option value="4">View 4</option>
            <option value="5">View 5</option>
            <option value="6">View 6</option>
            <option value="7">View 7</option>
            <option value="8">View 8</option>
            <option value="9">View 9</option>
            <option value="10">View 10</option>
         </select>
      </form> 

   </h1>
   <div class="box-container">
      <?php

         if(isset($_POST["view"])){
            $view=$_POST["view"];
            //echo "<p> View is a view </p>";
            if($view == "1"){
               $query = mysqli_query($real_conn, "SELECT games.game_name, developer.developer_name, publisher.publisher_name FROM games, developer, publisher WHERE games.pub_id = publisher.publisher_id and games.dev_id = developer.developer_id;");
               if(mysqli_num_rows($query) > 0 ){
                  while($fetch_query = mysqli_fetch_assoc($query)){
                  ?>
                     <div class="box">
                        <p> Name: <span><?php echo $fetch_query['game_name']; ?></span> </p>
                        <p> Developer : <span><?php echo $fetch_query['developer_name']; ?></span> </p>
                        <p> Publisher : <span><?php echo $fetch_query['publisher_name']; ?></span> </p>
                     </div>
                  <?php
                  }
               }
            }else if($view == "2"){
               $query = mysqli_query($real_conn, "SELECT games.game_id, COUNT(*) FROM games WHERE games.age_rating > 13 AND games.game_id IN (SELECT games.game_id FROM games GROUP BY games_id HAVING COUNT (*) > 5) GROUP BY games.game_id;");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> Game ID: <span><?php echo $fetch_query['game_id']; ?></span> </p>
                        <p> Count: <span><?php echo $fetch_query['count']; ?></span> </p>
                     </div>
               <?php
               }
            }else if($view == "3"){
               $query = mysqli_query($real_conn, "SELECT * FROM users AS u WHERE birthdate < (SELECT MAX(birthdate) FROM users WHERE u.username = username");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> User ID: <span><?php echo $fetch_query['user_id']; ?></span> </p>
                        <p> Username: <span><?php echo $fetch_query['username']; ?></span> </p>
                        <p> Birthdate: <span><?php echo $fetch_query['birthdate']; ?></span> </p>
                        <p> Country: <span><?php echo $fetch_query['country']; ?></span> </p>
                     </div>
               <?php
               }
            }else if($view == "4"){
               $query = mysqli_query($real_conn, "SELECT users.last_name, subscription.sub_status FROM users FULL JOIN subscription ON users.sub_id=subscription.sub_id ORDER BY users.last_name");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> Last name <span><?php echo $fetch_query['last_name']; ?></span> </p>
                        <p> Sub status: <span><?php echo $fetch_query['sub_status']; ?></span> </p>
                     </div>
               <?php
               }
            }else if($view == "5"){
               $query = mysqli_query($real_conn, "SELECT developer.developer_id FROM developer UNION SELECT games.dev_id FROM games ORDER BY developer_id");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> Developer ID: <span><?php echo $fetch_query['developer_id']; ?></span> </p>
                     </div>
               <?php
               }
            }else if($view == "6"){
               $query = mysqli_query($real_conn, "SELECT DISTINCT games.pub_id FROM games");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> Publisher ID: <span><?php echo $fetch_query['pub_id']; ?></span> </p>
                     </div>
               <?php
               }
            }else if($view == "7"){
               $query = mysqli_query($real_conn, "SELECT * FROM subscriptions WHERE subscriptions.sub_status=0");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> Sub ID: <span><?php echo $fetch_query['sub_id']; ?></span> </p>
                        <p> Sub status: <span><?php echo $fetch_query['sub_status']; ?></span> </p>
                        <p> sub_start: <span><?php echo $fetch_query['sub_start']; ?></span> </p>
                        <p> sub_end: <span><?php echo $fetch_query['sub_end']; ?></span> </p>
                     </div>
               <?php
               }
            }
            else if($view == "8"){
               $query = mysqli_query($real_conn, "SELECT * FROM users LIMIT 3");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> User ID: <span><?php echo $fetch_query['user_id']; ?></span> </p>
                        <p> Username: <span><?php echo $fetch_query['username']; ?></span> </p>
                        <p> Birthdate: <span><?php echo $fetch_query['birthdate']; ?></span> </p>
                        <p> Country: <span><?php echo $fetch_query['country']; ?></span> </p>
                     </div>
               <?php
               }
            }
            else if($view == "9"){
               $query = mysqli_query($real_conn, "SELECT * FROM publisher WHERE publisher.publisher_id LIKE 'M%'");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> Publisher ID: <span><?php echo $fetch_query['publisher_id']; ?></span> </p>
                        <p> Publisher name: <span><?php echo $fetch_query['publisher_name']; ?></span> </p>
                     </div>
               <?php
               }
            }
            else if($view == "10"){
               $query = mysqli_query($real_conn, "SELECT * FROM games WHERE games.release_date BETWEEN '2016-02-26' AND '2021-09-15'");
               while($fetch_query = mysqli_fetch_assoc($query)){
               ?>
                  <div class="box">
                        <p> Game ID: <span><?php echo $fetch_query['game_id']; ?></span> </p>
                        <p> Game name: <span><?php echo $fetch_query['game_name']; ?></span> </p>
                        <p> Age rating: <span><?php echo $fetch_query['age_rating']; ?></span> </p>
                        <p> Release date: <span><?php echo $fetch_query['release_date']; ?></span> </p>
                     </div>
               <?php
               }
            }
         }
      ?>
   </div>

</section>
<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>