<?php namespace App\Controllers\Configuracoes;

 use App\Models\Configuracoes\AgendaModel;
 use CodeIgniter\Controller;
 use App\Libraries\Auth;
 
 class Agenda extends Controller
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
        $this->agendaModel = new AgendaModel();
        $this->auth = new Auth();
        helper('complementos'); 
    }

	public function AgendaConsultar(){
        echo view('Commons/header');	
        echo view('Commons/navbartop');
        echo view('Commons/navbarleft', getBarMenu($this->usuario));
        echo view('Configuracoes/Agenda/agenda');
        echo view('Commons/footer');
	}
	
	public function getEvents(){
        echo json_encode($this->agendaModel->getEventUnico($this->request->getPost('id')));
    }

	public function getAgendaMensal(){  
		echo json_encode($this->agendaModel->agendaMensal($this->usuario->ID_USUARIO));	
    } 	

	public function deleteEvents(){
        if($this->agendaModel->deleteLembrete($this->request->getPost('id'))){
            echo json_encode(array("msg"=>"success"));
        }else{
            echo json_encode(array("msg"=>"success"));
        }
	}

	public function inserirLembrete(){
		$dados = array();
		$dados['ID_AGENDA'] = $this->request->getPost('id_agenda');
		$dados['FK_ID_USUARIO'] = $this->usuario->ID_USUARIO;
		$dados['TITULO'] = mb_strtoupper($this->request->getPost('titulo'),'UTF-8');
		$dados['DESCRICAO'] = $this->request->getPost('descricao');
		$dados['INICIO'] = Countdata($this->request->getPost('data_inicio'));
		$dados['FIM'] = Countdata($this->request->getPost('data_final'));
		$dados['COR'] = $this->request->getPost('cor');
		
		$this->agendaModel->setLembrete($dados);		  
    }
}
