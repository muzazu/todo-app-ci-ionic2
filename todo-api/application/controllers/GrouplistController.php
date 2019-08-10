<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GrouplistController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('GrouplistModel');
    $this->load->helper('date');
  }

  public function getGrouplist()
  {
    $page = $this->input->get('page') ? $this->input->get('page') : 1;
    $size = $this->input->get('offset') ? $this->input->get('offset') : 10;

    $data = $this->GrouplistModel->getGrouplist(($page - 1) * $size, $size);
    $response = array(
      'data' => $data,
      'meta' => [
        'total' => ceil($this->GrouplistModel->getCountGrouplist() / $size),
        'page' => $page,
        'offset' => $size,
        'status' => COUNT($data) > 0 ? true : false,
        'message' => COUNT($data) > 0 ? "List of Grouplist" : "Data tidak ditemukan"
      ],
    );

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function saveGrouplist()
  {
    $data = array(
        'idgroup' => $this->input->post('idgroup'),
        'idmhs' => $this->input->post('idmhs'),
        'status' => $this->input->post('status')
    );
    
    $response = $this->GrouplistModel->insertGrouplist($data);

    $this->output
      ->set_status_header(201)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function updateGrouplist($id)
  {
    $data = array(
        'idgroup' => $this->input->post('idgroup'),
        'idmhs' => $this->input->post('idmhs'),
        'status' => $this->input->post('status')
    );
    
    $response = $this->GrouplistModel->updateGrouplist($data, $id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function deleteGrouplist($id)
  {
    $response = $this->GrouplistModel->deleteGrouplist($id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }
}