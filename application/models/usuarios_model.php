<?php
class Usuarios_model extends CI_Model
{
    public function getUsuarios()
    {
        $produtos = $this->db->get('produtos');
        if ($produtos->num_rows()) {
            return $produtos->result_array();
        }else{
            return false;
        }
    }
}
