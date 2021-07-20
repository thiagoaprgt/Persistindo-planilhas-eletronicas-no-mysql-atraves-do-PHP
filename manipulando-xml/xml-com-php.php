<?php

    /*

        DOM = Document Object Model
        O DOM é usado para manipular documento XML

        // as pasta com o nome tmp são onde os sistemas armazenam arquivo temporários

        row = linha

    */

    $file = $_FILES['xml'];    


    if(isset($_FILES['xml']['tmp_name'])) {

        $file = $_FILES['xml']['tmp_name'];

        $xml = new DOMDocument();

        // Carrega o arquivo XML.
        $xml->load($file); 
        
        // Retorna uma instancia da classe DOMNodeList contendo todos os elementos com um determinado nome de tag local.
        $rows = $xml->getElementsByTagName('Row'); 

        $contador = 0;        

        foreach ($rows as $row) {


            if($contador == 0) {

                $contador++;

                // Retorna uma instancia da classe DOMNodeList contendo todos os elementos com um determinado nome de tag local.
                $data = $row->getElementsByTagName("Data");

                // Retorna o valor escolhido que está dentro do arquivo XML
                $coluna[] = $data->item(0)->nodeValue;
                $coluna[] = $data->item(1)->nodeValue;
                $coluna[] = $data->item(2)->nodeValue;
                $coluna[] = $data->item(3)->nodeValue;

                

            }else{

                // Retorna uma instancia da classe DOMNodeList contendo todos os elementos com um determinado nome de tag local.
                $data = $row->getElementsByTagName("Data");

                // Retorna o valor escolhido que está dentro do arquivo XML
                $nome = $data->item(0)->nodeValue;
                $preco_venda = $data->item(1)->nodeValue;
                $preco_custo = $data->item(2)->nodeValue;
                $estoque = $data->item(3)->nodeValue;

                echo $coluna[0] . " : $nome <br>\n";
                echo $coluna[1] . " : $preco_venda<br>\n";
                echo $coluna[2] . " : $preco_custo<br>\n";
                echo $coluna[3] . " : $estoque<br>\n";

                echo "<br>\n <hr>";
                
                $config = parse_ini_file('../config/config.ini');
                
                extract($config);

                $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

                $sql = "INSERT INTO `produtos`(`id`, `nome`, `preco_venda`, `preco_custo`, `estoque`) VALUES
                
                    (null, '$nome', '$preco_venda', '$preco_custo', '$estoque')
                ";

                $query = $conn->query($sql);

                
                

            }      
            

        }       

        

    }


    

    





?>