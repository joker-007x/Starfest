<?php require_once('connection.php'); ?>

<?php
session_start();
?>

<?php
require_once('vendor/autoload.php');
// $id = $_GET['id'];

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey('sk_test_51Ho62uJixMHAqmvGxoc5jdNsJJWWDZk0sXHldeA6jGHV84rPlemuBinak6I6IKUycnf48rOKHGkf6k1JxPu2dF2600I8YkHRJT');

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

//sanitize POST array
$receiver = $POST['receiver'];
$purpose = $POST['purpose'];
$email = $POST['email'];
$amount = $POST['amount'];
$token = $POST['stripeToken'];
$doc_id2 = $_SESSION['doc_id5'];
$even_id2 = $_SESSION['event_id5'];


$token = $_POST['stripeToken'];
$customer = \Stripe\customer::create([
  "email" => $email,
  "source" => $token
]);

$charge = \Stripe\Charge::create([
  "amount" => $amount,
  "currency" => "usd",
  "description" => $purpose,
  "customer" => $customer->id
]);


$query2 = "SELECT * FROM document where docid=$doc_id2 AND event_id=$even_id2";
$result_set2 = mysqli_query($connection, $query2);
$record2 = mysqli_fetch_assoc($result_set2);
$sp_id = $record2['sender_userid'];
$eo_id = $record2['reciever_userid'];

$sql = "INSERT INTO payment (amount, event_id, eo_id, sp_id)
    values ('$amount','$even_id2','$eo_id','$sp_id')";
$connection->query($sql);

$_SESSION['doc_id5'] = NULL;
$_SESSION['event_id5'] = NULL;



//redirect to success
header('Location: ./db/success.php');

?>
<?php mysqli_close($connection); ?>
  