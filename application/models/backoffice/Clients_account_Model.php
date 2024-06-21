<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients_account_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->get('clients_account')->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('clients_account', array('id_client' => $id))->row_array();
    }

    public function register($data)
    {
        $this->db->insert('clients_account', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_client', $id);
        return $this->db->update('clients_account', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('clients_account', array('id_client' => $id));
    }

    // public function verify_login($mail, $password)
    // {
    //     $query = $this->db->get_where('clients_account', array('mail' => $mail, 'password' => MD5('' . $password . '')));
    //     //echo $this->db->last_query();
    //     if ($query->num_rows() >= 1) {
    //         return true;
    //     }
    //     return false;
    // }

    public function verify_login($client, $password)
    {
        $this->db->where('(mail = ' . $this->db->escape($client) . ' OR phone_number = ' . $this->db->escape($client) . ')');
        $this->db->where('password', MD5($password));
        $query = $this->db->get('clients_account');

        // Uncomment the following line to debug the query
        // echo $this->db->last_query();

        if ($query->num_rows() >= 1) {
            return $query->row()->id_client;
        }
        return false;
    }


    public function search_client($name)
    {
        $name = strtolower($this->db->escape_like_str($name));
        $sql = "SELECT * FROM clients_account WHERE LOWER(full_name) LIKE '%$name%'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
