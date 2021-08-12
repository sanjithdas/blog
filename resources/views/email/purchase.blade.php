<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Thanks you for purchasing 
        <!-- when dd($paymentInfo); we can get all the below mentioned structure... -->
        {{$paymentInfo->transactions[0]->item_list->items[0]->name}} 
        <?php
            echo "<pre>";
            print_r($paymentInfo);
            echo "</pre>";
        ?>
    </h2>
</body>
</html>