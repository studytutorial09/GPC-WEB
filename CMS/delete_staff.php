<?php
    include "database.php";
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM staff WHERE TID=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        
        // Redirect back to view staff page after deletion
        header("Location: view_staff.php");
        exit();
    }
?>
