<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MhsController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('MhsModel');
  }

  public function getMahasiswa()
  {
    $page = $this->input->get('page') ? $this->input->get('page') : 1;
    $size = $this->input->get('offset') ? $this->input->get('offset') : 10;

    $data = $this->MhsModel->getMahasiswa(($page - 1) * $size, $size);
    $response = array(
      'data' => $data,
      'meta' => [
        'total' => ceil($this->MhsModel->getCountMahasiswa() / $size),
        'page' => $page,
        'offset' => $size,
        'status' => COUNT($data) > 0 ? true : false,
        'message' => COUNT($data) > 0 ? "List of mahasiswa" : "Data tidak ditemukan"
      ],
    );

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function showMahasiswa($id)
  {
    $data = $this->MhsModel->showMahasiswa($id);
    $response = array(
      'data' => $data,
      'meta' => [
        'status' => COUNT($data) > 0 ? true : false,
        'message' => COUNT($data) > 0 ? "Data Mahasiswa" : "Data tidak ditemukan"
      ],
    );

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;    
  }

  public function saveMahasiswa()
  {
    $data = array(
        'id' => $this->input->post('id'),
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'alamat' => $this->input->post('alamat')
    );
    $user = array(
      'iduser' => $this->input->post('id'),
      'role' => 'mahasiswa',
      'pass' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
    );
    
    $response = $this->MhsModel->insertMahasiswa($data,$user);

    $this->output
      ->set_status_header(201)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function updateMahasiswa($id)
  {
    $data = array(
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'alamat' => $this->input->post('alamat')
    );
    
    $response = $this->MhsModel->updateMahasiswa($data, $id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function deleteMahasiswa($id)
  {
    $response = $this->MhsModel->deleteMahasiswa($id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function filteredMahasiswa(){
    $response = $this->MhsModel->filteredMahasiswa();

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function getCustom(){
    $idgroup = $this->input->get('idgroup');
    $response = $this->MhsModel->getCustom($idgroup);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }
}