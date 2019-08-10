<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GroupModel extends CI_Model {

  public function getCountGroup()
  {
      return $this->db->count_all_results('group', FALSE);
  }

  public function getGroup($page, $size, $where)
  {
    $mhs = $this->db->get_where('group', $where, $size, $page)->result();
    return $mhs;  
  }
  
  public function showGroup($id){
    $mhs = [];
    $query = $this->db->query("SELECT 
                                mhs.*,
                                (SELECT count(*) FROM todo where glist.idmhs = todo.idmhs and todo.idgroup = 4) todo,
                                (SELECT count(*) FROM todo where glist.idmhs = todo.idmhs and todo.idgroup = 4 and status = 1) todo_done
                              FROM group_list as glist
                                INNER JOIN mahasiswa as mhs on glist.idmhs = mhs.id
                              WHERE glist.idgroup = 4 ")->result();
    return $query;
  }

  public function insertGroup($val) 
  {
    $this->db->insert('group', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil ditambahkan" : "Gagal ditambahkan"
      ]
    );
    return $result;
  }

  public function updateGroup($val, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('group', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil diperbarui" : "Gagal diperbarui"
      ]
    );
    return $result;
  }

  public function deleteGroup($id)
  {
    $val = array(
      'id' => $id
    );
    $this->db->delete('group', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil dihapus" : "Gagal dihapus"
      ]
    );
    return $result;
  }

}