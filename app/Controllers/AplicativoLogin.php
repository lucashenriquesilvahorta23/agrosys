<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\EscolaModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class AplicativoLogin extends BaseController
{

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->usuarioModel = new UsuarioModel();
		$this->escolaModel = new EscolaModel();
        $this->session = \Config\Services::session();
    }

	public function index()
	{

		$usuario = $this->session->get('dadoslogin');
        if(isset($usuario)){
            return redirect()->to('/Aplicativo');
        }else{
			$dados['escolas'] =  $this->escolaModel->getEscolas();
			echo view('login_app', $dados);
		}
		
	}

	//--------------------------------------------------------------------

	public function validaLogin(){
        $login = $this->usuarioModel->getInformacoesLogin(strtoupper($this->request->getPost('username')), sha1($this->request->getPost('password'))); //Verifica as informações de Login
        if(!empty($login)){	
			$escola = $this->usuarioModel->getPermissaoEscola($login->ID_USUARIO, $this->request->getPost('profissional_escola'));
			if($escola->QTD > 0){
				$dadosuser['dadoslogin'] = $login;
				$info_escola = $this->escolaModel->getEscolaID($this->request->getPost('profissional_escola'));
				$dadosuser['escola'] = $info_escola;	
				$this->session->set($dadosuser); //Se o login existir, seta as informações retornadas pela query em uma sessão.
				/** SALVA LOG DE ACESSO */
				$log['FK_ID_USUARIO'] = $dadosuser['dadoslogin']->ID_USUARIO;
				$log['DATA'] = date('Y-m-d H:i:s');
				$this->usuarioModel->setLogAcess($log);
				return redirect()->to('/Aplicativo'); //redireciona para a página principal do sistema
			}else{
				$dados['escolas'] =  $this->escolaModel->getEscolas();
				$dados['errologin'] = 'Você não tem permissão para acessar essa escola'; // Se o login não existir retorna um erro para view.
				/* Carrega as views*/
				echo view('login', $dados);
			}
        }else{
			$dados['escolas'] =  $this->escolaModel->getEscolas();
			$dados['errologin'] = 'Usuario ou senha estão incorretos'; // Se o login não existir retorna um erro para view.
			/* Carrega as views*/
			echo view('login_app', $dados);
        }
	}
	
	public function sair(){
		//Destroi a sessão atual no navegador do usuario.
		$this->session->destroy();
		//chama o metodo (tela) de login
		return redirect()->to('/AplicativoLogin');
	}

	public function getEscolas(){
        echo json_encode($this->escolaModel->getEscolasUsuario($this->request->getPost('usuario')));
	}

	public function Senha(){
		echo view('senha');
	}

	public function Recovery(){
		$login = $this->usuarioModel->getInformacoesCPF(strtoupper($this->request->getPost('username'))); 
		if(!empty($login)){	
			$senha = uniqid();
			$dados['ID_USUARIO'] = $login->ID_USUARIO;
			$dados['SENHA'] = sha1($senha);
			$this->usuarioModel->updateUsuario($dados);
			
			$html = '<!doctype html>
            <html>
            <head>
            <meta charset="utf-8">
            <title>Sisgeo</title>
            </head>

            <body style="font-family: \'Helvetica Neue\', Helvetica, Arial, \'sans-serif\'; line-height: 1.6em; text-align: justify;">
                <table style="margin: 0 auto; max-width: 640px">
                    <tr>
                        <td>
                            <p>Prezado '.$login->NOME.',</p>
                            <p>Sua senha temporária para acesso ao sistema é: '.$senha.'</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Para acessar o sistema SISGEO, basta entrar no endereço <a href="https://www.app.sisgeo.com.br" target="_blank" style="text-decoration: none; color:#b000000">https://www.app.sisgeo.com.br</a> informar seu CPF e sua NOVA SENHA TEMPORÁRIA</p>
                        </td>
                    </tr>
                </table>
            </body>
            </html>';

            $email = \Config\Services::email();
            $config['SMTPHost'] = 'mail.lifecardmais.com.br';
            $config['SMTPPort'] = 465;
            $config['SMTPUser'] = 'contato@lifecardmais.com.br';
            $config['SMTPPass'] = 'Lifemais@34512';
            $config['protocol'] = 'smtp';
            $config['SMTPCrypto'] = 'ssl';
            $config['charset'] = 'utf-8';
            $config['mailType'] = 'html';
            $config['newline'] = '\r\n';
            $email->initialize($config);
            $email->setFrom('contato@lifecardmais.com.br', 'Sisgeo');
            $email->setTo($login->EMAIL);
            $email->setSubject('SISGEO - SENHA TEMPORÁRIA');
            $email->setMessage($html);
            if($email->send()){
                $dados['escolas'] =  $this->escolaModel->getEscolas();
				$dados['errologin'] = 'Enviamos um e-mail com a sua nova senha'; // Se o login não existir retorna um erro para view.
				/* Carrega as views*/
				echo view('login', $dados);
            }else{
                echo $email->printDebugger();
            }
		}else{
			$dados['escolas'] =  $this->escolaModel->getEscolas();
			$dados['errologin'] = 'Não encontramos esse CPF em nossa base de dados'; // Se o login não existir retorna um erro para view.
			/* Carrega as views*/
			echo view('login', $dados);
		}
	}

}
