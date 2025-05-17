<?php 
session_start();
include("../conn.php");

extract($_POST);

// Step 1: Fetch user by email only (no password in query)
$selAcc = $conn->prepare("SELECT * FROM examinee_tbl WHERE exmne_email = ?");
$selAcc->execute([$username]);
$selAccRow = $selAcc->fetch(PDO::FETCH_ASSOC);

// Step 2: Verify password using password_verify()
if ($selAcc && $selAcc->rowCount() > 0) {
    if (password_verify($pass, $selAccRow['exmne_password'])) {
        $_SESSION['examineeSession'] = array(
            'exmne_id' => $selAccRow['exmne_id'],
            'examineenakalogin' => true
        );
        $res = array("res" => "success");
    } else {
        // Password doesn't match
        $res = array("res" => "invalid");
    }
} else {
    // Email doesn't exist
    $res = array("res" => "invalid");
}

echo json_encode($res);
?>
