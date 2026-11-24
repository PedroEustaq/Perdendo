<?php
require_once "includes/banco.php";
require_once "includes/login.php";

$isAjax = isset($_GET["ajax"]) && $_GET["ajax"] === "1";

if (!$isAjax) {
    $listaGeneros = pg_query($conn, "
        SELECT cod, genero
        FROM generos
        ORDER BY genero
    ");

    $listaProdutoras = pg_query($conn, "
        SELECT cod, produtora
        FROM produtoras
        ORDER BY produtora
    ");
}

function obterParametroTexto($nome, $padrao = "")
{
    $valor = $_GET[$nome] ?? $padrao;
    return is_string($valor) ? trim($valor) : $padrao;
}

$pesquisa = obterParametroTexto("pesquisa");
$notaInput = obterParametroTexto("nota");
$produtoraInput = obterParametroTexto("produtora");
$generoInput = obterParametroTexto("genero");

$notaValor = is_numeric($notaInput)
    ? max(0, min(10, (float)$notaInput))
    : 0;

$produtora = ctype_digit($produtoraInput) ? (int)$produtoraInput : 0;
$genero = ctype_digit($generoInput) ? (int)$generoInput : 0;

$sql = "
    SELECT
        j.cod,
        j.nome,
        j.nota,
        g.genero,
        p.produtora,
        j.plataforma
    FROM jogos j
    JOIN generos g ON g.cod = j.genero
    JOIN produtoras p ON p.cod = j.produtora
    WHERE 1 = 1
";

$parametros = [];

if ($pesquisa !== "") {
    $parametros[] = "%" . $pesquisa . "%";
    $sql .= " AND j.nome ILIKE $" . count($parametros);
}

if ($notaValor > 0) {
    $parametros[] = $notaValor;
    $sql .= " AND j.nota >= $" . count($parametros);
}

if ($produtora > 0) {
    $parametros[] = $produtora;
    $sql .= " AND j.produtora = $" . count($parametros);
}

if ($genero > 0) {
    $parametros[] = $genero;
    $sql .= " AND j.genero = $" . count($parametros);
}

$sql .= " ORDER BY j.nome";

$busca = pg_query_params($conn, $sql, $parametros);

if (!$busca) {
    error_log("Falha ao consultar catálogo: " . pg_last_error($conn));

    if ($isAjax) {
        http_response_code(500);
        header("Content-Type: text/html; charset=UTF-8");
        echo '<p class="catalogo-erro" data-i18n="catalog.errorLoading">Não foi possível atualizar o catálogo. Tente novamente.</p>';
        exit;
    }
}

function localizarImagem($pasta, $nomeArquivo)
{
    $extensoes = ["png", "jpg", "jpeg", "webp", "avif", "gif"];

    foreach ($extensoes as $extensao) {
        $arquivo = $pasta . "/" . $nomeArquivo . "." . $extensao;

        if (is_file($arquivo)) {
            return $arquivo;
        }
    }

    return null;
}

if ($isAjax) {
    header("Content-Type: text/html; charset=UTF-8");
    header("Cache-Control: no-store, no-cache, must-revalidate");

    require __DIR__ . "/market-cards.php";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title data-i18n="page.catalogTitle">Catálogo | Perdendo</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cabecalho.css">
    <link rel="stylesheet" href="market.css">

    <meta name="description" content="Descubra os melhores jogos para PC, PlayStation, Xbox e Nintendo. Explore lançamentos, promoções, avaliações e encontre seu próximo game favorito." data-i18n-content="page.description">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <?php require_once "cabecalho.php"; ?>

    <main class="Market">

        <aside class="filtros">
            <h2 data-i18n="catalog.filters">Filtros</h2>

            <form id="formFiltros" method="GET" action="market.php">
                <div class="campoBusca">
                    <button type="submit" class="campoBusca__botao" aria-label="Pesquisar jogos">
                        <img src="svg/LoopaCinza.svg" alt="">
                    </button>

                    <input
                        id="pesquisa"
                        type="search"
                        name="pesquisa"
                        aria-label="Pesquisar jogos"
                        placeholder="Pesquisar jogo..."
                        data-i18n-placeholder="catalog.searchPlaceholder"
                        autocomplete="off"
                        value="<?= htmlspecialchars($pesquisa, ENT_QUOTES, "UTF-8") ?>">
                </div>

                <h3 data-i18n="catalog.minimumRating">Nota mínima</h3>

                <input
                    type="range"
                    id="nota"
                    name="nota"
                    min="0"
                    max="10"
                    step="0.1"
                    value="<?= htmlspecialchars((string)$notaValor, ENT_QUOTES, "UTF-8") ?>">

                <p class="valorNota">
                    <img src="svg/starYellow.svg" alt="">
                    <span id="notaValor"><?= htmlspecialchars((string)$notaValor, ENT_QUOTES, "UTF-8") ?></span>
                </p>

                <h3 data-i18n="catalog.publisher">Produtora</h3>

                <select name="produtora">
                    <option value="" data-i18n="common.allFemale">Todas</option>

                    <?php if ($listaProdutoras): ?>
                        <?php while ($p = pg_fetch_assoc($listaProdutoras)): ?>
                            <option
                                value="<?= (int)$p["cod"] ?>"
                                <?= $produtora === (int)$p["cod"] ? "selected" : "" ?>>
                                <?= htmlspecialchars($p["produtora"], ENT_QUOTES, "UTF-8") ?>
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>

                <h3 data-i18n="catalog.genre">Gênero</h3>

                <select name="genero">
                    <option value="" data-i18n="common.allMale">Todos</option>

                    <?php if ($listaGeneros): ?>
                        <?php while ($g = pg_fetch_assoc($listaGeneros)): ?>
                            <option
                                value="<?= (int)$g["cod"] ?>"
                                data-i18n-database="genre"
                                <?= $genero === (int)$g["cod"] ? "selected" : "" ?>>
                                <?= htmlspecialchars($g["genero"], ENT_QUOTES, "UTF-8") ?>
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </form>
        </aside>

        <section
            class="catalogo"
            id="listaJogos"
            aria-live="polite"
            aria-busy="false">

            <?php if ($busca): ?>
                <?php require __DIR__ . "/market-cards.php"; ?>
            <?php else: ?>
                <p class="catalogo-erro" data-i18n="catalog.errorLoading">Não foi possível carregar o catálogo. Tente novamente.</p>
            <?php endif; ?>

        </section>

    </main>

    <?php require_once "rodape.php"; ?>

    <script src="script.js"></script>
    <script>
        (() => {
            "use strict";

            const formFiltros = document.getElementById("formFiltros");
            const formCabecalho = document.getElementById("buscaCabecalho");
            const campoLateral = document.getElementById("pesquisa");
            const campoTopo = document.getElementById("buscaCabecalhoInput");
            const catalogo = document.getElementById("listaJogos");
            const slider = document.getElementById("nota");
            const notaValor = document.getElementById("notaValor");

            if (!formFiltros || !formCabecalho || !campoLateral || !campoTopo || !catalogo) {
                return;
            }

            let temporizadorBusca = null;
            let controllerBusca = null;
            let numeroRequisicao = 0;

            function sincronizarPesquisa(origem) {
                const valor = origem.value;
                campoLateral.value = valor;
                campoTopo.value = valor;
            }

            function atualizarEndereco(parametros) {
                const endereco = new URL(window.location.href);
                endereco.search = parametros.toString();
                endereco.searchParams.delete("ajax");

                window.history.replaceState({}, "", endereco.pathname + endereco.search + endereco.hash);
            }

            async function atualizarCatalogo() {
                if (controllerBusca) {
                    controllerBusca.abort();
                }

                controllerBusca = new AbortController();
                const controllerAtual = controllerBusca;
                const requisicaoAtual = ++numeroRequisicao;
                const parametros = new URLSearchParams(new FormData(formFiltros));

                catalogo.setAttribute("aria-busy", "true");

                const enderecoAjax = new URL(window.location.href);
                enderecoAjax.search = parametros.toString();
                enderecoAjax.searchParams.set("ajax", "1");

                try {
                    const resposta = await fetch(enderecoAjax.toString(), {
                        method: "GET",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        cache: "no-store",
                        signal: controllerAtual.signal
                    });

                    if (!resposta.ok) {
                        throw new Error("A consulta do catálogo falhou.");
                    }

                    const html = await resposta.text();

                    if (requisicaoAtual !== numeroRequisicao) {
                        return;
                    }

                    catalogo.innerHTML = html;
                    atualizarEndereco(parametros);

                    if (typeof window.perdendoApplyLanguage === "function") {
                        window.perdendoApplyLanguage();
                    }
                } catch (erro) {
                    if (erro.name !== "AbortError" && requisicaoAtual === numeroRequisicao) {
                        console.error("Erro ao atualizar catálogo:", erro);
                        catalogo.innerHTML = '<p class="catalogo-erro" data-i18n="catalog.errorLoading">Não foi possível atualizar o catálogo. Tente novamente.</p>';

                        if (typeof window.perdendoApplyLanguage === "function") {
                            window.perdendoApplyLanguage();
                        }
                    }
                } finally {
                    if (requisicaoAtual === numeroRequisicao) {
                        catalogo.setAttribute("aria-busy", "false");
                    }
                }
            }

            function agendarAtualizacao(imediata = false) {
                window.clearTimeout(temporizadorBusca);

                if (imediata) {
                    atualizarCatalogo();
                    return;
                }

                temporizadorBusca = window.setTimeout(atualizarCatalogo, 350);
            }

            campoLateral.addEventListener("input", () => {
                sincronizarPesquisa(campoLateral);
                agendarAtualizacao();
            });

            campoTopo.addEventListener("input", () => {
                sincronizarPesquisa(campoTopo);
                agendarAtualizacao();
            });

            formCabecalho.addEventListener("submit", (evento) => {
                evento.preventDefault();
                sincronizarPesquisa(campoTopo);
                agendarAtualizacao(true);
            });

            formFiltros.addEventListener("submit", (evento) => {
                evento.preventDefault();
                sincronizarPesquisa(campoLateral);
                agendarAtualizacao(true);
            });

            formFiltros.querySelectorAll("select").forEach((select) => {
                select.addEventListener("change", () => agendarAtualizacao(true));
            });

            if (slider && notaValor) {
                slider.addEventListener("input", () => {
                    notaValor.textContent = Number(slider.value).toFixed(1).replace(".0", "");
                    agendarAtualizacao();
                });
            }
        })();
    </script>
</body>

</html>
