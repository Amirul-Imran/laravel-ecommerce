<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list_item(Request $request) {
        $fields = $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'description' => 'max:255'
        ]);

        // Filter user input for malicious code injection
        $fields['name'] = strip_tags($fields['name']);
        $fields['description'] = strip_tags($fields['description']);
        $fields['created_by'] = auth()->id();
        $fields['updated_by'] = auth()->id();
        Products::create($fields);

        return redirect('/');
    }
}
