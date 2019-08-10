<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MatkulModel extends CI_Model {

  public function getCountMatkul()
  {
      return $this->db->count_all_results('matkul', FALSE);
  }

  public function getMatkul($page, $size)
  {
    $mhs = $this->db->query('select m.id, m.nama, d.nama as dosen from matkul as m inner join dosen as d on m.iddosen = d.id')->result();
    return $mhs;  
  }

  public function insertMatkul($val,$user) 
  {
    $this->db->insert('matkul', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil ditambahkan" : "Gagal ditambahkan"
      ]
    );
    return $result;
  }

  public function updateMatkul($val, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('matkul', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil diperbarui" : "Gagal diperbarui"
      ]
    );
    return $result;
  }

  public function deleteMatkul($id)
  {
    $val = array(
      'id' => $id
    );
    $this->db->delete('matkul', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil dihapus" : "Gagal dihapus"
      ]
    );
    return $result;
  }

  public function relationMhs($val){
    $this->db->insert('matkul_mhs',$val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil ditambahkan" : "Gagal ditambahkan"
      ]
    );
    return $result;
  }

  public function deleteRelationMhs($id)
  {
    $val = array(
      'id' => $id
    );
    $this->db->delete('matkul_mhs', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil dihapus" : "Gagal dihapus"
      ]
    );
    return $result;
  }
}