<!-- Header -->
<?php include "../header.php" ?>

<?php
$currentTimestamp = date('Y-m-d H:i:s');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $requiredFields = ['firstname', 'lastname', 'streetaddress', 'city', 'state', 'zip'];
    $binaryFields = ['isveteran', 'shopperscard', 'newneighbor', 'hasbenefits'];
    $numericFields = ['seniors', 'adults', 'kids', 'cats', 'dogs'];
    $errors = [];

    // Validate Required Fields
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "The field '{$field}' is required.";
        }
    }

    // Validate Binary Fields
    foreach ($binaryFields as $field) {
        if (isset($_POST[$field]) && !in_array($_POST[$field], [0, 1])) {
            $errors[] = "The field '{$field}' must be either 0 or 1.";
        }
    }

    // Validate Numeric Fields
    foreach ($numericFields as $field) {
        if (isset($_POST[$field]) && !is_numeric($_POST[$field])) {
            $errors[] = "The field '{$field}' must be a number or 0.";
        }
    }

    // If no validation errors, insert data into the database
    if (empty($errors)) {
        $insertQuery = "INSERT INTO neighbors(regdate, firstname, lastname, streetaddress, city, state, zip, isveteran, veterandep, shopperscard, newneighbor, hasbenefits, seniors, adults, kids, cats, dogs, ethnicity)
                        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $isVeteran = isset($_POST['isveteran']) ? $_POST['isveteran'] : 0;
        $veteranDep = isset($_POST['veterandep']) ? 1 : 0;
        $shopperscard = isset($_POST['shopperscard']) ? $_POST['shopperscard'] : 0;
        $newneighbor = isset($_POST['newneighbor']) ? $_POST['newneighbor'] : 0;
        $hasbenefits = isset($_POST['hasbenefits']) ? $_POST['hasbenefits'] : 0;

        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssssssiiiiiiiiiiis", $currentTimestamp, $_POST['firstname'], $_POST['lastname'], $_POST['streetaddress'], $_POST['city'], $_POST['state'], $_POST['zip'], $isVeteran, $veteranDep, $shopperscard, $newneighbor, $hasbenefits, $_POST['seniors'], $_POST['adults'], $_POST['kids'], $_POST['cats'], $_POST['dogs'], $_POST['ethnicity']);
        
        if (!$stmt->execute()) {
            echo "Something went wrong: " . $stmt->error;
        } else {
            echo "<script type='text/javascript'>alert('User added successfully!'); window.location.href = 'https://mm.myneighborscupboard.org/includes/home.php';</script>";
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo "<p>{$error}</p>";
        }
        echo '<a href="create.php" class="btn btn-warning mt-2">Back</a>';
    }
}
?>

<h1 class="text-center">Add User details </h1>

<div class="container">
    <form action="create.php" method="post">
        <!-- Form Group 1 -->
        <div class="form-group">
            <label for="regdate">Date Registered</label>
            <input type="text" name="regdate" class="form-control" value="<?php echo $currentTimestamp ?>" readonly />
            <small id="regdateHelp" class="form-text text-muted">Date person first signed up.</small>
        </div>

        <!-- Form Group 2 -->
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" class="form-control" value="" />
            <small id="firstnameHelp" class="form-text text-muted">Persons First Name.</small>
        </div>

        <!-- Form Group 3 -->
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="" />
            <small id="LastnameHelp" class="form-text text-muted">Persons Last Name.</small>
        </div>

        <!-- Form Group 4 -->
        <div class="form-group">
            <label for="streetaddress">Street Address</label>
            <input type="text" name="streetaddress" class="form-control" value="" />
            <small id="streetaddressHelp" class="form-text text-muted">Mailing Address.</small>
        </div>

        <!-- Form Group 5 -->
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" value="" />
            <small id="cityHelp" class="form-text text-muted">City person resides in.</small>
        </div>

        <!-- Form Group 6 -->
        <div class="form-group">
            <label for="state">State</label>
            <input type="text" name="state" class="form-control" pattern="[A-Za-z]{2}" title="Enter two alphabetical characters" required />
            <small id="stateHelp" class="form-text text-muted">State Person resides in (two letters).</small>
        </div>

        <!-- Form Group 7 -->
        <div class="form-group">
            <label for="zip">Zip Code</label>
            <input type="number" name="zip" class="form-control" value="" />
            <small id="zipHelp" class="form-text text-muted">Zip Code Person Resides In.</small>
        </div>

        <!-- Form Group 8 -->
        <div class="form-group">
            <label for="isveteran">Is A Veteran</label>
            <input type="checkbox" name="isveteran" value="1" class="form-check-input" />
        </div>
        <small id="isvetranHelp" class="form-text text-muted">Checked is True (1) Unchecked is false (0).</small>

        <!-- Form Group 9 -->
        <div class="form-group">
            <label for="veterandep">Number of Veteran Dependents.</label>
            <input type="number" name="veterandep" class="form-control">
        </div>
        <small id="veterandepHelp" class="form-text text-muted">If Person is a Veteran, Count all people in household as dependents!</small>

        <!-- Form Group 10 -->
        <div class="form-group">
            <label for="shopperscard">Does Family have a Cupboard Shoppers Card?</label>
            <input type="checkbox" name="shopperscard" value="1" class="form-check-input">
        </div>
        <small id="shopperscardHelp" class="form-text text-muted">Checked is True (1) Unchecked is false (0).</small>

        <!-- Form Group 11 -->
        <div class="form-group">
            <label for="newneighbor">Has never been to an MMO Event Before?</label>
            <input type="checkbox" name="newneighbor" value="1" class="form-check-input" >
        </div>
        <small id="newneighborHelp" class="form-text text-muted">Checked is True (1) Unchecked is false (0).</small>

        <!-- Form Group 12 -->
        <div class="form-group">
            <label for="hasbenefits">Has Government Benefits</label>
            <input type="checkbox" name="hasbenefits" value="1" class="form-check-input" />
        </div>
        <small id="hasbenefitsHelp" class="form-text text-muted">Checked is True (1) Unchecked is false (0).</small>

        <!-- Form Group 13 -->
        <div class="form-group">
            <label for="seniors">Number of 60+ Seniors in the household?</label>
            <input type="number" name="seniors" class="form-control" value="" />
        </div>
        <small id="SeniorHelp" class="form-text text-muted">Number of 60+ year old People in the family.</small>

        <!-- Form Group 14 -->
        <div class="form-group">
            <label for="adults">Number of Adults (18 - 59) in the household?</label>
            <input type="number" name="adults" class="form-control" value="" />
        </div>
        <small id="adultsHelp" class="form-text text-muted">Number of 18 - 59 Year old people in the family.</small>

        <!-- Form Group 15 -->
        <div class="form-group">
            <label for="kids">Children (0 - 17) In the Household?</label>
            <input type="number" name="kids" class="form-control" value="" />
        </div>
        <small id="kidsHelp" class="form-text text-muted">Number of children in the family.</small>

        <!-- Form Group 16 -->
        <div class="form-group">
            <label for="cats">Number of Cats in the household?</label>
            <input type="number" name="cats" class="form-control" value="" />
        </div>
        <small id="catsHelp" class="form-text text-muted">Number of Cats in the family.</small>

        <!-- Form Group 17 -->
        <div class="form-group">
            <label for="dogs">Number of Dogs in the household?</label>
            <input type="number" name="dogs" class="form-control" value="" />
        </div>
        <small id="dogsHelp" class="form-text text-muted">Number of dogs in the family.</small>

        <!-- Form Group 18 -->
        <div class="form-group">
            <label for="ethnicity">Ethnicity?</label>
            <input type="text" name="ethnicity" class="form-control" pattern="[LWB AHI2N]" title="Allowed values: L, W, B, A, H, I, 2, N" />
        </div>
        <small id="ethnicityHelp" class="form-text text-muted">Latino = L / White = W / Black = B / Asian = A / Hawaian = H / Indian = I / 2 or more = 2 / Refuse = N </small>

        <!-- Form Group 19 -->
        <div class="form-group">
            <input type="submit" name="create" id="submitBtn" class="btn btn-primary mt-2" value="Submit">
        </div>
    </form>
</div>
