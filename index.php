<?php 
//To retrive all the records from the table and show on page
	//MySQLi-- mysql improved  -- allows to code in no procedure manner
	//or
	// PDO- php data objects -- uses objects

	//connect to database
include('config/db_connect.php');

	//write query for all pizzas
    $sql = 'SELECT title,ingredients,id FROM pizzas ORDER BY created_at'; //select from table

    //make query and get result
    //make connection and perform query
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as an array
     $pizzas = mysqli_fetch_all($result , MYSQLI_ASSOC);

     mysqli_free_result($result);

     //close connection
     mysqli_close($conn);

     //print_r($pizzas);
    

	//print_r(explode(',' , $pizzas[0]['ingredients'])); //splitting strings
	//explode(',' , $pizzas[0]['ingredients']);
?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>


	<h4 class="center grey-text">Pizzas!</h4>
	<div class="container">
		<div class="row">
			<?php foreach($pizzas as $pizza): ?>
				<!-- s -on small screen 6 col width and md - on medium screen 3 columns of width-->
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<!--add image-->
						<img src="img/pizza.svg" class="pizza" alt="">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<div>
							<ul>
							<?php foreach(explode(',' , $pizzas[0]['ingredients'])as $ing): ?>
								<li><?php echo htmlspecialchars($ing); ?></li>
							<?php endforeach ;?>
							</ul>
							</div>
						</div>
						<div class="card-action right-align">
						<a href="details.php?id=<?php echo $pizza['id'];?>" class="brand-text">more info</a>
                        </div>

					</div>
				</div>
			<?php endforeach ;?>
			<?php if(count($pizzas)>=3): ?>
				<p>there are 3 or more pizzas available</p>
			<?php  else: ?>
				<p>there are less than 3 pizzas available</p>
			<?php endif;?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>