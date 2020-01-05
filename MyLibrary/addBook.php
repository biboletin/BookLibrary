<?php
include_once "partials/menu_header.php";
?>

<main role="main" class="container">
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="center_div">
                    <h1 class="h3 mb-3 font-weight-normal">Add Book</h1>
                    <form id="addbook_form" method="post">
                        <label for="book_name" class="sr-only">Name:</label>
                        <input type="text" name="book_name" id="book_name" class="form-control" placeholder="Name"/>

                        <label for="isbn" class="sr-only">ISBN:</label>
                        <input type="text" name="isbn" id="isbn" class="form-control" placeholder="ISBN"/>

                        <label for="year" class="sr-only">Year:</label>
                        <input type="text" name="year" id="year" class="form-control" placeholder="Year"/>

                        <label for="description" class="sr-only">Description:</label>
                        <textarea name="description" id="description" cols="30" rows="5"></textarea>
                        <div class="custom-file">
                            <input type="file" name="password" id="password" class="custom-file-input" placeholder="Cover image"/>
                            <label class="custom-file-label" for="inputGroupFile04">Cover image</label>
                        </div>
                        <hr/>
                        <input type="button" id="add" class="btn btn-primary" value="Add"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="js/addBook.js"></script>
</body>
</html>
