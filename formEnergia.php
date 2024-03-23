<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <?php
    // definir variaves e inicializar com valores vazios
    $nameErr = $sexoErr = $enderecoErr = $cepErr = $bairroErr = $cpfErr = $nascimentoErr =  $data_vencimentoErr =  $uniConsumoErr = $emailErr = $KwhErr = $valor = $siteErr = "";
    $name = $sexo = $endereco = $cep = $bairro = $cpf = $nascimento = $data_vencimento = $uniConsumo = $email = $Kwh = $valor = $site = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Nome é obrigatório";
        } else {
            $name = test_input($_POST["name"]);
            // verifique se o nome contém apenas letras e espaços em branco
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "Somente letras e espaços em branco são permitidos";
            }
        }
        if (empty($_POST["sexo"])) {
            $sexoErr = "Sexo é obrigatório";
        } else {
            $sexo = test_input($_POST["sexo"]);
        }
        if (empty($_POST["endereco"])) {
            $enderecoErr = "Endereço é obrigatório";
        } else {
            $endereco = test_input($_POST["endereco"]);
            // verifique se o endereço contém apenas letras, espaços em branco e números
            if (!preg_match("/^[a-zA-Z-' ]*$/",$endereco)) {
                $enderecoErr = "Somente letras, espaços em branco e números são permitidos";
            }
        }
        if (empty($_POST["cep"])) {
            $cepErr = "CEP é obrigatório";
        } else {
            $cep = test_input($_POST["cep"]);
            // verifique se o CEP está bem formado
            if (!preg_match("/^[0-9]*$/",$cep)) {
                $cepErr = "Somente números são permitidos";
            }
        }
        if (empty($_POST["bairro"])) {
            $bairroErr = "Bairro é obrigatório";
        } else {
            $bairro = test_input($_POST["bairro"]);
            // verifique se o bairro contém apenas letras e espaços em branco
            if (!preg_match("/^[a-zA-Z-' ]*$/",$bairro)) {
                $bairroErr = "Somente letras e espaços em branco são permitidos";
            }
        }
        if (empty($_POST["cpf"])) {
            $cpfErr = "CPF é obrigatório";
        } else {
            $cpf = test_input($_POST["cpf"]);
            // verifique se o CPF está bem formado
            if (!preg_match("/^[0-9]*$/",$cpf)) {
                $cpfErr = "Somente números são permitidos";
            }
        }
        if (empty($_POST["nascimento"])) {
            $nascimentoErr = "Data de nascimento é obrigatório";
        } else {
            $nascimento = test_input($_POST["nascimento"]);
            // verifique se a data de nascimento está bem formada
            if (!preg_match("/^[0-9]*$/",$nascimento)) {
                $nascimentoErr = "Somente números são permitidos";
            }
        }
        if (empty($_POST["data_vencimento"])) {
            $data_vencimentoErr = "Data de vencimento é obrigatório";
        } else {
            $data_vencimento = test_input($_POST["data_vencimento"]);
            // verifique se a data de vencimento está bem formada
            if (!preg_match("/^[0-9]*$/",$data_vencimento)) {
                $data_vencimentoErr = "Somente números são permitidos";
            }
        }
        if (empty($_POST["uniConsumo"])) {
            $uniConsumoErr = "Unidade de consumo é obrigatório";
        } else {
            $uniConsumo = test_input($_POST["uniConsumo"]);
            // Digitar apenas numeros
            if (!preg_match("/^[0-9]*$/",$uniConsumo)) {
                $uniConsumoErr = "Somente números são permitidos";
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email é obrigatório";
        } else {
            $email = test_input($_POST["email"]);
            // verifique se o endereço de e-mail está bem formado
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Formato de email inválido";
            }
        }
        if (empty($_POST["Kwh"])) {
            $KwhErr = "Kwh é obrigatório";
        } else {
            $Kwh = test_input($_POST["Kwh"]);
            // Digitar apenas numeros
            if (!preg_match("/^[0-9]*$/",$Kwh)) {
                $KwhErr = "Somente números são permitidos";
            }
        }
        if (empty($_POST["valor"])) {
            $valorErr = "Valor é obrigatório";
        } else {
            $valor = test_input($_POST["valor"]);
            // Digitar o valor em reais com ponto
            if (!preg_match("/^[0-9]*$/",$valor)) {
                $valorErr = "Somente números são permitidos";
            }
        }
        if (empty($_POST["site"])) {
            $siteErr = "Site é obrigatório";
        } else {
            $site = test_input($_POST["site"]);
            // verifique se a sintaxe do endereço URL é válida (esta expressão regular também permite hífens no URL)
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$site)) {
                $siteErr = "URL inválido";
            }
        }

    }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <h2>Formulário de validação PHP Consumo de energia</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Nome: <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        Sexo:
        <input type="radio" name="sexo" <?php if (isset($sexo) && $sexo=="feminino") echo "checked";?> value="feminino">Feminino
        <input type="radio" name="sexo" <?php if (isset($sexo) && $sexo=="masculino") echo "checked";?> value="masculino">Masculino
        <span class="error">* <?php echo $sexoErr;?></span>
        <br><br>
        Endereço: <input type="text" name="endereco" value="<?php echo $endereco;?>">
        <span class="error">* <?php echo $enderecoErr;?></span>
        <br><br>
        CEP: <input type="text" name="cep" value="<?php echo $cep;?>">
        <span class="error">* <?php echo $cepErr;?></span>
        <br><br>
        Bairro: <input type="text" name="bairro" value="<?php echo $bairro;?>">
        <span class="error">* <?php echo $bairroErr;?></span>
        <br><br>
        CPF: <input type="text" name="cpf" value="<?php echo $cpf;?>">
        <span class="error">* <?php echo $cpfErr;?></span>
        <br><br>
        Data de nascimento: <input type="text" name="nascimento" value="<?php echo $nascimento;?>">
        <span class="error">* <?php echo $nascimentoErr;?></span>
        <br><br>
        Data de vencimento: <input type="text" name="data_vencimento" value="<?php echo $data_vencimento;?>">
        <span class="error">* <?php echo $data_vencimentoErr;?></span>
        <br><br>
        Unidade de consumo: <input type="text" name="uniConsumo" value="<?php echo $uniConsumo;?>">
        <span class="error">* <?php echo $uniConsumoErr;?></span>
        <br><br>
        Email: <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Kwh: <input type="text" name="Kwh" value="<?php echo $Kwh;?>">
        <span class="error">* <?php echo $KwhErr;?></span>
        <br><br>
        Valor: <input type="text" name="valor" value="<?php echo $valor;?>">
        <span class="error">* <?php echo $valorErr;?></span>
        <br><br>
        Site: <input type="text" name="site" value="<?php echo $site;?>">
        <span class="error">* <?php echo $siteErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
        <?php
        echo "<h2>Seus dados:</h2>";
        echo $name;
        echo "<br>";
        echo $sexo;
        echo "<br>";
        echo $endereco;
        echo "<br>";
        echo $cep;
        echo "<br>";
        echo $bairro;
        echo "<br>";
        echo $cpf;
        echo "<br>";
        echo $nascimento;
        echo "<br>";
        echo $data_vencimento;
        echo "<br>";
        echo $uniConsumo;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $Kwh;
        echo "<br>";
        echo $valor;
        echo "<br>";
        echo $site;
        ?>

</body>
</html>