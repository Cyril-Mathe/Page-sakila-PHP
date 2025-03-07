<?php
$username = "root";
$password = "";
$host = "localhost";
$port = 3306;
$engine = "mysql";
$dbName = "sakila";

$pdo = new PDO(
    "$engine:host=$host;port=$port;dbname=$dbName",
    $username, $password
);

$stmt = $pdo->prepare("SELECT * FROM language");
$stmt->execute();
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
$langues = [];
foreach ($resultats as $resultat) {
    $langues[] = $resultat["name"];
};

$language = filter_input(INPUT_POST, "language");
if ($language) {
    $stmt = $pdo->prepare("
        INSERT INTO language(name)
        VALUES(:language)"
    );
$stmt->execute([
    ":language" => $language
]);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sakila</title>
</head>
<body>
    <h1>Test</h1>
    <?php
    foreach ($langues as $langue) {
        echo $langue . "<br>";
    }
    ?>
    <form method="post">
        <input type="text" name="language">

        <input type="submit" value="Envoyer">
    </form>
</body>
</html>