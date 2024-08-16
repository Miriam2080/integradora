<?php
include_once "../conexion/conexion.php";

$sql = "SELECT u.Id_usuario, u.nombre_usuario, u.ap_pat_usuario, u.ap_mat_usuario, u.numero_tel, u.codigo_postal, 
        u.correo_electronico, u.contra, c.nom_ciudad, t.tipo_de_usuario 
        FROM ((usuario u LEFT JOIN ciudad c ON u.Id_ciudad = c.Id_ciudad))LEFT JOIN tipo_de_usuario t on u.Id_tipo_de_usuario = t.Id_tipo_de_usuario";

$productos = $conn->query($sql);
if ($productos->num_rows > 0) {
  while ($row = $productos->fetch_assoc()) {
    echo "
            <tr>
              <td>{$row["Id_usuario"]}</td>
              <td>{$row["nombre_usuario"]}</td>
              <td>{$row["ap_pat_usuario"]}</td>
              <td>{$row["ap_mat_usuario"]}</td>
              <td>{$row["numero_tel"]}</td>
              <td>{$row["codigo_postal"]}</td>
              <td>{$row["correo_electronico"]}</td>
              <td>{$row["contra"]}</td>
              <td>{$row["nom_ciudad"]}</td>
              <td>{$row["tipo_de_usuario"]}</td>
             
              <td>
                <button  class='btn btn-light' onclick='fnmodi({$row["Id_usuario"]})'>Editar</button>
                <button  class='btn btn-danger' onclick='fnborrar({$row["Id_usuario"]})'>Borrar</button>
              </td>
            </tr>
            ";
  }
} else {
  echo "<tr><td colspan='10'>0 usuario</td></tr>";
}
$conn->close();
