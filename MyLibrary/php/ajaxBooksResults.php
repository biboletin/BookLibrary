<?php
include_once '../inc/classes/config.php';
include_once '../inc/classes/filter.php';
include_once '../inc/classes/session.php';
include_once '../inc/classes/hash.php';
include_once '../inc/classes/book.php';
include_once '../inc/db/databaseConnector.php';
include_once "../inc/classes/file.php";
\Biboletin\Session::start();

/**
 *
 */
$filter = new \Biboletin\Filter();
/**
 *
 */
$action = strtolower($filter->sanitizeInput($_POST['action']));
/**
 *
 */
$dbs = new \DataBaseConnector();
/**
 *
 */
$mysqli = $dbs->setEngine('mysqli')->makeConnection();

$bookName = $filter->sanitizeInput($_POST['book_name']);
$isbn = $filter->sanitizeInput($_POST['isbn']);
$bookYear = $filter->sanitizeInput($_POST['year']);
$description = $filter->sanitizeInput($_POST['description']);

$book = new \Biboletin\Book($mysqli);

if($action === 'addbook'){
    $book->setName($bookName);
    $book->setISBN($isbn);
    $book->setYear($bookYear);
    $book->setDescription($description);
    $data['response'] = false;
    if($book->addBook()){
        $data['response'] = true;

        if(!empty($_FILES)){
            $file = new \Biboletin\FileUploader($mysqli);
            if($file->uploadImage() === false){
                $data['response'] = false;
            }
        }
    }

    echo json_encode($data);
}