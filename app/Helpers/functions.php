<?php
function title(){
    $title = \App\Models\Title::all()->first();

    if (is_null($title)) {
        $title = 'RB SIMPLIFICADO';
    }
    return $title;
}
