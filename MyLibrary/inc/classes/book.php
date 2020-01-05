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

        return $this->dbs->sqlQuery($sql);
    }

    public function getMyBooks(): array
    {
        $sql = "SELECT 
                        books.book_name,
                        books.book_isbn,
                        books.book_year,
                        books.book_description,
                        book_images.`file_name`,
                        book_images.`file_path` 
                    FROM
                        books,
                        book_images,
                        users 
                    WHERE users.id = '" . \Biboletin\Session::get('user') . "' 
                        AND books.id = book_images.`book_id`";
        $result = $this->dbs->sqlQuery($sql);
        if ((empty($result)) || ($result === null)) {
            return [];
        }
        return $result;
    }

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