<?php
$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

$hotel_filter = [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container-xl">
        <h1 class="p-5 text-center">Tabella Hotel</h1>
        <form action="index.php" method="GET" class="py-3">

            <label for="parking" class="fw-bold">Filtro Parcheggio:</label>
            <select name="parking" id="parking">
                <option value="" selected>Scegli un' opzione</option>
                <option value="1">Con Parcheggio</option>
                <option value="0">Senza Parcheggio</option>
            </select>

            <label for="vote">Filtro Voto:</label>
            <select name="vote" id="vote">
                <option value="" selected>Scegli un' opzione</option>
                <option value="1">1 Stella</option>
                <option value="2">2 Stelle</option>
                <option value="3">3 Stelle</option>
                <option value="4">4 Stelle</option>
                <option value="5">5 Stelle</option>
            </select>
            <?php var_dump($_GET) ?>
            <button type="submit">Invia</button>
        </form>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Parking</th>
                    <th scope="col">Vote</th>
                    <th scope="col">Distance to center</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                    // Mia soluzione
                    if ($_GET["vote"] !== "") {
                        $hotel_filter = array_filter($hotels, function($hotel) {
                            return $hotel["vote"] >= $_GET["vote"];
                            });
                            var_dump($hotel_filter);
                    } elseif ($_GET["parking"] === "true") {
                        $hotel_filter = array_filter($hotels, function($hotel) {
                        return $hotel["parking"] === true;
                        });
                    } elseif ($_GET["parking"] === "false") {
                        $hotel_filter = array_filter($hotels, function($hotel) {
                            return $hotel["parking"] === false;
                        });
                    } else {
                        $hotel_filter = $hotels;
                    }
                ?>
                <?php foreach ($hotel_filter as $key => $hotel) {
                    // Ticket
                    if ($_GET["parking"] == $hotel["parking"] && $_GET["vote"] >= $hotel["vote"]) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $key + 1; ?></th>
                            <td><?php echo $hotel["name"] ?></td>
                            <td><?php echo $hotel["description"] ?></td>
                            <td><?php echo $hotel["parking"] ?></td>
                            <td><?php echo $hotel["vote"] ?></td>
                            <td><?php echo $hotel["distance_to_center"] ?></td>
                        </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>