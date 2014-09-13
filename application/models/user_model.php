<?php
class User_model extends CI_Model {

    # VALIDA USUÁRIO
    function validate() {
        $this->db->where('username', $this->input->post('username')); 
        $this->db->where('password', md5($this->input->post('password'))); /* */
        $this->db->where('status >=', 1); // Verifica o status do usuário
        $query = $this->db->get('tbl_user');



        if ($query->num_rows == 1) { 
            return $query->result(); // RETORNA VERDADEIRO
        }
        else
        {
             return null;
        }
    }

    # VERIFICA SE O USUÁRIO ESTÁ LOGADO
    function logged() {
        $logged = $this->session->userdata('logged');

        if (!isset($logged) || $logged != true) {
             redirect('login?sessao expirada');
            //echo 'Voce nao tem permissao para entrar nessa pagina. <a href="http://localhost/ULA_front/index.php/login">Efetuar Login</a>';
            //die();
           //$this->load->view(base_url().'/application/views/login/sessao_expirada_view');
        }
    }
}