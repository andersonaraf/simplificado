<?php
use Illuminate\Support\Facades\Route;

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
//FALBACK
Route::fallback(function (){
   dd('Sem resposta com o servidor');
});
//LOGIN
Auth::routes([
    'register' => false
]);
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/sair', function () {
    auth()->logout();
    return redirect()->route('inicio');
})->name('sair');

//AREA DO USUÁRIO ::INICIO::
//Inscrição usuário
Route::get('/', [\App\Http\Controllers\WeelcomeController::class, 'index'])->name('inicio');
Route::get('/cadastro/simplificado', [\App\Http\Controllers\RegistroController::class, 'index'])->name('cadastro-simplificado');
Route::post('/cadastro/simplificado/salvar', [\App\Http\Controllers\RegistroController::class, 'store'])->name('cadastro-simplificado.store');
Route::get('usuario/formulario/{id}', [\App\Http\Controllers\Usuario\UsuarioFormularioController::class, 'show'])->name('usuario.formulario.show');
Route::get('usuario/inscricao/{cargo_id}/{formulario_id}', [\App\Http\Controllers\Usuario\UsuarioFormularioController::class, 'create'])->name('usuario.formulario.create');
Route::post('usuario/finalizar/inscricao', [\App\Http\Controllers\Usuario\UsuarioFormularioController::class, 'store'])->name('usuario.formulario.store');

//retorna tela de admin do usuário
Route::get('/usuario', [\App\Http\Controllers\Usuario\UsuarioController::class, 'index'])->name('usuario.index');
//lista processos participados pelo usuário
Route::get('/usuario/lista/{id}', [\App\Http\Controllers\Usuario\UsuarioController::class, 'show'])->name('usuario.lista.processos');

//AREA DO USUÁRIO ::FIM::

Route::group(['middleware' => 'acesso.restrito'] , function () {
    Route::resource('formulario', \App\Http\Controllers\FormularioController::class);
    Route::resource('formulario/configuracao', \App\Http\Controllers\ConfiguracaoFormularioController::class)->only(['index', 'store', 'show', 'edit', 'update']);
    Route::resource('formulario/configuracao/escolaridade', \App\Http\Controllers\EscolaridadeController::class);
    Route::resource('formulario/configuracao/escolaridade/cargo', \App\Http\Controllers\CargoController::class);
    Route::resource('formulario/configuracao/campo', \App\Http\Controllers\Admin\Configuracao\Formulario\CampoController::class);
    Route::resource('avaliar/formulario/escolher', \App\Http\Controllers\Admin\Avaliacao\FormularioController::class)->only(['index', 'show']);
    Route::resource('avaliar/formulario/candidato', \App\Http\Controllers\Admin\Avaliacao\CandidatoController::class);

    Route::get('formulario/configuracao/collapse/show/{id}', [\App\Http\Controllers\ConfigurarCargoController::class, 'show'])->name('configurar.cargo.show');
    Route::get('formulario/configuracao/create/{id}', [\App\Http\Controllers\ConfiguracaoFormularioController::class, 'create'])->name('configuracao.create');
    Route::post('/formulario/configurar/collapse/store', [\App\Http\Controllers\CollapseController::class, 'store'])->name('collapse.store');
    Route::put('/formulario/configurar/collapse/update/{id}', [\App\Http\Controllers\CollapseController::class, 'update'])->name('collapse.update');
    Route::delete('/formulario/configurar/collapse/destroy/{id}', [\App\Http\Controllers\CollapseController::class, 'destroy'])->name('collapse.destroy');
    Route::post('cadastrar/item/select/', [\App\Http\Controllers\ConfigurarCargoController::class, 'cadastarItemSelect'])->name('cadastrar.itemSelect');
    Route::put('editar/campo/{id}', [\App\Http\Controllers\ConfigurarCargoController::class, 'editarCampo'])->name('editar.campo');
    Route::post('/formulario/cargo/campo/salvar', [\App\Http\Controllers\ConfiguracaoFormularioController::class,'store'])->name('formulario.cargo.campo.store');
    Route::get('grupos', [\App\Http\Controllers\GrupoController::class, 'index'])->name('grupo.index');
    Route::get('grupo', [\App\Http\Controllers\GrupoController::class, 'create'])->name('grupo.create');
    Route::post('grupo', [\App\Http\Controllers\GrupoController::class, 'store'])->name('grupo.store');
    Route::get('grupo/{id}', [\App\Http\Controllers\GrupoController::class, 'edit'])->name('grupo.edit');
    Route::put('grupo/{id}', [\App\Http\Controllers\GrupoController::class, 'update'])->name('grupo.update');
    Route::get('pessoas/grupo/{id}', [\App\Http\Controllers\GrupoController::class, 'people'])->name('grupo.people');
    Route::post('pessoas', [\App\Http\Controllers\GrupoController::class, 'search'])->name('grupo.search');
    Route::post('remove/pessoa', [\App\Http\Controllers\GrupoController::class, 'removePeople'])->name('grupo.removepeople');
    Route::post('adicionar/pessoas', [\App\Http\Controllers\GrupoController::class, 'addpeople'])->name('grupo.adicionarpeople');


});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', \App\Http\Controllers\UserController::class, ['except' => ['show']]);
});
