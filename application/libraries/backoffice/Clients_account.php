<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients_account
{
    protected $CI;

    private $id_client;
    private $full_name;
    private $mail;
    private $password;
    private $phone_number;
    private $user_image;
    private $purchases;
    private $last_activities;

    public function __construct($id = null, $full_name = null, $mail = null, $password = null, $phone_number = null, $user_image = null, $last_activities=null,$purchases=null)
    {
        $this->CI = &get_instance();
        $this->CI->load->model('backoffice/Clients_account_Model','Clients_account_Model');
        $this->CI->load->model('backoffice/Orders_Model','Orders_Model');
        $this->id_client = $id;
        $this->full_name = $full_name;
        $this->mail = $mail;
        $this->password = $password;
        $this->phone_number = $phone_number;
        $this->user_image = $user_image;
        $this->last_activities = $last_activities;
        $this->purchases = $purchases;
    }

    public function get_purchases() {
        return $this->purchases;
    }
 
    public function set_purchases() {
        $this->purchases = $this->CI->Orders_Model->get_client_purchase($this->get_id_client())[0]['purchases'];
    }

    public function set_last_activities() {
        if($this->CI->Orders_Model->last_client_orders($this->get_id_client(),1)==null) {
            $this->last_activities = null;
        }
        else {
            $this->last_activities = ($this->CI->Orders_Model->last_client_orders($this->get_id_client(),1))[0]['ordering_date'];
        }
    }

    public function get_last_activites ()  {
        return $this->last_activities;
    }

    public function get_id_client()
    {
        return $this->id_client;
    }

    public function set_id_client($id_client)
    {
        $this->id_client = $id_client;
    }

    public function get_full_name()
    {
        return $this->full_name;
    }

    public function set_full_name($full_name)
    {
        $this->full_name = $full_name;
    }

    public function get_mail()
    {
        return $this->mail;
    }

    public function set_mail($mail)
    {
        $this->mail = $mail;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function set_password($password)
    {
        $this->password = $password;
    }

    public function get_phone_number()
    {
        return $this->phone_number;
    }

    public function set_phone_number($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function get_user_image()
    {
        return $this->phone_number;
    }

    public function set_user_image($user_image)
    {
        $this->user_image = $user_image;
    }

    public function get_all_clients()
    {
        $result = $this->CI->Clients_account_Model->get_all();
        $clients = array();
        foreach ($result as $data) {
            $clients[] = new Clients_Account(
                $data['id_client'],
                $data['full_name'],
                $data['mail'],
                $data['password'],
                $data['phone_number'],
                $data['user_image']
            );
        }
        return $clients;
    }

    public function get_client_by_id($id)
    {
        $data = $this->CI->Clients_account_Model->get_by_id($id);
        return new Clients_Account(
            $data['id_client'],
            $data['full_name'],
            $data['mail'],
            $data['password'],
            $data['phone_number'],
            $data['user_image']
        );
    }

    public function add_client()
    {
        //$hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
        $data = array(
            'full_name' => $this->full_name,
            'mail' => $this->mail,
            'password' => MD5(''.$this->password.''),
            'phone_number' => $this->phone_number,
            'user_image' => $this->user_image
        );

        $this->CI->Clients_account_Model->register($data);
    }

    public function update_client($id, $data)
    {
        return $this->CI->Clients_account_Model->update($id, $data);
    }

    public function delete_client($id)
    {
        return $this->CI->Clients_account_Model->delete($id);
    }

    public function search_client_by_name($name)
    {
        $client = $this->CI->Clients_account_Model->search_client($name);
        $result = array();
        if ($client) {
            foreach ($client as $client_result) {
                $client_search = new Clients_account();
                $client_search->set_id_client($client_result['id_client']);
                $client_search->set_full_name($client_result['full_name']);
                $client_search->set_mail($client_result['mail']);
                $client_search->set_phone_number($client_result['phone_number']);
                $client_search->set_last_activities();
                $client_search->set_purchases();
                $result[] = $client_search;
            }
        }
        return $result;
    }

    public function login($client, $password)
    {
        return $this->CI->Clients_account_Model->verify_login($client, $password);
    }
}