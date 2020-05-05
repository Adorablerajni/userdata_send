<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme {
    protected $CI;

    public function __construct()
    {
         // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
    }
    public function load_view($data,  $view)
    {
        $this->CI->load->view('layouts/header',$data);
        $this->CI->load->view($view);
        $this->CI->load->view('layouts/footer');
    }
}