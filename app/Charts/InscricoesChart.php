<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Pessoa;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class InscricoesChart extends BaseChart
{
    public ?string $name = 'chart_inscricao';
    public ?string $routeName = 'chart_inscricao';
    public ?string $prefix = 'some_prefix';
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

        $geral = Pessoa::where('cargo_id', '1')->get()->count();
        $ginicologista = Pessoa::where('cargo_id', '2')->get()->count();
        $pediatra = Pessoa::where('cargo_id', '3')->get()->count();
        $familia = Pessoa::where('cargo_id', '4')->get()->count();

        $endemias = Pessoa::where('cargo_id', '5')->get()->count();
        $zoonoses = Pessoa::where('cargo_id', '6')->get()->count();

        $condutor = Pessoa::where('cargo_id', '7')->get()->count();
        $enfermagem = Pessoa::where('cargo_id', '8')->get()->count();

        return Chartisan::build()
            ->labels(['Médico Clínico Geral', 'Médico Ginecologista', 'Médico Pediatra', 'Médico de Saúde da Família e Comunidade', 'Agente de Endemias', 'Agente de Vigilância em Zoonoses', 'Condutor de Ambulância', 'Técnico de enfermagem'])
            ->dataset('Nivel Superior', [$geral, $ginicologista, $pediatra, $familia, 0, 0, 0, 0])
            ->dataset('Nivel Fundamental', [0, 0, 0, 0, $endemias, $zoonoses, 0, 0])
            ->dataset('Nível Médio', [0, 0, 0, 0, 0, 0, $condutor, 0])
            ->dataset('Nível Técnico', [0, 0, 0, 0, 0, 0, 0, $enfermagem]);
    }
}
