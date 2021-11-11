<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Admin_model;
use App\Models\User_model;

class New_Admin extends ResourceController
{     use RequestTrait;
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        // 
        $dbs=db_connect();
        $return=new Admin_model($dbs);
        $data=$return->getAllBooks();
        return $this->respond($data);
    }
     public function availableBooks(){
        $dbs=db_connect();
        $return=new Admin_model($dbs);
        $data=$return->availableBooks();
                if(empty($data)){
            return $this->failNotFound('NO Book Available');
           }
          else{
            return $this->respond($data);

           }
     } 
     public function borrowedBooks(){
        $dbs=db_connect();
        $return=new Admin_model($dbs);
        $data=$return->getBorrowedBooks();
                if(empty($data)){
            return $this->failNotFound('NO Book Available');
           }
          else{
            return $this->respond($data);

           }
     } 
    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
        
         $dbs=db_connect();
         $return=new Admin_model($dbs);
        $data=$return->getBook($id);
         if(empty($data)){
          return $this->failNotFound('NOt Book Found');
         }
        else{
          return $this->respond($data);
         }

    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        
        $dbs=db_connect();
        $return=new User_model($dbs);

        $data=['book_title' => $this->request->getVar('book_title')];
         
        $return->saveBook($data);
        
        return $this->respondCreated($data);
    
    }
    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
         $dbs=db_connect();
        $return=new Admin_model($dbs);

        $data=['book_title'=>$this->request->getVar('book_title')];
        $return->updateBook($id,$data);
        return $this->respondUpdated($data);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
          $dbs=db_connect();
        $return=new Admin_model($dbs);
         $data=$return->getBook($id);
         if(empty($data)){
            return $this->failNotFound('Book not found');
         }
         else{
             $return->deleteBook($id);
             return $this->respondDeleted();
         }
       
    }
}
