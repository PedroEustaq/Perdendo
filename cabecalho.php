<?php
require_once "includes/funcoes.php";

$buscaCabecalho = (
    basename($_SERVER["SCRIPT_NAME"] ?? "") === "market.php"
    && isset($_GET["pesquisa"])
    && is_string($_GET["pesquisa"])
) ? $_GET["pesquisa"] : "";
?>

<header class="cabecalho">

    <div class="menu-esquerda">

        <div class="logo">
            <img src="imgDeco/PERDENDOLogo.webp" alt="">
        </div>

        <a href="index.php">
            <img src="svg/HomeVermelho.svg" alt="">
            <span data-i18n="nav.home">Central</span>
        </a>

        <a href="market.php">
            <img src="svg/BagVermelha.svg" alt="">
            <span data-i18n="nav.catalog">Catálogo</span>
        </a>

    </div>

    <div class="Direito">

        <form class="pesquisa" id="buscaCabecalho" action="market.php" method="GET" role="search">

            <button type="submit" class="pesquisa__botao" aria-label="Pesquisar" title="Pesquisar">
                <img src="svg/LoopaCinza.svg" alt="">
            </button>

            <input
                id="buscaCabecalhoInput"
                type="search"
                name="pesquisa"
                placeholder="Pesquisar"
                data-i18n-placeholder="search.placeholder"
                autocomplete="off"
                value="<?= htmlspecialchars($buscaCabecalho, ENT_QUOTES, "UTF-8") ?>">

        </form>

        <div class="login">

            <img src="svg/ContaIcone.svg" alt="User Icon">

            <?php if (logado()) { ?>

                <div class="usuario-logado">

                    <strong><?= htmlspecialchars($_SESSION["nome"]) ?></strong><br>

                    <small>
                        <?= admin() ? '<span data-i18n="user.admin">Administrador</span>' : '<span data-i18n="user.standard">Usuário</span>' ?>
                    </small>

                </div>

                <a href="user-edit.php">
                    <span data-i18n="user.myDetails">Meus Dados</span>
                </a>

                <?php if (admin()) { ?>

                    <a href="user-new.php">
                        <span data-i18n="user.register">Registrar Usuário</span>
                    </a>

                <?php } ?>

                <a href="user-logout.php">
                    <span data-i18n="user.logout">Sair</span>
                </a>

            <?php } else { ?>

                <a href="user-login.php">
                    <span data-i18n="user.login">Iniciar Sessão</span>
                </a>

            <?php } ?>

        </div>

        <button type="button" class="idioma-toggle" id="idiomaToggle" aria-label="Mudar para inglês">
            <span class="idioma-toggle__code" aria-hidden="true">EN</span>
            <span class="idioma-toggle__text">English</span>
        </button>
    </div>
</header>
<script src="i18n.js" defer></script>
