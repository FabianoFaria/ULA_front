<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
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

}
