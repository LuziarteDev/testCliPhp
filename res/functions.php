<?php 

function render_header(){
    printf(" %s ", base64_decode('ICAgICAgICAgICAgICAgICAgICAgIC5fX19fX19fX19fXy4gX19fX19fXyAgICAgX19fX19fXy5fX19fX19fX19fXy4gX19fX19fXyAKfCAgICAgICAgICAgfHwgICBfX19ffCAgIC8gICAgICAgfCAgICAgICAgICAgfHwgICBfX19ffApgLS0tfCAgfC0tLS1gfCAgfF9fICAgICB8ICAgKC0tLS1gLS0tfCAgfC0tLS1gfCAgfF9fICAgCiAgICB8ICB8ICAgICB8ICAgX198ICAgICBcICAgXCAgICAgICB8ICB8ICAgICB8ICAgX198ICAKICAgIHwgIHwgICAgIHwgIHxfX19fLi0tLS0pICAgfCAgICAgIHwgIHwgICAgIHwgIHxfX19fIAogICAgfF9ffCAgICAgfF9fX19fX198X19fX19fXy8gICAgICAgfF9ffCAgICAgfF9fX19fX198CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgIC5fX19fX18gICAgICAgICAgX19fICAgICAgIF9fICAgX19fX19fX18gIAogICAgICAgfCAgIF8gIFwgICAgICAgIC8gICBcICAgICB8ICB8IHwgICAgICAgLyAgCiAgICAgICB8ICB8XykgIHwgICAgICAvICBeICBcICAgIHwgIHwgYC0tLS8gIC8gICAKICAgICAgIHwgICAgICAvICAgICAgLyAgL19cICBcICAgfCAgfCAgICAvICAvICAgIAogICAgICAgfCAgfFwgIFwtLS0tLi8gIF9fX19fICBcICB8ICB8ICAgLyAgLy0tLS0uCiAgICAgICB8IF98IGAuX19fX18vX18vICAgICBcX19cIHxfX3wgIC9fX19fX19fX3wKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIA==') );
    sleep(2);

    for ($i=3; $i > 0; $i--) { 

        printf("\nIniciando Sistema em %s ", $i);
        sleep(1);

    }

    ( 'Linux' == PHP_OS) ? system('clear') : system('clear');


    echo "=====================================: \n";
    echo "===    Sistema de beneficiário    ===: \n";
    echo "=====================================: \n";
}

//Renderiza o menu de cadastro de beneficiário
function render_menu_costumer(){
    $menu = "
    1) Cadastrar novo\n
    2) Listar todos cadastrados\n
    3) Pesquisar por nome ou por código\n
    ";
    echo $menu;
}

function list_plans( $id ){
    $plans = json_decode( file_get_contents('planos.json') );
    if( !empty($id) ){
        foreach( $plans as $key => $value ){
            if( $value->codigo == $id ) return $value;
        }
        return 'Not found';
    }else{
        return $plans;
    }
}

//Renderiza e executa o input da opções
function render_option_menu(){
    $option = readline('Selecione uma opção:');
    switch ($option) {
        case '1':
            new_costumer();
            break;
        case '2':
            # code...
            break;
        case '3':
            # code...
            break;
        
        default:
            echo "\n opção inválida amigão!! \n";
            sleep(1);
            render_option_menu();
            break;
    }
}

//Cadastro de novo usuario
function new_costumer(){

    echo "=====================================: \n";
    echo "===    Cadastro de beneficiário   ===: \n";
    echo "=====================================: \n";
    
    echo "Quantos beneficiários você quer cadastrar?\n";
    list_plans();
    $qnt = readline();

    for ( $i = 0; $i < $qnt; $i++ ) { 

    }

}