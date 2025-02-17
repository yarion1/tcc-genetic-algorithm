<?php

use App\Http\Controllers\CollegeClassesController;
use App\Http\Controllers\Configuracao\MenuController;
use Illuminate\Http\Request;
use App\Http\Controllers\Disciplina\DisciplinaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Horario\BusinessHoursController;
use App\Http\Controllers\Horario\DayController;
use App\Http\Controllers\TimeslotsController;
use App\Http\Controllers\Horario\EventoController;
use App\Http\Controllers\Horario\HorarioController;
use App\Http\Controllers\Horario\HorarioEventoController;
use App\Http\Controllers\Horario\NotificacaoHorarioController;
use App\Http\Controllers\Horario\Restricao\RestricaoClassificacaoController;
use App\Http\Controllers\Horario\Restricao\RestricaoController;
use App\Http\Controllers\Horario\Restricao\RestricaoGrupoController;
use App\Http\Controllers\Horario\Restricao\RestricaoGrupoEventoController;
use App\Http\Controllers\Horario\Restricao\TipoRestricaoController;
use App\Http\Controllers\Pessoa\PessoaController;
use App\Http\Controllers\Professor\ProfessorController;
use App\Http\Controllers\Sala\SalaController;
use App\Http\Controllers\Sala\TipoSalasController;
use App\Http\Controllers\TimetablesController;
use App\Http\Controllers\Turma\TurmaController;
use App\Http\Controllers\UnavailableTimeslotController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [PessoaController::class, 'login']);
Route::post('/register', [PessoaController::class, 'register']);
Route::get('/cursos', [PessoaController::class, 'cursos']);

Route::middleware('jwt.auth')->group(function () {
    
    Route::group([
        'prefix' => 'home',
        'controller' => HomeController::class
    ], function () {
        Route::get('/', 'index');
    });

    Route::prefix('pessoa')->group(function () {

        Route::controller(PessoaController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/usuario', 'usuario');
            Route::get('/{id}', 'show')->whereNumber('id');
            Route::post('/alterar-dados', 'alterarDados');
            Route::put('/{id}', 'update')->whereNumber('id');
            Route::delete('/{id}', 'destroy')->whereNumber('id');
        });
    });

    Route::prefix('configuracao')->group(function () {
        Route::prefix('menu')->group(function () {
            Route::controller(MenuController::class)->group(function () {
                Route::get('/', 'index');
            });
            // Route::prefix('menu')->group(function () {
            //     Route::controller(MenuController::class)->group(function () {
            //         Route::get('/', 'index');
            //     });
            // });
        });
    });

    Route::prefix('sala')->group(function () {
        Route::controller(SalaController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show')->whereNumber('id');
            Route::put('/{id}', 'update')->whereNumber('id');
            Route::delete('/{id}', 'destroy')->whereNumber('id');
        });
        Route::prefix('tipo-salas')->group(function () {
            Route::controller(TipoSalasController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::get('/{id}', 'show')->whereNumber('id');
                Route::put('/{id}', 'update')->whereNumber('id');
                Route::delete('/{id}', 'destroy')->whereNumber('id');
            });
        });
    });

    Route::prefix('disciplina')->group(function () {
        Route::controller(DisciplinaController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show')->whereNumber('id');
            Route::put('/{id}', 'update')->whereNumber('id');
            Route::delete('/{id}', 'destroy')->whereNumber('id');
        });
    });

    Route::prefix('periodos')->group(function () {
        Route::controller(CollegeClassesController::class)->group(function () {
            Route::get('/', 'indexPeriodos');
        });
    });

    Route::prefix('professor')->group(function () {
        Route::controller(ProfessorController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show')->whereNumber('id');
            Route::get('/pessoa/{id}', 'showPessoaProfessor')->whereNumber('id');
            Route::put('/{id}', 'update')->whereNumber('id');
            Route::delete('/{id}', 'destroy')->whereNumber('id');
        });

        Route::prefix('indisponibilidade')->group(function () {
            Route::controller(UnavailableTimeslotController::class)->group(function () {
                Route::delete('/{id}', 'destroy')->whereNumber('id');
            });
        });
    });

    Route::prefix('business-hours')->group(function () {
        Route::prefix('days')->group(function () {
            Route::controller(DayController::class)->group(function () {
                Route::get('/', 'index');
            });
        });
        Route::prefix('timeslots')->group(function () {
            Route::controller(TimeslotsController::class)->group(function () {
                Route::get('/', 'selects');
            });
        });
        // Route::controller(BusinessHoursController::class)->group(function () {
        //     Route::get('/', 'index');
        // });
    });

    Route::prefix('horario')->group(function () {
        Route::prefix('geracao')->group(function () {
            Route::controller(TimetablesController::class)->group(function () {
                Route::post('/', 'store');
            });
        });

        Route::prefix('notificacao')->group(function () {
            Route::controller(NotificacaoHorarioController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::delete('/{id}', 'destroy')->whereNumber('id');
            });
        });

        Route::controller(HorarioController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('/{id}', 'show')->whereNumber('id');
            Route::put('/{id}', 'update')->whereNumber('id');
            Route::delete('/{id}', 'destroy')->whereNumber('id');
            Route::post('/{id}/imprimir', 'imprimir')->whereNumber('id');
            Route::post('/{id}/criar-copia', 'criarCopia')->whereNumber('id');
            Route::put('/ativar-versao/{id}', 'ativarVersao')->whereNumber('id');
            Route::put('/gerando/{id}', 'updateGeracao')->whereNumber('id');
        });
        Route::prefix('restricao')->group(function () {

            Route::controller(RestricaoController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::get('/{id}', 'show')->whereNumber('id');
                Route::put('/{id}', 'update')->whereNumber('id');
                Route::delete('/{id}', 'destroy')->whereNumber('id');
            });

            Route::prefix('classificacao')->group(function () {
                Route::controller(RestricaoClassificacaoController::class)->group(function () {
                    Route::get('/', 'index');
                    Route::post('/', 'store');
                    Route::get('/{id}', 'show')->whereNumber('id');
                    Route::put('/{id}', 'update')->whereNumber('id');
                    Route::delete('/{id}', 'destroy')->whereNumber('id');
                });
            });

            Route::prefix('grupo')->group(function () {
                Route::controller(RestricaoGrupoController::class)->group(function () {
                    Route::get('/', 'index');
                    Route::post('/', 'store');
                    Route::get('/{id}', 'show')->whereNumber('id');
                    Route::put('/{id}', 'update')->whereNumber('id');
                    Route::delete('/{id}', 'destroy')->whereNumber('id');
                });

                Route::prefix('evento')->group(function () {
                    Route::controller(RestricaoGrupoEventoController::class)->group(function () {
                        Route::get('/', 'index');
                        Route::post('/', 'store');
                        Route::get('/{id}', 'show')->whereNumber('id');
                        Route::put('/{id}', 'update')->whereNumber('id');
                        Route::delete('/unico/{id}', 'destroy')->whereNumber('id');
                        Route::delete('/{id}', 'destroyGrupo')->whereNumber('id');
                        Route::put('/atualizar/{id}', 'acaoAtivacao')->whereNumber('id');
                        Route::get('/geral', 'geral');
                    });
                });
            });

            Route::prefix('tipos')->group(function () {
                Route::controller(TipoRestricaoController::class)->group(function () {
                    Route::get('/', 'index');
                });
            });
        });

        Route::prefix('evento')->group(function () {
            Route::controller(EventoController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/', 'store');
                Route::get('/{id}', 'show')->whereNumber('id');
                Route::put('/{id}', 'update')->whereNumber('id');
                Route::delete('/{id}', 'destroy')->whereNumber('id');
            });
        });
    });
});
