<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MhsModel extends CI_Model {

  public function getCountMahasiswa()
  {
      return $this->db->count_all_results('mahasiswa', FALSE);
  }

  public function getMahasiswa($page, $size)
  {
    $mhs = $this->db->get('mahasiswa', $size, $page)->result();
    return $mhs;  
  }
  
  public function showMahasiswa($id){
    $mhs = [];
    $query = $this->db->get_where('mahasiswa',array('id' => $id));
    if($query->num_rows() > 0){
      foreach ($query->result() as $row) {
        $matkul = $this->db->query("select matkul.nama,matkul.id,(select idgroup from group_list where idmhs = $id) as idgroup from matkul_mhs as con inner join matkul on con.idmatkul = matkul.id where con.idmhs = $id")->result();
        $data = array(
          'nama' => $row->nama,
          'alamat' => $row->alamat,
          'email' => $row->email,
          'matkul' => $matkul
        );
        array_push($mhs, $data);
      }
    }
    return $mhs;
  }

  public function insertMahasiswa($val,$user) 
  {
    $this->db->insert('mahasiswa', $val);
    $this->db->insert('users', $user);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil ditambahkan" : "Gagal ditambahkan"
      ]
    );
    return $result;
  }

  public function updateMahasiswa($val, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('mahasiswa', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil diperbarui" : "Gagal diperbarui"
      ]
    );
    return $result;
  }

  public function deleteMahasiswa($id)
  {
    $val = array(
      'id' => $id
    );
    $this->db->delete('mahasiswa', $val);
    
    $result = array(
      'meta' => [        
        'status' => ($this->db->affected_rows() > 0) ? true : false,
        'message' => ($this->db->affected_rows() > 0) ? "Berhasil dihapus" : "Gagal dihapus"
      ]
    );
    return $result;
  }

  public function filteredMahasiswa()
  {
    $query = $this->db->query("select mhs.* from mahasiswa as mhs where mhs.id NOT IN (SELECT idmhs FROM group_list)");
    return $query->result();
  }

  public function getCustom($id)
  {
    $query = $this->db->query("select mhs.* from mahasiswa as mhs inner join group_list as glist on glist.idmhs = mhs.id where glist.idgroup = $id");
    return $query->result();
  }
}