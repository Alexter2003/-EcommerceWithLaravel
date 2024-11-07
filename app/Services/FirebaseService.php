<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Storage;

class FirebaseService
{
    protected $storage;

    public function __construct()
    {
        $this->storage = (new Factory)
            ->withServiceAccount(base_path('firebase_credentials.json')) // Ajusta la ruta si es necesario
            ->createStorage();
    }

    public function uploadFile($filePath, $fileName)
    {
        $bucket = $this->storage->getBucket();

        // Subir el archivo
        $object = $bucket->upload(
            fopen($filePath, 'r'), // Abre el archivo
            [
                'name' => $fileName // Nombre con el que se guardará en Firebase
            ]
        );

        return $object->info(); // Retorna información sobre el archivo subido
    }
}
