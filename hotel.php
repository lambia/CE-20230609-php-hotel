<?php
$parkingFilter = ($_GET['parking'] == "SI") ? true : false;

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
    ]
];
$filteredHotels = $hotels;

if ($parkingFilter) {
    $nuovoArray = [];

    foreach ($hotels as $albergo) {
        if ($albergo['parking']) {
            $nuovoArray[] = $albergo;
        }
    }

    $filteredHotels = $nuovoArray;
}

if (isset($_GET['vote']) && $_GET['vote'] !== "") {
    $nuovoArray = [];

    foreach ($filteredHotels as $albergo) {
        if ($albergo['vote'] >= $_GET['vote']) {
            $nuovoArray[] = $albergo;
        }
    }

    $filteredHotels = $nuovoArray;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Alberghi PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background: #222;
            color: white;
            font-family: sans-serif;
        }

        /* * { box-sizing: border-box; padding: 0; margin: 0;} */
    </style>
</head>

<body>

    <div class="container py-4">
        <div class="row">
            <form action="hotel.php" method="GET" class="row gx-3 gy-2 align-items-center">
                <div class="col-12">
                    <label for="parking">Mostra alberghi:</label>
                    <?php if (!$parkingFilter) { ?>
                        <select name="parking" id="parking">
                            <option value="" selected>TUTTI</option>
                            <option value="SI">SOLO CON PARCHEGGIO</option>
                        </select>
                    <?php } else { ?>
                        <select name="parking" id="parking">
                            <option value="">TUTTI</option>
                            <option value="SI" selected>SOLO CON PARCHEGGIO</option>
                        </select>
                    <?php } ?>
                </div>
                <div class="col-12">
                    <label for="vote">Votazione almeno di:</label>
                    <?php if ( $_GET['vote'] ) { ?>
                        <input type="number" name="vote" id="vote" max="5" min="1" value="<?php echo $_GET['vote'] ?>" >
                    <?php } else { ?>
                        <input type="number" name="vote" id="vote" max="5" min="1">
                    <?php } ?>
                </div>
                <div class="col-12">
                    <button type="submit">INVIA</button>
                    <button type="reset">CANCELLA</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Lista Alberghi</h1>
            </div>
        </div>

        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Parcheggio</th>
                        <th scope="col">Stelle</th>
                        <th scope="col">Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filteredHotels as $albergo) { ?>
                        <?php /*if( !$parkingFilter || ($parkingFilter && $albergo['parking']) ){*/ ?>
                        <tr>
                            <td><?php echo $albergo['name'] ?></td>
                            <td><?php echo $albergo['description'] ?></td>
                            <td><?php echo ($albergo['parking']) ? "SI" : "NO" ?></td>
                            <td><?php echo $albergo['vote'] ?></td>
                            <td><?php echo $albergo['distance_to_center'] ?></td>
                        </tr>
                        <?php /*}*/ ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


</body>

</html>