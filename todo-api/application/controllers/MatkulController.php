<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MatkulController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('MatkulModel');
  }

  public function getMatkul()
  {
    $page = $this->input->get('page') ? $this->input->get('page') : 1;
    $size = $this->input->get('offset') ? $this->input->get('offset') : 10;

    $data = $this->MatkulModel->getMatkul(($page - 1) * $size, $size);
    $response = array(
      'data' => $data,
      'meta' => [
        'total' => ceil($this->MatkulModel->getCountMatkul() / $size),
        'page' => $page,
        'offset' => $size,
        'status' => COUNT($data) > 0 ? true : false,
        'message' => COUNT($data) > 0 ? "List of Matkul" : "Data tidak ditemukan"
      ],
    );

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function saveMatkul()
  {
    $data = array(
        'nama' => $this->input->post('nama'),
        'iddosen' => $this->input->post('iddosen')
    );
    
    $response = $this->MatkulModel->insertMatkul($data,$user);

    $this->output
      ->set_status_header(201)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function updateMatkul($id)
  {
    $data = array(
        'nama' => $this->input->post('nama'),
        'iddosen' => $this->input->post('iddosen')
    );
    
    $response = $this->MatkulModel->updateMatkul($data, $id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function deleteMatkul($id)
  {
    $response = $this->MatkulModel->deleteMatkul($id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function relationMhs(){
    $data = array(
        'idmatkul' => $this->input->post('idmatkul'),
        'idmhs' => $this->input->post('idmhs')
    );
    
    $response = $this->MatkulModel->relationMhs($data);

    $this->output
      ->set_status_header(201)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function deleteRelationMhs($id)
  {
    $response = $this->MatkulModel->deleteRelationMhs($id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }
}