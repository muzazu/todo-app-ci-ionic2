<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GrouplistModel extends CI_Model {

  public function getCountGrouplist()
  {
      return $this->db->count_all_results('group_list', FALSE);
  }

  public function getGrouplist($page, $size)
  {
    $mhs = $this->db->get('group_list', $size, $page)->result();
    return $mhs;  
  }

  public function insertGrouplist($val) 
  {
    $this->db->insert('group_list', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil ditambahkan" : "Gagal ditambahkan"
      ]
    );
    return $result;
  }

  public function updateGrouplist($val, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('group_list', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil diperbarui" : "Gagal diperbarui"
      ]
    );
    return $result;
  }

  public function deleteGrouplist($id)
  {
    $val = array(
      'id' => $id
    );
    $this->db->delete('group_list', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil dihapus" : "Gagal dihapus"
      ]
    );
    return $result;
  }

}