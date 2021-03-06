<?php
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once 'config.php';
$function_name = '';
if (isset($_GET['fc']))
{
    $function_name = $_GET['fc'];
}
else
{
    if (isset($_POST['fc']))
    {
        $function_name = $_POST['fc'];
    }
}
if ($function_name == 'login')
{
    $connect = $c;
    include 'connect.php';
    date_default_timezone_set("Asia/Bangkok");

    $username = $_POST['txtUsername'];
    $password = md5($_POST['txtPassword']);
    //echo md5('12345');

    $query = "select * from backend_user where backend_user_name = '$username' AND backend_user_pw = '$password' AND backend_user_status = 1";
    $data = query_where($query);

    if ($data['backend_user_id'] != null)
    {
        $_SESSION['backend_user_id'] = $data['backend_user_id'];
        $_SESSION['backend_user_name'] = $data['backend_user_name'];
        $_SESSION['backend_user_group'] = $data['backend_user_group'];
        $_SESSION['backend_user_time'] = time() + (5 * 60);

        $data_log = array(
            "backend_user_id " => $data['backend_user_id'],
            "backend_user_log_timestamp" => date("Y-m-d H:i:s")
        );
        insert("backend_user_log", $data_log);
        ?>
        <meta http-equiv='refresh' content='0;URL=../destination.php'>
        <?php
    }
    else
    {
        //echo "Login Again";
        unset($_SESSION["backend_user_id"]);
        unset($_SESSION["backend_user_name"]);
        unset($_SESSION["backend_user_group"]);
        unset($_SESSION["backend_user_time"]);

        $_SESSION['login_warning'] = "Username or Password is wrong. Please Try Again.";
        ?>
        <meta http-equiv='refresh' content='0;URL=../login.php'>
        <?php
    }
}

if ($function_name == 'save_accommodation')
{

    $lag = $_POST['lag'];
    $accommodation_district_id = $_POST['accommodation_district_id'];
    $accommodation_province_id = $_POST['accommodation_province_id'];
    $accommodation_status = $_POST['accommodation_status'];
    $accommodation_geo_x = $_POST['accommodation_geo_x'];
    $accommodation_geo_y = $_POST['accommodation_geo_y'];
    $accommodation_info_tel = $_POST['accommodation_info_tel'];
    $accommodation_info_website = $_POST['accommodation_info_website'];
    $accommodation_info_email = $_POST['accommodation_info_email'];
    $accommodation_social_facebook = $_POST['accommodation_social_facebook'];
    $accommodation_social_instragram = $_POST['accommodation_social_instragram'];
    $accommodation_social_youtube = $_POST['accommodation_social_youtube'];
    $accommodation_book_via_hotels = $_POST['accommodation_book_via_hotels'];
    $accommodation_book_via_agoda = $_POST['accommodation_book_via_agoda'];
    $accommodation_book_via_booking = $_POST['accommodation_book_via_booking'];
    $accommodation_start_price = $_POST['accommodation_start_price'];
    $accommodation_top_price = $_POST['accommodation_top_price'];
    $accommodation_cat = $_POST['accommodation_cat'];
    $accommodation_name = $_POST['accommodation_name'];
    $accommodation_address = $_POST['accommodation_address'];
    $accommodation_details_80 = $_POST['accommodation_details_80'];
    $accommodation_details_200 = $_POST['accommodation_details_200'];
    $accommodation_details_long = $_POST['accommodation_details_long'];
    $accommodation_review_ref_short = $_POST['accommodation_review_ref_short'];
    $accommodation_review_ref_long = $_POST['accommodation_review_ref_long'];
    $accommodation_around_dec = $_POST['accommodation_around_dec'];
    $accommodation_distance_airport = $_POST['accommodation_distance_airport'];
    $accommodation_distance_town = $_POST['accommodation_distance_town'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';

    $query = "INSERT INTO `accommodation` (`accommodation_district_id`, `accommodation_province_id`, `accommodation_status`, `accommodation_geo_x`, `accommodation_geo_y`, `accommodation_info_tel`, `accommodation_info_website`, `accommodation_info_email`, `accommodation_social_facebook`, `accommodation_social_instragram`, `accommodation_social_youtube`, `accommodation_book_via_hotels`, `accommodation_book_via_agoda`, `accommodation_book_via_booking`, `accommodation_start_price`, `accommodation_top_price`, `accommodation_cat`, `accommodation_name`, `accommodation_address`, `accommodation_details_80`, `accommodation_details_200`, `accommodation_details_long`, `accommodation_review_ref_short`, `accommodation_review_ref_long`, `accommodation_around_dec`, `accommodation_distance_airport`, `accommodation_distance_town`) VALUES "
            . "('$accommodation_district_id', '$accommodation_province_id', '$accommodation_status', '$accommodation_geo_x', '$accommodation_geo_y', '$accommodation_info_tel', '$accommodation_info_website', '$accommodation_info_email', '$accommodation_social_facebook', '$accommodation_social_instragram', '$accommodation_social_youtube', '$accommodation_book_via_hotels', '$accommodation_book_via_agoda', '$accommodation_book_via_booking', '$accommodation_start_price', '$accommodation_top_price', '$accommodation_cat', '$accommodation_name', '$accommodation_address', '$accommodation_details_80', '$accommodation_details_200', '$accommodation_details_long', '$accommodation_review_ref_short', '$accommodation_review_ref_long', '$accommodation_around_dec', '$accommodation_distance_airport', '$accommodation_distance_town');";

    $result = mysqli_query($connect, $query);
    include 'close.php';
}

if ($function_name == 'save_destination')
{
    $lag = $_POST['lag'];
    $destination_district_id = $_POST['destination_district_id'];
    $destination_province_id = $_POST['destination_province_id'];
    $destination_status = $_POST['destination_status'];
    $destination_geo_x = $_POST['destination_geo_x'];
    $destination_geo_y = $_POST['destination_geo_y'];
    $destination_info_tel = $_POST['destination_info_tel'];
    $destination_info_fax = $_POST['destination_info_fax'];
    $destination_info_email = $_POST['destination_info_email'];
    $destination_info_website = $_POST['destination_info_website'];
    $destination_social_facebook = $_POST['destination_social_facebook'];
    $destination_social_instragram = $_POST['destination_social_instragram'];
    $destination_social_youtube = $_POST['destination_social_youtube'];
    $destination_cat = $_POST['destination_cat'];
    $destination_name = $_POST['destination_name'];
    $destination_address = $_POST['destination_address'];
    $destination_details_80 = str_replace("'", "\'", $_POST['destination_details_80']);
    $destination_details_200 = str_replace("'", "\'", $_POST['destination_details_200']);
    $destination_details_long = str_replace("'", "\'", $_POST['destination_details_long']);
    $destination_open_hour = $_POST['destination_open_hour'];
    $destination_fee = $_POST['destination_fee'];
    $destination_visit_season = $_POST['destination_visit_season'];

    $destination_content_ref_1 = $_POST['destination_content_ref_1'];
    $destination_content_ref_2 = $_POST['destination_content_ref_2'];
    $destination_content_ref_3 = $_POST['destination_content_ref_3'];
    $destination_content_ref_4 = $_POST['destination_content_ref_4'];
    $destination_content_ref_5 = $_POST['destination_content_ref_5'];
    $destination_update = $_POST['destination_update'];
    $destination_activity = $_POST['destination_activity'];


    if ($lag == "th")
    {
        $connect = $a;
    }
    if ($lag == "en")
    {
        $connect = $b;
    }
    include 'connect.php';

    //Check index_num_runup Table
    $chk_runup = count_table_record('index_num_runup');
    if ($chk_runup == 0 || $chk_runup == NULL)
    {
        $data_insert_runup = array(
            "id" => '1',
            "destination_runup_num" => '331',
            "restaurant_runup_num" => '0',
            "accommodation_runup_num" => '0'
        );
        insert("index_num_runup", $data_insert_runup);
    }

    //Set Destination ID
    $runup = query_by_id('index_num_runup', '1');
    $last_destination_id = $runup['destination_runup_num'];
    $count_runup_num = strlen($last_destination_id);

    if ($count_runup_num == 1)
    {
        $set_destination_id = "d0000" . ($last_destination_id + 1);
    }
    else if ($count_runup_num == 2)
    {
        $set_destination_id = "d000" . ($last_destination_id + 1);
    }
    else if ($count_runup_num == 3)
    {
        $set_destination_id = "d00" . ($last_destination_id + 1);
    }
    else if ($count_runup_num == 4)
    {
        $set_destination_id = "d0" . ($last_destination_id + 1);
    }
    else if ($count_runup_num == 5)
    {
        $set_destination_id = "d" . ($last_destination_id + 1);
    }
    else
    {
        $set_destination_id = "";
    }

    //Insert Destination
    $query = "INSERT INTO `destination` (`destination_id`, `destination_district_id`, `destination_province_id`, `destination_status`, `destination_geo_x`, `destination_geo_y`, `destination_info_tel`, `destination_info_fax`, `destination_info_email`, `destination_info_website`, `destination_social_facebook`, `destination_social_instragram`, `destination_social_youtube`, `destination_cat`, `destination_name`, `destination_address`, `destination_details_80`, `destination_details_200`, `destination_details_long`, `destination_open_hour`, `destination_fee`, `destination_visit_season`, `destination_content_ref_1`, `destination_content_ref_2`, `destination_content_ref_3`, `destination_content_ref_4`, `destination_content_ref_5`, `destination_update`) VALUES "
            . "('$set_destination_id','$destination_district_id', '$destination_province_id', '$destination_status', '$destination_geo_x', '$destination_geo_y', '$destination_info_tel', '$destination_info_fax', '$destination_info_email', '$destination_info_website', '$destination_social_facebook', '$destination_social_instragram', '$destination_social_youtube', '$destination_cat', '$destination_name', '$destination_address', '$destination_details_80', '$destination_details_200', '$destination_details_long', '$destination_open_hour', '$destination_fee', '$destination_visit_season', '$destination_content_ref_1', '$destination_content_ref_2', '$destination_content_ref_3', '$destination_content_ref_4', '$destination_content_ref_5', '$destination_update');";
    $result = mysqli_query($connect, $query);


    //Update index_num_runup Table
    $data_index_num_runup_update = array(
        "destination_runup_num" => ($last_destination_id + 1)
    );
    update("index_num_runup", $data_index_num_runup_update, "id=1");


    //Insert destination_type_tag Table
    if (trim($destination_cat) != '')
    {
        $count_destination_cat = substr_count($destination_cat, ",");

        if ($count_destination_cat > 0)
        {
            $split_destination_cat = explode(",", $destination_cat);
            $dc = 0;
            while ($dc < count($split_destination_cat))
            {
                if (trim($split_destination_cat[$dc]) != '')
                {
                    $data_insert_destination_type_tag = array(
                        "destination_id" => $set_destination_id,
                        "destination_type_tag" => $split_destination_cat[$dc]
                    );
                    insert("destination_type_tag", $data_insert_destination_type_tag);
                }
                $dc++;
            }
        }
        else
        {
            $data_insert_destination_type_tag = array(
                "destination_id" => $set_destination_id,
                "destination_type_tag" => $destination_cat
            );
            insert("destination_type_tag", $data_insert_destination_type_tag);
        }
    }



    //Insert destination_activity_tag Table
    if (trim($destination_activity) != '')
    {
        $count_destination_activity = substr_count($destination_activity, ",");
        if ($count_destination_activity > 0)
        {
            $split_destination_activity = explode(",", $destination_activity);

            $da = 0;
            while ($da < count($split_destination_activity))
            {
                if (trim($split_destination_activity[$da]) != '')
                {
                    $data_insert_destination_activity_tag = array(
                        "destination_id" => $set_destination_id,
                        "destination_activites_tag" => $split_destination_activity[$da]
                    );
                    insert("destination_activity_tag", $data_insert_destination_activity_tag);
                }
                $da++;
            }
        }
        else
        {
            $data_insert_destination_activity_tag = array(
                "destination_id" => $set_destination_id,
                "destination_activites_tag" => $destination_activity
            );
            insert("destination_activity_tag", $data_insert_destination_activity_tag);
        }
    }



    include 'close.php';
}


if ($function_name == 'save_event')
{
    $lag = $_POST['lag'];
    $event_venue_district_id = $_POST['event_venue_district_id'];
    $event_venue_province_id = $_POST['event_venue_province_id'];
    $event_name = $_POST['event_name'];
    $event_detail = $_POST['event_detail'];
    $event_info_link_short = $_POST['event_info_link_short'];
    $event_info_link_long = $_POST['event_info_link_long'];
    $event_venue = $_POST['event_venue'];
    $event_geo_x = $_POST['event_geo_x'];
    $event_geo_y = $_POST['event_geo_y'];
    $event_start_date = $_POST['event_start_date'];
    $event_end_date = $_POST['event_end_date'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "INSERT INTO `event` ( `event_venue_district_id`, `event_venue_province_id`, `event_name`, `event_detail`, `event_info_link_short`, `event_info_link_long`, `event_venue`, `event_geo_x`, `event_geo_y`, `event_start_date`, `event_end_date`) VALUES "
            . "('$event_venue_district_id', '$event_venue_province_id', '$event_name', '$event_detail', '$event_info_link_short', '$event_info_link_long', '$event_venue', '$event_geo_x', '$event_geo_y', '$event_start_date', '$event_end_date');";

    $result = mysqli_query($connect, $query);
    include 'close.php';
}

if ($function_name == 'save_restaurant')
{
    $lag = $_POST['lag'];
    $restaurant_district_id = $_POST['restaurant_district_id'];
    $restaurant_province_id = $_POST['restaurant_province_id'];
    $restaurant_status = $_POST['restaurant_status'];
    $restaurant_geo_x = $_POST['restaurant_geo_x'];
    $restaurant_geo_y = $_POST['restaurant_geo_y'];
    $restaurant_info_tel = $_POST['restaurant_info_tel'];
    $restaurant_info_website = $_POST['restaurant_info_website'];
    $restaurant_info_email = $_POST['restaurant_info_email'];
    $restaurant_social_facebook = $_POST['restaurant_social_facebook'];
    $restaurant_social_instragram = $_POST['restaurant_social_instragram'];
    $restaurant_social_youtube = $_POST['restaurant_social_youtube'];
    $restaurant_cat = $_POST['restaurant_cat'];
    $restaurant_name = $_POST['restaurant_name'];
    $restaurant_address = $_POST['restaurant_address'];
    $restaurant_details_80 = $_POST['restaurant_details_80'];
    $restaurant_details_200 = $_POST['restaurant_details_200'];
    $restaurant_details_long = $_POST['restaurant_details_long'];
    $restaurant_open_hour = $_POST['restaurant_open_hour'];
    $restaurant_review_ref_short = $_POST['restaurant_review_ref_short'];
    $restaurant_review_ref_long = $_POST['restaurant_review_ref_long'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "INSERT INTO `restaurant` (`restaurant_district_id`, `restaurant_province_id`, `restaurant_status`, `restaurant_geo_x`, `restaurant_geo_y`, `restaurant_info_tel`, `restaurant_info_website`, `restaurant_info_email`, `restaurant_social_facebook`, `restaurant_social_instragram`, `restaurant_social_youtube`, `restaurant_cat`, `restaurant_name`, `restaurant_address`, `restaurant_details_80`, `restaurant_details_200`, `restaurant_details_long`, `restaurant_open_hour`, `restaurant_review_ref_short`, `restaurant_review_ref_long`) VALUES "
            . "('$restaurant_district_id', '$restaurant_province_id', '$restaurant_status', '$restaurant_geo_x', '$restaurant_geo_y', '$restaurant_info_tel', '$restaurant_info_website', '$restaurant_info_email', '$restaurant_social_facebook', '$restaurant_social_instragram', '$restaurant_social_youtube', '$restaurant_cat', '$restaurant_name', '$restaurant_address', '$restaurant_details_80', '$restaurant_details_200', '$restaurant_details_long', '$restaurant_open_hour', '$restaurant_review_ref_short', '$restaurant_review_ref_long');";

    $result = mysqli_query($connect, $query);
    include 'close.php';
}

if ($function_name == 'save_restaurant_menu_pic')
{
    $lag = $_POST['lag'];
    $restaurant_manu_pic_id = $_POST['restaurant_manu_pic_id'];
    $restaurant_id = $_POST['restaurant_id'];
    $restaurant_manu_name = $_POST['restaurant_manu_name'];
    $restaurant_manu_pic_status = $_POST['restaurant_manu_pic_status'];
    $restaurant_file_saved_name = $_POST['restaurant_file_saved_name'];
    $restaurant_pic_alt = $_POST['restaurant_pic_alt'];
    $restaurant_pic_detail = $_POST['restaurant_pic_detail'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "INSERT INTO `restaurant_menu_pic` (`restaurant_manu_pic_id`, `restaurant_id`, `restaurant_manu_name`, `restaurant_manu_pic_status`, `restaurant_file_saved_name`, `restaurant_pic_alt`, `restaurant_pic_detail`) VALUES "
            . "('$restaurant_manu_pic_id', '$restaurant_id', '$restaurant_manu_name', '$restaurant_manu_pic_status', '$restaurant_file_saved_name', '$restaurant_pic_alt', '$restaurant_pic_detail');";
    $result = mysqli_query($connect, $query);
    include 'close.php';
}


if ($function_name == 'save_restaurant_type_tag')
{
    $lag = $_POST['lag'];
    $restaurant_type_tag = $_POST['restaurant_type_tag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "INSERT INTO `restaurant_type_tag_list` (`restaurant_type_tag`) VALUES "
            . "('$restaurant_type_tag');";
    $result = mysqli_query($connect, $query);
    include 'close.php';
}

if ($function_name == 'save_accommodation_room_tag')
{
    $lag = $_POST['lag'];
    $accommodation_room_tag = $_POST['accommodation_room_tag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "INSERT INTO `accommodation_room_tag_list` (`accommodation_room_tag`) VALUES "
            . "('$accommodation_room_tag');";
    $result = mysqli_query($connect, $query);
    include 'close.php';
}

if ($function_name == 'save_accommodation_type_tag')
{
    $lag = $_POST['lag'];
    $accommodation_type_tag = $_POST['accommodation_type_tag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "INSERT INTO `accommodation_type_tag_list` (`accommodation_type_tag`) VALUES "
            . "('$accommodation_type_tag');";
    $result = mysqli_query($connect, $query);
    include 'close.php';
}

if ($function_name == 'save_destination_activity_tag')
{
    $lag = $_POST['lag'];
    $destination_activity_tag = $_POST['destination_activity_tag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "INSERT INTO `destination_activity_tag_list` (`destination_activity_tag`) VALUES "
            . "('$destination_activity_tag');";
    $result = mysqli_query($connect, $query);
    include 'close.php';
}

if ($function_name == 'save_destination_type_tag')
{
    $lag = $_POST['lag'];
    $destination_type_tag = $_POST['destination_type_tag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "INSERT INTO `destination_type_tag_list` (`destination_type_tag`) VALUES "
            . "('$destination_type_tag');";
    $result = mysqli_query($connect, $query);
    include 'close.php';
}

if ($function_name == 'get_restaurant')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT a.restaurant_id, c.district_name as restaurant_district_id, b.province_name as restaurant_province_id, d.restaurant_type_tag as restaurant_cat, if(a.restaurant_status = 1, 'Enable', 'Disable') as restaurant_status, a.restaurant_geo_x, a.restaurant_geo_y, a.restaurant_info_tel, a.restaurant_info_website, "
            . "a.restaurant_info_email, a.restaurant_social_facebook,a.restaurant_social_instragram, a.restaurant_social_youtube, a.restaurant_name, a.restaurant_address, a.restaurant_details_80, a.restaurant_details_200, a.restaurant_details_long, a.restaurant_open_hour, a.restaurant_review_ref_short, a.restaurant_review_ref_long FROM "
            . "restaurant AS a LEFT JOIN province AS b ON a.restaurant_province_id = b.province_id LEFT JOIN district AS c ON b.province_id = c.district_id LEFT JOIN restaurant_type_tag_list AS d ON a.restaurant_cat = d.restaurant_type_tag_list_id";
    include 'json.php';
}


if ($function_name == 'get_destination')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT a.destination_id, c.district_name as destination_district_id, b.province_name as destination_province_id, d.destination_type_tag as destination_cat, if(a.destination_status = 1, 'Enable', 'Disable') as destination_status, a.destination_geo_x,a.destination_geo_y, a.destination_info_tel,a.destination_info_fax, a.destination_info_email, "
            . "a.destination_info_website, a.destination_social_facebook, a.destination_social_instragram, a.destination_social_youtube, a.destination_name, a.destination_address, a.destination_details_80, a.destination_details_200, a.destination_details_long, a.destination_open_hour, a.destination_fee, a.destination_visit_season, "
            . "a.destination_content_ref_1, a.destination_content_ref_2, a.destination_content_ref_3, a.destination_content_ref_4, a.destination_content_ref_5 FROM destination AS a LEFT JOIN province AS b ON a.destination_province_id = b.province_id LEFT JOIN district AS c ON b.province_id = b.province_id LEFT JOIN destination_type_tag_list AS d ON a.destination_cat = d.destination_type_tag_list_id";
    include 'json.php';
}

if ($function_name == 'get_accommodation')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT a.accommodation_id, c.district_name as accommodation_district_id, b.province_name as accommodation_province_id, d.accommodation_type_tag as accommodation_cat, if(a.accommodation_status = 1, 'Enable', 'Disable') as accommodation_status, a.accommodation_geo_x, a.accommodation_geo_y, a.accommodation_info_tel, a.accommodation_info_website, "
            . "a.accommodation_info_email, a.accommodation_social_facebook, a.accommodation_social_instragram, a.accommodation_social_youtube, a.accommodation_book_via_hotels, a.accommodation_book_via_agoda, a.accommodation_book_via_booking, a.accommodation_start_price, a.accommodation_top_price, a.accommodation_name, a.accommodation_address, "
            . "a.accommodation_details_80, a.accommodation_details_200, a.accommodation_details_long, a.accommodation_review_ref_short, a.accommodation_review_ref_long, a.accommodation_around_dec, a.accommodation_distance_airport, a.accommodation_distance_town FROM accommodation AS a LEFT JOIN province AS b ON a.accommodation_province_id = b.province_id "
            . "LEFT JOIN district AS c ON b.province_id = c.province_id LEFT JOIN accommodation_type_tag_list AS d ON a.accommodation_cat = d.accommodation_type_tag_list_id";
    include 'json.php';
}


if ($function_name == 'get_destination_type_tag')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT * FROM destination_type_tag_list";
    include 'json.php';
}

if ($function_name == 'get_destination_activity_tag')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT * FROM destination_activity_tag_list";
    include 'json.php';
}

if ($function_name == 'get_restaurant_type_tag')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT * FROM restaurant_type_tag_list";
    include 'json.php';
}

if ($function_name == 'get_accommodation_type_tag')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT * FROM accommodation_type_tag_list";
    include 'json.php';
}

if ($function_name == 'get_accommodation_room_tag')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT * FROM accommodation_room_tag_list";
    include 'json.php';
}

if ($function_name == 'get_event')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT a.event_id, c.district_name as event_venue_district_id, b.province_name as event_venue_province_id, a.event_name, a.event_detail, a.event_info_link_short, a.event_info_link_long, a.event_venue, a.event_geo_x, a.event_geo_y, a.event_start_date, a.event_end_date FROM `event` AS a LEFT JOIN province AS b ON a.event_venue_province_id = b.province_id LEFT JOIN district AS c ON b.province_id = c.district_id";
    include 'json.php';
}


if ($function_name == 'get_province')
{
    $lag = $_POST['lag'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT * FROM province";
    include 'json.php';
}

if ($function_name == 'get_district')
{
    $lag = $_POST['lag'];
    $province_id = $_POST['province_id'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT * FROM district where province_id = '$province_id' ";
    include 'json.php';
}


/////////////////////////////////////// edit
if ($function_name == 'get_des_update')
{
    $lag = $_POST['lag'];
    $destination_id = $_POST['destination_id'];

    if ($lag == 'th')
    {
        $connect = $a;
    }
    else
    {
        $connect = $b;
    }
    include 'connect.php';
    $query = "SELECT * FROM destination where destination_id = '$destination_id' ";
    include 'json.php';
}

if ($function_name == 'edit_destination')
{
    $lag = $_POST['lag'];

    $destination_id = $_POST['destination_id'];
    $destination_cat = $_POST['destination_cat'];
    $destination_activity = $_POST['destination_activity'];
    $destination_details_80 = str_replace("'", "\'", $_POST['destination_details_80']);
    $destination_details_200 = str_replace("'", "\'", $_POST['destination_details_200']);
    $destination_details_long = str_replace("'", "\'", $_POST['destination_details_long']);


    if ($lag == 'th')
    {
        $connect = $a;
    }
    else if ($lag == 'en')
    {
        $connect = $b;
    }
    include 'connect.php';

    $destination_data_update = array(
        "destination_district_id" => $_POST['destination_district_id'],
        "destination_province_id" => $_POST['destination_province_id'],
        "destination_status" => $_POST['destination_status'],
        "destination_geo_x" => $_POST['destination_geo_x'],
        "destination_geo_y" => $_POST['destination_geo_y'],
        "destination_info_tel" => $_POST['destination_info_tel'],
        "destination_info_fax" => $_POST['destination_info_fax'],
        "destination_info_email" => $_POST['destination_info_email'],
        "destination_info_website" => $_POST['destination_info_website'],
        "destination_social_facebook" => $_POST['destination_social_facebook'],
        "destination_social_instragram" => $_POST['destination_social_instragram'],
        "destination_social_youtube" => $_POST['destination_social_youtube'],
        "destination_cat" => $_POST['destination_cat'],
        "destination_name" => $_POST['destination_name'],
        "destination_address" => $_POST['destination_address'],
        "destination_details_80" => $destination_details_80,
        "destination_details_200" => $destination_details_200,
        "destination_details_long" => $destination_details_long,
        "destination_open_hour" => $_POST['destination_open_hour'],
        "destination_fee" => $_POST['destination_fee'],
        "destination_visit_season" => $_POST['destination_visit_season'],
        "destination_content_ref_1" => $_POST['destination_content_ref_1'],
        "destination_content_ref_2" => $_POST['destination_content_ref_2'],
        "destination_content_ref_3" => $_POST['destination_content_ref_3'],
        "destination_content_ref_4" => $_POST['destination_content_ref_4'],
        "destination_content_ref_5" => $_POST['destination_content_ref_5'],
        "destination_update" => $_POST['destination_update']
    );

    update("destination", $destination_data_update, "destination_id = '" . $destination_id . "'");
 
    //Insert destination_type_tag Table
    if (trim($destination_cat) != '')
    {
        //delete all destination cat
        delete('destination_type_tag', "destination_id = '" . $destination_id . "'");


        $count_destination_cat = substr_count($destination_cat, ",");

        if ($count_destination_cat > 0)
        {
            $split_destination_cat = explode(",", $destination_cat);
            $dc = 0;
            while ($dc < count($split_destination_cat))
            {
                if (trim($split_destination_cat[$dc]) != '')
                {
                    $data_insert_destination_type_tag = array(
                        "destination_id" => $destination_id,
                        "destination_type_tag" => $split_destination_cat[$dc]
                    );
                    insert("destination_type_tag", $data_insert_destination_type_tag);
                }
                $dc++;
            }
        }
        else
        {
            $data_insert_destination_type_tag = array(
                "destination_id" => $destination_id,
                "destination_type_tag" => $destination_cat
            );
            insert("destination_type_tag", $data_insert_destination_type_tag);
        }
    }
    //Insert destination_activity_tag Table
    if (trim($destination_activity) != '')
    {
        //delete all destination cat

        delete('destination_activity_tag', "destination_id = '" . $destination_id . "'");

        $count_destination_activity = substr_count($destination_activity, ",");
        if ($count_destination_activity > 0)
        {
            $split_destination_activity = explode(",", $destination_activity);

            $da = 0;
            while ($da < count($split_destination_activity))
            {
                if (trim($split_destination_activity[$da]) != '')
                {
                    $data_insert_destination_activity_tag = array(
                        "destination_id" => $destination_id,
                        "destination_activites_tag" => $split_destination_activity[$da]
                    );
                    insert("destination_activity_tag", $data_insert_destination_activity_tag);
                }
                $da++;
            }
        }
        else
        {
            $data_insert_destination_activity_tag = array(
                "destination_id" => $destination_id,
                "destination_activites_tag" => $destination_activity
            );
            insert("destination_activity_tag", $data_insert_destination_activity_tag);
        }
    }


    include 'close.php';
}