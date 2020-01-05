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

        let formData = new FormData();
        formData.append('file', $('form')[1].file.files[0]);
        formData.append('book_name', bookName);
        formData.append('isbn', isbn);
        formData.append('year', year);
        formData.append('description', description);
        formData.append('action', 'addBook');

        $.ajax({
            url: 'php/ajaxBooksResults.php',
            type: 'POST',
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success: function (response) {
                let data = JSON.parse(response);

                if (data.response === true) {
                    alert('Book added!');
                    return true;
                }
            }
        });
    });

});