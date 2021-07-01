<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Http\Requests\Recurso;
use App\Models\Cargo;
use App\Models\Escolaridade;
use App\Models\Pessoa;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class RecursoChart extends BaseChart
{
    public ?string $name = 'chart_recurso';
    public ?string $routeName = 'chart_recurso';
    public ?string $prefix = 'some_prefix';
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $cargos = Cargo::all();
        $escolaridades = Escolaridade::all();
        $nome_cargos = [];
        foreach ($cargos as $key => $cargo) {

            $nome_cargos[$key] = $cargo->cargo;
        }

        $chart = Chartisan::build()
            ->labels($nome_cargos);
        foreach ($escolaridades as $key => $escolaridade) {
            $chart->dataset($escolaridade->nivel_escolaridade,[]);
        }
        return $chart;
    }
}
