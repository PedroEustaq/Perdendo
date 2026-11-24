<?php


require_once "includes/funcoes.php";
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

        <div class="pesquisa">

            <img src="svg/LoopaCinza.svg" alt="">

            <input type="text" placeholder="Pesquisar" data-i18n-placeholder="search.placeholder">

        </div>

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