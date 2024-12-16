<?php

namespace App\Controllers;
use App\Models\EscolaModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\DocumentoEscolaModel;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Fazendas extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
        $this->escola = $this->session->get('escola');
        if($this->usuario == null){
            header('Location: '.base_url());
            exit(); 
        }
		date_default_timezone_set('America/Sao_Paulo');
        $this->escolaModel = new EscolaModel();
        $this->documentoEscolaModel = new DocumentoEscolaModel();
        $this->auth = new Auth();
        helper('complementos');
    }

    public function index()
    {
        if($this->auth->checkAuth(21)){
            if($this->usuario->TIPO == "AD"){
                $dados['resultados'] = $this->escolaModel->getEscolas();    
            }else{
                $dados['resultados'] = $this->escolaModel->getEscolasProfissional($this->escola->ID_ESCOLA);
            }
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('escola/escola.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }


    public function Inserir(){
        if($this->auth->checkAuth(22)){
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('escola/escola_cadastro.php');
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('fazenda_id');

        $dados['NOME'] = $this->request->getPost('nome');
        $dados['ENDERECO'] = $this->request->getPost('endereco');
        $dados['AREA_TOTAL'] = $this->request->getPost('area_total');
        $dados['TIPO_PRODUCAO'] = $this->request->getPost('tipo_producao');
        $dados['CONTATO_RESPONSAVEL'] = $this->request->getPost('contato_responsavel');
        $dados['TELEFONE_CONTATO'] = $this->request->getPost('telefone_contato');
        $dados['DATA_CADASTRO'] = $this->request->getPost('data_cadastro');
        $dados['STATUS'] = $this->request->getPost('status');



            /* $arquivo = $this->request->getFile('foto_escola');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[foto_escola]',
                        'mime_in[foto_escola,image/jpg,image/jpeg,image/png]',
                        'max_size[foto_escola,2048]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Fazendas/index?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('foto_escola');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            } */
        if($id == ""){
            if($this->escolaModel->setEscola($dados)){
                return redirect()->to('/Fazendas/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Fazendas/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['ID_ESCOLA'] = $this->request->getPost('fazenda_id');
            if($this->escolaModel->updateEscola($dados)){
                return redirect()->to('/Fazendas/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Fazendas/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }

        }
    }

    public function Editar($id=""){
        if($this->auth->checkAuth(23)){
            $dados['fazenda'] = $this->escolaModel->getEscolaID(base64_decode($id));
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('escola/escola_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(24)){
            if($this->escolaModel->deleteEscola(base64_decode($id))){
                return redirect()->to('/Fazendas/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Fazendas/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }
}
