<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_restrita extends CI_Controller {
    
    function __construct() {
        parent::__construct();

        $this->load->model('Atualizar_documento_model', 'atualizar');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->model('User_model', 'user');
        $this->user->logged();
    }
    
    public function index() {

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('login/area_restrita_view');
        $this->load->view('templates/footer');
        
    }

    public function main_page() 
    {
        $config = array();
        $config['base_url'] = base_url()."index.php/area_restrita/main_page";
        $config['total_rows'] = $this->atualizar->doct_count();
        $config['per_page'] = 10; 

        $config['uri_segment'] = 3;     

        /* Initialize the pagination library with the config array */
        $this->pagination->initialize($config);

        $choice = $config["total_rows"]  / $config["per_page"];

        $config['num_links'] = round($choice);

        // $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Verificaremos se a paginação esta sendo executada ou
        // se apenas a página foi iniciada
        // Caso ela tenha apenas os dados iniciais,
        // a paginação começará
        // no ponto 0, ou seja, limit(100, 0)
        if ($this->uri->segment(3) == "/ ")
        {
            $page = 0;
        }
        else
        {
            $page = $this->uri->segment(3);
        }

        $data["result"] = $this->atualizar->fetch_docs($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        /* Load the view and pass the variables */
       // $this->load->view('page_view', $data);
        //}
    

        $this->load->helper('url');
        $this->load->view('templates/header');
        $this->load->view('login/area_restrita_view', $data);
        $this->load->view('templates/footer');
        
    }



    
}