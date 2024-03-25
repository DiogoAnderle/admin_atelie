<?php

class ControllerUsuarios
{
    /* ********************************* 
                Fazer Login
    ********************************* */
    public static function ctrLoginUsuario()
    {
        $dadosTemp = @array(
            "usuarioLogin" => $_POST["usuario"],
            "senhaLogin" => $_POST["senha"],
        );
        if (isset ($_POST["usuario"])) {
            $hash_cripted = '$6$rounds=1000000$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/';

            $encriptar = crypt($_POST["senha"], $hash_cripted);

            if (
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['usuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['senha'])
            ) {

                $tabela = "usuarios";
                $item = "usuario";
                $valor = $_POST["usuario"];

                $resposta = ModeloUsuarios::MdlMostrarUsuarios($tabela, $item, $valor);

                if (
                    @$resposta["usuario"] == $_POST['usuario'] &&
                    @$resposta["senha"] == $encriptar
                ) {
                    if ($resposta["estado"] == 1) {
                        $_SESSION["initSession"] = "ok";
                        $_SESSION["id"] = $resposta["id"];
                        $_SESSION["nome"] = $resposta["nome"];
                        $_SESSION["usuario"] = $resposta["usuario"];
                        $_SESSION["imagem"] = $resposta["imagem"];
                        $_SESSION["perfil"] = $resposta["perfil"];

                        date_default_timezone_set("America/Sao_Paulo");

                        $data = date('Y-m-d');
                        $hora = date('H:m:s');

                        $dataAtual = $data . ' ' . $hora;

                        $item1 = "ultimo_login";
                        $valor1 = $dataAtual;
                        $item2 = "id";
                        $valor2 = $resposta['id'];

                        $ultimoLogin = ModeloUsuarios::mdlAtualizarUsuario($tabela, $item1, $valor1, $item2, $valor2);

                        if ($ultimoLogin == 'ok') {
                            echo '
                            <script>
                                window.location = "inicio"
                            </script>';
                        }

                    } else {
                        "echo <br><div class='alert alert-danger text-center m-3'>Usuário inativo, entre em contato com o administrador do sistema</div>
                        <script>
                        let usuario = document.getElementById('usuario');
                        let senha = document.getElementById('senha');
                         senhaLogin.type = 'text'

                        usuarioLogin.value = " . "\"" . ($dadosTemp['usuarioLogin']) . "\"" . "
                        senhaLogin.value = " . "\"" . ($dadosTemp['senhaLogin']) . "\"" . "
                        senhaLogin.type = 'password'
                    </script>";
                    }

                } else {
                    echo "<br>
                    
                    <div class='alert alert-danger text-center m-3'>
                        Login ou senha inválidos, tente novamente
                    </div>
                    <script>
                        let usuarioLogin = document.getElementById('usuarioLogin');
                        let senhaLogin = document.getElementById('senhaLogin');
                         senhaLogin.type = 'text'

                        usuarioLogin.value = " . "\"" . ($dadosTemp['usuarioLogin']) . "\"" . "
                        senhaLogin.value = " . "\"" . ($dadosTemp['senhaLogin']) . "\"" . "
                        senhaLogin.type = 'password'
                    </script>
                    ";
                }
            }
        }
    }

    /* ********************************* 
                Salvar Usuário
    ********************************* */
    public static function ctrCriarUsuario()
    {
        $dadosTemp = @array(
            "nome" => $_POST["nome"],
            "usuario" => $_POST["usuario"],
            "senha" => $_POST["senha"],
            "perfil" => $_POST["perfil"],
        );

        if (isset ($_POST["usuario"])) {

            if (
                $_POST['nome'] &&
                preg_match('/^[a-zyA-ZY0-9]+$/', $_POST['usuario']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['senha']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['perfil'])
            ) {

                /* *****************************
                 * validar imagem
                 **************************** */
                $rota = 'views/img/usuarios/user-default.png';


                if (isset ($_FILES["novaImagem"]["tmp_name"]) && $_FILES["novaImagem"]["tmp_name"] != "") {

                    list($largura, $altura) = getimagesize($_FILES["novaImagem"]["tmp_name"]);

                    $novaLargura = 500;
                    $novaAltura = 500;

                    /* *****************************
                     * criar diretório para salvar a imagem do usuário
                     **************************** */

                    $diretorio = "views/img/usuarios/" . $_POST['usuario'];

                    mkdir($diretorio, 0755);
                    /* *****************************
                     * de acordo com o tipo da imagem, aplicamos com as funções padrões do php
                     **************************** */

                    if ($_FILES["novaImagem"]["type"] == "image/jpg" || $_FILES["novaImagem"]["type"] == "image/jpeg") {
                        /* *****************************
                         * guardar a imagem no diretório
                         **************************** */

                        $rota = "views/img/usuarios/" . $_POST['usuario'] . "/" . $_POST['usuario'] . ".jpg";

                        $origem = imagecreatefromjpeg($_FILES["novaImagem"]["tmp_name"]);

                        $destino = imagecreatetruecolor($novaLargura, $novaAltura);

                        imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

                        imagejpeg($destino, $rota);

                    }
                    if ($_FILES["novaImagem"]["type"] == "image/png") {
                        /* *****************************
                         * guardar a imagem no diretório
                         **************************** */

                        $rota = "views/img/usuarios/" . $_POST['usuario'] . "/" . $_POST['usuario'] . ".png";

                        $origem = imagecreatefrompng($_FILES["novaImagem"]["tmp_name"]);

                        $destino = imagecreatetruecolor($novaLargura, $novaAltura);

                        imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

                        imagepng($destino, $rota);

                    }
                }

                $tabela = "usuarios";

                $hash_cripted = '$6$rounds=1000000$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/';

                $encriptar = crypt($_POST["senha"], $hash_cripted);

                $dados = array(
                    "nome" => $_POST["nome"],
                    "usuario" => $_POST["usuario"],
                    "senha" => $encriptar,
                    "perfil" => $_POST["perfil"],
                    "imagem" => $rota,
                );
                $resposta = ModeloUsuarios::mdlCriarUsuario($tabela, $dados);
                if ($resposta == "ok") {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Usuário incluído com sucesso.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location = 'usuarios';}
                    });
           
                    </script>";
                }

            } else {
                echo "
                    <script>

                        let nome = document.getElementById('nome');
                        let usuario = document.getElementById('usuario');
                        let senha = document.getElementById('senha');
                        let perfil = document.getElementById('perfil');
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Ops! Algo deu errado!',
                            text: 'Campos Obrigatórios não informados.',
                            confirmButtonText: 'Fechar',

                        }).then((result) => {
                            if(result.value){
                                let btnCadastrarUsuario = document.getElementById('btnCadastrarUsuario');
                                btnCadastrarUsuario.click();
                                mensagem = '';
                            }
                        })

                        senha.type = 'text'

                        nome.value = " . "\"" . ($dadosTemp['nome']) . "\"" . "
                        usuario.value = " . "\"" . ($dadosTemp['usuario']) . "\"" . "
                        senha.value = " . "\"" . ($dadosTemp['senha']) . "\"" . "
                        perfil.value = " . "\"" . ($dadosTemp['perfil']) . "\"" . "
                        perfil.text = " . "\"" . ($dadosTemp['perfil']) . "\"" . "

                        senha.type = 'password'

                        if(nome.value == ''){
                            nome.classList.toggle('vermelho')
                        }
                        if(usuario.value == ''){
                            usuario.classList.toggle('vermelho')
                        }
                        if(senha.value == ''){
                            senha.classList.toggle('vermelho')
                        }
                        if(perfil.value == ''){
                            perfil.classList.toggle('vermelho')
                            perfil.text = '-- Selecione um perfil --'
                        }

                    </script>";
            }
        }
    }

    /* ********************************* 
            Mostrar Usuário
    ********************************* */
    public static function crtMostrarUsuarios($item, $valor)
    {
        $tabela = "usuarios";

        $resposta = ModeloUsuarios::mdlMostrarUsuarios($tabela, $item, $valor);

        return $resposta;
    }

    /* ********************************* 
                Editar Usuário
    ********************************* */
    public static function ctrEditarUsuario()
    {
        if (isset ($_POST["editarUsuario"])) {

            if ($_POST['editarNome']) {


                /* *****************************
                 * validar imagem
                 **************************** */
                $rota = $_POST['imagemAtual'];

                if (isset ($_FILES["editarImagem"]["tmp_name"]) && !empty ($_FILES["editarImagem"]["tmp_name"])) {


                    list($largura, $altura) = getimagesize($_FILES["editarImagem"]["tmp_name"]);

                    $novaLargura = 500;
                    $novaAltura = 500;

                    /* *****************************
                     * criar diretório para salvar a imagem do usuário
                     **************************** */

                    $diretorio = "views/img/usuarios/" . $_POST['editarUsuario'];


                    /* *****************************
                     * Verificar se já existe uma imagem na base de dados
                     **************************** */
                    if (!empty ($_POST['imagemAtual'])) {

                        unlink($_POST['imagemAtual']);

                    } else {
                        mkdir($diretorio, 0755);

                    }

                    /* *****************************
                     * de acordo com o tipo da imagem, aplicamos com as funções padrões do php
                     **************************** */

                    if ($_FILES["editarImagem"]["type"] == "image/jpeg") {
                        /* *****************************
                         * guardar a imagem no diretório
                         **************************** */

                        $rota = "views/img/usuarios/" . $_POST['editarUsuario'] . "/" . $_POST['editarUsuario'] . ".jpg";

                        $origem = imagecreatefromjpeg($_FILES["editarImagem"]["tmp_name"]);

                        $destino = imagecreatetruecolor($novaLargura, $novaAltura);

                        imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

                        imagejpeg($destino, $rota);

                    }
                    if ($_FILES["editarImagem"]["type"] == "image/png") {
                        /* *****************************
                         * guardar a imagem no diretório
                         **************************** */
                        $rota = "views/img/usuarios/" . $_POST['editarUsuario'] . "/" . $_POST['editarUsuario'] . ".png";

                        $origem = imagecreatefrompng($_FILES["editarImagem"]["tmp_name"]);

                        $destino = imagecreatetruecolor($novaLargura, $novaAltura);

                        imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

                        imagepng($destino, $rota);

                    }
                }

                $tabela = "usuarios";



                if ($_POST['editarSenha']) {
                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['editarSenha'])) {

                        $encriptar = crypt($_POST["editarSenha"], '$6$rounds=1000000$NJy4rIPjpOaU$0ACEYGg/aKCY3v8O8AfyiO7CTfZQ8/W231Qfh2tRLmfdvFD6XfHk12u6hMr9cYIA4hnpjLNSTRtUwYr9km9Ij/');

                    } else {
                        echo "<script>

                        Swal.fire({
                            icon: 'error',
                            title: 'Algo deu errado!',
                            text: 'Senha não pode estar vazia ou conter caracteres especiais.',
                            confirmButtonText: 'Fechar',

                        }).then((result) => {
                            if(result.value){
                                window.location = 'usuarios';}
                        });
                    
                        </script>";
                    }

                } else {
                    $encriptar = $_POST['senhaAtual'];
                }

                $dados = array(
                    "nome" => $_POST["editarNome"],
                    "usuario" => $_POST["editarUsuario"],
                    "senha" => $encriptar,
                    "perfil" => $_POST["editarPerfil"],
                    "imagem" => $rota,
                );

                $resposta = ModeloUsuarios::mdlEditarUsuario($tabela, $dados);

                if ($resposta == "ok") {
                    echo "<script>

                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Usuário atualizado com sucesso.',
                    }).then((result) => {
                        if(result.value){
                            window.location = 'usuarios';
                             
                        }
                    });
                   
                
                    </script>";
                }
            } else {
                echo "<script>

                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado!',
                        text: 'Usuário não pode ser vazio ou conter caracteres especiais.',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'usuarios';
                            
                        }
                    });
                
                    </script>";
            }
        }
    }

    /* ********************************* 
                Excluir Usuário
    ********************************* */

    public static function ctrExcluirUsuario()
    {

        if (isset ($_GET["idUsuario"])) {
            $tabela = 'usuarios';
            $dados = $_GET["idUsuario"];

            if ($_GET["imagemUsuario"] != "") {
                unlink($_GET["imagemUsuario"]);
                rmdir("views/img/usuarios/" . $_GET['usuario']);
            }

            $resposta = ModeloUsuarios::mdlExcluirUsuario($tabela, $dados);

            if ($resposta == "ok") {
                echo "<script>

                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Usuário excluído com sucesso.',
                    showConfirmButton: 'false',
                }).then((result) => {
                    if(result.value){
                        window.location = 'usuarios';}
                });
            
                </>";
            }
        }
    }
}