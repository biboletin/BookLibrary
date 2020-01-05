$(document).ready(function () {
    $('#add').click(function (e) {
        e.preventDefault();

        let bookName = $('#book_name').val();
        let isbn = $('#isbn').val();
        let year = $('#year').val();
        let description = $('#description').val();

        if (bookName === '') {
            alert('Book name is empty!');
            return false;
        }
        if (isbn === '') {
            alert('ISBN is empty!');
            return false;
        }
        if (year === '') {
            alert('Year is empty!');
            return false;
        }
        if (description === '') {
            alert('Description is empty!');
            return false;
        }

        $.post('php/ajaxBooksResults.php', $('#addbook_form').serialize() + '&action=addBook')
            .done(function (response) {
                let data = JSON.parse(response);

                if (data.response === true) {
                    alert('Book added!');
                    return true;
                }
            });
    });

});