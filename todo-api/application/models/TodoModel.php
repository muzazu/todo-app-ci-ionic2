<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TodoModel extends CI_Model {

  public function getCountTodo()
  {
      return $this->db->count_all_results('todo', FALSE);
  }

  public function getTodo($check)
  {
    $this->db->where($check);
    $mhs = $this->db->get('todo')->result();
    return $mhs;  
  }
  
  public function showTodo($id){
    $mhs = [];
    $this->db->select('mahasiswa.nama,todo.title,todo.created_at,todo.updated_at,todo.deadline,todo.desc');
    $this->db->join('mahasiswa','todo.idmahasiswa = mahasiswa.id');
    $query = $this->db->get_where('todo',array('id' => $id));
    return $query;
  }

  public function insertTodo($val) 
  {
    $this->db->insert('todo', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil ditambahkan" : "Gagal ditambahkan"
      ]
    );
    return $result;
  }

  public function updateTodo($val, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('todo', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil diperbarui" : "Gagal diperbarui"
      ]
    );
    return $result;
  }

  public function deleteTodo($id)
  {
    $val = array(
      'id' => $id
    );
    $this->db->delete('todo', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil dihapus" : "Gagal dihapus"
      ]
    );
    return $result;
  }

}