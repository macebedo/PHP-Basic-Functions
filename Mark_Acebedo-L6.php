<?php

  $debug = 1;
  $output_form = true;
  $firstname = "";
  $sentence = "";
  $firstname_msg = "";
  $error_line1 = "";
  $error_line2 = "";
  $error_line3 = "";
  $error_code1 = 0;     // PASS OR FAILED FLAG FOR NAME FIELD
  $error_code2 = 0;     // PASS OR FAILED FLAG FOR NUMBER FIELD
  $error_code3 = 0;     // PASS OR FAILED FLAG FOR SENTENCE FIELD
  $reg_good = "";

/*
    Pass in the user name, concatenate the name with a welcome message. 
    Return the welcome message if the user name is not empty. If the user name is empty, return false.

    Pass in the users number. Verify the number is in the correct range. 
    If not in the range, return false. If in the correct range, calculate the square root and the number cubed. 
    Return both values.

    Pass in the users sentence. Check that the sentence is at least 20 characters. 
    If less than 20 characters, return a false. If at least 20 characters, return the last 9 characters.

*/

// FUNCTION OUTPUTS THE NAME - LINE 1 
function welcome_msg($firstname) {

    echo "<p>Welcome $firstname to my first PHP function</p>";

}

// FUNCTION OUTPUTS THE SQUAREROOT AND NUMBE CUBED OF THE ENTERED NUMBER $number
function calculator($number) {

  $squareroot = sqrt($number);
  $cuberoot = pow($number, 1/3);
  $roundedsqr = round($squareroot, 2);
  $roundcubed = round($cuberoot, 2);
  echo "<p>The squareroot of $number is: $roundedsqr and the cuberoot is $roundcubed</p>";

}

// FUNCTION CALCULATES THE LENGTH OF SENTENCE AND SUBSTRINGS THE LAST 9 CHARACTERS OF THE ENTERED SENTENCE 
Function lastcharacters($sentence) {

  $str_length = strlen($sentence);
  $str = $str_length-9;
  $sentence_final = substr($sentence, $str, $str_length);

  echo "<p>The last 9 letters of your sentence are: $sentence_final</p>";

}

// FIELD VALIDATION
   if (isset($_POST['submit'])) {

      $firstname = trim($_POST['firstname']);
      $number = $_POST['number'];
      $sentence = $_POST['sentence'];
      $str_length = strlen($sentence);

   // VALIDATE FIRSTNAME FIELD
   if (empty($firstname))  {

      $output_form = true;
      $error_line1 = "<p> X - Cannot leave this field blank. Please enter a first name.</p>";
      $error_code1 = 0;

   } else if (!empty($firstname)) {

      $error_code1 = 1;

   } // END IF VALIDATE FIRSTNAME FIELD

   // VALIDATE NUMBER FIELD
   if (empty($number)) {
      $output_form = true;
      $error_line2 = "<p> X - Cannot leave this field blank. Please enter a number.</p>";
      $error_code2 = 0;

    } else if ((!empty($number)) && (($number >= 201) || ($number <= 99))) {

      $output_form = true;
      $error_line2 = "<p> X - Please enter a number Between 100 and 200.</p>";
      $error_code2 = 0;

    } else if ((!empty($number)) && (($number >= 100) || ($number <= 200))) {

       $error_code2 = 1;

    }

   // VALIDATE SENTENCE FIELD
   // SENTENCE IS EMPTY
   if (empty($sentence)) {  

      $output_form = true;
      $error_line3 = "<p> X - Cannot leave this field blank. Please enter a sentence with at least 20 characters.</p>";
      $error_code3 = 0;

      // SENTENCE IS NOT EMPTY AND LESS THAN 20 CHARACTERS
    } else if ((!empty($sentence)) && ($str_length <= 19 )) {

      $output_form = true;
      $error_line3 = "<p> X - You entered $str_length characters. The sentence must have at least 20 characters. Please enter a sentence again.</p>";
      $error_code3 = 0;
      
      // SENTENCE IS NOT EMPTY AND IS MORE THAN 20 CHARACTERS
    } else if ((!empty($sentence)) && ($str_length >= 20)) {

      $error_code3 = 1;

    }

    // THE FOLLOWING FIELDS SATISFIES ALL ENTRIES
   if ((!empty($firstname)) && (!empty($number)) && (!empty($sentence)) && ($error_code1 == 1) && ($error_code2 == 1) && $error_code3 == 1) {

      $output_form = false;

    }

}

?>

<!DOCTYPE html>
<html>
   <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
   </head>
   
   <body>
       <header>
    	  <div id="header">
       	   <h2>ASSIGNMENT 6: Functions</h2>
        </div>
      </header>  
   
<?php if ($output_form) { ?>
              <form action="<?=$_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"> 

              <!-- USER ENTRY -->

                  <table id="main_table">
                            <tr>
                                <td>First Name:</td>
                                <td class="input"><input type="text" name="firstname" value="<?=$firstname ?>"></td>
                                <td class="out"><?=$error_line1 ?></td>
                            </tr>
                            <tr>
                                <td>Number (Between 100 and 200):</td>
                                <td class="input"><input type="text" name="number" value="<?=$number ?>"></td>
                                <td class="out"> <?=$error_line2 ?></td>
                            </tr>
                            <tr>
                                <td>Type a sentence (At least 20 characters):</td>
                                <td class="input"><input type="text" name="sentence" value="<?=$sentence ?>"></td>
                                <td class="out"> <?=$error_line3 ?></td>
                            </tr>
                            <tr><td></td><td><br><input type="submit" name="submit" value="Submit"></td></tr>
                            
                       </table>
                 </form> 

                <!-- ERROR -->
                <table id="messages">
                   <tr>
                     <td><?=$error_msg ?></td>
                   </tr>
                </table> <!-- END ERROR TABLE -->
<?php

// THIS IS THE FINAL OUTPUT OF ALL SATISFIED FIELDS.
}
  if (!$output_form) {

     welcome_msg($firstname);
     calculator($number);
     lastcharacters($sentence);

   }

   require_once("./include/footer.inc.php");
?>

   </body>
</html>