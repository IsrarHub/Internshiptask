<?php  namespace App\Models;
use  CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class Login_model extends Model
{
 protected $table ='admin';
 protected $primaryKey='id';
  
 protected $allowedFields=['email','password','books_limits'];

 public $db;
 public function __construct(ConnectionInterface &$db)
 {
   $this->db=$db;
 }
 public function login($email,$password){
  return $this->db->table('admin')
                ->where(['email' => $email])
                ->where(['password' => $password])
                ->get()
                ->getRowArray();

 }
 public function register($data){
   $builder=$this->db->table('admin');
   $query=$builder->insert($data);
   return $query;
 }

}