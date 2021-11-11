<?php  namespace App\Models;
use  CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
class Admin_model extends Model
{
  public $db;
  public function __construct(ConnectionInterface &$db)
  {
    $this->db=$db;
  }
 protected $table ='books';
 protected $primaryKey='book_id';
  
 //protected $allowedFields=['book_title','book_status'];

 public function findUSer($id){
  return $this->db->table('admin')
     ->where(['id'=>$id])
     ->get()->getR;

  
 }
 public function saveBook($data){
  return $this->db->table('books')->insert($data);
}

 public function getAllBooks(){
   return $this->db->table('books')->get()->getResult();
 }
 public function getBook($id){
   return $this->db->table('books')
   ->where('book_id',$id)
   ->get()->getRow();
 }
 public function availableBooks(){
   return $this->db->table('books')
   ->where('book_status',1)
   ->get()->getResult();
 }
 public function getBorrowedBooks(){
  $builder=$this->db->table('book_borrowed');
  $builder->select('book_borrowed.id, book_borrowed.user_id,book_borrowed.book_id,books.book_title,admin.email'); 
  $builder->join('books',' book_borrowed.book_id= books.book_id');
  $builder->join('admin',' book_borrowed.user_id= admin.id');
  
  
  $book=$builder->get()->getResult();
  return $book; 
}
 public function updateBook($id,$data){
  return $this->db->table('books')
  ->where(['book_id'=>$id])
  ->update($data);
 }
 public function deleteBook($id){
  return $this->db->table('books')
  ->where('book_id',$id)
  ->delete();
 }
}