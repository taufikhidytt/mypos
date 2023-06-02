<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{


    public function index()
    {
        ga_ada_session();
        $data['title'] = "Dashboard";
        $this->template->load('template','dashboard', $data);
    }
}


?>