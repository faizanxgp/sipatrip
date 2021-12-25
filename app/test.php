<?php
session_start();
include('connection.php');
if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE email = '$email' ";


    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo true;
    } else {
        echo false;
    }


}
if (isset($_POST['booking_date']) && isset($_POST['start_time']) && isset($_POST['duration']) && isset($_POST['yacht_id'])) {
    // error_reporting(E_ALL);
    $date = $_POST['booking_date'];
    $booking_time = $_POST['start_time'];
    $booking_time = date('G:i:s', strtotime($booking_time));
    $duration = $_POST['duration'];
    $yacht_id = $_POST['yacht_id'];
    $time_book_requested = (float)(60 * 60 * $duration);
    $booking_time_end = date('G:i:s', strtotime($booking_time) + $time_book_requested);
    if (strtotime('00:00:00') == strtotime($booking_time_end)) {
        $booking_time_end = '24:00:00';
    }
// print_r($booking_time_end);
    $query = "SELECT * from booking where 
yacht_id = '" . $yacht_id . "' AND booking_date = '" . $date . "' 
 ";


    $result = mysqli_query($conn, $query);
    // print_r($result);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $value) {

            if (strtotime($booking_time) == strtotime($value['booking_time'])
                || strtotime($value['booking_time']) <= strtotime($booking_time) && strtotime($value['booking_time_end']) > strtotime($booking_time)
                || strtotime($value['booking_time']) < strtotime($booking_time_end) && strtotime($value['booking_time_end']) > strtotime($booking_time_end)
                || strtotime($value['booking_time']) < strtotime($booking_time_end) && strtotime($value['booking_time_end']) > strtotime($booking_time_end)
            ) {

                $ses_data = array
                (
                    'sYacht_id' => $yacht_id,
                    'sDate' => $date

                );
                // $_SESSION['showing_data'] = $ses_data;
                echo json_encode($ses_data);
                exit;
            } else {

                /*$ses_data = array
                 (
                  'sYacht_id'=>'',
                  'sDate' =>'',
                  'status'=>FALSE
                 );
               $_SESSION['showing_data'] = $ses_data; */
            }


        }


    } else {
        echo 0;
    }

}


if (isset($_POST["country_id"]) && !empty($_POST["country_id"])) {
    $country_id = $_POST["country_id"];
    // die();
    $query = "SELECT * from states where country_id = '" . $country_id . "' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $key => $value) {
            $id = $value['id'];
            $name = $value['name'];
            echo "<option value='$id' id='id'>" . ucfirst($name) . "</option>";
        }
    }
} else if (isset($_POST["state_id"]) && !empty($_POST["state_id"])) {
    $state_id = $_POST["state_id"];
    $query = "SELECT * from cities where state_id = '" . $state_id . "' ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $key => $value) {
            $id = $value['id'];
            $name = $value['name'];
            echo "<option value='$id' id='id'>" . ucfirst($name) . "</option>";
        }
    }

}


if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['selected_hours_list']) && isset($_POST['hours'])) {
    $start = $_POST['start'];
    $end = $_POST['end'];
    $hours = $_POST['hours'];
    $hours_array = $_POST['selected_hours_list'];
    $selected_hours_list = array();

    $period = new DatePeriod(
        new DateTime($start),
        new DateInterval('PT1H'),
        new DateTime($end)
    );
    foreach ($period as $date) {
        array_push($selected_hours_list, $date->format("G:i"));
    }
    $result = array_intersect($selected_hours_list, $hours_array);
    if (count($result) > 0) {
        echo 1;
    } else {
        echo 0;
    }
}

?>