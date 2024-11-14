<?php namespace App\Controllers\Configuracoes;

 use App\Models\UsuarioModel;
 use App\Models\Configuracoes\AgendaModel;
 use CodeIgniter\Controller;
 use App\Libraries\Auth;
 
 class Log extends Controller
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
        $this->usuarioModel = new UsuarioModel();
        $this->auth = new Auth();
        helper('complementos');  
    }

    public function logConsultar(){
        if($this->auth->CheckAuth(8)){
            $dados = array();
            $datahoje = date('Y-m-d');
            $datahoje = explode("-", $datahoje);
            $mes = $datahoje[1];
            $ano = $datahoje[0];
            if($this->request->getPost('log_dt_inicial')==null || $this->request->getPost('log_dt_inicial')==""){
                $dt_inicial = $ano.'-'.$mes.'-01';
            }else{
                $dt_inicial = inverterData($this->request->getPost('log_dt_inicial'));
            }
            if($this->request->getPost('log_dt_final')==null || $this->request->getPost('log_dt_final')==""){
                $dt_final = $ano.'-'.$mes.'-31';
            }else{
                $dt_final = inverterData($this->request->getPost('log_dt_final'));
            }

            $dados['usuarios'] = $this->usuarioModel->getUsuarioAtivo();
            $dados['resultados'] = $this->usuarioModel->getLogs($dt_inicial, $dt_final, $this->request->getPost('filtro_parceiro')); //Busca no BD todos as pagamentos e salva no array $dados na posição resultados.
            
            echo view('Commons/header');	
            echo view('Commons/navbartop');
            echo view('Commons/navbarleft', getBarMenu($this->usuario));	
            echo view('Configuracoes/Log/log', $dados);
            echo view('Commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }
}