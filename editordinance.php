<?php

if(isset($_POST['save'])){
    include("connect.php");
    error_reporting(0);
    session_start();

    $moNo = $_POST['moNo'];
    $title = $_POST['title'];
    $dateAdopted = $_POST['dateAdopted'];
    $authorSponsor = $_POST['authorSponsor'];
    $remarks = $_POST['remarks'];
    $dateApproved = $_POST['dateApproved'];

    $sql = "UPDATE `ordinance` SET `mo_no`='$moNo', `title`='$title', `d_adopted`='$dateAdopted', `author_sponsor`='$authorSponsor', `remarks`='$remarks', `d_approved`='$dateApproved' WHERE mo_no = $moNo";
    $query = mysqli_query($conn, $sql);    

    if($query) {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ordinance Created',
                        text: 'The ordinance has been successfully Created.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'files-ordinances.php';
                        }
                    });
                });
              </script>";    
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error creating the ordinance.',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
        header("Location: files-ordinances.php");
        exit;    
    }
}    
?>

