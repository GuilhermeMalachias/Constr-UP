<?php
require_once 'conexao.php';
$mat = new materiais("constr up app","localhost","root","");
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>ConstrUp</title>
</head>

<body>
    <?php
        if(isset($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $descricao = addslashes($_POST['descricao']);
            $marca = addslashes($_POST['marca']);
            $quantidade = addslashes($_POST['quantidade']);
            $datacriacao = addslashes($_POST['datacriacao']);
            if(!empty($nome) && !empty($descricao) && !empty($marca) && !empty($quantidade) && !empty($datacriacao)) {
                if(!$mat->insertMaterial($nome, $descricao, $marca, $quantidade, $datacriacao)) {
                    echo "Material já cadastrado no sistema!";
                }
            } else {
                echo "Preencha todos os campos!";
            }
        }
    ?>
        <header>
                <h1>Constr UP</h1>
                <p>Compare e Economize</p>
        </header>
        <h1 id="title">Materiais de Construção</h1>

        <table border="1">
            <div id="tableHead">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Marca</th>
                <th>Quantidade</th>
                <th>Data de Criação</th>
            </tr>
            </thead>

        <?php
            $datas = $mat->catchDatas();
            if(count($datas) > 0) {
                for ($i=0; $i < count($datas); $i++) {
                    echo "<tr>"; 
                    foreach ($datas[$i] as $key => $value) {
                        if($key != "id") {
                            echo "<td>".$value."</td>";
                        }
                    }
                    echo "</tr>";
                }
            } else {
                echo "Ainda não há materiais cadastrados!";
            }
        ?>
        </table>
        </div>

        <button id="openModal">Novo material de construção</button>
        
        <div id="modalTools" class="modalContainer">
            <div class="modal">
                <button class="close">x</button>
                <h3 class="subtitulo">Adicionar Material</h3>
                <form method="post">
                    <input class="input" type="text" name="nome" id="" placeholder="Nome do material">
                    <input type="text" name="descricao" id="" placeholder="Descrição">
                    <input type="text" name="marca" id="" placeholder="Marca">
                    <input type="text" name="quantidade" id="" placeholder="Quantidade">
                    <input type="text" name="datacriacao" id="" placeholder="Data de criação">
                    <button class="button" type="submit">Adicionar</button>
                </form>
            </div>
        </div>
        <script src="index.js"></script>
</body>
</html>