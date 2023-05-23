<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        $users = auth()->getProvider();
        $jumlah_user = $users->countAll();
        $kategori_model = new \App\Models\CategoryModel();
        $jumlah_kategori = $kategori_model->countAll();

        return view('dashboard', [
            'kategori' => 'dashboard',
            'user' => auth()->user(),
            'jumlah_user' => $jumlah_user,
            'jumlah_kategori' => $jumlah_kategori
        ]);
    }
    public function dataMitra()
    {
        return view('dashboard', [
            'kategori' => 'datamitra',
            'user' => auth()->user()
        ]);
    }

    public function pengingat_penjadwalan()
    {
        $maxPaginate = 5;

        $model = new \App\Models\CategoryModel();
        $countAllRow = $model->countAll();

        $data = $model->orderBy('id', 'DESC')->paginate($maxPaginate);

        $page = request()->getVar('page');
        if ($page == null) {
            $page = 1;
        }

        // calculate number of page
        $pageCount = $countAllRow / $maxPaginate;
        // if page count is not integer, round up
        if (!is_int($pageCount)) {
            $pageCount = ceil($pageCount);
        }

        return view(
            'dashboard',
            [
                'kategori' => 'penjadwalan',
                'page' => $page,
                'pageCount' => $pageCount,
                'data' => $data,
                'maxPaginate' => $maxPaginate,
                'countAllRow' => $countAllRow,
                'user' => auth()->user()
            ]
        );
    }
    public function pengingat_dataKegiatan()
    {
        return view('dashboard', ['kategori' => 'dataKegiatan', 'user' => auth()->user()]);
    }
    public function kepanitiaan_panitia()
    {
        return view('dashboard', ['kategori' => 'panitia', 'user' => auth()->user()]);
    }
    public function kepanitiaan_sk()
    {
        return view('dashboard', ['kategori' => 'sk', 'user' => auth()->user()]);
    }

    public function chart_desainWeb()
    {
        return view('dashboard', ['kategori' => 'desainWeb', 'user' => auth()->user()]);
    }
    public function chart_pemrogramanMobile()
    {
        return view('dashboard', ['kategori' => 'pemrogramanMobile', 'user' => auth()->user()]);
    }
    public function chart_uiUx()
    {
        return view('dashboard', ['kategori' => 'uiUx', 'user' => auth()->user()]);
    }
    public function chart_ctf()
    {
        return view('dashboard', ['kategori' => 'ctf', 'user' => auth()->user()]);
    }
}
