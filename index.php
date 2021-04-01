<?php
require 'connection.php';
if (isset($_POST['save'])) {

    $stmt = $connect->prepare('INSERT INTO book(author,title,genre) 
    VALUE(:author,:title,:genre)');

    $stmt->bindValue('author', $_POST['author']);
    $stmt->bindValue('title', $_POST['title']);
    $stmt->bindValue('genre', $_POST['genre']);

    $stmt->execute();
    header("location:index.php");
}
//DELETE DATA
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $stmt = $connect->prepare('DELETE FROM book WHERE id=:id');
    $stmt->bindValue('id', $_GET['id']);
    $stmt->execute();

    echo "Data Deleted Succesfully";
}

//DISPLAY DATA
$stmt = $connect->prepare('SELECT * FROM book');
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>CRUD with PDO</title>
</head>

<body>
    <div class="data-contaier">
        <form action="" method="post">
            <div class="container">
                <label class="label" for="author">Author: </label>
                <input type="text" name="author" value="" id="author" class="container-form" placeholder="Insert Author Name">
                <label class="label" for="title">Title: </label>
                <input type="text" name="title" value="" id="title" class="container-form" placeholder="Insert Book Title">
                <label class="label" for="author">Genre: </label>
                <input type="text" name="genre" value="" id="genre" class="container-form" placeholder="Insert the Book Genre">

                <button type="submit" name="save" value="save" class="btn-submit">Submit</button>
            </div>
        </form>
    </div> <br>

    <div class="output-container">
        <fieldset>
            <table class="table-container">
                <thead>
                    <tr>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Genre</th>
                    </tr>
                    <?php
                    while ($book = $stmt->fetch(PDO::FETCH_OBJ)) { ?>
                        <tr>
                            <td class="teks-data"><?php echo $book->author; ?></td>
                            <td class="teks-data"><?php echo $book->title; ?></td>
                            <td class="teks-data"><?php echo $book->genre; ?></td>
                            <td class="button-info">
                                <a class="butang" href="index.php?id=<?php echo $book->id ?> &action=delete">Delete</a>
                                <a class="butang" href="edit.php?id=<?php echo $book->id ?>">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </thead>
            </table>
        </fieldset>
    </div>
</body>

</html>