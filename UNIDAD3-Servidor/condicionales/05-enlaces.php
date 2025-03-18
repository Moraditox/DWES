<?php
/* Script que muestre una lista de enlaces en función del perfil de usuario:
Perfil Administrador: Pagina1, Pagina2, Pagina3, Pagina4
Perfil Usuario: Pagina1, Pagina2 */

// Rol perfil
$perfil = "Administrador";

// Mostrar enlaces en un solo echo
if ($perfil == "Administrador") {
    echo "<h1>Enlaces para el perfil: Administrador</h1>
          <ul>
              <li><a href='#'>Pagina1</a></li>
              <li><a href='#'>Pagina2</a></li>
              <li><a href='#'>Pagina3</a></li>
              <li><a href='#'>Pagina4</a></li>
          </ul>";
} elseif ($perfil == "Usuario") {
    echo "<h1>Enlaces para el perfil: Usuario</h1>
          <ul>
              <li><a href='#'>Pagina1</a></li>
              <li><a href='#'>Pagina2</a></li>
          </ul>";
} else {
    echo "Perfil no válido.";
}
?>
