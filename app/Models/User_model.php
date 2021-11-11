<?php  namespace App\Models;
use  CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class User_model extends Model
{  public $db;
  public function __construct(ConnectionInterface &$db)
  {
    $this->db=$db;
  }
 protected $table ='book_borrowed';
 protected $primaryKey='id';
  
 
 protected $allowedFields=['user_id','book_id'];

public function getBorrowedBooks($user_id){
  $builder=$this->db->table('book_borrowed');
  $builder->join('books',' book_borrowed.book_id= books.book_id');
  $builder->join('admin',' book_borrowed.user_id= admin.id');
  $builder->where('user_id',$user_id);
  $book=$builder->get()->getResult();
  return $book; 
}
public function updateLimit($data,$user_id){
  
  return $this->db->table('admin')
         ->where(['id'=>$user_id])
         ->update($data);
      }  
 public function updateBookStatus($data,$book_id){
  return $this->db->table('books')
         ->where(['book_id'=>$book_id])
         ->update($data);

      }
      public function deleteBorrowBook($user_id,$book_id){
     return $this->db->table('book_borrowed')
          ->where(['user_id'=>$user_id])
          ->where(['book_id'=>$book_id])
          ->delete();
   
     }
     
     public function getAvialbebooks(){
      return $this->db->table('books')
      ->where('book_status',1)
      ->get()->getResult();
     }
     
}