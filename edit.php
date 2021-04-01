<?php

require "connection.php";

//ACCESS BOOK DATA BY ID
$stmt = $connect->prepare('SELECT * FROM book WHERE id=:id');
$stmt->bindValue('id', $_GET['id']);
$stmt->execute();

//ENABLE DATA BE FETCH FOR UPDATE
$book = $stmt->fetch(PDO::FETCH_OBJ);

if (isset($_POST['save'])) {

    //WHERE WE UPDATE N REPLACE OLD DATA
    $stmt = $connect->prepare('UPDATE book SET author=:author, title=:title, genre=:genre
    WHERE id=:id ');

    $stmt->bindValue('id', $_POST['id']);
    $stmt->bindValue('author', $_POST['author']);
    $stmt->bindValue('title', $_POST['title']);
    $stmt->bindValue('genre', $_POST['genre']);

    $stmt->execute();
    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>

<body>
    <div>
        <form action="" method="POST" autocomplete="off">
            <fieldset>
                <h1>Book Information</h1>
                <table>
                    <tr>
                        <td>ID</td>
                        <td><input type="hidden" name="id" value="<?php echo $book->id; ?>"></td>
                    </tr>
                    <tr>
                        <td>Author</td>
                        <td><input type="text" name="author" value="<?php echo $book->author; ?>"></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" value="<?php echo $book->title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td><input type="text" name="genre" value="<?php echo $book->genre; ?>"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="save" value="Update"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
</body>

</html>