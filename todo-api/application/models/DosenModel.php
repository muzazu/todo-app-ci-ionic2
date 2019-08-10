<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DosenModel extends CI_Model {

  public function getCountDosen()
  {
      return $this->db->count_all_results('dosen', FALSE);
  }

  public function getDosen($page, $size)
  {
    $mhs = $this->db->get('dosen', $size, $page)->result();
    return $mhs;  
  }
  
  public function showDosen($id){
    $mhs = [];
    $query = $this->db->get_where('dosen',array('id' => $id));
    if($query->num_rows() > 0){
      foreach ($query->result() as $row) {
        $matkul = $this->db->get_where('matkul',array('iddosen'=>$row->id))->result();
        $data = array(
          'id' => $row->id,
          'nama' => $row->nama,
          'alamat' => $row->alamat,
          'email' => $row->email,
          'telp' => $row->telp,
          'matkul' => $matkul
        );
        array_push($mhs, $data);
      }
    }
    return $mhs;
  }

  public function insertDosen($val,$user) 
  {
    $this->db->insert('dosen', $val);
    $this->db->insert('users', $user);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil ditambahkan" : "Gagal ditambahkan"
      ]
    );
    return $result;
  }

  public function updateDosen($val, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('dosen', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil diperbarui" : "Gagal diperbarui"
      ]
    );
    return $result;
  }

  public function deleteDosen($id)
  {
    $val = array(
      'id' => $id
    );
    $this->db->delete('dosen', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil dihapus" : "Gagal dihapus"
      ]
    );
    return $result;
  }

}