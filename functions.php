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

function quotation_request($name, $image, $quantity, $email, $message, $weight, $subject = "Quote Request"){
    return "<div style='width: 100%; display:flex; justify-content: center;'>
<div style='width:100%; max-width: 800px; border: 1px solid rgb(230,230,230);border-radius: 10px; font-family: Arial, Helvetica, sans-serif;'>
<div style='width: calc(100% - 16px); border-top-left-radius: 10px; border-top-right-radius: 10px; background-color: #15133e; padding: 8px; '>
<h2 style='color:#ffffff; font-weight: bold; text-align: center;'>Quote Request</h2>
</div>

<!-- title -->
<div style='width: calc(100% - 16px); display: flex; flex-wrap: nowrap; border-bottom: 1px solid rgb(230, 230, 230); padding: 8px;'>
<div style='width: 30%;'>
<p style='color: #7BC144; font-weight: bold; font-size: 16px;'>Customer Email:</p>
</div>
<div style='width: 70%;'>
<p style='font-size: 14px; font-weight: semi-bold; color: rgb(50, 50, 50); '>" . htmlspecialchars($email) . "</p>
</div>
</div>
<!-- end of item -->

<div style='padding: 8px;'>
<div style='width: calc(100% - 20px); height: 1px; background-color: rgb(230, 230, 230); margin-top:10px; margin-bottom: 10px;'></div>
<h2 style='font-size: 18px; font-weight: semibold; color: #15133e; text-transform: uppercase;'>" . htmlspecialchars($subject) . "</h2>
<label style='color:#333333; font-weight: bold; '>Message:</label>
<p style='margin-top: 10px'>" . nl2br(htmlspecialchars($message)) . "</p>
</div>
<!-- end of items-->


<!-- form body -->
<table style='width: calc(100% - 16px); margin: 8px; border-collapse: collapse;'>
<thead>
<tr>
<th style='background-color: rgb(230, 230, 230); padding: 8px; text-align: left;'>Product</th>
<th style='background-color: rgb(230, 230, 230); padding: 8px; text-align: left;'>Weight</th>
<th style='background-color: rgb(230, 230, 230); padding: 8px;  text-align: left;'>Quantity</th>
</tr>
</thead>

<tbody>
<tr style='border-bottom: 1px solid rgb(230, 230, 230)'>
<td style='padding: 8px;'>
<img src='https://sanleon-website.vercel.app/" .htmlspecialchars($image). "' style='width: 150px; height: auto; '/>
<p style='margin-top: 20px; color: rgb(50, 50, 50);'>" .htmlspecialchars($name). "</p>
</td>
<td style='padding: 8px;'>" .htmlspecialchars($weight). "</td>
<td style='padding: 8px;'>" .htmlspecialchars($quantity). "</td>
</tr>
</tbody>
</table>
</div>
</div>";
}

function combined_quotation_request($items, $email, $subject = "Combined Quote Request"){
    // Calculate total items
    $total_items = 0;
    foreach($items as $item){
        $total_items += isset($item['quantity']) ? intval($item['quantity']) : 0;
    }
    
    // Build the table rows
    $table_rows = '';
    $item_number = 1;
    foreach($items as $item){
        $product_name = isset($item['product_name']) ? htmlspecialchars($item['product_name']) : 'N/A';
        $product_image = isset($item['product_image']) ? htmlspecialchars($item['product_image']) : '';
        $product_weight = isset($item['product_weight']) ? htmlspecialchars($item['product_weight']) : 'N/A';
        $quantity = isset($item['quantity']) ? htmlspecialchars($item['quantity']) : '0';
        
        $table_rows .= "
        <tr style='border-bottom: 1px solid rgb(230, 230, 230)'>
            <td style='padding: 8px; text-align: center;'>" . $item_number . "</td>
            <td style='padding: 8px;'>
                <img src='https://sanleon-website.vercel.app/" . $product_image . "' style='width: 100px; height: auto; display: block; margin-bottom: 10px;'/>
                <p style='margin: 0; color: rgb(50, 50, 50); font-weight: 600;'>" . $product_name . "</p>
            </td>
            <td style='padding: 8px; text-align: center;'>" . $product_weight . "</td>
            <td style='padding: 8px; text-align: center; font-weight: 600;'>" . $quantity . "</td>
        </tr>";
        
        $item_number++;
    }
    
    return "<div style='width: 100%; display:flex; justify-content: center;'>
<div style='width:100%; max-width: 800px; border: 1px solid rgb(230,230,230);border-radius: 10px; font-family: Arial, Helvetica, sans-serif;'>
    <div style='width: calc(100% - 16px); border-top-left-radius: 10px; border-top-right-radius: 10px; background-color: #15133e; padding: 8px; '>
        <h2 style='color:#ffffff; font-weight: bold; text-align: center;'>Combined Quote Request</h2>
    </div>

    <!-- Email Section -->
    <div style='width: calc(100% - 16px); display: flex; flex-wrap: nowrap; border-bottom: 1px solid rgb(230, 230, 230); padding: 8px;'>
        <div style='width: 30%;'>
            <p style='color: #7BC144; font-weight: bold; font-size: 16px;'>Customer Email:</p>
        </div>
        <div style='width: 70%;'>
            <p style='font-size: 14px; font-weight: semi-bold; color: rgb(50, 50, 50); '>" . htmlspecialchars($email) . "</p>
        </div>
    </div>

    <!-- Summary Section -->
    <div style='padding: 8px;'>
        <div style='width: calc(100% - 20px); height: 1px; background-color: rgb(230, 230, 230); margin-top:10px; margin-bottom: 10px;'></div>
        <label style='color:#333333; font-weight: bold; '>Message:</label>
        <p style='margin-top: 10px'>Hello, I would love to make a quotation enquiry of the following products</p>
    </div>

    <!-- Products Table -->
    <table style='width: calc(100% - 16px); margin: 8px; border-collapse: collapse; border: 1px solid rgb(230, 230, 230);'>
        <thead>
            <tr>
                <th style='background-color: rgb(230, 230, 230); padding: 12px; text-align: center; width: 50px;'>#</th>
                <th style='background-color: rgb(230, 230, 230); padding: 12px; text-align: left;'>Product</th>
                <th style='background-color: rgb(230, 230, 230); padding: 12px; text-align: center; width: 120px;'>Weight/Size</th>
                <th style='background-color: rgb(230, 230, 230); padding: 12px; text-align: center; width: 100px;'>Quantity</th>
            </tr>
        </thead>
        <tbody>
            " . $table_rows . "
        </tbody>
    </table>
</div>
</div>";
}
?>