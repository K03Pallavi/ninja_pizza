<?php 
    //isset() - function checks the value is set or not --here we have to check if data is send to the server not
    //$_GET--global array in php-- all the parameters(email,ingredients..) of data will be stored in server
    //if(isset($_GET['submit'])) 
    //{
    //    echo $_GET['email'];
    //    echo $_GET['title'];
    //    echo $_GET['ingredients'];
   // }

   	//connect to database
    include('config/db_connect.php');

    //initially they are empty strings
   $title = $email =$ingredients = '';
   //to show errors
   $errors =array('email' =>'', 'title'=>'', 'ingredients'=>'');

   if(isset($_POST['submit'])) 
    {

        //check email
        if(empty($_POST['email'])){
            $errors['emails']= 'An email is required <br />';
        }
        else{
            //email passed by post method
            $email = $_POST['email'];
            // Validate e-mail

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))//If email is invalid
            {
                $errors['emails']= 'email must be a valid address  <br />';

            }
           
        }

         //check title
         if(empty($_POST['title'])){
            $errors['title']=  'A title is required <br />';
        }
        else{
            $title = $_POST['title'];
            //RegEx--
            // ^  finds a match as the beggining of the string
            // $  finds a match at the end of the string
            if(!preg_match('/^[a-zA-Z\s]+$/',$title))
            {
                $errors['title']=  'title must be letters and spaces only  <br />';

            }
           
        }
 
         //check ingredients
         if(empty($_POST['ingredients'])){
            $errors['ingredients']=  'At lease one ingredient is required <br />';
        }
        else{
            $ingredients = $_POST['ingredients'];
            // s*  Matches any string that contains zero or more occurrences of space
            //If your expression needs to search for one of the special characters you can use a backslash ( \ ) to escape them
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients))
            {
                $errors['ingredients']= 'Ingredients must be separated by comma  <br />';

            }

        }

        //if there is error or not in form
        if(array_filter($errors)){
            //echo 'errors in the form';
        }
        else{
            // escape sql chars
            //legal sql string
            $email = mysqli_real_escape_string($conn, $_POST['email']); //overriding email variable
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            //create sql
            $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES ('$title','$email','$ingredients')";

            //save to db and check
            if(mysqli_query($conn,$sql)){
                //success
                 // echo 'form is valid';
           header('Location: index.php');
            }
            else{
                echo 'query error' . mysqli_error($conn);
            }

          
        }
    }
    //end of POST check


?>


 




<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>


    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>

        <form action="add.php" method="POST" class="white">

        <!--provide value to store the value updated by the user-->
            <label for="">Your Email:</label>
            <input type="text" name="email" value="<?php echo $email?>">

            <div class="red-text"><?php echo $errors['emails'] ?></div>

            <label for="">Pizza Title:</label>
            <input type="text" name="title" value="<?php echo $title?>" >

            <div class="red-text"><?php echo $errors['title'] ?></div>


            <label for="">Ingredients (comma separated):</label>
            <input type="text" name="ingredients"  value="<?php echo $ingredients?>">

            <div class="red-text"><?php echo $errors['ingredients'] ?></div>

            <div class="center">
                <input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>

</html> 