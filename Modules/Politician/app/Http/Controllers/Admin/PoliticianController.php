<?php

namespace Modules\Politician\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shared\responses\HTTPResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use services\PoliticianService;

class PoliticianController extends Controller
{
    public function __construct(
        protected PoliticianService $politicianService,
        protected HTTPResponse $httpResponse,
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('politician::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($data)
    {
        try
        {

        }
        catch (\Exception $e)
        {
            return $this->httpResponse->badRequest([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('politician::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('politician::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
