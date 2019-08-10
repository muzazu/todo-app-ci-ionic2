<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroupController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('GroupModel');
    $this->load->helper('date');
  }

  public function getGroup()
  {
    $page = $this->input->get('page') ? $this->input->get('page') : 1;
    $size = $this->input->get('offset') ? $this->input->get('offset') : 10;
    $where = [
      'idmatkul' => $this->input->get('matkul') ? $this->input->get('matkul') : ''
    ];
    $data = $this->GroupModel->getGroup(($page - 1) * $size, $size, $where);
    $response = array(
      'data' => $data,
      'meta' => [
        'total' => ceil($this->GroupModel->getCountGroup() / $size),
        'page' => $page,
        'offset' => $size,
        'status' => COUNT($data) > 0 ? true : false,
        'message' => COUNT($data) > 0 ? "List of Group" : "Data tidak ditemukan"
      ],
    );

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function showGroup($id)
  {
    $data = $this->GroupModel->showGroup($id);
    $response = array(
      'data' => $data,
      'meta' => [
        'status' => COUNT($data) > 0 ? true : false,
        'message' => COUNT($data) > 0 ? "Data Group" : "Data tidak ditemukan"
      ],
    );

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;    
  }

  public function saveGroup()
  {
    $data = array(
        'idmatkul' => $this->input->post('idmatkul'),
        'max' => $this->input->post('max'),
        'min' => $this->input->post('min'),
        'nama' => $this->input->post('nama'),
        'date_created' => date("Y-m-d h:i:sa")
    );
    
    $response = $this->GroupModel->insertGroup($data);

    $this->output
      ->set_status_header(201)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function updateGroup($id)
  {
    $data = array(
        'idmatkul' => $this->input->post('idmatkul'),
        'max' => $this->input->post('max'),
        'min' => $this->input->post('min'),
        'nama' => $this->input->post('nama'),
        'date_created' => $this->input->post('date_created')
    );
    
    $response = $this->GroupModel->updateGroup($data, $id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function deleteGroup($id)
  {
    $response = $this->GroupModel->deleteGroup($id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }
}