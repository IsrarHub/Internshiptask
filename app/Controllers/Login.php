<?php

namespace App\Controllers;


use App\Models\Login_model;

class Login extends BaseController

{  
   protected $login;
  function __construct()

  {    $dbs=db_connect();
       $this->login=new Login_model($dbs);
      helper('form');
  }
    public function index()
    {
     
       return view('login');
    }
   public function login (){
    
    $session=\Config\Services::session();
   
    $email=$this->request->getPost('email');
    $password=md5($this->request->getPost('password'));
    //$array = array('email' => $email, 'password' => $password);

    $data = $this->login->login($email,$password);
    
    if($data!=""){
      $ses_data = [
        'id' => $data['id'],
        'email' => $data['email'],
        'user_type'=>$data['user_type'],
        'books_limits'=>$data['books_limits']
        
    ];
    
    
    $session->set($ses_data);
    
    if($session->get('user_type')==2){

      return redirect()->to('admin/dashboard');
    }
    else if($session->get('user_type')==1){
      
      return redirect()->to('User/userdashboard');
    }

    }
    else{
      return redirect()->to(base_url('Login/index'))->with('status','Your are not registered');
    }
    

}
public function register(){
  if($this->request->getPost()){
     $data=['email'=>$this->request->getPost('email'),'password'=>md5($this->request->getPost('password'))];

     $query=$this->login->register($data);
     if($query){
      return redirect()->to(base_url('Login/index'))->with('status','You have been registered Successfully. Please Login');
     }
     else{
       echo "error";
       exit;
     }
  }
  else{
    return view('register');
  }
}

}
