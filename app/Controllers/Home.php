<?php

namespace App\Controllers;

use App\Models\TaskModel; // Modelimizi kullanacağımızı belirtiyoruz.

class Home extends BaseController
{
    public function index()
    {

        $model = new TaskModel();

        // Veritabanındaki tüm görevleri alıyoruz.
        $data['tasks'] = $model->findAll();

        // Verileri view dosyasına gönderiyoruz.
        return view('tasks', $data);
    }
}
