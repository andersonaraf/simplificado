<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use phpDocumentor\Reflection\Types\This;

class ResultadoExport implements FromView
{

    /**
    * @return \Illuminate\Support\Collection
    */
    private $pessoas;
    private $pessoasPNE;
    private $titulo;
    private $carrossel;

    /**
     * @param $pessoas
     * @param $pessoasPNE
     */
    public function __construct($pessoas, $pessoasPNE, $titulo, $carrossel)
    {
        $this->pessoas = $pessoas;
        $this->pessoasPNE = $pessoasPNE;
        $this->titulo = $titulo;
        $this->carrossel = $carrossel;
    }

    public function view() : View
    {
        $pessoas = $this->pessoas;
        $pessoasPNE = $this->pessoasPNE;
        $titulo = $this->titulo;
        $carrossel = $this->carrossel;
        $excel = true;
        return view('pdf_view', compact('pessoas', 'pessoasPNE', 'titulo', 'carrossel', 'excel'));
    }
}
