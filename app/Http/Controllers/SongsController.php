<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Kris\LaravelFormBuilder\FormBuilder;

class SongsController extends Controller {

    public function create(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\SongForm::class, [
            'method' => 'POST',
            'url' => route('song.store')
        ]);

        return view('song.create', compact('form'));
    }

    public function store(FormBuilder $formBuilder)
    {
        $form = $formBuilder->create(\App\Forms\SongForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        // Do saving and other things...
    }
}