<?php /* if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_login extends CI_Model {

	public function getUser($username, $password)
	{
		$query = "select * from admin_user where username = ? and password = MD5(?)";
		$result = $this->db->query($query, array($username, $password));
		return $result;
	}
} */ ?>


<?php
Class Mod_login extends CI_Model
{
 function getUser($username, $password)
 {
   $this -> db -> select('id, username, password');
   $this -> db -> from('admin_user');
   $this -> db -> where('username = ' . "'" . $username . "'");
   $this -> db -> where('password = ' . "'" . MD5($password) . "'");
   $this -> db -> limit(1);

   $query = $this -> db -> get();

   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
   
 }
}
?>

