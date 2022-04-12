<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Product list</title>
</head>

<body class="container bg-dark">
    <h1 class="text-center text-white">Gestion de productos</h1>
    <div class="d-flex align-items-center justify-content-around">
        <a class="btn btn-success mb-2" href="./crear.php">New item</a>
        <p class="text-white m-0" id="name-person"></p>
        <a class="btn btn-danger mb-2" href="./loginVIEW.php" id="logout">Log out</a>
    </div>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Details</th>
                <th scope="col">Code</th>
                <th scope="col">Valoracion</th>
                <th scope="col">Valorar</th>
            </tr>
        </thead>
        <tbody>

            <?php
            // Se crea la conexion a la base de datos (he creado un archivo por separado a ser recurrente)
            require('./db/db.php');
            $sql = "SELECT * FROM productos";
            $bd = new BD();
            $conexion = $bd->getConexion();
            $statement = $conexion->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            //Creo la tabla mediante foreach usando bootstrap
          
            foreach ($result as $product) {
                if ($product['voto'] == null) {
                    $product['voto'] = "Sin votos";
                }else{
                    $product['voto'] = $product['voto'];
                }
                echo "<tr idpr='$product[id]'>";
                echo "<td id='idPr' idpr='$product[id]'>$product[id]</td>";
                echo "<td id='idPr'>$product[nombre]</td>";
                echo "<td id='voto'>$product[voto]</td>";
                echo "<td id='idPr'>";
                echo "<div class='d-flex'>";
                // echo "<form id='form-vote' action='src/listado.php' class='d-flex'>";
                echo "<select class='form-select' id='voto' name='vote'>";
                echo "<option value='1'>1</option>";
                echo "<option value='2'>2</option>";
                echo "<option value='3'>3</option>";
                echo "<option value='4'>4</option>";
                echo "<option value='5'>5</option>";
                echo "</select>";
                echo "<button class='btn btn-success mx-2' id='btn-voto' >Valorar</button>";
                echo "<input type='hidden' id='input-id' value='$product[id]'>";
                echo "</div>";
                // echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
            ?>




        </tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>

    <script>
        if (!localStorage.getItem('user')) {
            window.location.replace('./loginVIEW.php');
        }
        $('#name-person').html(localStorage.getItem('user')).css('text-transform', 'uppercase');
        $('#logout').click(function() {
            localStorage.removeItem('user');
        })

        const allButtons = document.querySelectorAll('#btn-voto');

        allButtons.forEach(function(element) {

            element.addEventListener('click', function(e) {

                const voto = e.target.parentElement.children[0].value;
                const id = e.target.parentElement.children[2].value;
                const idUsuario = localStorage.getItem('user');

                const values = {
                    voto,
                    id,
                    idUsuario
                };
                $.ajax({
                    url: 'src/listado.php',
                    type: 'POST',
                    data: values,
                    success: function(data) {

                        // Aqui viene el numero de votos que tiene el producto
                        let res = JSON.parse(data);
                        console.log(res);
                        if (res.result) {
                            valoracion(res.id,res.estrellas.estrellas);
                            console.log(res);
                        } else if (!res.result) {
                            console.log(data);
                            alert("Ya has votado a este producto");
                        }

                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            })

            function valoracion(id, voto) {
                let texto = document.querySelector(`tr[idpr="${id}"]`);
                let query = texto.querySelector('#voto');
               for (let i = 0; i < parseInt(voto); i++) {
                   let estrella = document.createElement('i');
                     estrella.classList.add('fa-solid', 'fa-star');
                        query.appendChild(estrella);
                  
               }
                query.innerHTML = voto;
                
            }


        })
    </script>

</body>

</html>