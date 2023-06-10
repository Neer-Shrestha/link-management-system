<?php
define('DBHOST', 'localhost');
define('DBUESR', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'linkme');


function open_con()
{
    $con = new mysqli(DBHOST, DBUESR, DBPASSWORD, DBNAME);

    if ($con->connect_error) {
        die("Connction Failed " . $con->connect_error);
    }

    return $con;
}

function close_con($con)
{
    $con->close();
}

function validate_user(string $name, string $username, string $email, string $pass, string $confirm_pass)
{
    global $con;
    $message = [];

    if (empty($name)) {
        $message['name'] = 'Name cannot be empty';
    }
    if (empty($username)) {
        $message['username'] = 'username cannot be empty';
    } else {
        $stmt = $con->prepare('SELECT * FROM users WHERE user_login=?');
        $stmt->bind_param('s', $username);

        $stmt->execute();

        $result = $stmt->get_result();

        $users =  $result->fetch_array(MYSQLI_ASSOC);


        if (isset($users)) {
            $message['username'] = "username already exists";
        }
    }

    if (empty($email)) {
        $message['email'] = "Email cannot be empty";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message['email'] =  "Invalid Email Format";
    }

    if (empty($pass) && empty($confirm_pass)) {
        $message['password'] = 'Password cannot be empty';
    } elseif ($pass != $confirm_pass) {
        $message['password'] = 'Password and Confirm Password must be the same';
    }

    return $message;
}

function register_user($name, $user_avatar, $username,  $email,  $pass,  $confirm_pass)
{
    global $con;

    $message = [];

    $pname = rand(1000, 10000) . '-' . $user_avatar['name'];
    $tname = $user_avatar['tmp_name'];
    $upload_dir =  'frontend/uploads/';

    // user id
    $id = rand(time(), 10000000);

    move_uploaded_file($tname, $upload_dir . $pname);

    $stmt = $con->prepare("INSERT INTO users(user_id, user_name,user_avatar, user_login,user_email, user_pass, user_confirm_pass) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('issssss', $id, $name, $pname, $username, $email, $pass, $confirm_pass);

    if ($stmt->execute()) {
        $message['success'] = "User Registered Successfully";
    } else {
        $message['error'] = "Error occured during the registration";
    }

    $stmt->close();

    return $message;
}

function user_auth(string $username, string $pass)
{
    global $con;
    $message = [];

    $stmt = $con->prepare('SELECT * FROM users WHERE user_login=?');
    $stmt->bind_param('s', $username);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $message['username'] = "Username does not exist";
    } else {
        $user =  $result->fetch_array(MYSQLI_ASSOC);

        if ($user['user_login'] == $username && password_verify($pass, $user['user_pass'])) {
            $_SESSION['user_id'] = $user['user_id'];
            header('location: ' . ABSPATH . '/account');
        } else {
            $message['error'] = "Incorrect username or password";
        }
    }


    return $message;
}

function user_logout()
{
    // Clear session data
    session_unset();
    session_destroy();
    // Redirect the user to a desired page
    header("Location: " . ABSPATH . "/login"); // Replace "login.php" with the desired page URL
    exit();
}

function get_userid()
{
    if (isset($_SESSION['user_id']))
        return $_SESSION['user_id'];
}

function is_login()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    }
    return false;
}

function check_is_login()
{
    if (!is_login()) {
        header('Location: ' . ABSPATH . '/login');
    }
}

function is_admin()
{
    global $con;

    $stmt = $con->prepare('SELECT user_role FROM user_roles WHERE user_id = ?');
    $stmt->bind_param('i', $_SESSION['user_id']);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0)
        return false;

    $data =  $result->fetch_array(MYSQLI_ASSOC);
    if ($data['user_role'] == 'admin') :
        return true;
    endif;
    return false;
}

function post_user_link($title, $url, $userid)
{
    global $con;

    $stmt = $con->prepare('INSERT INTO links(user_id, link_title, link_content) VALUES (?,?,?)');
    $stmt->bind_param('sss', $userid, $title, $url);

    if ($stmt->execute()) {
        $_SESSION['link_post_success'] = "The link was successfully posted.";
    } else {
        $_SESSION['link_post_error'] = "Error posting link.";
    }
    header('Location: ' . ABSPATH . '/account');
}

function get_user_links($id)
{
    global $con;

    $stmt = $con->prepare('SELECT * FROM links WHERE user_id=?');
    $stmt->bind_param('s', $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data =  $result->fetch_all(MYSQLI_ASSOC);
    }

    return $data;
}

function get_user_data($id)
{
    global $con;

    $stmt = $con->prepare('SELECT * FROM users WHERE user_id=?');
    $stmt->bind_param('s', $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data =  $result->fetch_array(MYSQLI_ASSOC);
    }

    return $data;
}

function handle_file_upload($file, $userid)
{
    global $con;

    $pname = rand(1000, 10000) . '-' . $file['name'];
    $tname = $file['tmp_name'];
    $upload_dir =  'frontend/uploads/';

    move_uploaded_file($tname, $upload_dir . $pname);

    $stmt = $con->prepare('UPDATE users SET user_avatar = ? WHERE user_id = ?');
    $stmt->bind_param('si', $pname, $userid);

    $stmt->execute();
}
function get_uploaded_img_uri($name)
{
    return FRONTEND_PATH . '/' . 'uploads/' . $name;
}

function delete_link($linkid)
{
    global $con;

    $stmt = $con->prepare('DELETE FROM links WHERE link_id = ?');
    $stmt->bind_param('i', $linkid);

    $stmt->execute();
}


function get_total_users()
{
    global $con;

    $stmt = $con->prepare('SELECT * FROM users');
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows;
}
function get_total_link_count()
{
    global $con;

    $stmt = $con->prepare('SELECT * FROM links');
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows;
}

function get_all_users_data()
{
    global $con;

    $stmt = $con->prepare('SELECT * FROM users');

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data =  $result->fetch_all(MYSQLI_ASSOC);
    }

    return $data;
}

function get_formated_date($date_string)
{
    $dateTime = new DateTime($date_string);
    $formattedDate = $dateTime->format('D m Y');
    return $formattedDate;
}

function pre_print($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}
