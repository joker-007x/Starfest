<?php 
require 'db_conn.php';
require_once 'publicevent_db.php';

session_start();

$e_id = $_GET['data1'];
echo $e_id;




$message1 = $e_id;
$_SESSION['firstMessage'] = $message1;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket Prices</title>
    <link rel="stylesheet" href="css1/style.css">
</head>
<body>


    <div class="main-section">
       <div class="add-section">
          <form action="app/add.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" 
                     name="ticket_price" 
                     style="border-color: #ff6666"
                     placeholder="This field is required" />

                     <input type="text" 
                     name="category" 
                     style="border-color: #ff6666"
                     placeholder="This field is required" />

                     <input type="text" 
                     name="quantity" 
                     style="border-color: #ff6666"
                     placeholder="This field is required" />

              <button type="submit">Add &nbsp; <span>&#43;</span></button>

             <?php }else{ ?>
              <input type="text" 
                     name="ticket_price" 
                     placeholder="Ticket prices?" />

                     <input type="text" 
                     name="category" 
                     placeholder="category      Eg:Gold,Platinum,Silver,Balcony" />

                     <input type="text" 
                     name="quantity" 
                     placeholder="quantity" />
              <button type="submit">Add &nbsp; <span>&#43;</span></button>
             <?php } ?>
          </form>
       </div>
       <?php



            
            // while($todo1 = $empty1->fetch(PDO::FETCH_ASSOC)) { 
                
            //     echo $todo1['count(empty)']; 

                             
             
    
          $todos = $conn->query("SELECT * FROM public_ticket_price where event_id= $e_id  ORDER BY ticket_price");
       ?>
       <div class="show-todo-section">
            <?php if($todos->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                        <!-- <img src="img/f.png" width="100%" />
                        <img src="img/Ellipsis.gif" width="80px"> -->
                    </div>
                </div>
            <?php } ?>

            <?php while($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $todo['id']; ?>"
                          class="remove-to-do">x</span>
                    <!-- <?php if($todo['checked']){ ?>  -->
                        <!-- <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               checked /> -->
                        <h2 class="checked"><?php echo $todo['ticket_price']; ?></h2>
                        
                    <!-- <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $todo['id']; ?>"
                               class="check-box" /> -->
                        <h2><?php echo "Category:"; echo $todo['category']; echo "<br>"; echo "Price:"; echo $todo['ticket_price'];echo "<br>"; echo "Quantity:";
                          echo $todo['quantity']?></h2>
                    <?php } ?> 
                    <br>
                    
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="js1/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/remove.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            // $(".check-box").click(function(e){
            //     const id = $(this).attr('data-todo-id');
                
            //     $.post('app/check.php', 
            //           {
            //               id: id
            //           },
            //           (data) => {
            //               if(data != 'error'){
            //                   const h2 = $(this).next();
            //                   if(data === '1'){
            //                       h2.removeClass('checked');
            //                   }else {
            //                       h2.addClass('checked');
            //                   }
            //               }
            //           }
            //     );
            // });
        });
    </script>




</body>
</html>