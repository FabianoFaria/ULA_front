<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "login/login"; /*welcome*/
$route['404_override'] = '';

$route['login'] = 'login/login';
$route['area_restrita'] = 'login/area_restrita/main_page/';
$route['area_restrita/main_page/'] = 'login/area_restrita/';
$route['area_restrita/main_page/(:any)'] = 'login/area_restrita/main_page/$i';

$route['/login/login/usuariosCadastrados'] = 'login/login/usuariosCadastrados/';
$route['/login/login/usuariosCadastrados/'] = 'login/login/';
$route['/login/login/usuariosCadastrados/(:any)'] = 'login/login/usuariosCadastrados/$i';

$route['novo_documento'] = 'login/novo_documento';
$route['novo_documento/cadastrarProtocolo'] = 'login/novo_documento/cadastrarProtocolo';
$route['continuar_documento'] = 'login/continuando_documento';
$route['continuar_documento/(:any)'] = "login/continuando_documento/$1";
$route['continuar_documento/Endereco/(:any)'] = 'login/continuando_documento/Endereco/$1';

$route['atualizar_documento'] = 'login/atualizar_documento';
$route['detalhes_documento/(:any)'] = "login/detalhes_documento/$1";

/* Deletar registros...*/

$route['deletar_documento/(:any)'] = "login/atualizar_documento/deletar_doct/$1";
$route['deletar_mercadoria/(:any)'] = "login/atualizar_documento/deletar_mercadoria/$1";
$route['deletar_pessoas/(:any)'] = "login/atualizar_documento/deleta_pessoas/$1";
$route['deletar_automoveis/(:any)'] = "login/atualizar_documento/deleta_auto/$1";
$route['deletar_warehouse/(:any)'] = "login/atualizar_documento/deleta_wrs/$1";
$route['deletar_anexo/(:any)'] = "login/atualizar_documento/deleta_anexo/$1";
$route['deletar_image/(:any)'] = "login/atualizar_documento/deleta_image/$1";


/* Pesquisa avançada*/
$route['pesquisa_avancada'] = "pesquisa/pesquisa_avancada";
$route['gerarRelatorios'] = "pesquisa/relatorios_gen";
$route['relatorio_gerado'] = "relatorios";
$route['pesquisar_documento'] = 'login/pesquisar_documento';

/* Paginas basicas ....*/
$route['logout'] = 'login/login/logout';
$route['about'] = 'pages/view/about';
$route['home'] = 'pages/view/home';

$route['pages'] = 'pages';
//$route['(:any)'] = 'pages/view/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */