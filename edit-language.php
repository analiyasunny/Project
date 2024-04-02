<?php 
$title = 'Edit Language';
include('shared/header.php'); 

// get the languageId from the URL parameter using $_GET
$languageId = $_GET['languageId'];

// initialize variables
$Language = null;
$NativeSpeakers = null;
$Country = null;
$linguisticage = null;

// if languageId is numeric, fetch language from the database
if (is_numeric($languageId)) {

    // connect to the database
    include('shared/db.php');

    // fetch language data from the database
    $sql = "SELECT * FROM Language WHERE languageId = :languageId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':languageId', $languageId, PDO::PARAM_INT);
    $cmd->execute();
    $Language = $cmd->fetch(PDO::FETCH_ASSOC);

    // assign values to variables
    $LanguageName = $Language['Language'];
    $NativeSpeakers = $Language['NativeSpeakers'];
    $Country = $Language['Country'];
    $linguisticage = $Language['linguisticage'];
}

?>

<h2>World Languages and Speakers</h2>
<form method="post" action="update-lang.php">
    <fieldset>
        <label for="Language">Language: *</label>
        <input name="Language" id="Language" required value="<?php echo htmlspecialchars($LanguageName); ?>"/>
    </fieldset>
    <fieldset>
        <label for="NativeSpeakers">Native Speakers: *</label>
        <input name="NativeSpeakers" id="NativeSpeakers" required value="<?php echo htmlspecialchars($NativeSpeakers); ?>"/>
    </fieldset>
    <fieldset>
        <label for="Country">Country: *</label>
        <input name="Country" id="Country" required value="<?php echo htmlspecialchars($Country); ?>" /> 
    </fieldset>
    <fieldset>
        <label for="linguisticage">Linguistic age: *</label>
        <select name="linguisticage" id="linguisticage" required>
            <?php
            // set up & run query, store data results
            $sql = "SELECT * FROM Lingusticage ORDER BY name";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $Lingusticage = $cmd->fetchAll(PDO::FETCH_ASSOC);

            // loop through list of linguistic ages, adding each one to dropdown 1 at a time
            // check each linguistic age & select the one that matches the language we're editing
            foreach ($Lingusticage as $Lingusticages) {
                if ($Lingusticages['name'] == $linguisticage) {
                    echo '<option selected>' . htmlspecialchars($Lingusticages['name']) . '</option>';
                } else {
                    echo '<option>' . htmlspecialchars($Lingusticages['name']) . '</option>';
                }
            }
            ?>
        </select> 
    </fieldset>
    <input type="hidden" name="languageId" id="languageId" value="<?php echo $languageId; ?>" />
    <button class="offset-button">Submit</button>
</form>
</main>
</body>
</html>
