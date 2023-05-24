<?php

namespace App\Http\Controllers\Admin\Tampilan;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Tampilan\Footer;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        $footer = Footer::get();

        return view("admin.tampilan.footer.index", compact("user", "footer"));
    }

}
