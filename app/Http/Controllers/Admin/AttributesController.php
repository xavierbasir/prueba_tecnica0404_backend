<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attribute;
use Carbon\Carbon;

class AttributesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $attributes = Attribute::whereNull('softDelete')->get();
        return response()->json(['attribute' => $attributes], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:10',
            'type' => 'required|min:2|max:10'
        ]);

        $attribute = Attribute::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return response()->json(['attribute' => "Attribute Created Successfully"], 200);
    }

    public function show($id)
    {
        $attribute = Attribute::find($id);
        return response()->json(['attribute' => $attribute], 200);
    }

    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return response()->json(['attribute' => $attribute], 200);
    }

    public function update(Request $request, $id)
    {
        $attribute = Attribute::find($id);
        $attribute->update($request->all());
        return response()->json(['attribute' => $attribute,'message' => 'Attribute Updated Successfully'], 200);
    }

    public function destroy($id)
    {
        Attribute::where('id', $id)
        ->update(['softDelete' => Carbon::now()]);
        return response()->json(['attribute' => "",'message' => 'Attribute Deleted Successfully'], 200);
    }
}
