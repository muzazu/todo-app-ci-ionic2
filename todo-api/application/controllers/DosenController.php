<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DosenController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('DosenModel');
  }

  public function getDosen()
  {
    $page = $this->input->get('page') ? $this->input->get('page') : 1;
    $size = $this->input->get('offset') ? $this->input->get('offset') : 10;

    $data = $this->DosenModel->getDosen(($page - 1) * $size, $size);
    $response = array(
      'data' => $data,
      'meta' => [
        'total' => ceil($this->DosenModel->getCountDosen() / $size),
        'page' => $page,
        'offset' => $size,
        'status' => COUNT($data) > 0 ? true : false,
        'message' => COUNT($data) > 0 ? "List of Dosen" : "Data tidak ditemukan"
      ],
    );

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function showDosen($id)
  {
    $data = $this->DosenModel->showDosen($id);
    $response = array(
      'data' => $data,
      'meta' => [
        'status' => COUNT($data) > 0 ? true : false,
        'message' => COUNT($data) > 0 ? "Data Dosen" : "Data tidak ditemukan"
      ],
    );

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;    
  }

  public function saveDosen()
  {
    $data = array(
        'id' => $this->input->post('id'),
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'telp' => $this->input->post('telp'),
        'alamat' => $this->input->post('alamat')
    );
    $user = array(
      'iduser' => $this->input->post('id'),
      'role' => 'dosen',
      'pass' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
    );
    
    $response = $this->DosenModel->insertDosen($data,$user);

    $this->output
      ->set_status_header(201)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function updateDosen($id)
  {
    $data = array(
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'telp' => $this->input->post('telp'),
        'alamat' => $this->input->post('alamat')
    );
    
    $response = $this->DosenModel->updateDosen($data, $id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function deleteDosen($id)
  {
    $response = $this->DosenModel->deleteDosen($id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

}