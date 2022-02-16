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
   dd(1);
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
Route::get('/', [\App\Http\Controllers\WeelcomeController::class, 'index'])->name('inicio');
Route::get('/cadastro/simplificado', [\App\Http\Controllers\RegistroController::class, 'index'])->name('cadastro-simplificado');
Route::post('/cadastro/simplificado/salvar', [\App\Http\Controllers\RegistroController::class, 'store'])->name('cadastro-simplificado.store');
Route::get('usuario/formulario/{id}', [\App\Http\Controllers\Usuario\UsuarioFormularioController::class, 'show'])->name('usuario.formulario.show');
Route::get('usuario/inscricao/{cargo_id}/{formulario_id}', [\App\Http\Controllers\Usuario\UsuarioFormularioController::class, 'create'])->name('usuario.formulario.create');
Route::post('usuario/finalizar/inscricao', [\App\Http\Controllers\Usuario\UsuarioFormularioController::class, 'store'])->name('usuario.formulario.store');
Route::get('/usuario', [\App\Http\Controllers\Usuario\UsuarioController::class, 'index'])->name('usuario.index');
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


});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', \App\Http\Controllers\UserController::class, ['except' => ['show']]);
});
