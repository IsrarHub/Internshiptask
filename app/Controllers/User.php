<?php

namespace App\Controllers;

use App\Models\Admin_model;
use App\Models\User_model;
use App\Models\Login_model;
class User extends BaseController
{
  use \CodeIgniter\API\ResponseTrait; 
  function __construct()
    {  $session=\Config\Services::session();
       if($session->get('user_type')==""){
         return redirect()->to(base_url('Login/'));
       }
            
      if($session->get('user_type')==1){
     return redirect()->to(base_url('Login'));
  }
      helper('form');
  }
    public function index()
     {  
      $dbs=db_connect();
      $session=session();
      $books= new Admin_model($dbs);
    $borrow_book= new User_model($dbs);
     $user_id=$session->get('id');
    
        $data['books']=$books->where('book_status',1)->findAll(); 
        $data['borrowed_books']= $borrow_book->getBorrowedBooks($user_id);
        // print_r($data['borrowed_books']);
        // exit;
       return view('userdashboard',$data);
    }
   public function borrow($id){
     $dbs=db_connect();
     $borrow_book= new User_model($dbs);
     
     $update_book_limt=new Login_model($dbs);
     $book_status=new Admin_model($dbs);
     $session=session();
     $data_b_limit=0;
     $borrow_limit= $session->get('books_limits');
     $user_id=$session->get('id');
      $data=['book_status'=>0];
     $book_status->update($id,$data);
     if($borrow_limit>0){
      $data_b_limit=['books_limits'=>$borrow_limit-1];
     }
     
     $session->set($data_b_limit);
     $update_book_limt->update($user_id,$data_b_limit);
   
     $save=['user_id'=>$user_id,'book_id'=>$id];
     
     $borrow_book->insert($save);
   

     return redirect()->to(base_url('User/index'))->with('status','Book has been borrowed');
 
   }
   public function sentback($book_id){
    $dbs=db_connect();
    $session=\Config\Services::session();
     $return=new User_model($dbs);
     $user_id=$session->get('id');
     $get_limit=$session->get('books_limits');
     $data=['books_limits'=>($get_limit +1)];
     $session->set('books_limits',$data);
     $book_status=['book_status'=>1];
    $update_Blimit=$return->updateLimit($data,$user_id);
    $update_Bstatus=$return->updateBookStatus($book_status,$book_id);
    $delete_bb=$return->deleteBorrowBook($user_id,$book_id);
    return redirect()->to(base_url('User/'));
  }
   public function logout(){
    $session=\Config\Services::session();
    $session->destroy();
    return redirect()->to(base_url('Login/'));
   }
   public function show(){
    $dbs=db_connect();
     $return=new User_model($dbs);
      $data=$return->allBooks();
      return $this->respond($data);
   }
   public function addBook(){
   $data=["book_title"=>$this->request->getPost()];
   $dbs=db_connect();
  $return=new User_model($dbs);
  $saave=$return->saveBook($data);

   }
}
