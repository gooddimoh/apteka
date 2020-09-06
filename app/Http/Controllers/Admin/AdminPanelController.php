<?php

namespace App\Http\Controllers\Admin;

class AdminPanelController
{
    public function index()
    {
        return redirect()->route('admin.pharmacy.index');
    }
}
