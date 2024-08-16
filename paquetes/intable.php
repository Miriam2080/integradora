<?php
include_once "../conexion/conexion.php";

$sql = "SELECT paquetes.Id_paquete, eventos.Nom_evento, tipo_paquete.tipo_de_paquete 
        FROM paquetes
        JOIN eventos ON paquetes.Id_eventos = eventos.Id_eventos
        JOIN tipo_paquete ON paquetes.Id_tipo_de_paquetes = tipo_paquete.Id_Tipo_de_paquetes
        ORDER BY paquetes.Id_paquete ASC, eventos.Nom_evento, tipo_paquete.tipo_de_paquete";
$productos = $conn->query($sql);
if ($productos->num_rows > 0) {
  while ($row = $productos->fetch_assoc()) {
    echo "
            <tr>
              <td>{$row["Id_paquete"]}</td>
              <td>{$row["tipo_de_paquete"]}</td>
              <td>{$row["Nom_evento"]}</td>
             
              <td>
                <button class='btn btn-light' data-bs-toggle='modal' data-bs-target='#myeditModal' onClick='fnEditar({$row["Id_paquete"]})'> Editar </button>
              <button class='btn btn-danger' onClick='fnBorrar({$row["Id_paquete"]})'> Borrar </button>
              </td>
              
            </tr>
            ";
  }
} else {
  echo "<tr><td colspan='10'>0 usuario</td></tr>";
}
$conn->close();
