<?php
$contador = 0;
$exibiuJogo = false;

while ($busca && ($jogo = pg_fetch_assoc($busca))) {
    $wide = ($contador % 5 === 0);
    $pasta = "imgJogos/" . $jogo["nome"];

    $imagem = $wide
        ? localizarImagem($pasta, "banner1")
        : localizarImagem($pasta, "capa");

    if ($imagem === null) {
        continue;
    }

    $exibiuJogo = true;
    $contador++;
    ?>

    <a href="detalhes.php?id=<?= (int)$jogo["cod"] ?>" class="card-link">
        <article class="card <?= $wide ? "card--wide" : "" ?>">
            <img
                src="<?= htmlspecialchars($imagem, ENT_QUOTES, "UTF-8") ?>"
                alt="<?= htmlspecialchars($jogo["nome"], ENT_QUOTES, "UTF-8") ?>"
                loading="lazy">

            <div class="card-info">
                <div class="card-topo">
                    <h3><?= htmlspecialchars($jogo["nome"], ENT_QUOTES, "UTF-8") ?></h3>
                    <span>
                        <img src="./svg/starYellow.svg" alt="">
                        <?= number_format((float)$jogo["nota"], 1) ?>
                    </span>
                </div>

                <div class="DataProd">
                    <p><?= htmlspecialchars($jogo["produtora"], ENT_QUOTES, "UTF-8") ?></p>
                    <p>
                        <span data-i18n-database="genre">
                            <?= htmlspecialchars($jogo["genero"], ENT_QUOTES, "UTF-8") ?>
                        </span>
                    </p>
                </div>
            </div>
        </article>
    </a>

<?php
}

if (!$exibiuJogo):
    ?>
    <p class="catalogo-vazio" data-i18n="catalog.noResults">
        Nenhum jogo encontrado com esses filtros.
    </p>
<?php endif; ?>
