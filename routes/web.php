<?php

Route::get('/', function () {
    if (Auth::user()) {
        return view('home');
    } else {
        return view('acrpaginas.usuarios.login');
    }
})->name('login.acessar');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

/* ROTAS DO PROJETO BASE DE ACESSO */
Route::post('/logout', 'Admin\UsuarioController@logout')->name('logout');
Route::post('/login', 'Admin\UsuarioController@login')->name('login.post');
Route::get('/login', 'Admin\UsuarioController@loginView')->name('login.acessar');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/alterarsenha', 'Admin\UsuarioController@viewAlterarSenha')->name('alterar.senha');
Route::post('/alterarsenhaatual', 'Admin\UsuarioController@updateSenha')->name('usuario.update.senha');

Route::get('/getadicionapermissao/{user}', 'Admin\UsuarioController@viewAdicionaPermissaoUsuario')->name('getadiciona.permissao.usuario');
Route::get('/getremovepermissao/{user}', 'Admin\UsuarioController@viewRemovePermissaoUsuario')->name('getremove.permissaousuario');
Route::get('/getadicionapermissaogrupo/{role}', 'Admin\GrupoController@viewAdicionaPermissaoGrupo')->name('getadiciona.permissao.grupo');
Route::get('/getremovepermissaogrupo/{role}', 'Admin\GrupoController@viewRemovePermissaoGrupo')->name('getremove.permissao.grupo');

Route::get('/getremoveusuariogrupo/{role}', 'Admin\GrupoController@viewRemoveUsuarioGrupo')->name('getrenove.usuario.grupo');
Route::post('/removeusuariogrupo/{role}', 'Admin\GrupoController@removeUsuarioGrupo')->name('postremove.usuario.grupo');
Route::get('/getadicionausuariogrupo/{role}', 'Admin\GrupoController@viewAdicionaUsuarioGrupo')->name('getadiciona.usuario.grupo');
Route::post('/adicionausuariogrupo/{role}', 'Admin\GrupoController@adicionaUsuarioGrupo')->name('postadiciona.usuario.grupo');

Route::post('/adicionapermissao{user}', 'Admin\UsuarioController@adicionaPermissaoUsuario')->name('postadiciona.permissao.usuario');
Route::post('/removepermissao/{user}', 'Admin\UsuarioController@removePermissaoUsuario')->name('postremove.permissaousuario');
Route::post('/adicionapermissaogrupo/{user}', 'Admin\GrupoController@adicionaPermissaoGrupo')->name('postadiciona.permissao.grupo');
Route::post('/removepermissaogrupo/{user}', 'Admin\GrupoController@removePermissaoGrupo')->name('postremove.permissao.grupo');
/* ROTAS DO PROJETO BASE DE ACESSO */


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

Route::get('/getTableUsuarios', 'Admin\UsuarioController@getTableUsuarios')->name('datatable.getusuarios');
Route::get('/getTableGrupos', 'Admin\GrupoController@getTableGrupos')->name('datatable.getgrupos');
Route::get('/getTablePermissoes', 'Admin\PermissionController@getTablePermissoes')->name('datatable.getpermissoes');
Route::get('/getConveniados', 'Admin\ConveniadoController@getViewConveniados')->name('datatables.lista.conveniados');
Route::get('/getConvenios', 'Admin\ConvenioController@getViewConvenios')->name('datatables.lista.convenios');
Route::get('/getAdmConveniados', 'Admin\AdmConveniadoController@getViewAdmConveniados')->name('datatables.lista.admconveniados');
// FIM ROTAS GETS VIEWS E TABELAS


// ROTAS RESOURCES
Route::resource('users', 'Admin\UsuarioController');
Route::resource('roles', 'Admin\GrupoController');
Route::resource('permissions', 'Admin\PermissionController');
Route::resource('encomendas', 'Admin\EncomendaController');
Route::resource('conveniados', 'Admin\ConveniadoController');
Route::resource('convenios', 'Admin\ConvenioController');
Route::resource('admconveniados', 'Admin\AdmConveniadoController');
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
