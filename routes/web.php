<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// FIM ROTAS GETS VIEWS E TABELAS
Route::get('/getTableEncomendaPendente', 'Admin\EncomendaController@getEncomendaPendente')->name('encomendas.table.pendentes');
Route::get('/getTableEncomendaSolicitada', 'Admin\EncomendaController@getEncomendaSolicitadas')->name('encomendas.table.solicitadas');
Route::get('/getTableEncomendaEntregue', 'Admin\EncomendaController@getEncomendaEntregues')->name('encomendas.table.entregues');
Route::get('/getEncomendasSolicitada', 'Admin\EncomendaController@getViewEncomendaSolicitadas')->name('encomendas.index.solcitadas');
Route::get('/getEncomendasEntregue', 'Admin\EncomendaController@getViewEncomendaEntregues')->name('encomendas.index.entregues');
Route::get('/getEncomendasTrash', 'Admin\EncomendaController@getViewEncomendaTrash')->name('encomendas.index.trash');
Route::get('getTableGrupos', 'Admin\GrupoController@getTableGrupos')->name('grupos.table.index');
Route::get('removeacessogrupo/{role}', 'Admin\GrupoController@viewRemoveAcessoGrupo')->name('grupo.removeacesso');
Route::post('removeacessogrupo', 'Admin\GrupoController@postRemovePermission')->name('remove.permissions.grupo');
Route::get('adicionacessogrupo/{role}', 'Admin\GrupoController@viewAdicionaAcessoGrupo')->name('grupo.adicionaacesso');
Route::post('adicionaacessogrupo', 'Admin\GrupoController@postAdicionaPermission')->name('adiciona.permissions.grupo');
Route::get('alterarsenhaatual', 'Admin\UsuarioController@viewAlterarSenha')->name('usuario.mudarsenha');
Route::post('alterarsenhaatual', 'Admin\UsuarioController@updateSenha')->name('usuario.update.senha');
// FIM ROTAS GETS VIEWS E TABELAS

// ROTAS RESOURCES
Route::resource('encomendas', 'Admin\EncomendaController');
Route::resource('grupos', 'Admin\GrupoController');
// FIM  ROTAS RESOURCES

// ROTAS DE ENCOMENDAS NÃO RESOURCES
Route::get('solcicitarcompra/{encomenda}', 'Admin\EncomendaController@solicitarCompra')->name('encomendas.comprar');
Route::post('confirmarcompra/{encomenda}', 'Admin\EncomendaController@confirmarCompra')->name('encomendas.confirmar');
Route::get('preparadelete/{encomenda}', 'Admin\EncomendaController@prepararDelete')->name('encomendas.delete');
Route::get('preparaentrega/{encomenda}', 'Admin\EncomendaController@prepararEntrega')->name('encomendas.preparar.entrega');
Route::post('confirmarentrega/{encomenda}', 'Admin\EncomendaController@confirmarEntrega')->name('encomendas.confirmar.entrega');
Route::get('getTableEncomendaTrash', 'Admin\EncomendaController@getEncomendaTrash')->name('encomendas.table.trash');
Route::get('showtrash/{encomenda}', 'Admin\EncomendaController@showTrash')->name('encomendas.showtrash');
Route::get('cancelaentrega/{encomenda}', 'Admin\EncomendaController@preparaCancelaEntrega')->name('encomendas.prepara.cancela.entrega');
Route::post('confirmaCancelaEntrega/{encomenda}', 'Admin\EncomendaController@confirmarCancelaEntrega')->name('encomendas.confirma.cancela.entrega');
//  FIM ROTAS DE ENCOMENDAS
