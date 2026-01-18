<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Agenda_model;
Paginator::useBootstrap();

class Agenda extends Controller
{
    // Agenda page
    public function index()
    {
        Paginator::useBootstrap();
        $site = DB::table('konfigurasi')->first();
        $model = new Agenda_model();
        $agenda = $model->listing();

        $data = array(
            'title' => 'Agenda - ' . $site->namaweb,
            'deskripsi' => 'Agenda - ' . $site->namaweb,
            'keywords' => 'Agenda',
            'site' => $site,
            'agenda' => $agenda,
            'agendas' => $agenda
        );
        return view('agenda.index', $data);
    }

    // Detail agenda
    public function detail($slug_agenda)
    {
        Paginator::useBootstrap();
        $site = DB::table('konfigurasi')->first();
        $model = new Agenda_model();
        $read = $model->read($slug_agenda);
        if (!$read) {
            return redirect('agenda');
        }

        $data = array(
            'title' => $read->judul_agenda,
            'deskripsi' => $read->judul_agenda,
            'keywords' => $read->judul_agenda,
            'site' => $site,
            'read' => $read,
            'content' => 'agenda/detail'
        );
        return view('agenda.detail', $data);
    }
}
