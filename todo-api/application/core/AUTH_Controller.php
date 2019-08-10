<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AUTH_Controller extends CI_Controller {
	protected $jwt;
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('jwt');
    }
}