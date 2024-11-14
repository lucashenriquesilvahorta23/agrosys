<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{

    protected $table = 'CON_USUARIO';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CON_USUARIO');
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
    }

    function getInformacoesLogin($usuario, $senha){
        $this->builder->select('USUARIO, NOME, EMAIL,TELEFONE,ID_USUARIO, URL_FOTO, FK_ID_PROFISSIONAL, TIPO');
        $this->builder->where('USUARIO', $usuario);
        $this->builder->where('SENHA', $senha);
        $this->builder->where('ATIVO', "A");
        return $this->builder->get()->getRow();
    }

    function getInformacoesCPF($usuario){
        $this->builder->select('USUARIO, NOME, EMAIL,TELEFONE,ID_USUARIO, URL_FOTO, FK_ID_PROFISSIONAL, TIPO');
        $this->builder->where('USUARIO', $usuario);
        return $this->builder->get()->getRow();
    }

    function getPermissaoMenu($idusuario, $escola){
        $builder = $this->db->table('CON_PERMISSAO AS PERM');
        $builder->select('M.FK_ID_MENU, ME.*');
        $builder->join('CON_METODO AS M', 'M.ID_METODO = PERM.FK_ID_METODO', 'INNER');
        $builder->join('CON_MENU AS ME', 'ME.ID_MENU = M.FK_ID_MENU', 'LEFT');
        $builder->where('PERM.FK_ID_USUARIO', $idusuario);
        $builder->where('PERM.FK_ID_ESCOLA', $escola);
        $builder->where('M.FK_ID_MENU != 0');
        $builder->groupBy('ME.DESCRICAO');
        $builder->orderBy('ME.PESO, ME.ID_MENU', 'ASC');
        return $builder->get();
    }

    function getPermissaoEscola($usuario, $escola){
        $builder = $this->db->table('CON_PERMISSAO AS PERM');
        $builder->select('COUNT(*) AS QTD');
        $builder->where('PERM.FK_ID_USUARIO', $usuario);
        $builder->where('PERM.FK_ID_ESCOLA', $escola);
        return $builder->get()->getRow();
    }

    /** Seleciona os submenu que o usuario tem acesso */

    function getUsuariosEscola($escola){
        $builder = $this->db->table('CON_USUARIO AS A');
        $builder->select('A.*');
        $builder->join('CON_PERMISSAO AS B', 'A.ID_USUARIO = B.FK_ID_USUARIO', 'INNER');
        $builder->where('B.FK_ID_ESCOLA', $escola);
        $builder->groupBy('FK_ID_USUARIO');
        return $this->builder->get()->getResult();
    }

    function getPermissaoSubmenu($idusuario, $escola, $idmenu){
        $builder = $this->db->table('CON_METODO AS M');
        $builder->select('M.FK_ID_SUBMENU, S.*');
        $builder->join('CON_PERMISSAO AS PERM', 'PERM.FK_ID_METODO = M.ID_METODO', 'LEFT');
        $builder->join('CON_SUBMENU AS S', 'S.ID_SUBMENU = M.FK_ID_SUBMENU', 'INNER');
        $builder->where('M.FK_ID_MENU', $idmenu);
        $builder->where('PERM.FK_ID_USUARIO', $idusuario);
        $builder->where('PERM.FK_ID_ESCOLA', $escola);
        $builder->groupBy('S.ID_SUBMENU');
        $builder->orderBy('S.DESCRICAO', 'ASC');
        return $builder->get();
    }

    function getUsuariosPermissao($idusuario){
        $this->builder->select('ID_USUARIO, NOME');
        $this->builder->orderBy('NOME', 'ASC');
        return $this->builder->get()->getResult();
    }

    function getPerfisPermissao(){
        $builder = $this->db->table('CON_PERFIL');
        return $builder->get()->getResult();
    }

    function getPermissao($array){
        $builder = $this->db->table('CON_PERMISSAO');
        $builder->where($array);
        return $builder->get()->getResultArray();
    }

    function getPermissoesUsuario($idusuario){
        $builder = $this->db->table('CON_PERMISSAO');
        $builder->select('FK_ID_METODO');
        $builder->where('FK_ID_USUARIO', $idusuario);
        return $builder->get()->getResultArray();
    }

    function getUsuarioAtivo(){
        $builder = $this->db->table('CON_USUARIO');
        $builder->where('ATIVO', 'A');
        $builder->orderBy('NOME', 'ASC');
        return $builder->get();
    }

    function getUsuarios(){
        return $this->builder->get()->getResult();
    }
    

    function getPass($email, $login){
        $builder = $this->db->table('CON_USUARIO');
        $builder->select('COUNT(*) AS QTD, ID_USUARIO');
        $builder->where('EMAIL', $email);
        $builder->where('USUARIO', $login);
        return $builder->get()->getRow();
    }

    function getLogs($dt_inicial, $dt_final, $usuario=""){
        $builder = $this->db->table('SYS_ACESS_LOG AS A');
        $builder->select('A.DATA, B.NOME, A.ID_LOG');
        $builder->join('CON_USUARIO AS B', 'A.FK_ID_USUARIO = B.ID_USUARIO', 'INNER');
        $builder->where('DATE_FORMAT(A.DATA, "%Y-%m-%d") >=', $dt_inicial);
        $builder->where('DATE_FORMAT(A.DATA, "%Y-%m-%d") <=', $dt_final);
        if($usuario!=""){
            $builder->where('B.ID_USUARIO', $usuario);
        }
        return $builder->get();
    }

    function getUsuarioID($id){
        $builder = $this->db->table('CON_USUARIO');
        $builder->where('ID_USUARIO', $id);
        return $builder->get()->getRow();
    }

    function usuarioVerificar($usuario){
        $builder = $this->db->table('CON_USUARIO');
        $builder->select('ID_USUARIO');
        $builder->where('USUARIO', $usuario);
        return $builder->get()->getResultArray();
    }

    function setUsuario($dados){
        $builder = $this->db->table('CON_USUARIO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        sys_log($this->usuario->ID_USUARIO, "Inserção de dados ID: ".$id."", "CON_USUARIO");
        return $id;
    }

    function updateUsuario($dados){
        $builder = $this->db->table('CON_USUARIO');
        $builder->where('ID_USUARIO', $dados['ID_USUARIO']);
        $builder->update($dados);
        //sys_log($this->usuario->ID_USUARIO, "Atualização de dados ID: ".$dados['ID_USUARIO']."", "CON_USUARIO");
        return $this->db->affectedRows();
    }

    function setLogAcess($data){
        $builder = $this->db->table('SYS_ACESS_LOG');
        $builder->insert($data);
    }

    function setLog($dados){
        $builder = $this->db->table('SYS_LOG');
        $builder->insert($dados);
    }

    function system_log($dados){
        $builder = $this->db->table('LOG');
        $builder->insert($dados);
    }

    function setPermissoesUsuario($checkperm, $idusuario, $escola){
        $builder = $this->db->table('CON_PERMISSAO');
        $this->limparPermissoes($idusuario, $escola);
        if($checkperm != null){
            foreach ($checkperm as $check){
                $dadosarray = array(
                    'FK_ID_USUARIO' => $idusuario,
                    'FK_ID_METODO' => $check,
                    'FK_ID_ESCOLA' => $escola
                );
                $builder->insert($dadosarray); 
                unset($dadosarray);  
            }
        }else{
            $dadosarray = array(
                'FK_ID_USUARIO' => $idusuario,
                'FK_ID_ESCOLA' => $escola
            );
            $builder->insert($dadosarray); 
            unset($dadosarray);  
        }
        sys_log($this->usuario->ID_USUARIO, "Inserção de permissão Usuario: ".$idusuario."", "CON_PERMISSAO");
    }

    function limparPermissoes($idusuario, $escola){   
        $builder = $this->db->table('CON_PERMISSAO');
        $builder->where('FK_ID_USUARIO', $idusuario);
        $builder->where('FK_ID_ESCOLA', $escola)->delete();  
    }
}
?>