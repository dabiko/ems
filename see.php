<?php
/**
 * Created by PhpStorm.
 * User: Dabiko Blaise
 * Date: 02-Jul-18
 * Time: 4:43 AM
 */
require_once 'resources/session.php';
require_once 'resources/utilities.php';

if(isset($_POST["item_id"]))
{
    if(isset($_SESSION["item_basket"])){
        $item_array_id = array_column($_SESSION["item_basket"], "item_id");
        if(!in_array($_POST["item_id"], $item_array_id))
        {
            $count = count($_SESSION["item_basket"]);
            $item_array = array(
                'item_id' => $_POST["item_id"],
            );
            $_SESSION["item_basket"][$count] = $item_array ;

        }else{
            foreach($_SESSION["item_basket"] as $keys => $values) {
                if ($values["item_id"] == $_POST['item_id']) {
                    unset($_SESSION["item_basket"][$keys]);
                    echo 'Item Already exit in the Invoice';
                }
            }



          }

    }

    else{
        $item_array = array(
            'item_id' => $_POST["item_id"],
        );
      $_SESSION["item_basket"][0] = $item_array;
    }

}




if (isset($_POST['delete_id'])){
    foreach($_SESSION["item_basket"] as $keys => $values)
    {
        if($values["item_id"] == $_POST['delete_id'])
        {
            unset($_SESSION["item_basket"][$keys]);
            echo 'Item Removed';
        }
    }
}


//$json = '[{"Item_Id":"1","Quantity":"8","Cogs":"1500","Unit_Price":"2000","Total":"16000"},
//          {"Item_Id":"2","Quantity":"9","Cogs":"1000","Unit_Price":"3000","Total":"27000"},
//          {"Item_Id":"8","Quantity":"","Cogs":"15000","Unit_Price":"20000","Total":"200000"}]';
//
//$books = json_decode($json);
//
////for ($i =0; $i<$books)
////echo $books[2]->Item_Id;
//foreach ($books as $name=>$items){
//    echo 'Cost of Goods' ."=>". $items->Cogs."</br>";
//    echo $name ."=>". $items->Unit_Price."</br>";

//    if(array_search(3000, array_column($books, 'Unit_Price')) !== False) {
//        echo "FOUND"."</br>";
//    } else {
//        echo "Not Found"."</br>";
//    }
//
//    if($items->Unit_Price < $items->Cogs){
//        echo 'Item cant be sold for this price'."</br>";
//    }else{
//        echo 'Good'."</br>";
//    }
//    if ($scores->Unit_Price < $scores->Cogs){
//        echo 'Item cant be sold for this price'."</br>";
//    }else{
//        echo 'Good'."</br>";
//    }
//}
?>
<!DOCTYPE html>
<html>
<head>
    <script src="scripts/js/jquery2.1.1.min.js"></script>


    <meta charset=utf-8 />
    <title>Live Word and Character Counter using jQuery</title>
    <style>
        textarea{
            width:300px;
            height:300px;
        }
    </style>
    <script>
        function count_words(){

            var  str1= document.getElementById("InputText").value;

            /** exclude  start and end white-space */
            str1 = str1.replace(/(^\s*)|(\s*$)/gi,"");

            /** convert 2 or more spaces to 1 */
            str1 = str1.replace(/[ ]{2,}/gi," ");

            /** exclude newline with a start spacing */
            str1 = str1.replace(/\n /,"\n");

            var words = str1.split(' ').length;
            $("#noofwords").val(words);
            if (words > 15) {
                alert('long description');
                //$("#noofwords").val(words - 3);
            }else {
                console.log('cool')
            }

        }

    </script>

</head>
<body>
<form>

    <input  onkeyup=" return nospaces(this)" type="text" name="countDisplay" id="countDisplay" class="form-control"/>
</form>

</body>
</html>
