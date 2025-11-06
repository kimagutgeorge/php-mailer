<?php 

function contact_message_body($name, $email, $phone, $subject, $message){
    return "<div style='width: 100%; display:flex; justify-content: center;'>
<div style='width:100%; max-width: 600px; border: 1px solid rgb(230,230,230);border-radius: 10px; font-family: Arial, Helvetica, sans-serif;'>
<div style='width: calc(100% - 16px); border-top-left-radius: 10px; border-top-right-radius: 10px; background-color: #15133e; padding: 8px; '>
<h2 style='color:#ffffff; font-weight: bold; text-align: center;'>Getting In Touch</h2>
</div>
<!-- form body -->
<div style='width: 100%; padding: 10px;'>

<div style='width: calc(100% - 16px); display: flex; flex-wrap: nowrap; border-bottom: 1px solid rgb(230, 230, 230)'>
<div style='width: 30%;'>
<p style='color: #7BC144; font-weight: bold; font-size: 16px;'>Full Name:</p>
</div>
<div style='width: 70%;'>
<p style='font-size: 14px; font-weight: semi-bold; color: rgb(50, 50, 50); '>" . htmlspecialchars($name) . "</p>
</div>
</div>
<!-- end of item -->

<div style='width: calc(100% - 16px); display: flex; flex-wrap: nowrap; border-bottom: 1px solid rgb(230, 230, 230)'>
<div style='width: 30%;'>
<p style='color: #7BC144; font-weight: bold; font-size: 16px;'>Email:</p>
</div>
<div style='width: 70%;'>
<p style='font-size: 14px; font-weight: semi-bold; color: rgb(50, 50, 50); '>" . htmlspecialchars($email) . "</p>
</div>
</div>
<!-- end of item -->

<div style='width: calc(100% - 16px); display: flex; flex-wrap: nowrap; border-bottom: 1px solid rgb(230, 230, 230)'>
<div style='width: 30%;'>
<p style='color: #7BC144; font-weight: bold; font-size: 16px;'>Phone:</p>
</div>
<div style='width: 70%;'>
<p style='font-size: 14px; font-weight: semi-bold; color: rgb(50, 50, 50); '>" . htmlspecialchars($phone) . "</p>
</div>
</div>
<!-- end of item -->

<div style='width: calc(100% - 20px); height: 1px; background-color: rgb(230, 230, 230); margin-top:10px; margin-bottom: 10px;'></div>
<h2 style='font-size: 18px; font-weight: semibold; color: #15133e; text-transform: uppercase;'>" . htmlspecialchars($subject) . "</h2>
<label style='color:#333333; font-weight: bold; '>Message:</label>
<p style='margin-top: 10px'>" . nl2br(htmlspecialchars($message)) . "</p>
</div>
</div>
</div>";
}

?>