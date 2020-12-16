<?php
// This script "sends" a message to the admin inbox
// @author Isabel

// Get message basics -- contents, recipient, sender
$text = $_POST["text"];
$from = $_POST["from"];
if ($from == "") {
  $from = false; // no identified sender
}

// Get timestamp of message
$sent = time();

// create a new message array:
$message = [
  "text" => $text,
  "from" => $from,
  "sent" => $sent,
];

// get admin's current inbox
$toInbox = "../../../Private/adminMessages.json";
$toInboxArray = json_decode(file_get_contents($toInbox), true);
// add new message to the front of the unreads
array_unshift($toInboxArray["unread"], $message);
// try to update json
if (file_put_contents($toInbox, json_encode($toInboxArray))) {
  // if successful, indicate success
  echo "User sent message to admin.";
} else {
  // otherwise, indicate failure
  echo 0;
}
?>