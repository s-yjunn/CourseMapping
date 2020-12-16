<?php
/* This script "sends" a message to a user's regular inbox
For now only admins have access to this functionality
@author Isabel */

// Get message basics -- contents, recipient, sender
$text = $_POST["text"];
$to = $_POST["to"];
$from = $_POST["from"];

// Get timestamp of message
$sent = time();

// create a new message array:
$message = [
  "text" => $text,
  "from" => $from,
  "sent" => $sent,
];

// get recipient's current inbox
$toInbox = "../../../Private/$to/messages.json";
$toInboxArray = json_decode(file_get_contents($toInbox), true);
// add new message to the front of the unreads
array_unshift($toInboxArray["unread"], $message);
// try to update json
if (file_put_contents($toInbox, json_encode($toInboxArray))) {
  // if successful, indicate success
  echo "Admin $from sent message '$text' to user $to.";
} else {
  // otherwise, indicate failure
  echo 0;
}
?>