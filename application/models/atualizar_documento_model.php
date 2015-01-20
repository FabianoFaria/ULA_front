<?php
class Atualizar_documento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /* Carregar dados */

    public function doct_count() 
    {
        //Retorna o total de documentos ativos cadastrados...

        $this->db->where('status_doct', 0);
        return $this->db->count_all_results('tbl_doct');
    }

    public function fetch_docs($limit, $start) 
    {   
        //retorna os documentos que estão ativos no banco de dados...

        $this->db->limit($limit, $start);
        $this->db->order_by("tbl_doct.ROW_ID", "desc");
        //$this->db->join('tbl_main','tbl_main.parent_id = tbl_doct.ROW_ID', 'full outer');
        //$this->db->join('tbl_addr','tbl_addr.ID_addr = tbl_main.CHILD_ID' , 'left');
        //$this->db->join('tbl_estados','tbl_estados.id_estado = tbl_addr.state', 'left');
        //$this->db->join('tbl_cidades','tbl_cidades.id = tbl_addr.city', 'left');
        //$this->db->where('tbl_main.CHILD_TBL','tbl_addr');
        $this->db->where('tbl_doct.status_doct', 0);
        $query = $this->db->get('tbl_doct');

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

    public function load_todos_Ipls()
    {
        //carrega todos os documentos....
        $lastDoct = $this->db->get_where('tbl_doct', array('status_doct' => 0));
        return $lastDoct->result();
    }

    public function load_ultimos_Ipls()
    {

    	//$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
        $this->db->limit(10);
    	$lastDoct = $this->db->get_where('tbl_doct', array('status_doct' => 0));
    	return $lastDoct->result();
    }

    function load_estados()
    {
        $query = $this->db->get('tbl_estados');
        return $query->result();
    }

    /* Atualizar dados */

    public function atualiza_doct($data)
    {
       // echo $data['ROW_ID'];

        $doct= array(
            'qualification' => $data['qualification'] ,
            'security_unit' => $data['security_unit'] ,
            'arrest_date' =>    $data['arrest_date'] ,
            'link_arrest' =>    $data['link_arrest'] , 
            'summary' =>        $data['summary'] , 
            'operation' => $data['operation'] , 
            'arrest_destination' => $data['arrest_destination'],
            'UPDATED_BY' => $data['UPDATED_BY'],
            'LAST_UPDATE' => $data['LAST_UPDATE']
            );

        $this->db->where('ROW_ID', $data['ROW_ID']);
        $this->db->update('tbl_doct', $data);
        
        return true;
    }

    public function atualiza_addr($data)
    {
       // echo $data['ROW_ID'];

        $id_adr = $data['Adr_ID'];

        $doct= array(
            'address' => $data['address'] ,
            'nunber' => $data['nunber'] ,
            'complement' =>    $data['complement'] ,
            'district' =>    $data['district'] , 
            'city' => $data['city'] , 
            'state' => $data['state'] ,
            'zipcode' => $data['zipcode'],
            'country' =>        $data['country'],
            'UPDATE_BY' => $data['UPDATED_BY'],
            'LAST_UPDATE' => $data['LAST_UPDATE']
            );

        $this->db->where('ID_addr', $id_adr);
        $this->db->update('tbl_addr', $doct);
        
        return true;
    }

    public function atualizar_endereco_wrs($data)
    {

        /*
             $dataEnderecoWrs['ROW_ID'] = $this->input->post('row_id');
                $dataEnderecoWrs['address'] = $this->input->post('endereco');
                $dataEnderecoWrs['nunber'] = $this->input->post('numero_wrs');
                $dataEnderecoWrs['complement'] = $this->input->post('complemento');
                $dataEnderecoWrs['district'] = $this->input->post('bairro');
                $dataEnderecoWrs['state'] = $this->input->post('estado_apr');
                $dataEnderecoWrs['city'] = $this->input->post('cidade_apr');
                $dataEnderecoWrs['zipcode'] = $this->input->post('CEP');
                $dataEnderecoWrs['ID_addr'] = $this->input->post('id_addr');
                $dataEnderecoWrs['CREATED_BY'] = $user_name;
                $dataEnderecoWrs['CREATED'] = $dataAtualizacao;
                $dataEnderecoWrs['UPDATE_BY'] = $user_name;
                $dataEnderecoWrs['LAST_UPDATE'] = $dataAtualizacao;
    
        */
       // echo $data['ROW_ID'];

        $id_adr = $data['ID_addr'];

        $doct= array(
            'address' => $data['address'] ,
            'nunber' => $data['nunber'] ,
            'complement' =>    $data['complement'] ,
            'district' =>    $data['district'] , 
            'city' => $data['city'] , 
            'state' => $data['state'] ,
            'zipcode' => $data['zipcode'],
            'country' =>        $data['country'],
            'UPDATE_BY' => $data['UPDATED_BY'],
            'LAST_UPDATE' => $data['LAST_UPDATE']
            );

        $this->db->where('ID_addr', $id_adr);
        $this->db->update('tbl_addr', $doct);
        
        return true;
    }

    public function atualiza_auto($data)
    {
       // echo $data['ROW_ID'];

        $id_auto = $data['ID_vehicle'];

        $auto= array(
            'category' => $data['category'],
            'model' => $data['model'],
            'brand' => $data['brand'],
            'cor_veiculo' => $data['cor_veiculo'],
            'chassi' => $data['chassi'],
            'renavan' => $data['renavan'],
            'placa' => $data['placa'],
            'city' => $data['city'],
            'state' => $data['state'],
            'detalhes_veiculos' => $data['detalhes_veiculos'],
            'UPDATE_BY' => $data['UPDATED_BY'],
            'LAST_UPDATE' => $data['LAST_UPDATE']         
            );

        $this->db->where('ID_vehicle', $id_auto);
        $this->db->update('tbl_vehicle', $auto);
        
        return true;
    }

    public function atualiza_merc($data)
    {
       // echo $data['ROW_ID'];

        $id_haul = $data['ID_HAUL'];

        $merc= array(
            'product' => $data['product'],
            'unit' => $data['unit'],
            'qty' => $data['qty'],
            'brand' => $data['brand'],
            'tabacalera' => $data['tabacalera'],
            'UPDATED_BY' => $data['UPDATED_BY'],
            'LAST_UPDATE' => $data['LAST_UPDATE']        
            );

        $this->db->where('ID_HAUL', $id_haul);
        $this->db->update('tbl_haul', $merc);
        
        return true;
    }


    public function atualiza_contact($data)
    {
       // echo $data['ROW_ID'];

        $id_contact = $data['ID_contact'];

        $contact= array(
            'name' => $data['name'],  
            'genre' => $data['genre'],
            'CPF' => $data['CPF'],
            'rg' => $data['rg'],
            'passport' => $data['passport'],
            'father' => $data['father'],
            'mother' => $data['mother'],
            'profession' => $data['profession'],
            'birth_dt' => $data['birth_dt'],
            //'endereco_contato' => $data['endereco_contato'],
            'birth_city' => $data['birth_city'],
            'birth_state' => $data['birth_state'],
            'birth_country' => $data['birth_country'],
            'comentarios_detidos' => $data['comentarios_detidos'],

            'telefone' => $data['telefone'],
            'marca_telefone' => $data['marca_telefone'],
            'modelo_telefone' => $data['modelo_telefone'],
            'IMEI' => $data['IMEI'],
            'operadora' => $data['operadora'],
            
            'UPDATE_BY' => $data['UPDATE_BY'],
            'LAST_UPDATE' => $data['LAST_UPDATE']        
            );

        //var_dump($contact);
        //die;

        $this->db->where('ID_contact', $id_contact);
        $this->db->update('tbl_contact', $contact);
        
        return true;
    }

    public function verificaContatoIpl($rowId, $contactId)
    {

        $this->db->select('*');
        $this->db->from('tbl_main');
        $this->db->where('tbl_main.CHILD_TBL', 'tbl_contact');
        $this->db->where('tbl_main.parent_id', $rowId);
        $this->db->where('tbl_main.CHILD_ID', $contactId);
        $contatoIPL = $this->db->get();

        return $contatoIPL->result();

    }


    public function atualiza_wrs($data)
    {
       // echo $data['ROW_ID'];

        $id_wrs = $data['ID_wrs'];

        $contact= array(
            'unidade_produto_deposito' => $data['unidade_produto_deposito'],
            'produto_deposito' => $data['produto_deposito'],
            'marca_produto_deposito' => $data['marca_produto_deposito'],
            'quantidade_deposito' => $data['quantidade_deposito'],
            'tabacalera_produto_deposito' => $data['tabacalera_produto_deposito'],
            'UPDATED_BY' => $data['UPDATED_BY'],
            'LAST_UPDATe' => $data['LAST_UPDATE']
            );

        $this->db->where('ID_wrs', $id_wrs);
        $this->db->update('tbl_wrs', $contact);
        
        return true;
    }

   
     public function atualiza_anexo($data)
    {
       // echo $data['ROW_ID'];

        $id_anx = $data['ID_anexos'];

        $anexos = array(
            'nome_arquivo' => $data['nome_arquivo'],
            'location' => $data['location'],
            'UPDATED_BY' => $data['UPDATED_BY'],
            'LAST_UPDATE' => $data['LAST_UPDATE']
            );

        $this->db->where('ID_anexos', $id_anx);
        $this->db->update('tbl_anexos', $anexos);
        
        return true;
    }

     public function atualiza_image($data)
    {
       // echo $data['ROW_ID'];
       // var_dump($data);
        //die;

        $id_img = $data['ID_image'];

        $anexos = array(
            'nome_arquivo' => $data['nome_arquivo'],
            'location' => $data['location'],
            'UPDATED_BY' => $data['UPDATED_BY'],
            'LAST_UPDATE' => $data['LAST_UPDATE']
            );

        $this->db->where('id_image', $id_img);
        $this->db->update('tbl_image_doct', $data);
        
        return true;
    }

     /* funçâo para deletar o documento...  é um update na verdade, mas tudo para evitar problemas de dados inconsistentes */

     public function deleta_doct($id_doct)
    {

        $data = array(
            'status_doct' => 3
            );

        $this->db->where('ROW_ID', $id_doct);
        $this->db->update('tbl_doct', $data); 

        return true;

    }

    /* funçôes para deletar os conteudos dos documentos... */

   
    public function deleta_mercadoria($id_haul)
    {
        $this->db->where('ID_HAUL', $id_haul);
        $this->db->delete('tbl_haul');

        return true;

    }

    public function deleta_pessoas($id_contact)
    {
        //$this->db->where('ID_contact', $id_contact);
        //$this->db->delete('tbl_contact');

        //return true;

        $data = array(
            'deletado' => 1
            );

        $this->db->where('ID_contact', $id_contact);
        $this->db->update('tbl_contact', $data); 

        return true;

    }

    public function deleta_automoveis($id_vehicle)
    {
        $this->db->where('ID_vehicle', $id_vehicle);
        $this->db->delete('tbl_vehicle');

        return true;

    }

    public function deleta_wrs($id_wrs)
    {

        $data = array('deletado' => 1);
        $this->db->where('ID_wrs', $id_wrs);
        $this->db->update('tbl_wrs', $data); 
        //$this->db->delete('tbl_wrs');

        return true;

    }

    public function deleta_anexos($id_anexo)
    {
        $this->db->where('ID_anexos', $id_anexo);
        $this->db->delete('tbl_anexos');

        return true;

    }

    public function deleta_image($id_image)
    {
        $this->db->where('id_image', $id_image);
        $this->db->delete('tbl_image_doct');

        return true;

    }
}

       