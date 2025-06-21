<?php
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
?>
<body>
<?php 
include("presentacion/encabezadoD.php"); 
include("presentacion/menu" . ucfirst($rol) . ".php"); 
$perro = new Perro(); 
$perros = $perro->consultar($rol, $id); 
?>
<div class="container">
    <div class="row mt-4"> <div class="col">
            <div class="card">
                <div class="card-header"><h4>Listado de Perros</h4></div>
                <div class="card-body">
                    <?php
                    $cantidadPerros = count($perros);
                    echo $cantidadPerros . " perro" . ($cantidadPerros !== 1 ? "s" : "") . " encontrado" . ($cantidadPerros !== 1 ? "s" : "") . "<br>"; 
                    
                    if (empty($perros)) {
                        echo "<div class='alert alert-warning mt-3'>No se encontraron perros para mostrar.</div>";
                    } else {
                        echo "<table class='table table-striped table-hover mt-3'>";
                        echo "<thead><tr><th>Id</th><th>Nombre y Foto</th><th>Raza</th><th>Tamaño</th><th>Acción</th></tr></thead>";
                        echo "<tbody>";
                        foreach($perros as $perroItem){
                            echo "<tr>";
                            echo "<td class='align-middle py-3'>" . htmlspecialchars($perroItem->getId()) . "</td>"; 
                            echo "<td class='d-flex align-items-center py-3'>"; 
                                $imgRelativePath = $perroItem->getFoto(); 
                                $fullServerPath = __DIR__ . '/../../../' . $imgRelativePath; 
                                
                                $imgSrc = (
                                    $perroItem->getFoto() && file_exists($fullServerPath) && !is_dir($fullServerPath)
                                ) ? '../../../' . htmlspecialchars($imgRelativePath) : '../../../img/placeholder_dog.png';
                                
                                echo "<img src='" . $imgSrc . "' alt='Foto de " . htmlspecialchars($perroItem->getNombre()) . "' class='rounded-circle mr-3' style='width: 70px; height: 70px; object-fit: cover;'>"; 
                                echo "<span class='ml-2'>" . htmlspecialchars($perroItem->getNombre()) . "</span>"; 
                            echo "</td>";
                            echo "<td class='align-middle py-3'>" . htmlspecialchars($perroItem->getRaza()) . "</td>"; 
                            echo "<td class='align-middle py-3'>" . htmlspecialchars($perroItem->getTamaño()) . "</td>"; 
                            echo "<td class='align-middle py-3'>"; 
                                echo "<a href='detallePerro.php?id=" . htmlspecialchars($perroItem->getId()) . "' class='btn btn-info btn-sm'>Ver</a> ";
                                echo "<a href='editarPerro.php?id=" . htmlspecialchars($perroItem->getId()) . "' class='btn btn-warning btn-sm'>Editar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>