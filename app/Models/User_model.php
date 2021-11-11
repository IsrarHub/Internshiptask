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

public function getBorrowedBooks(){
  $builder=$this->db->table('book_borrowed');
  $builder->join('books',' book_borrowed.book_id= books.book_id');
  $builder->join('admin',' book_borrowed.user_id= admin.id');
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
     public function allBooks(){
       return $this->db->table("books")->get()->getResult();

         }
         public function saveBook($data){
           return $this->db->table('books')->insert($data);
         }
         public function findbook($id){
          return $this->db->table('books')
          ->where(['book_id'=>$id])
          ->get()->getRow();
         }
         public function updateBook($id,$data){
          return $this->db->table('books')
          ->where(['book_id'=>$id])
          ->update($data);
         }
         public function deleteBook($id){
          return $this->db->table('books')
          ->where(['book_id'=>$id])
          ->delete();
         }
         public function getAllBooks(){
          return $this->db->table('books')->get()->getResult();
        }
}