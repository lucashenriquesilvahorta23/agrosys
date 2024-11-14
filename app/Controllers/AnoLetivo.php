<?php

namespace App\Controllers;
use App\Models\AnoLetivoModel;
use App\Models\TurmaModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class AnoLetivo extends BaseController
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
        $this->anoLetivoModel = new AnoLetivoModel();
        $this->turmaModel = new TurmaModel();
        $this->auth = new Auth();
        helper('complementos');
    }


    public function index(){
        if($this->auth->checkAuth(9)){
            $dados = array();
            $dados['resultados'] = $this->anoLetivoModel->getAnoLetivo($this->escola->ID_ESCOLA);
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('anoLetivo/anoLetivo', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Inserir(){
        if($this->auth->checkAuth(10)){
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('anoLetivo/anoLetivo_cadastro');
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('anoLetivo_id');
        if($id == ""){
            $dados['ANO_LETIVO'] = $this->request->getPost('ano_letivo');
            $dados['DATA_INICIAL'] = $this->request->getPost('data_inicial');
            $dados['DATA_FINAL'] = $this->request->getPost('data_final');
            $dados['DATA_INICIAL_MATRICULA'] = $this->request->getPost('data_inicial_matricula');
            $dados['DATA_FINAL_MATRICULA'] = $this->request->getPost('data_final_matricula');
            $dados['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;

            $insert_id = $this->anoLetivoModel->setAnoLetivo($dados);

            $this->anoLetivoModel->deleteDatas($insert_id);
        
            $descricao_data = $this->request->getPost('descricao_data');
            $data_especifica = $this->request->getPost('data_especifica');
            $cor = $this->request->getPost('cor');


            if($descricao_data != NULL && $descricao_data != ""){

                for($x=0; $x<count($descricao_data); $x++){
                    $dados_dependentes['FK_ID_ANO_LETIVO'] = $insert_id;  
                    $dados_dependentes['DESCRICAO_DATA'] = $descricao_data[$x];  
                    $dados_dependentes['DATA'] = $data_especifica[$x];  
                    $dados_dependentes['COR_CALENDARIO'] = $cor[$x];  

                    $this->anoLetivoModel->setDatas($dados_dependentes);
                }
            }


            if($insert_id){
                return redirect()->to('/AnoLetivo/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/AnoLetivo/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['ID_ANO_LETIVO'] = $this->request->getPost('anoLetivo_id');
            $dados['ANO_LETIVO'] = $this->request->getPost('ano_letivo');
            $dados['DATA_INICIAL'] = $this->request->getPost('data_inicial');
            $dados['DATA_FINAL'] = $this->request->getPost('data_final');
            $dados['DATA_INICIAL_MATRICULA'] = $this->request->getPost('data_inicial_matricula');
            $dados['DATA_FINAL_MATRICULA'] = $this->request->getPost('data_final_matricula');

            $this->anoLetivoModel->deleteDatas($this->request->getPost('anoLetivo_id'));
        
            $descricao_data = $this->request->getPost('descricao_data');
            $data_especifica = $this->request->getPost('data_especifica');
            $cor = $this->request->getPost('cor');

            if($descricao_data != NULL && $descricao_data != ""){

                for($x=0; $x<count($descricao_data); $x++){
                    $dados_dependentes['FK_ID_ANO_LETIVO'] = $this->request->getPost('anoLetivo_id');  
                    $dados_dependentes['DESCRICAO_DATA'] = $descricao_data[$x];  
                    $dados_dependentes['DATA'] = $data_especifica[$x];  
                    $dados_dependentes['COR_CALENDARIO'] = $cor[$x];  

                    $this->anoLetivoModel->setDatas($dados_dependentes);
                }
            }
            
            if($this->anoLetivoModel->updateAnoLetivo($dados)){
                return redirect()->to('/AnoLetivo/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/AnoLetivo/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }

        }
    }

    public function Editar($id=""){
        if($this->auth->checkAuth(11)){
            $dados['anoLetivo'] = $this->anoLetivoModel->getAnoLetivoID(base64_decode($id));
            $dados['datas_especificas'] = $this->anoLetivoModel->getDatasAnoLetivoID(base64_decode($id));
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('anoLetivo/anoLetivo_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(12)){
            if($this->anoLetivoModel->deleteAnoLetivo(base64_decode($id))){
                return redirect()->to('/AnoLetivo/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/AnoLetivo/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function getAnosLetivo(){
        $ano_letivo = $this->turmaModel->getAnoLetivoAtual(date('Y'), $this->escola->ID_ESCOLA);

        if($ano_letivo != null && $ano_letivo != ""){
            echo json_encode($this->anoLetivoModel->getDatasAnoLetivoID($ano_letivo->ID_ANO_LETIVO));
        }else{
            echo json_encode("");
        }
    }   
}
