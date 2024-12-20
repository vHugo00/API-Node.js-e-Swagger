<?php 
$host = 'localhost';
$db = 'u828529475_vacation'; 
$user = 'u828529475_vacation'; 
$pass = 'Mapa#2019@'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados.");
}

$feedback = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
    $profissao = filter_var($_POST['profissao'] ?? '', FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $idade = filter_var($_POST['idade'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $celular = filter_var($_POST['celular'] ?? '', FILTER_SANITIZE_STRING);
    $estado_civil = filter_var($_POST['estado_civil'] ?? '', FILTER_SANITIZE_STRING);
    $cidade = filter_var($_POST['cidade'] ?? '', FILTER_SANITIZE_STRING);
    $faixa_salarial = filter_var($_POST['faixa_salarial'] ?? '', FILTER_SANITIZE_STRING);
    $gostaria_contato = isset($_POST['gostaria_contato']) ? 1 : 0;
    $gostaria_info = isset($_POST['gostaria_info']) ? 1 : 0;

    if (!$email) {
        $feedback = "<div class='alert alert-danger'>Por favor, insira um e-mail válido.</div>";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM formulario WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $feedback = "<div class='alert alert-danger'>Este e-mail já está registrado. Tente usar outro e-mail.</div>";
        } else {
            $sql = "INSERT INTO formulario (nome, profissao, email, idade, celular, estado_civil, cidade, faixa_salarial, gostaria_contato, gostaria_info)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $profissao, $email, $idade, $celular, $estado_civil, $cidade, $faixa_salarial, $gostaria_contato, $gostaria_info]);

            $feedback = "<div class='alert alert-success'>Formulário enviado com sucesso! Obrigado por se cadastrar.</div>";
            
            $to = 'vv001226@gmail.com';
            $subject = 'Novo Formulário Enviado';
            $message = "Nome: $nome\nProfissão: $profissao\nE-mail: $email\nIdade: $idade\nCelular: $celular\nEstado Civil: $estado_civil\nCidade: $cidade\nFaixa Salarial: $faixa_salarial\nGostaria de ser contatado: " . ($gostaria_contato ? 'Sim' : 'Não') . "\nGostaria de receber informações: " . ($gostaria_info ? 'Sim' : 'Não');
            $headers = "From: contato@seusite.com\r\n";
            mail($to, $subject, $message, $headers);
        }
    }
}
?>

<?php get_header(); ?>

<section>
<article id="banner">
            <h1>O melhor de jurema águas quentes</h1><br>
            <h2>nosso clube de férias, o ano todo!</h2>
            <br>
            <a href="">
                <div class="menu">
                    <!-- <img src="<?php echo get_bloginfo('template_url'); ?>/img/menu.png" alt="">Menu -->
                </div>
            </a>
            <a href="#vantagens" class="quero-conhecer">Ver benefícios</a>
            <img src="<?php echo get_bloginfo('template_url'); ?>/img/mouse.png" alt="" class="animated-image">
        </article>
        <div class='iconsMobile'>
          <a href="#form"><img class="img-responsive" src="https://juremavacationclub.com.br/wp-content/uploads/2024/06/formjur.png" alt=""></a>
          <a href="tel:4435738110"><img class="img-responsive" src="https://juremavacationclub.com.br/wp-content/uploads/2024/06/teljur.png" alt=""></a>
          <a href="https://wa.me/5544998970319"><img class="img-responsive" src="https://juremavacationclub.com.br/wp-content/uploads/2024/06/whatsjur.png" alt=""></a>
        </div>
        <article id="clube">
            <div class="container">
              <div class="row" style="justify-content: center;">
                <div class="imgC col-12 col-lg-6">
                    <img class="img-responsive" src="<?php echo get_bloginfo('template_url'); ?>/img/img1.png" alt="">
                </div>
                <div class="textoC col-12 col-lg-4">
                    <h5>O seu clube de férias, o ano inteiro</h5>
                    <p>Chegou o <b>Jurema Vacation Club (JVC)</b>, que vai garantir férias em um dos melhores resorts do Brasil ao mesmo tempo em que abre um leque de opções em todo o mundo.</p>
                    <p>Com águas naturalmente quentes a 42ºC, Jurema Águas Quentes está localizado em meio a 340 hectares de extensas matas e rios. Infraestrutura que conta com área de eventos, quadras, piscinas e spa, além de uma equipe completa de recreação para todas as idades.</p>
                    <p>Faça parte do Jurema Vacation Club e tenha uma experiência exclusiva no maior destino de águas termais do Sul do Brasil.</p>
                </div>
            </div>
            </div>
        </article>
        <article id="funcionamento">
            <div class="container">
                <h2 style="margin-bottom: 65px;">Como funciona o <br> Jurema Vacation Club?</h2>
                <div class="perguntas">
                    <div class="row">
                        <div class="accordion accordion-flush" id="accordionFlushExample1">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                O que é o Jurema Vacation Club e quais as vantagens do Programa?
                                </button>
                              </h2>
                              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample1">
                                <div class="accordion-body">
                                O Jurema Vacation Club é o programa de férias do Complexo Jurema Águas Quentes, desenvolvido de forma muito especial para você.  Nele, você tem a opção de escolher entre quatro produtos em formato de pontuação que serão convertidos em hospedagem, de acordo com o período de sua escolha.<br> 
                                Além da vantagem financeira, cada produto contempla um amplo pacote de benefícios que podem ser utilizados em todas as hospedagens em nossos resorts. Sim, o programa tem uso tanto no Lagos de Jurema como no Jardins de Jurema, você escolhe. <br>
                                Também estará à disposição do cliente Jurema Vacation Club a opção de filiação ao maior clube de intercâmbio, a RCI, com mais de 4.000 resorts em todo o mundo em que o cliente adquire pontos que são convertidos em semanas de hospedagem no próprio hotel-base ou em outros resorts filiados à RCI.
                                </div> 
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Como funciona o uso dos pontos?
                                </button>
                              </h2>
                              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample1">
                                <div class="accordion-body">Ao adquirir o Programa de Férias, o sócio adquire o direito de uso de pontos que são convertidos em semanas de hospedagem, sempre de acordo com a tabela de pontos anexa ao contrato. A pontuação pode variar de acordo com o período de sua viagem, a quantidade de hóspedes e tipo de acomodação.</div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Quando posso começar a utilizar o meu programa de Férias?
                                </button>
                              </h2>
                              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample1">
                                <div class="accordion-body">A utilização do Programa de Férias pode ser feita de imediato, sempre observando a quantidade de pontos liberada pelo valor proporcional pago.</div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                O que é uso proporcional?
                                </button>
                              </h2>
                              <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample1">
                                <div class="accordion-body">É o uso dos pontos mediante o que já foi pago. Enquanto não quitado, seu programa utiliza a pontuação correspondente ao valor pago.</div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                Quando receberei o código de identificação RCI?
                                </button>
                              </h2>
                              <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample1">
                                <div class="accordion-body">A associação à RCI será feita após 45 dias da aquisição. Após este período, será enviado via e-mail o código de associado ID, que dará acesso ao site <a href="https://www.rci.com/pre-rci/br/pt">www.RCI.com</a> </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                O que significa ID (Identification Number)?
                                </button>
                              </h2>
                              <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">ID é o seu número de identificação na RCI. Por meio dele, você poderá consultar a disponibilidade de hotéis no mundo inteiro, realizar reservas e ter acesso a todos os benefícios da RCI.
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                Como faço para depositar minhas semanas no banco de semanas da RCI?
                                </button>
                              </h2>
                              <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                A pontuação que adquiriu sempre ficará no seu hotel-base, neste caso o complexo Jurema Águas Quentes. <br>
                                Para que apareça o saldo de pontos no site RCI, você precisa antes entrar em contato com a Central de Relacionamento com Cliente do seu programa e solicitar a transferência de pontos referente a pelo menos uma semana de hospedagem, para que possa começar a realizar seus intercâmbios!
                               </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                Posso viajar mais de uma vez por ano utilizando meu programa de Férias?
                                </button>
                              </h2>
                              <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Você pode utilizar quantas semanas quiser, desde que a sua pontuação disponível para uso cubra o total de pontos necessários para as reservas, ou seja, o uso proporcional.
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseNine" aria-expanded="false" aria-controls="flush-collapseNine">
                                O que acontece caso não haja disponibilidade de intercâmbio para os destinos que eu escolhi? 
                                </button>
                              </h2>
                              <div id="flush-collapseNine" class="accordion-collapse collapse" aria-labelledby="flush-headingNine" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">O cliente pode colocar o seu nome na lista de espera da RCI. Desse modo, você e sua família terão preferência quando alguma semana for depositada. O sistema da RCI é on-line e ágil, podendo ocorrer a confirmação com rapidez. De qualquer forma, a RCI oferece milhares de outros destinos com possibilidade de confirmação.</div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTen" aria-expanded="false" aria-controls="flush-collapseTen">
                                Quando posso usar minha semana de boas-vindas?
                                </button>
                              </h2>
                              <div id="flush-collapseTen" class="accordion-collapse collapse" aria-labelledby="flush-headingTen" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Após receber seu número de associado (ID) por e-mail, deverá entrar em contato direto com a RCI por telefone ou mesmo se cadastrando no site www.RCI.com e pesquisar destinos por meio de sua semana de boas-vindas. </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingEleven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEleven" aria-expanded="false" aria-controls="flush-collapseEleven">
                                Quando são realizados o check-in e checkout dos hotéis?
                                </button>
                              </h2>
                              <div id="flush-collapseEleven" class="accordion-collapse collapse" aria-labelledby="flush-headingEleven" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">No Complexo Jurema Águas Quentes, o check-in ocorre a partir das 17h e o checkout, às 15h. A hospedagem pode ser realizada pelo período de 7 dias ou fracionada em 3 e 4 dias, sendo um período passando pelo meio de semana e outro pelo final de semana. <br>
                                Em hotéis afiliados à RCI, os dias de check-in e checkout são variáveis de acordo com o estabelecimento, e podem ser verificados no site <a href="https://www.rci.com/pre-rci/br/pt" style="color:mediumvioletred">www.RCI.com</a> </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="flush-headingTweven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTweven" aria-expanded="false" aria-controls="flush-collapseTweven">
                                Tenho que utilizar meus pontos todos os anos?
                                </button>
                              </h2>
                              <div id="flush-collapseTweven" class="accordion-collapse collapse" aria-labelledby="flush-headingTweven" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">O objetivo do Programa de Férias é incentivar você e sua família a viajar pelo menos uma vez por ano, evitando que ocorra a perda de pontos por não utilização. Para cada semana em aberto, o cliente tem até dois anos para efetuar a hospedagem. </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <article id="clube">
           <div class="container">
            <div class="row reverse" style="justify-content: center;">
              <div id="vantagens" class="textoC col-12 col-lg-4">
                  <h5>As suas vantagens não param no JVC</h5>
                  <p>Além da vantagem financeira , cada produto contempla um amplo pacote de benefícios que podem ser utilizados em todas as hospedagens em nossos resorts. <br>Sim, o programa tem uso tanto no Lagos de Jurema como no Jardins de Jurema, você escolhe.</p>
                  <p>Também estará à disposição do Cliente Jurema Vacation Club a opção de filiação ao maior clube de intercâmbio, a RCI, com mais de 4.000 resorts em que o cliente adquire pontos que são convertidos em semanas de hospedagem no próprio hotel-base ou em outros resorts filiados à RCI em todo o mundo.</p> <br>
              </div> 
              <div class="imgC col-12 col-lg-6">
                <img class="img-responsive" src="<?php echo get_bloginfo('template_url'); ?>/img/img2.png" alt="">
              </div>
            </div>
            <img class="img-responsive icomobile" src="https://juremavacationclub.com.br/wp-content/uploads/2024/06/iconsjur.png" alt="">
           </div>
        </article>

    <article id="form">
        <div class="container">
            <h2 class="text-center">QUERO CONHECER O<br> JUREMA VACATION CLUB</h2>

            <!-- Mensagem de Feedback -->
            <?php if (!empty($feedback)) echo $feedback; ?>

            <form method="POST">
                <div class="row">
                    <div class="col-12">
                        <label for="nome">Nome Completo</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label for="profissao">Profissão</label>
                        <input type="text" name="profissao" id="profissao" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-4">
                        <label for="idade">Idade</label>
                        <input type="number" name="idade" id="idade" class="form-control">
                    </div>
                    <div class="col-8">
                        <label for="celular">Celular</label>
                        <input type="text" name="celular" id="celular" class="form-control">
                    </div>
                    <div class="col-4">
                        <label for="estado_civil">Estado Civil</label>
                        <select name="estado_civil" id="estado_civil" class="form-control">
                            <option value="selecione">Selecione</option>
                            <option value="solteiro(a)">Solteiro(a)</option>
                            <option value="casado(a)">Casado(a)</option>
                            <option value="divorciado(a)">Divorciado(a)</option>
                            <option value="viúvo(a)">Viúvo(a)</option>
                            <option value="separado(a)">Separado(a)</option>
                        </select>
                    </div>
                    <div class="col-8">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control">
                    </div>
                    <div class="col-12">
                        <label for="faixa_salarial">Faixa Salarial</label>
                        <select name="faixa_salarial" id="faixa_salarial" class="form-control">
                            <option value="selecione">Selecione</option>
                            <option value="Até R$ 5 mil reais">Até R$ 5 mil reais</option>
                            <option value="Entre R$ 5 e 10 mil reais">Entre R$ 5 e 10 mil reais</option>
                            <option value="Entre R$ 11 e 15 mil reais">Entre R$ 11 e 15 mil reais</option>
                            <option value="Mais de R$ 15 mil reais">Mais de R$ 15 mil reais</option>
                        </select>
                    </div>
                    <div class="col-12 checkbox">
                        <label><input type="checkbox" name="gostaria_contato"> Gostaria de ser contatado por nossa equipe?</label>
                    </div>
                    <div class="col-12 checkbox">
                        <label><input type="checkbox" name="gostaria_info"> Gostaria de receber informações sobre nosso programa?</label>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">ENVIAR</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="texts">
                  <img class="img-responsive" src="<?php echo get_bloginfo('template_url'); ?>/img/logo.png">
                  <p>Jurema Vacation Club</p>
                  <p><a href="tel:4435738110"  style="text-decoration: none; color: #fff;">+55 (44) 3573 8110</a>  | <a href="https://wa.me/5544998970319" style="text-decoration: none; color: #fff;">+55 (44) 9 9897-0319</a></p>
                  <p>atendimento.jvc@juremaaguasquentes.com.br</p>
                </div>
    
                <!-- <div class="socials">
                  <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                  <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@juremaaguasquentes?_t=8aHdt1rxzhG&_r=1"><i class="fa-brands fa-tiktok"></i></a>
                  <a href=""><img src="<?php echo get_bloginfo('template_url'); ?>/img/trip.png" alt=""></a>
                </div> -->
              </div>
            </article>
            <article id="footer" class="text-center" style=" margin-top: -150px;">
              <img class="img-responsive" src="<?php echo get_bloginfo('template_url'); ?>/img/logos.png" alt="">
            </article>
    </article>

    

</section>

<?php get_footer(); ?>
