<?php


namespace Biboletin;


class FileUploader
{
    private $name;
    private $imagePath;
    private $userId;
    private $dbs;

    public function __construct($db)
    {
        $this->dbs = $db;
        $this->userId = \Biboletin\Session::get('user');
        $this->imagePath = '../book_images';
        if(!empty($_FILES)){
            $this->name = $_FILES['file']['name'];
        }
    }

    public function uploadImage(): bool
    {
        if (empty($_FILES)) {
            return false;
        }
        if (!mkdir($concurrentDirectory = $this->imagePath . '/' . $this->userId . '/') && !is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }
        $filePath = $concurrentDirectory . basename($_FILES['file']['name']);
        if(move_uploaded_file($_FILES['file']['tmp_name'], $filePath)){
            $sql = "INSERT INTO book_images (book_id, file_name, file_path) 
                        VALUES
                            ('" . $this->dbs->last_id . "', 
                            '" . $this->name . "', 
                            '" . $filePath . "')";
            return $this->dbs->sqlQuery($sql);
        }
        return false;
    }

    public function __destruct()
    {
        $this->name = null;
        $this->imagePath = null;
        $this->userId = null;
        $this->dbs = null;
    }
}