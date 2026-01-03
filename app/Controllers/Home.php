<?php

namespace App\Controllers;

use App\Models\TaskModel; // Modelimizi kullanacağımızı belirtiyoruz.

class Home extends BaseController
{
    public function index()
    {
        // Görevleri kategoriyle birleştirerek çekiyoruz
        $db = \Config\Database::connect();

        $builder = $db->table('tasks');
        $builder->select('tasks.*, categories.name as category_name, categories.color as category_color');
        $builder->join('categories', 'categories.id = tasks.category_id', 'left'); // Sol birleştirme
        $builder->orderBy('^tasks.id', 'DESC');

        $tasks = $builder->get()->getResultArray();

        // Kategorileri de (seçim kutusu için) çekelim

        $categories = $db->table('categories')->get()->getResultArray();

        return view('tasks', [
            'tasks' => $tasks,
            'categories' => $categories
        ]);
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

    public function complete($id)
    {
        $model = new TaskModel();

        // Önce bu id'li görevleri bulalım.
        $task = $model->find($id);

        if ($task) {
            // Durumu tersine çevirelim: pending ise completed, tam tersiyse pending yapalım.
            $newStatus = ($task['status'] === 'pending') ? 'completed' : 'pending';

            $model->update($id, ['status' => $newStatus]);
        }

        return redirect()->to('/');
    }

    public function delete($id)
    {
        $model = new TaskModel();
        $model->delete($id);
        return redirect()->to("/");
    }
}
