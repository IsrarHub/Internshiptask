<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <center><a href="<?= base_url('admin/add_book');?>"> Add New Book</a></center>
  <h1>Total Books</h1>

  <?php 
   if(session()->getFlashdata('status')){
     echo "<h2>".session()->getFlashdata('status')."</h2>";
   }
  ?>
<table>
  <thead>
    <tr>
      <th>book id</th>
      <th>book_name</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($books as $book):?>
      
    <tr>
     <td><?=  $book['book_id']?></td>
     <td><?=  $book['book_title']?></td>
     <?php if($book['book_status']!= 1){?>
      <td>Taken</td>
     <?php }
     else{?>

     <td>available</td>
     <?php }?>
     <td><a href="<?= base_url('admin/edit/'.$book['book_id'])?>">Edit</a></td>
     <td><a href="<?= base_url('admin/delete/'.$book['book_id'])?>">Delete</a></td>
    </tr>
   <?php endforeach ?>
  </tbody>

</table>


</body>
</html>