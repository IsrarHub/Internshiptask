<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit</title>
</head>
<body>
  <h2>Edit Book</h2>
  <form action="<?= base_url('admin/saveEdit/'.$book['book_id'])?>" method="Post">
  <input type="hidden" name="method" value="PUT" >
    <input type="text" name="title" value="<?= $book['book_title'];?>">
    <input type="submit" value="Update">

  </form>
</body>
</html>