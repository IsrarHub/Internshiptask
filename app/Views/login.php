<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
   <h1>Login</h1> 
  <?php 
   if(session()->getFlashdata('status')){
     echo "<h2>".session()->getFlashdata('status')."</h2>";
   }
  ?>


  <form action="<?= base_url('Login/login'); ?>" method="Post">
  <?php 
  echo form_input('email',  '', ['placeholder'=>'Email Address']);
  echo form_password('password', '',['placeholder'=>'password']);
  echo form_submit('login', 'Login');
  ?>
    
    </form>

   <h1>new! want to register?</h1>
   <a href="<?= base_url('Login/register')?>">Register here....</a>

</body>
</html>