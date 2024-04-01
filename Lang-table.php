    <?php 
    //including the shared header
    include('shared/header.php'); 
    $title = 'World Languages and Speakers';
    
    //including the shared Database
    include('shared/db.php');

    //set up query to fetch show data
    $sql = "SELECT * FROM Language";
    $cmd = $db->prepare($sql);

    // runnig query and storing results 
    $cmd->execute();
    $Language = $cmd->fetchAll();

    //Showing the Language list
    echo '<h1>Language Table</h1>';
    echo '<table><thead><th>Language</th><th>Native Speakers</th><th>Country</th><th>linguistic age</th></thead>';

    // looping through the data result from the query, and displaying each show name
    foreach ($Language as $Languages) {
        echo '<tr>
        <td>' . $Languages['Language'] . '</td>
        <td>' . $Languages['NativeSpeakers'] . '</td>
        <td>' . $Languages['Country'] . '</td>
        <td>' . $Languages['linguisticage'] . '</td>
        </tr>';
          }

    // end of the list
    echo '</table>';

    //disconnect
    $db = null;
    ?>
</body>
</html>