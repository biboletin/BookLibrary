<?php


namespace Biboletin;


/**
 * Class Book
 * @package Biboletin
 */
class Book
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $isbn;
    /**
     * @var
     */
    private $year;
    /**
     * @var
     */
    private $description;
    /**
     * @var
     */
    private $dbs;

    /**
     * Book constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->dbs = $db;
    }

    /**
     * @param string $name
     */
    public function setName($name = '')
    {
        $this->name = $name;
    }

    /**
     * @param string $isbn
     */
    public function setISBN($isbn = '')
    {
        $this->isbn = $isbn;
    }

    /**
     * @param string $year
     */
    public function setYear($year = '')
    {
        $this->year = $year;
    }

    /**
     * @param string $description
     */
    public function setDescription($description = '')
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getISBN()
    {
        return $this->isbn;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function addBook()
    {
        $sql = "INSERT INTO books (
                        book_name,
                        book_isbn,
                        book_year,
                        book_description,
                        user_id
                    ) 
                    VALUES
                        (
                        '" . $this->name . "', 
                        '" . $this->isbn . "', 
                        '" . $this->year . "', 
                        '" . $this->description . "', 
                        '" . \Biboletin\Session::get('user') . "')";
        error_log($this->dbs->last_id);
        return $this->dbs->sqlQuery($sql);
    }
    public function getBookById(){}
    public function getAllBooks(){}
    /**
     *
     */
    public function __destruct()
    {
        $this->name = null;
        $this->isbn = null;
        $this->year = null;
        $this->description = null;
        $this->dbs = null;
    }
}