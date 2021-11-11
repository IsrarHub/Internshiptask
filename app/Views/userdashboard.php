
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User dashboard</title>
</head>
<body>

  <h1 style="text-align: right;"> <?= session()->get('email');?></h1>
  <h1 style="text-align: right;"> <a href="<?= base_url('User/logout')?>">Logout</a></h1>
<h2>Book Limit available for You:</h2>
 <h1> <?=session()->get('books_limits') ;
                  
 
   
   ?> </h1>

 <br>
 <?php 
   if(session()->getFlashdata('status')){
     echo "<h2>".session()->getFlashdata('status')."</h2>";
   }
  ?>
 <br>
 <h1>available Books</h1>
 <?php if(!empty($books)){ ?>
<table>
  <thead>
    <tr>
      <th>book id</th>
      <th>book_name</th>
      <th>Status</th>
      <th>Want to borrow</th>
    </tr>
  </thead>
  <tbody>
  
 <?php foreach($books as $book){?>

    <tr>
        <td><?php echo $book['book_id']?></td> 
        
        <td><?php echo $book['book_title']?></td> 
      <td>available</td>
      <td><a href="<?php echo base_url('User/borrow/'.$book['book_id'])?>">Borrow</a></td>
    </tr>

    <?php }?>
   </tbody>

   </table> <?php } else{
    ?> 
    <h1> No book availble to borrow</h1>
   <?php } ?>
 
<h1>Borrowed Books</h1>
<?php if(!empty($borrowed_books)){ ?>
<table>
  <thead>
    <tr>
      <th>book id</th>
      <th>book_name</th>
      <th>return book</th>
      
    </tr>
  </thead>
  <tbody>
 
  <?php foreach($borrowed_books as $bb){?>

    <tr>
        <td><?php echo $bb->book_id?></td> 
        
        <td><?php echo $bb->book_title?></td> 
        <td><a href="<?= base_url('User/sentback/'.$bb->book_id)?>">Return</a></td>
    </tr>
    </tbody>
    <?php } }
    else{
     ?>
     <h1> NO book borrowed</h1>
      
     
     <?php 
    }?>
  

</table>

</body>
</html>