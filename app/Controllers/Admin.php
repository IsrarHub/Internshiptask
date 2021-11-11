<?php

namespace App\Controllers;

use App\Models\Admin_model;

class Admin extends BaseController
{   
  use \CodeIgniter\API\ResponseTrait; 
  public $dbs;
    public function __construct()
    {  $this->dbs=db_connect(); 
     }
    public function index()
    {   
      $books=new Admin_model($this->db);
      
      $data['books']=$books->findAll();
      return view('dashboard',$data);
    }
    public function addBook(){
      return view('addbook');
    }
    public function saveBook(){
      $data=['book_title'=>$this->request->getPost('title')];

      $books=new Admin_model($this->db);
      $books->save($data);
      return redirect()->to(base_url('admin/dashboard'))->with('status','Book has been added');
    }
    public function edit($id){
      $book=new Admin_model($this->db);
      $data['book']=$book->find($id);
       return view('edit_book',$data );
    }
    public function saveEdit($id){
      $data=['book_title'=>$this->request->getPost('title')];
      $book=new Admin_model($this->db);
      $book->update($id,$data);
      
      return redirect()->to(base_url('admin/dashboard'))->with('status','Book has been updated');
    }
    public function delete($id){
      $book=new Admin_model($this->db);
      $book->delete($id);
      return redirect()->to(base_url('admin/dashboard'))->with('status','Book has been Deleted');
    }
    public function test(){
      $books=new Admin_model($this->db);
      $data=$books->findAll();
      return $this->respond($data);
    }
    
}
