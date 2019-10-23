<?php 
function app(){

sleep(1);
render_menu_customer();

sleep(1);
render_option_menu();

}


function render_header(){
    printf(" %s ", base64_decode('ICAgICAgICAgICAgICAgICAgICAgIC5fX19fX19fX19fXy4gX19fX19fXyAgICAgX19fX19fXy5fX19fX19fX19fXy4gX19fX19fXyAKfCAgICAgICAgICAgfHwgICBfX19ffCAgIC8gICAgICAgfCAgICAgICAgICAgfHwgICBfX19ffApgLS0tfCAgfC0tLS1gfCAgfF9fICAgICB8ICAgKC0tLS1gLS0tfCAgfC0tLS1gfCAgfF9fICAgCiAgICB8ICB8ICAgICB8ICAgX198ICAgICBcICAgXCAgICAgICB8ICB8ICAgICB8ICAgX198ICAKICAgIHwgIHwgICAgIHwgIHxfX19fLi0tLS0pICAgfCAgICAgIHwgIHwgICAgIHwgIHxfX19fIAogICAgfF9ffCAgICAgfF9fX19fX198X19fX19fXy8gICAgICAgfF9ffCAgICAgfF9fX19fX198CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgIC5fX19fX18gICAgICAgICAgX19fICAgICAgIF9fICAgX19fX19fX18gIAogICAgICAgfCAgIF8gIFwgICAgICAgIC8gICBcICAgICB8ICB8IHwgICAgICAgLyAgCiAgICAgICB8ICB8XykgIHwgICAgICAvICBeICBcICAgIHwgIHwgYC0tLS8gIC8gICAKICAgICAgIHwgICAgICAvICAgICAgLyAgL19cICBcICAgfCAgfCAgICAvICAvICAgIAogICAgICAgfCAgfFwgIFwtLS0tLi8gIF9fX19fICBcICB8ICB8ICAgLyAgLy0tLS0uCiAgICAgICB8IF98IGAuX19fX18vX18vICAgICBcX19cIHxfX3wgIC9fX19fX19fX3wKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIA==') );
    sleep(2);

    for ($i=3; $i > 0; $i--) { 

        printf("\nIniciando Sistema em %s ", $i);
        sleep(1);

    }
    ( 'Linux' == PHP_OS) ? system('clear') : system('cls');


    echo "\n=====================================: \n";
    echo "===    Sistema de beneficiário    ===: \n";
    echo "=====================================: \n";
}

//Renderiza o menu de cadastro de beneficiário
function render_menu_customer(){
    $menu = "
    1) Cadastrar novo\n
    2) Listar todos cadastrados\n
    3) Preço total do Plano escolhido (soma do preço de cada beneficiário)\n
    ";
    echo $menu;
}

function list_plans( $id = false ){
    $plans = json_decode( file_get_contents('planos.json') );
    if($id){
        foreach( $plans as $key => $value ){
            if( $value->codigo == $id ) return $value;
        }
        return false;
    }else{

        foreach( $plans as $key => $value ){
            echo "\n--------------------------------";
            echo "\nCodigo: " . $value->codigo;
            echo "\nNome do plano: " . $value->nome;
            echo "\nRegistro: " . $value->registro;
        }
    }
}

//Renderiza e executa o input da opções
function render_option_menu(){
    $option = readline('Selecione uma opção:');
    switch ($option) {
        case '1':
            new_customer();
            break;
        case '2':
            list_plans();
            render_menu_customer();
            sleep(1);
            render_option_menu();
            break;
        case '3':
            list_plans();
            get_total_plan();
            break;
        
        default:
            echo "\n opção inválida amigão!! \n";
            sleep(1);
            render_option_menu();
            break;
    }
}
//Insere beneficiario no json
function insert_customer( $data ){
    $customers = json_decode( file_get_contents('beneficiarios.json') );
    $data_to_insert = array();

    if( null == $customers ){
        for ($i=0; $i < count($data); $i++) { 
            $data_to_insert[$i]->nome                = $data->nome;
            $data_to_insert[$i]->idade               = $data->idade;
            $data_to_insert[$i]->codigo_beneficiario = $i;
            $data_to_insert[$i]->codigo_plano        = $data->codigo_plano;
        }
    }else{
        foreach( $customers as $key => $value ) $codigo_max[] = $value->codigo_beneficiario;

        $flag = max( $codigo_max );
        foreach( $data as $key => $value ){
            
            $value->codigo_beneficiario = ++$flag;
            $customers[] = $value;

        }
    }

    $result = file_put_contents( 'beneficiarios.json', json_encode( $customers ) );
    if( is_numeric( $result ) ){
        echo "Novos beneficiarios cadastrados\n Digite para continuar";
        readline();
        app();
    }else{
        return "Aconteceu algo de errado que nao era pra acontecer :s, reinicie a aplicação por gentileza :S";
    }
} 

//Cadastro de novo usuario
function new_customer(){

    echo "=====================================: \n";
    echo "===    Cadastro de beneficiário   ===: \n";
    echo "=====================================: \n";
    
    echo "Quantos beneficiários você quer cadastrar?\n";
    $qnt = readline();

    //Defino o objeto
    $data = array();

    echo "\nCadastrando $qnt beneficiários(s)\n";
    for ( $i = 0; $i < $qnt; $i++ ) { 

        echo "\nDigite o nome do beneficiario\n";
        @$data[$i]->nome = readline();

        echo "\nDigite a idade do beneficiario\n";
        $age = readline();
        age_validate( $age );
        @$data[$i]->idade = readline();

        echo "\nSelecione um plano pelo código:\n";
        list_plans();
        echo "\n";
        do {
            $codigo_plano = readline();
            if( !list_plans( $codigo_plano ) ) echo "\n Plano inválido, selecione outro\n";

        } while ( !list_plans( $codigo_plano ));

        @$data[$i]->codigo_plano = (int)$codigo_plano;
        
    }
    insert_customer( $data );
}

function age_validate( $age ){
    if( $age < 0 || $age > 120 ){
        echo "Idade inválida";
        die();
    }
}

function get_total_plan(){
    echo "\nSelecione qual plano deseja conferir os preços: \n";
    $option = readline();
}
