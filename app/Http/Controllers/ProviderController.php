<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Requests\ProviderRequest;

// php artisan make:controller ProviderController --model=Provider -r

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.admin.providers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.admin.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProviderRequest $request)
    {
        $provider = Provider::create($request->all());
        return redirect()->route('providers.index')
        ->with('message-created', 'Proveedor : ' . $provider->name . ' con id: ' . $provider->id . ' fue Creado correctamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        //TODO
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
        return view('layouts.admin.providers.edit', [
            'provider' => $provider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProviderRequest $request, Provider $provider)
    {
        $provider->update($request->all());
        return redirect()->route('providers.index')
            ->with('message-updated', 'Proveedor : ' . $provider->name . ' con id: ' . $provider->id . ' fue actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index')
            ->with('message-deleted', 'Proveedor: ' . $provider->name . ' con id: ' . $provider->id . ' fue eliminado Correctamente!');
    }
}
