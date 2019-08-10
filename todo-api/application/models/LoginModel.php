<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model {
  public function Login($user,$pass){
    $mhs = [];
    $query = $this->db->get_where('users',array('iduser' => $user));
    if($query->num_rows() > 0){
      foreach ($query->result() as $row) { 
        $role = $row->role;
        if(password_verify($pass, $row->pass)){
          $query2 = $this->db->get_where($role,array('id' => $user));
          if($query2->num_rows() > 0){
            foreach ($query2->result() as $row2) {
              $issuedAt   = time();           
              $expire     = $issuedAt + 68400;   
              $payload = array(
                'id' => $user,
                'role' => $row->role,
                'exp' => $expire
              );
              $token = JWT::encode($payload);
              $mhs = array(
                'data' => array(
                  'status' => true,
                  'token' => $token
                )
              ); 
            }
          }
        }
        else{
          $mhs = array(
            'data' => array(
              'status' => false,
              'message' => 'username atau password salah'
            )
          );
        }
      }
    }
    else{
      $mhs = array(
        'data' => array(
          'status' => false,
          'message' => 'username atau password salah'
        )
      );
    }
    return $mhs;
  }
}