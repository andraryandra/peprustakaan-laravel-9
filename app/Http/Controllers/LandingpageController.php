<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    public function index()
    {
        return view('user.anggota.landingpage');
    }

    public function about()
    {
        return view("user.anggota.tampilan.about");
    }

    public function mading()
    {
        return view("user.anggota.tampilan.mading");
    }

    public function detailmading()
    {
        return view("user.anggota.tampilan.detail_mading");
    }

    public function ebook()
    {
        return view('user.anggota.tampilan.ebook');
    }

    public function detailebook()
    {
        return view('user.anggota.tampilan.detail_ebook');
    }

    public function artikel()
    {
        return view('user.anggota.tampilan.artikel');
    }

    public function riwayat()
    {
        return view('user.anggota.tampilan.riwayat');
    }
}
