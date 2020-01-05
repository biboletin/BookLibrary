<?php
include_once 'inc/classes/config.php';
include_once 'partials/menu_header.php';
include_once 'inc/classes/filter.php';
include_once 'inc/classes/hash.php';
include_once 'inc/classes/book.php';
include_once 'inc/db/databaseConnector.php';
include_once 'inc/classes/file.php';

/**
 *
 */
$filter = new \Biboletin\Filter();
/**
 *
 */
$dbs = new \DataBaseConnector();
/**
 *
 */
$mysqli = $dbs->setEngine('mysqli')->makeConnection();
/**
 *
 */
$book = new \Biboletin\Book($mysqli);
?>

<main role="main">
<?php
    $books = $book->getMyBooks();
    if(empty($books)){
?>
        <div class="jumbotron">
            You don't have books
        </div>
</main>
    </body>
    </html>
<?php
        exit;
    }
?>
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
<?php
    foreach ($books as $book){
?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="<?php echo $book['file_path']?>" alt="<?php echo $book['file_name']?>" class="img-thumbnail" title="<?php echo $book['book_name']?>"/>
                    <div class="card-body">
                        <p>
                            <?php echo $book['book_name']?>
                        </p>
                        <p class="card-text">
                            <?php echo $book['book_description']?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-muted">
                                ISBN: <?php echo $book['book_isbn']?>
                                <br/>
                                Year: <?php echo $book['book_year']?>
                            </small>

                        </div>
                    </div>
                </div>
            </div>
<?php
    }
?>
        </div>
    </div>
</div>

</main>
</body>
</html>
