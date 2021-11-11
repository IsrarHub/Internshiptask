<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  <h1>Register here</h1>
  <?= form_open('/Login/register')?>
   <input type="email" name="email" placeholder="Enter Email">
   <br>
   <br>
   <input type="password" name="password" placeholder="Enter Password">
   <br><br>
   <input type="submit" name="submit" value="Regsiter">
  <?= form_close()?>
</body>
</html>