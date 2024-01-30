<!-- Footer -->
<?php include "../header.php" ?>

<?php
if (isset($_GET['user_id'])) {
    $userid = $_GET['user_id'];
}

$query = "SELECT * FROM neighbors WHERE id = $userid ";
$view_users = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($view_users)) {
    $id = $row['id'];
    $regdate = $row['regdate'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $streetaddress = $row['streetaddress'];
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $isveteran = $row['isveteran'];
    $veterandep = $row['veterandep'];
    $shopperscard = $row['shopperscard'];
    $newneighbor = $row['newneighbor'];
    $hasbenefits = $row['hasbenefits'];
    $seniors = $row['seniors'];
    $adults = $row['adults'];
    $kids = $row['kids'];
    $cats = $row['cats'];
    $dogs = $row['dogs'];
    $ethnicity = $row['ethnicity'];
}

if (isset($_POST['update'])) {
    $regdate = $_POST['regdate'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $streetaddress = $_POST['streetaddress'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $isveteran = isset($_POST['isveteran']) ? $_POST['isveteran'] : 0;
    $veterandep = $_POST['veterandep'];
    $shopperscard = isset($_POST['shopperscard']) ? $_POST['shopperscard'] : 0;
    $newneighbor = isset($_POST['newneighbor']) ? $_POST['newneighbor'] : 0;
    $hasbenefits = isset($_POST['hasbenefits']) ? $_POST['hasbenefits'] : 0;
    $seniors = $_POST['seniors'];
    $adults = $_POST['adults'];
    $kids = $_POST['kids'];
    $cats = $_POST['cats'];
    $dogs = $_POST['dogs'];
    $ethnicity = $_POST['ethnicity'];

    $query = "UPDATE neighbors SET regdate = '{$regdate}' , firstname = '{$firstname}' , lastname = '{$lastname}', streetaddress = '{$streetaddress}' , city = '{$city}' , state = '{$state}' , zip = '{$zip}' , isveteran = '{$isveteran}' , veterandep = '{$veterandep}' , shopperscard = '{$shopperscard}' , newneighbor = '{$newneighbor}' , hasbenefits = '{$hasbenefits}' , seniors = '{$seniors}' , adults = '{$adults}' , kids = '{$kids}' , cats = '{$cats}' , dogs = '{$dogs}' , ethnicity = '{$ethnicity}' WHERE id = $userid";
    $update_user = mysqli_query($conn, $query);
    if ($update_user) {
        echo "<script type='text/javascript'>alert('User data updated successfully!')</script>";
        header("Location: home.php");  // Redirect to home.php
        exit;  // Important to prevent further execution of the script
    } else {
        echo "<script type='text/javascript'>alert('Failed to update user data!')</script>";
    }
}
 
?>


<h1 class="text-center">Update User Details</h1>
  <div class="container ">
    <form action="" method="post">
      <div class="form-group">
        <label for="regdate">Date Registered</label>
            <input type="text" name="regdate" class="form-control" value="<?php echo $regdate ?>" />
        </div>
        <small id="regdateHelp" class="form-text text-muted">Date person first signed up.</small>

        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>" />
        </div>
        <small id="firstnameHelp" class="form-text text-muted">Persons First Name.</small>

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" />
        </div>
        <small id="LastnameHelp" class="form-text text-muted">Persons Last Name.</small>

        <div class="form-group">
            <label for="streetaddress">Street Address</label>
            <input type="text" name="streetaddress" class="form-control" value="<?php echo $streetaddress ?>" />
        </div>
        <small id="streetaddressHelp" class="form-text text-muted">Mailing Address.</small>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" value="<?php echo $city ?>" />
        </div>
        <small id="cityHelp" class="form-text text-muted">City person resides in.</small>

        <div class="form-group">
            <label for="state">State</label>
            <input type="text" name="state" class="form-control" value="<?php echo $state ?>" />
        </div>
        <small id="emailHelp" class="form-text text-muted">State Person resides in.</small>


        <div class="form-group">
            <label for="zip">Zip Code</label>
            <input type="number" name="zip" class="form-control" value="<?php echo $zip ?>" />
        </div>
        <small id="zipHelp" class="form-text text-muted">Zip Code Person Resides In.</small>

        <div class="form-group">
            <label for="isveteran">Is A Veteran</label>
            <input type="checkbox" name="isveteran" value="1" <?php if ($isveteran == 1)
                echo 'checked'; ?>> Is Veteran<br>
        </div>
        <small id="isvetranHelp" class="form-text text-muted">Checked is True (1) Unchecked is false (0).</small>


        <div class="form-group">
            <label for="veterandep">Number of Veteran Dependants.</label>
            <input type="number" name="veterandep" class="form-control" value="<?php echo $veterandep ?>" />

        </div>
        <small id="veterandepHelp" class="form-text text-muted">If Person is a Veteran, Count all people in household as dependants!</small>


        <div class="form-group">
            <label for="shopperscard">Does Family have a Cupboard Shoppers Card?</label>
             <input type="checkbox" name="shopperscard" value="1" <?php if ($shopperscard == 1)
                 echo 'checked'; ?>> Has Shopper's Card<br>
        </div>
        <small id="shopperscardHelp" class="form-text text-muted">Checked is True (1) Unchecked is false (0).</small>


        <div class="form-group">
            <label for="newneighbor">Has never been to a MMO Event Before?</label>
             <input type="checkbox" name="newneighbor" value="1" <?php if ($newneighbor == 1)
                 echo 'checked'; ?>> New Neighbor<br>
        </div>
        <small id="newneighborHelp" class="form-text text-muted">Checked is True (1) Unchecked is false (0).</small>


        <div class="form-group">
            <label for="hasbenefits">Has Goverment Benefits</label>
            <input type="checkbox" name="hasbenefits" value="1" <?php if ($hasbenefits == 1)
                echo 'checked'; ?>> Has Benefits<br>
        </div>
        <small id="hasbenefitsHelp" class="form-text text-muted">Checked is True (1) Unchecked is false (0).</small>


        <div class="form-group">
            <label for="seniors">Number of 60+ Seniors in the household?</label>
            <input type="number" name="seniors" class="form-control" value="<?php echo $seniors ?>" />
        </div>
        <small id="SeniorHelp" class="form-text text-muted">Number of 60+ year old People in the family.</small>

        <div class="form-group">
            <label for="adults">Number of Adults (18 - 59) in the household?</label>
            <input type="number" name="adults" class="form-control" value="<?php echo $adults ?>" />
        </div>
        <small id="adultsHelp" class="form-text text-muted">Number of 18 - 59 Year old people in the family.</small>

        <div class="form-group">
            <label for="kids">Children (0 - 17) In the Household?</label>
            <input type="number" name="kids" class="form-control" value="<?php echo $kids ?>" />
        </div>
        <small id="kidsHelp" class="form-text text-muted">Number of children in the family.</small>

        <div class="form-group">
            <label for="cats">Number of Cats in the household?</label>
            <input type="number" name="cats" class="form-control" value="<?php echo $cats ?>" />
        </div>
        <small id="catsHelp" class="form-text text-muted">Number of Cats in the family.</small>

        <div class="form-group">
            <label for="dogs">Number of Dogs in the household?</label>
            <input type="number" name="dogs" class="form-control" value="<?php echo $dogs ?>" />
        </div>
        <small id="dogsHelp" class="form-text text-muted">Number of dogs in the family.</small>
             
  <div class="form-group">
            <label for="ethnicity">ethnicity ?</label>
            <input type="text" name="ethnicity" class="form-control" value="<?php echo $ethnicity ?>" />
        </div>
        <small id="ethnicityHelp" class="form-text text-muted">Latino = L /White = W /Black = B /Asian = A /Hawaian = H /Indian = I /2 or more = 2 /Refuse = N </small>
      
      <div class="form-group">
         <input type="submit"  name="update" class="btn btn-primary mt-2" value="update">
      </div>
    </form>    
  </div>

    <!-- a BACK button to go to the home page -->
    <div class="container text-center mt-5">
      <a href="home.php" class="btn btn-warning mt-5"> Back </a>
    <div>

<!-- Footer -->
<?php include "../footer.php" ?>