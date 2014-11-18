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

    function perfil_usr($usr)
    {
        $this->db->where('username', $usr);
        $this->db->where('status >=', 1); // Verifica o status do usuário
        $query = $this->db->get('tbl_user');
        return $query->result();
    }

    function perfil_usr_alvo($id_usr_up)
    {
        $this->db->where('ID_user', $id_usr_up);
        $query = $this->db->get('tbl_user');
        return $query->result();
    }
    function gerar_novo_usuario($data_usr)
    {
        $this->db->insert('tbl_user', $data_usr);
        $this->db->select_max('ID_user');
        $RowAdr = $this->db->get('tbl_user');

        return $RowAdr->result();
    }

    function novos_usurario()
    {
        $this->db->select('tbl_user.ID_user, tbl_user.username,tbl_user.status , tbl_user.nome_usuario, tbl_user.cpf_usuario, tbl_user.CREATED_BY, tbl_user.CREATED');
        $query = $this->db->get('tbl_user');
        return $query->result();
    }


    function atualizar_usuario_alvo($data)
    {
        $this->db->where('ID_user', $data['ID_user']);
        $this->db->update('tbl_user', $data);
        
        return true;
    }

     public function usr_count() 
    {
        //Retorna o total de usuarios cadastrados...
        return $this->db->count_all_results('tbl_user');
    }

     public function fetch_usr($limit, $start) 
    {   
        //retorna os documentos que estão ativos no banco de dados...

        $this->db->limit($limit, $start);
        $this->db->order_by("tbl_user.ID_user", "desc");
        $query = $this->db->get('tbl_user');

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row) 
            {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
}