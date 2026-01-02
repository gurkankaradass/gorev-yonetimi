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

    public function create()
    {

        $model = new TaskModel();

        // Formdan gelen verileri alıyoruz.
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'status' => 'pending'
        ];

        // Veritabanına kaydet
        $model->insert($data);

        // İşlem bitince ana sayfaya geri dön
        return redirect()->to('/');
    }
}
