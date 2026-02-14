<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = [
            "Buku menguasai bumi",
            "Buku seporsi mie ayam sebelum mati",
            "Buku is it bad or good habits",
            "Buku 10 keajaiban dunia",
        ];

        return $books;
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $books = [
            "Buku menguasai bumi",
            "Buku seporsi mie ayam sebelum mati",
            "Buku is it bad or good habits",
            "Buku 10 keajaiban dunia",
        ];

        return $books;
    }
}
