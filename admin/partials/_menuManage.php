<?php
    include 'connection.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['createItem'])) {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];

        $sql = "INSERT INTO `tbl_food` (`item`, `price`, `description`) VALUES ('$name', '$price', '$description')";   
        $result = mysqli_query($conn, $sql);
        $itemId = $conn->insert_id;
        if ($result){
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                
                $newName = 'item-'.$itemId;
                $newfilename=$newName .".jpg";

                $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/food-ordering-system/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                    echo "<script>alert('Success.');
                            window.location=document.referrer;
                        </script>";
                } else {
                    echo "<script>alert('Failed.');
                            window.location=document.referrer;
                        </script>";
                }

            }
            else{
                echo '<script>alert("Please select an image file to upload.");
                        window.location=document.referrer;
                    </script>';
            }
        }
        else {
            echo "<script>alert('Failed.');
                    window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['removeItem'])) {
        $itemId = $_POST["itemId"];
        $sql = "DELETE FROM `tbl_food` WHERE `id`='$itemId'";   
        $result = mysqli_query($conn, $sql);
        $filename = $_SERVER['DOCUMENT_ROOT']."/food-ordering-system/img/item-".$itemId.".jpg";
        if ($result){
            if (file_exists($filename)) {
                unlink($filename);
            }
            echo "<script>alert('Removed.');
                window.location=document.referrer;
                
            </script>";
        }
        else {
            echo "<script>alert('Failed.');
            window.location=document.referrer;
            </script>";
        }
    }
    if(isset($_POST['updateItem'])) {
        $itemId = $_POST["itemId"];
        $itemName = $_POST["name"];
        $itemDesc = $_POST["desc"];
        $itemPrice = $_POST["price"];
        
        $sql = "UPDATE `tbl_food` SET `item`='$itemName', `price`='$itemPrice', `description`='$itemDesc' WHERE `id`='$itemId'";   
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>alert('Update.');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('Failed.');
                window.location=document.referrer;
                </script>";
        }
    }
    if(isset($_POST['updateItemPhoto'])) {
        $itemId = $_POST["itemId"];
        $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
        if($check !== false) {
            $newName = 'item-'.$itemId;
            $newfilename=$newName .".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/food-ordering-system/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['itemimage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('Success.');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('Failed.');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
}
?>