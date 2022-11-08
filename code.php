<?php 
	require_once "connection.php";

	if(isset($_POST))
	{
    $nama = mysqli_real_escape_string($link, $_POST['nama']);
    $alamat = mysqli_real_escape_string($link, $_POST['alamat']);
    $email = mysqli_real_escape_string($link, $_POST['email']);

    if($nama == NULL || $alamat == NULL || $email == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return false;
    }



    $query = "INSERT INTO users (nama,alamat,email) VALUES ('$nama','$alamat','$email')";
    $query_run = mysqli_query($link, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Created Successfully'
        ];
        echo json_encode($res);
        return false;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Created'
        ];
        echo json_encode($res);
        return false;
    }
}

//--- edit students btn ---

    if(isset($_GET['students_id'])){

        $students_id = mysqli_real_escape_string($link,$_GET['students_id']);

        $query  = "SELECT * FROM users WHERE id='$students_id'";
        $result = mysqli_query($link,$query);

            if(mysqli_num_rows($result) == 1)
            {
                $students = mysqli_fetch_array($result);

                $res = [
                    'status' => 200,
                    'message' => 'Student fetch Successfully by id',
                    'data' => $students
                ];
                echo json_encode($res);
                return false;
            }
            else
            {
                $res = [
                    'status' => 404,
                    'message' => 'Student id not found'
                ];
                echo json_encode($res);
                return false;
            }
    }
?>