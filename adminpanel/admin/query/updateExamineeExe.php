<?php
include("../../../conn.php");
extract($_POST);

// Start building the update query based on whether a new password was provided
if (!empty($exPass)) {
    // Hash the new password
    $hashedPass = password_hash($exPass, PASSWORD_DEFAULT);

    $update = $conn->prepare("UPDATE examinee_tbl 
        SET exmne_fullname = ?, 
            exmne_course = ?, 
            exmne_gender = ?, 
            exmne_birthdate = ?, 
            exmne_year_level = ?, 
            exmne_email = ?, 
            exmne_password = ?
        WHERE exmne_id = ?");
    
    $updated = $update->execute([
        $exFullname, 
        $exCourse, 
        $exGender, 
        $exBdate, 
        $exYrlvl, 
        $exEmail, 
        $hashedPass, 
        $exmne_id
    ]);
} else {
    // No password change
    $update = $conn->prepare("UPDATE examinee_tbl 
        SET exmne_fullname = ?, 
            exmne_course = ?, 
            exmne_gender = ?, 
            exmne_birthdate = ?, 
            exmne_year_level = ?, 
            exmne_email = ?
        WHERE exmne_id = ?");
    
    $updated = $update->execute([
        $exFullname, 
        $exCourse, 
        $exGender, 
        $exBdate, 
        $exYrlvl, 
        $exEmail, 
        $exmne_id
    ]);
}

if ($updated) {
    $res = array("res" => "success", "exFullname" => $exFullname);
} else {
    $res = array("res" => "failed");
}

echo json_encode($res);
?>
