<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Book</title>
</head>
<body>
  <h2>Add new Book</h2>
  <form action="<?= base_url('admin/saveBook') ?>" method="POST">

   <input type="text" name="title" placeholder="Book Title">
   <input type="submit" name="save" value="Save Book">
</form>
</body>
</html>