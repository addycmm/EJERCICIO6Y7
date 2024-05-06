<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdadriana";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL
$sql = "SELECT
            SUM(CASE WHEN p.departamento = 'La Paz' THEN cb.saldo ELSE 0 END) AS La_Paz,
            SUM(CASE WHEN p.departamento = 'Santa Cruz' THEN cb.saldo ELSE 0 END) AS Santa_Cruz,
            SUM(CASE WHEN p.departamento = 'Cochabamba' THEN cb.saldo ELSE 0 END) AS Cochabamba,
            -- Agrega más casos para cada departamento de Bolivia según sea necesario
            SUM(CASE WHEN p.departamento = 'Oruro' THEN cb.saldo ELSE 0 END) AS Oruro,
            SUM(CASE WHEN p.departamento = 'Potosí' THEN cb.saldo ELSE 0 END) AS Potosí,
            SUM(CASE WHEN p.departamento = 'Tarija' THEN cb.saldo ELSE 0 END) AS Tarija,
            SUM(CASE WHEN p.departamento = 'Chuquisaca' THEN cb.saldo ELSE 0 END) AS Chuquisaca,
            SUM(CASE WHEN p.departamento = 'Beni' THEN cb.saldo ELSE 0 END) AS Beni,
            SUM(CASE WHEN p.departamento = 'Pando' THEN cb.saldo ELSE 0 END) AS Pando
        FROM
            persona p
        JOIN
            cuentabancaria cb ON p.id = cb.persona_id";

// Ejecutar consulta
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Imprimir tabla HTML con clases de Bootstrap
    echo "<h1>gerente bancario</h1>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>
            <tr>
                <th>La Paz</th>
                <th>Santa Cruz</th>
                <th>Cochabamba</th>
                <th>Oruro</th>
                <th>Potosí</th>
                <th>Tarija</th>
                <th>Chuquisaca</th>
                <th>Beni</th>
                <th>Pando</th>
            </tr>
        </thead>";
    echo "<tbody>";
    // Imprimir filas de datos
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['La_Paz'] . "</td>";
        echo "<td>" . $row['Santa_Cruz'] . "</td>";
        echo "<td>" . $row['Cochabamba'] . "</td>";
        // Agrega más celdas para cada departamento de Bolivia según sea necesario
        echo "<td>" . $row['Oruro'] . "</td>";
        echo "<td>" . $row['Potosí'] . "</td>";
        echo "<td>" . $row['Tarija'] . "</td>";
        echo "<td>" . $row['Chuquisaca'] . "</td>";
        echo "<td>" . $row['Beni'] . "</td>";
        echo "<td>" . $row['Pando'] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "No se encontraron resultados";
}

// Cerrar conexión
$conn->close();
?>
