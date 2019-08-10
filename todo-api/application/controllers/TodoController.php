<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TodoController extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('TodoModel');
    $this->load->helper('date');
  }

  public function getTodo()
  {
    $check = [
      'idmhs' => $this->input->get('idmhs'),
      'idgroup' => $this->input->get('idgroup')
    ];
    $data = $this->TodoModel->getTodo($check);
    $response = array(
      'data' => $data,
      'meta' => [
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

  public function showTodo($id)
  {
    $data = $this->TodoModel->showTodo($id);
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

  public function saveTodo()
  {
    $data = array(
        'idmhs' => $this->input->post('idmhs'),
        'idgroup' => $this->input->post('idgroup'),
        'desc' => $this->input->post('desc'),
        'title' => $this->input->post('title'),
        'status' => 0,
        'deadline' => date("Y-m-d h:i:sa", strtotime($this->input->post('deadline'))),
        'date_created' => date("Y-m-d h:i:sa")
    );
    
    $response = $this->TodoModel->insertTodo($data);

    $this->output
      ->set_status_header(201)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function updateTodo($id)
  {
    $data = array(
        'status' => $this->input->post('status'),
        'date_updated' => date("Y-m-d h:i:sa")
    );
    
    $response = $this->TodoModel->updateTodo($data, $id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }

  public function deleteTodo($id)
  {
    $response = $this->TodoModel->deleteTodo($id);

    $this->output
      ->set_status_header(200)
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT))
      ->_display();
      exit;
  }
}