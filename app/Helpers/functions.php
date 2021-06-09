<?php
function title(){
    $title = \App\Models\Title::all()->first();
    return $title->titulo;
}
