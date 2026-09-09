<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Log;

class GoogleDriveService
{
    protected $client;
    protected $drive;

    public function __construct()
    {
        $this->client = new Client();
        // Path ke file JSON Service Account
        $this->client->setAuthConfig(storage_path('app/google/service-account.json'));
        $this->client->addScope(Drive::DRIVE);
        $this->drive = new Drive($this->client);
    }

    public function createFolder($name, $parentId = null)
    {
        $fileMetadata = new DriveFile([
            'name' => $name,
            'mimeType' => 'application/vnd.google-apps.folder',
            'parents' => $parentId ? [$parentId] : []
        ]);
        return $this->drive->files->create($fileMetadata, ['fields' => 'id, webViewLink']);
    }

    public function shareFolder($folderId, $email)
    {
        $permission = new \Google\Service\Drive\Permission([
            'type' => 'user',
            'role' => 'writer',
            'emailAddress' => $email
        ]);
        $this->drive->permissions->create($folderId, $permission);
    }

    public function uploadFile($folderId, $filePath, $fileName)
    {
        $fileMetadata = new DriveFile([
            'name' => $fileName,
            'parents' => [$folderId]
        ]);
        $content = file_get_contents($filePath);
        return $this->drive->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($filePath),
            'uploadType' => 'multipart',
            'fields' => 'id, webViewLink'
        ]);
    }
}
