<?php

namespace App\Controllers;
use App\Models\ProfissionalModel;
use App\Models\UsuarioModel;
use App\Models\AnoLetivoModel;
use App\Models\ProfissaoModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\DocumentoProfissionalModel;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Animais extends BaseController
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
        $this->profissionalModel = new ProfissionalModel();
        $this->usuarioModel = new UsuarioModel();
        $this->anoLetivoModel = new AnoLetivoModel();
        $this->profissaoModel = new ProfissaoModel();
        $this->documentoProfissionalModel = new DocumentoProfissionalModel();
        $this->auth = new Auth();
        helper('complementos');
    }


    public function index(){
        if($this->auth->checkAuth(17)){
            $dados = array();

            $situacao = "";
            $cargo = "";

            if($this->request->getPost('pesquisar') == "S"){
                $situacao = $this->request->getPost('situacao_profissional');
                $cargo = $this->request->getPost('profissional_cargo');
            }


            if($this->usuario->TIPO == "AD"){
                //$dados['resultados'] = $this->profissionalModel->getProfissional($situacao, $cargo);
                $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, $situacao, $cargo);

            }else{
                $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, $situacao, $cargo);
            }
            $dados['profissoes'] = $this->profissaoModel->getProfissao();
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('profissionais/profissional', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }


    public function Inserir(){
        if($this->auth->checkAuth(18)){
            $dados['username'] = $this->usuario->USUARIO;
            $dados['lotes'] = $this->anoLetivoModel->getAnoLetivo($this->escola->ID_ESCOLA);

            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('profissionais/profissional_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('profissional_id');
        if($id == ""){



            $dados['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;
            $dados['IDENTIFICACAO'] = $this->request->getPost('identificacao');
            $dados['NOME'] = $this->request->getPost('nome');
            $dados['RACA'] = $this->request->getPost('raca');
            $dados['SEXO'] = $this->request->getPost('sexo');
            $dados['DATA_NASCIMENTO'] = $this->request->getPost('data_nascimento');
            $dados['IDADE'] = $this->request->getPost('idade');
            $dados['PESO_INICIAL'] = $this->request->getPost('peso_inicial');
            $dados['PESO_ATUAL'] = $this->request->getPost('peso_atual');
            $dados['HISTORICO_SAUDE'] = $this->request->getPost('historico_saude');
            $dados['DATA_ENTRADA'] = $this->request->getPost('data_entrada');
            $dados['STATUS'] = $this->request->getPost('status');
            $dados['OBSERVACOES'] = $this->request->getPost('observacoes');
            $dados['FK_ID_LOTE'] = $this->request->getPost('lote');
            

            $insert_id = $this->profissionalModel->setProfissional($dados);


            if($insert_id){
                return redirect()->to('/Animais/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Animais/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['ID_PROFISSIONAL'] = $this->request->getPost('profissional_id');
            $dados['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;
            $dados['IDENTIFICACAO'] = $this->request->getPost('identificacao');
            $dados['NOME'] = $this->request->getPost('nome');
            $dados['RACA'] = $this->request->getPost('raca');
            $dados['SEXO'] = $this->request->getPost('sexo');
            $dados['DATA_NASCIMENTO'] = $this->request->getPost('data_nascimento');
            $dados['IDADE'] = $this->request->getPost('idade');
            $dados['PESO_INICIAL'] = $this->request->getPost('peso_inicial');
            $dados['PESO_ATUAL'] = $this->request->getPost('peso_atual');
            $dados['HISTORICO_SAUDE'] = $this->request->getPost('historico_saude');
            $dados['DATA_ENTRADA'] = $this->request->getPost('data_entrada');
            $dados['STATUS'] = $this->request->getPost('status');
            $dados['OBSERVACOES'] = $this->request->getPost('observacoes');
            $dados['FK_ID_LOTE'] = $this->request->getPost('lote');
            
            if($this->profissionalModel->updateProfissional($dados)){
                return redirect()->to('/Animais/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Animais/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }

        }
    }

    public function Editar($id=""){
        if($this->auth->checkAuth(19)){
            $dados['animal'] = $this->profissionalModel->getProfissionalID(base64_decode($id));
            $dados['lotes'] = $this->anoLetivoModel->getAnoLetivo($this->escola->ID_ESCOLA);
            $dados['username'] = $this->usuario->USUARIO;
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('profissionais/profissional_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(20)){
            if($this->profissionalModel->deleteProfissional(base64_decode($id))){
                return redirect()->to('/Animais/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Animais/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function getPesoEDataPesagem(){

        $identificacao = $this->request->getPost('identificacao');

        echo json_encode($this->profissionalModel->getPesoEDataPesagem($identificacao));
    } 

    public function getVacinasAgrupadasPorProcedimento(){

        $identificacao = $this->request->getPost('identificacao');

        echo json_encode($this->profissionalModel->getVacinasAgrupadasPorProcedimento($identificacao));
    } 

    public function getMedicacoesAgrupadasPorProcedimento(){

        $identificacao = $this->request->getPost('identificacao');

        echo json_encode($this->profissionalModel->getMedicacoesAgrupadasPorProcedimento($identificacao));
    } 
}
