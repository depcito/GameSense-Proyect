<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocaleController extends Controller
{
    /**
     * Save the language chosen by the visitor and go back to the page they were on.
     */
    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'locale' => ['required', 'string', Rule::in(array_keys(config('app.available_locales')))],
        ]);

        $request->session()->put('locale', $data['locale']);

        return back();
    }
}
