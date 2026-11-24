(() => {
    "use strict";

    const STORAGE_KEY = "perdendo-language";

    const translations = {
        pt: {
            "language.toEnglish": "English",
            "language.toPortuguese": "Português",
            "language.switchToEnglish": "Mudar para inglês",
            "language.switchToPortuguese": "Mudar para português",

            "nav.home": "Central",
            "nav.catalog": "Catálogo",
            "search.placeholder": "Pesquisar",
            "user.admin": "Administrador",
            "user.standard": "Usuário",
            "user.myDetails": "Meus Dados",
            "user.register": "Registrar Usuário",
            "user.logout": "Sair",
            "user.login": "Iniciar Sessão",

            "page.homeTitle": "Central | Perdendo",
            "page.catalogTitle": "Catálogo | Perdendo",
            "page.loginTitle": "Login | Perdendo",
            "page.newUserTitle": "Novo usuário | Perdendo",
            "page.editUserTitle": "Meus dados | Perdendo",
            "page.description": "Descubra os melhores jogos para PC, PlayStation, Xbox e Nintendo. Explore lançamentos, promoções, avaliações e encontre seu próximo game favorito.",

            "home.featured": "Em Destaque",
            "home.giftTitle": "O presente perfeito para qualquer jogador.",
            "home.giftDescription": "Compre em poucos segundos e receba seu código rapidamente.",
            "home.giftAlert": "Estamos re-abastecendo nosso estoque, volte mais tarde!",
            "home.giftButton": "Ver Gift Cards",
            "home.shopMore": "Confira a loja completa!",

            "catalog.filters": "Filtros",
            "catalog.searchPlaceholder": "Pesquisar jogo...",
            "catalog.minimumRating": "Nota mínima",
            "catalog.publisher": "Produtora",
            "catalog.genre": "Gênero",
            "catalog.noResults": "Nenhum jogo encontrado com esses filtros.",
            "catalog.errorLoading": "Não foi possível atualizar o catálogo. Tente novamente.",

            "common.allFemale": "Todas",
            "common.allMale": "Todos",

            "details.saveChanges": "Salvar Alterações",
            "details.addToCart": "Botar no carrinho",
            "details.giftWrap": "Embrulhar para presente",
            "details.genre": "Gênero",
            "details.platform": "Plataforma",
            "details.publisher": "Fornecedor",

            "footer.developedBy": "Desenvolvido por",

            "auth.editData": "Alterar Dados",
            "auth.username": "Usuário",
            "auth.name": "Nome",
            "auth.type": "Tipo",
            "auth.password": "Senha",
            "auth.confirmPassword": "Confirme Senha",
            "auth.repeatPassword": "Repita a Senha",
            "auth.save": "Salvar",
            "auth.login": "Login",
            "auth.signIn": "Entrar",
            "auth.demoAccess": "Acesso Demo",
            "auth.systemAdmin": "Administrador do Sistema",
            "auth.systemEditor": "Editor do Sistema",
            "auth.newUser": "Novo Usuário",
            "auth.add": "Adicionar",
            "auth.logoutSuccess": "Logout bem sucedido",
            "auth.loginSuccess": "Login realizado com sucesso",
            "auth.loginError": "Opa... deu errado",
            "auth.restricted": "Eita! essa area é restrita",
            "auth.passwordMismatch": "As senhas não coincidem",
            "auth.adminOnly": "Você nao é ADM!",
            "auth.requiredFields": "todos os dados sao obrigatorios",
            "auth.readyToSave": "tudo certo para gravar",
            "auth.passwordsWrong": "senhas estão erradas!",

            "database.genre.ação": "Action",
            "database.genre.acao": "Action",
            "database.genre.aventura": "Adventure",
            "database.genre.terror": "Horror",
            "database.genre.plataforma": "Platform",
            "database.genre.estratégia": "Strategy",
            "database.genre.estrategia": "Strategy",
            "database.genre.esporte": "Sports",
            "database.genre.corrida": "Racing",
            "database.genre.tabuleiro": "Board Games",
            "database.genre.puzzle": "Puzzle",
            "database.genre.luta": "Fighting",
            "database.genre.musical": "Music",
            "database.genre.rpg": "RPG"
        },

        en: {
            "language.toEnglish": "English",
            "language.toPortuguese": "Português",
            "language.switchToEnglish": "Switch to English",
            "language.switchToPortuguese": "Switch to Portuguese",

            "nav.home": "Home",
            "nav.catalog": "Catalog",
            "search.placeholder": "Search",
            "user.admin": "Administrator",
            "user.standard": "User",
            "user.myDetails": "My Account",
            "user.register": "Register User",
            "user.logout": "Log out",
            "user.login": "Sign in",

            "page.homeTitle": "Home | Perdendo",
            "page.catalogTitle": "Catalog | Perdendo",
            "page.loginTitle": "Sign in | Perdendo",
            "page.newUserTitle": "New user | Perdendo",
            "page.editUserTitle": "My account | Perdendo",
            "page.description": "Discover the best games for PC, PlayStation, Xbox and Nintendo. Explore releases, deals, reviews, and find your next favorite game.",

            "home.featured": "Featured",
            "home.giftTitle": "The perfect gift for every gamer.",
            "home.giftDescription": "Buy in seconds and receive your code instantly.",
            "home.giftAlert": "We're restocking. Please check back later!",
            "home.giftButton": "View Gift Cards",
            "home.shopMore": "Explore the full store!",

            "catalog.filters": "Filters",
            "catalog.searchPlaceholder": "Search games...",
            "catalog.minimumRating": "Minimum rating",
            "catalog.publisher": "Publisher",
            "catalog.genre": "Genre",
            "catalog.noResults": "No games found with these filters.",
            "catalog.errorLoading": "The catalog could not be updated. Please try again.",

            "common.allFemale": "All",
            "common.allMale": "All",

            "details.saveChanges": "Save changes",
            "details.addToCart": "Add to cart",
            "details.giftWrap": "Wrap as a gift",
            "details.genre": "Genre",
            "details.platform": "Platform",
            "details.publisher": "Publisher",

            "footer.developedBy": "Developed by",

            "auth.editData": "Update account",
            "auth.username": "Username",
            "auth.name": "Name",
            "auth.type": "Role",
            "auth.password": "Password",
            "auth.confirmPassword": "Confirm password",
            "auth.repeatPassword": "Repeat password",
            "auth.save": "Save",
            "auth.login": "Sign in",
            "auth.signIn": "Sign in",
            "auth.demoAccess": "Demo access",
            "auth.systemAdmin": "System administrator",
            "auth.systemEditor": "System editor",
            "auth.newUser": "New user",
            "auth.add": "Add",
            "auth.logoutSuccess": "You have logged out successfully",
            "auth.loginSuccess": "Login successful",
            "auth.loginError": "Oops... something went wrong",
            "auth.restricted": "This area is restricted",
            "auth.passwordMismatch": "The passwords do not match",
            "auth.adminOnly": "Administrator access required",
            "auth.requiredFields": "All fields are required",
            "auth.readyToSave": "Ready to save",
            "auth.passwordsWrong": "The passwords are incorrect!",

            "database.genre.ação": "Action",
            "database.genre.acao": "Action",
            "database.genre.aventura": "Adventure",
            "database.genre.terror": "Horror",
            "database.genre.plataforma": "Platform",
            "database.genre.estratégia": "Strategy",
            "database.genre.estrategia": "Strategy",
            "database.genre.esporte": "Sports",
            "database.genre.corrida": "Racing",
            "database.genre.tabuleiro": "Board Games",
            "database.genre.puzzle": "Puzzle",
            "database.genre.luta": "Fighting",
            "database.genre.musical": "Music",
            "database.genre.rpg": "RPG"
        }
    };

    const gameDescriptions = {
        "Metal Gear Solid V": "Snake faces conspiracies in an open-world tactical warfare experience where stealth, strategy, and freedom of approach shape the success of every mission.",
        "Call of Duty Black Ops": "Enter the Cold War through secret missions filled with action, conspiracies, and intense battles, alongside an iconic multiplayer mode and the famous Zombies mode.",
        "Sonic the Hedgehog": "The world's fastest blue hedgehog races against time to stop Dr. Eggman's plans, collecting rings and taking on high-speed challenges.",
        "God of War": "Kratos seeks revenge against the gods of Olympus in a brutal journey filled with epic combat, Greek mythology, and an intense story of hatred and redemption.",
        "Super Mario Odyssey": "Mario travels across fantastic kingdoms with Cappy to rescue Peach, exploring creative worlds, collecting Power Moons, and using his hat to take control of enemies.",
        "Counter-Strike": "A classic tactical FPS where terrorists and counter-terrorists clash. Strategy, quick reflexes, and teamwork are essential to winning competitive matches.",
        "Super Smash Bros. Ultimate": "Iconic characters face off in the ultimate fighting experience, ready to play anytime, anywhere!",
        "Resident Evil 6": "Four interconnected campaigns bring action and horror to a battle against bioweapons, as classic heroes face zombies and mutant creatures.",
        "League of Legends": "A strategy and action game where teams battle to destroy the enemy base, using champions with unique abilities and competitive team-based gameplay.",
        "Donkey Kong Tropical Freeze": "Help Donkey Kong and his friends reclaim their island from Viking invaders, facing creative platforming challenges and stunning frozen landscapes.",
        "Grand Theft Auto V": "Three criminals navigate a story of action, heists, and betrayal in Los Santos, a huge open world full of activities and freedom to explore.",
        "Assassins Creed III": "Fight in the American Revolution as Connor, an assassin of Native American and English descent, taking on the Templars in an open world full of battles and intrigue."
    };
    let currentLanguage = "pt";

    function translate(key) {
        return translations[currentLanguage][key] ?? translations.pt[key] ?? null;
    }

    function updateLanguageButton() {
        const button = document.getElementById("idiomaToggle");
        if (!button) return;

        const code = button.querySelector(".idioma-toggle__code");
        const label = button.querySelector(".idioma-toggle__text");

        if (code) code.textContent = currentLanguage === "pt" ? "EN" : "PT";
        if (label) label.textContent = currentLanguage === "pt"
            ? translate("language.toEnglish")
            : translate("language.toPortuguese");

        button.setAttribute(
            "aria-label",
            currentLanguage === "pt"
                ? translate("language.switchToEnglish")
                : translate("language.switchToPortuguese")
        );
        button.setAttribute("aria-pressed", currentLanguage === "en" ? "true" : "false");
    }

    function translateDatabaseValues() {
        document.querySelectorAll('[data-i18n-database="genre"]').forEach((element) => {
            if (!element.dataset.i18nOriginal) {
                element.dataset.i18nOriginal = element.textContent.trim();
            }

            const original = element.dataset.i18nOriginal;
            const key = "database.genre." + original.toLocaleLowerCase("pt-BR");
            const translated = translate(key);

            element.textContent = currentLanguage === "pt"
                ? original
                : (translated || original);
        });

        document.querySelectorAll('[data-i18n-database="description"]').forEach((element) => {
            if (!element.dataset.i18nOriginal) {
                element.dataset.i18nOriginal = element.textContent.trim();
            }

            const original = element.dataset.i18nOriginal;
            const gameName = element.dataset.i18nGame;
            element.textContent = currentLanguage === "pt"
                ? original
                : (gameDescriptions[gameName] || original);
        });
    }

    function applyLanguage() {
        document.documentElement.lang = currentLanguage === "pt" ? "pt-BR" : "en";

        document.querySelectorAll("[data-i18n]").forEach((element) => {
            const value = translate(element.dataset.i18n);
            if (value !== null) element.textContent = value;
        });

        document.querySelectorAll("[data-i18n-placeholder]").forEach((element) => {
            const value = translate(element.dataset.i18nPlaceholder);
            if (value !== null) element.setAttribute("placeholder", value);
        });

        document.querySelectorAll("[data-i18n-value]").forEach((element) => {
            const value = translate(element.dataset.i18nValue);
            if (value !== null) element.value = value;
        });

        document.querySelectorAll("[data-i18n-title]").forEach((element) => {
            const value = translate(element.dataset.i18nTitle);
            if (value !== null) element.setAttribute("title", value);
        });

        document.querySelectorAll("[data-i18n-content]").forEach((element) => {
            const value = translate(element.dataset.i18nContent);
            if (value !== null) element.setAttribute("content", value);
        });

        translateDatabaseValues();
        updateLanguageButton();
    }

    function ensureLanguageButton() {
        let button = document.getElementById("idiomaToggle");
        if (button) return button;

        // Secondary pages without the shared header still get the same language control.
        button = document.createElement("button");
        button.type = "button";
        button.id = "idiomaToggle";
        button.className = "idioma-toggle idioma-toggle--floating";
        button.setAttribute("aria-label", "Mudar para inglês");
        button.innerHTML = [
            '<span class="idioma-toggle__code" aria-hidden="true">EN</span>',
            '<span class="idioma-toggle__text">English</span>'
        ].join("");

        Object.assign(button.style, {
            position: "fixed",
            top: "12px",
            right: "12px",
            zIndex: "10000",
            display: "inline-flex",
            alignItems: "center",
            gap: "7px",
            padding: "9px 13px",
            border: "1px solid #dedede",
            borderRadius: "999px",
            background: "#ffffff",
            color: "#303030",
            font: "600 13px Inter, Segoe UI, sans-serif",
            cursor: "pointer",
            boxShadow: "0 2px 10px rgba(0,0,0,.10)"
        });

        document.body.appendChild(button);
        return button;
    }

    function init() {
        const button = ensureLanguageButton();

        button.addEventListener("click", () => {
            currentLanguage = currentLanguage === "pt" ? "en" : "pt";

            try {
                localStorage.setItem(STORAGE_KEY, currentLanguage);
            } catch (error) {
                // The language still changes for the current page if storage is unavailable.
            }

            applyLanguage();
        });

        document.querySelectorAll("[data-i18n-alert]").forEach((element) => {
            if (element.dataset.i18nAlertBound === "true") return;

            element.dataset.i18nAlertBound = "true";
            element.addEventListener("click", () => {
                const message = translate(element.dataset.i18nAlert);
                if (message) window.alert(message);
            });
        });

        try {
            const savedLanguage = localStorage.getItem(STORAGE_KEY);
            currentLanguage = savedLanguage === "en" ? "en" : "pt";
        } catch (error) {
            currentLanguage = "pt";
        }

        applyLanguage();
    }

    // Permite reaplicar as traduções em cards inseridos por buscas sem recarregar a página.
    window.perdendoApplyLanguage = applyLanguage;

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init, { once: true });
    } else {
        init();
    }
})();