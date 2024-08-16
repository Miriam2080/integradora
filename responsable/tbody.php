<?php
include_once "../conexion/conexion.php";

$sql = "SELECT r.Id_responsable_evento, r.nombre_responsable, r.ap_pat_responsable, r.ap_mat_responsable, r.facebook, 
r.youtube, r.tiktok, r.telefono, r.correo, c.nom_ciudad, t.tipo_responsable, e.especialidad_experiencia 
FROM ((responsable_eventos r LEFT JOIN tipo_de_responsable t ON r.Id_tipo_responsable=t.Id_tipo_responsable) 
LEFT JOIN ciudad c ON r.Id_ciudad=c.Id_ciudad)LEFT JOIN especialidad e ON r.Id_especialidad=e.Id_especialidad";
$productos = $conn->query($sql);
if ($productos->num_rows > 0) {
  while ($row = $productos->fetch_assoc()) {
    echo "
            <tr>
              <td>{$row["Id_responsable_evento"]}</td>
              <td>{$row["nombre_responsable"]}</td>
              <td>{$row["ap_pat_responsable"]}</td>
              <td>{$row["ap_mat_responsable"]}</td>
              <td>{$row["facebook"]}</td>
              <td>{$row["youtube"]}</td>
              <td>{$row["tiktok"]}</td>
              <td>{$row["telefono"]}</td>
              <td>{$row["correo"]}</td>
              <td>{$row["nom_ciudad"]}</td>
              <td>{$row["tipo_responsable"]}</td>
              <td>{$row["especialidad_experiencia"]}</td>
              <td>
                <button  class='btn btn-light' onclick='fnmodi({$row["Id_responsable_evento"]})'>Editar</button>
                <button  class='btn btn-danger' onclick='fnborrar({$row["Id_responsable_evento"]})'>Borrar</button>
              </td>
            </tr>
            ";
  }
} else {
  echo "<tr><td colspan='10'>0 responsable</td></tr>";
}
$conn->close();
