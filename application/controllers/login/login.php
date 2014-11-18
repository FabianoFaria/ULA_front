<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->library('pagination');
        $this->load->helper('url');
    }

    function index() {

        // VALIDATION RULES
         $this->load->helper('url');  

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');


        // MODELO MEMBERSHIP
        $this->load->model('User_model', 'user');
        $query = $this->user->validate();
        

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('login/login_view');
        } else {

            if ($query != null) { // VERIFICA LOGIN E SENHA

                    
               //Reupera od dados
                    foreach ($query as $usr) {

                        $lusr = $this->input->post('username');
                        $lNome = $usr->nome_usuario;
                        $lstatus = $usr->status;
                        $llogged = true;
                    }

              //Settar os dados na sessao...
                $data = array(
                 'nome_usr' => $lNome,   
                'username' =>  $lusr,
                'status' => $lstatus ,
                 'logged' => $llogged
                );
                  
                $this->session->set_userdata($data);
                redirect('area_restrita');
            } else {
                redirect('login?login ou senha errados');
                //echo "Algo deu muito errado";
            }
        }
    }

    function logout()
    {
        $this->load->helper('url');
        $this->session->userdata = array();
        $this->session->sess_destroy();
        redirect('login');
        //redirect(site_url('login'));
    }

    function perfil()
    {
        $user_name = $this->session->userdata('username');

        $data['usuario'] = $this->user->perfil_usr($user_name);

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('login/perfil_user_view', $data);
        $this->load->view('templates/footer');
    }

    function perfil_outro_usr()
    {
        $user_name = $this->session->userdata('username');

        $data['usuario'] = $this->user->perfil_usr($user_name);

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('login/perfil_user_view', $data);
        $this->load->view('templates/footer');
    }

    function usuariosCadastrados()
    {
        $user_name = $this->session->userdata('username');

        $data['usuario'] = $this->user->novos_usurario($user_name);

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('login/usuarios_cadastrados_view', $data);
        $this->load->view('templates/footer');
    }

    public function cadastrarUsuario()
    {
        $data['usuario_atualizador'] = null;
        $data['usuario'] = null;

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('login/perfil_user_view',$data); 
        $this->load->view('templates/footer');
    }

    public function listarUsuariosCadastrados()
    {
        $data['usuario'] = null;

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('login/perfil_user_view',$data);
        $this->load->view('templates/footer');
    }

    public function registrarUsuario(){

         $usuario_atualizador = $this->session->userdata('username');
         $username = $this->input->post('loginName');
         $nome_usuario = $this->input->post('userName'); 
         $status = $this->input->post('statusUsr');
         $cpf_usuario = $this->input->post('cpfName');
         $password = md5($this->input->post('novaSenha'));
         $status_final = 0;

         if($status == 'Desativado')
         {
            $status_final = 0;
         }else
         if($status == 'Ativado')
         {
            $status_final = 1;
         }


         //Settar os dados na sessao...
         $data = array(
         'username' => $username,   
         'nome_usuario' =>  $nome_usuario,
         'status' => $status ,
         'cpf_usuario' => $cpf_usuario,
         'password' => $password,
         'UPDATED_BY' => $usuario_atualizador,
         'CREATED_BY' => $usuario_atualizador,
         'CREATED' => date('y-m-d H:i:s')
         );

         $Novo_usuario = $this->user->gerar_novo_usuario($data);

         redirect(base_url().'index.php/login/login/usuariosCadastrados');

    }

    public function atualizarUsuario(){

         $usuario_atualizador = $this->session->userdata('username');
         $username = $this->input->post('loginName');
         $nome_usuario = $this->input->post('userName'); 
         $status = $this->input->post('statusUsr');
         $cpf_usuario = $this->input->post('cpfName');
         $password = md5($this->input->post('novaSenha'));
         $status_final = 0;

         if($status == 'Desativado')
         {
            $status_final = 0;
         }else
         if($status == 'Ativado')
         {
            $status_final = 1;
         }


         //Settar os dados na sessao...
         $data = array(
         'username' => $username,   
         'nome_usuario' =>  $nome_usuario,
         'status' => $status ,
         'cpf_usuario' => $cpf_usuario,
         'password' => $password,
         'UPDATED_BY' => $usuario_atualizador
         );

         $Novo_usuario = $this->user->atualizar_usuario_alvo($data);

         redirect(base_url().'index.php/login/login/usuariosCadastrados');

    }

    public function atualizarUsuarioAlvo(){

         $usuario_atualizador = $this->session->userdata('username');
         $ID_user = $this->input->post('id_usr');
         $username = $this->input->post('loginName');
         $nome_usuario = $this->input->post('userName'); 
         $status = $this->input->post('statusUsr');
         $cpf_usuario = $this->input->post('cpfName');
         $password = md5($this->input->post('novaSenha'));


         //Settar os dados na sessao...
         $data = array(
         'ID_user' => $ID_user,
         'username' => $username,   
         'nome_usuario' =>  $nome_usuario,
         'status' => $status ,
         'cpf_usuario' => $cpf_usuario,
         'password' => $password,
         'UPDATED_BY' => $usuario_atualizador
         );

         $Novo_usuario = $this->user->atualizar_usuario_alvo($data);

         redirect(base_url().'index.php/login/login/usuariosCadastrados');

    }


     public function editar_usuario($id_usr_up) 
    {
        $data['usuario'] = $this->user->perfil_usr_alvo($id_usr_up);
        $data['usuario_atualizador'] = $this->session->userdata('username');

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('login/perfil_user_view', $data);
        $this->load->view('templates/footer');
    }

}
