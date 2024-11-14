<?php namespace App\Controllers;

 use CodeIgniter\Controller;
 use CodeIgniter\HTTP\RequestInterface;
 use CodeIgniter\HTTP\ResponseInterface;
 use Psr\Log\LoggerInterface;
 
 class Acesso extends BaseController
 {

	public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
        if($this->usuario == null){
            header('Location: '.base_url());
            exit(); 
        }
		date_default_timezone_set('America/Sao_Paulo');
        helper('complementos');
    }

	public function index(){
        echo view('commons/header');	          
        echo view('commons/navbartop');
        echo view('commons/navbarleft', getBarMenu($this->usuario));	
        echo view('Acesso/acesso');
        echo view('commons/footer');
    }
}