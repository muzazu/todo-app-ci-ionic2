<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LoginController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('LoginModel');
    $this->load->helper('jwt');
  }

  public function Login()
  {
    $iduser = $this->input->post('id');
    $pass = $this->input->post('pass');
    $data = $this->LoginModel->Login($iduser,$pass);
    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($data, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function decodeToken()
  {
    $data = JWT::decode($this->input->get_request_header('auth'));
    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($data, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }
}