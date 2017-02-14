<?php
require_once('../class_lib.php');
if($_SESSION['user']['is_admin'] == true){
  $id = (is_numeric($_POST['id']) ? (int)$_POST['id'] : 0);
  if (!isset($_POST['process'])){
    $active = (is_numeric($_POST['active']) ? (int)$_POST['active'] : 0);
    $state = (is_numeric($_POST['state']) ? (int)$_POST['state'] : 43);
    $zip = (is_numeric($_POST['zip_code']) ? (int)$_POST['zip_code'] : 77002);
    $phone = (is_numeric($_POST['phone']) ? (int)$_POST['phone'] : '');
    if ($id == 0) { # New Client
      Client::add($_POST['name'], $_POST['logo'], $_POST['street'], $_POST['city'], $state, $zip_code, $phone, $_POST['email'], $active);
    } else {
      Client::edit($id, $_POST['name'], $_POST['logo'], $_POST['street'], $_POST['city'], $state, $zip, $phone, $_POST['email'], $active);
    }
    
    #reset
    $servicesForClient = ClientServices::find_by_client($id);
    while ($row = $servicesForClient->fetch_array(MYSQLI_ASSOC)){
      ClientServices::reset_status($id, $row['service']);
    }

    if (isset($_POST['services']))
      while(list ($key, $service_id) = each ($_POST['services'])){
        if(!$serviceStatus = ClientServices::check_service_status($id, $service_id)->fetch_array(MYSQLI_ASSOC)){
          ClientServices::add($id, $service_id);
        } else { #change status
          ClientServices::activate($id, $service_id);
        }
      }
  }
}
$home_url = substr($home_url, 0, -9);
header('Location: ' . $home_url . 'clients.php?process=viewClients');
?>