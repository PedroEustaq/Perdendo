<h1 data-i18n="auth.editData">Alterar Dados</h1>

<form action="user-edit.php" method="post" id="formEditarConta">
    <table id="tableedit">
        <tr>
            <td><label for="usuario" data-i18n="auth.username">Usuário</label></td>
            <td>
                <input
                    type="text"
                    name="usuario"
                    id="usuario"
                    value="<?= htmlspecialchars($reg['usuario'], ENT_QUOTES, 'UTF-8') ?>"
                    maxlength="30"
                    autocomplete="username"
                    required>
            </td>
        </tr>
        <tr>
            <td><label for="nome" data-i18n="auth.name">Nome</label></td>
            <td>
                <input
                    type="text"
                    name="nome"
                    id="nome"
                    value="<?= htmlspecialchars($reg['nome'], ENT_QUOTES, 'UTF-8') ?>"
                    maxlength="60"
                    autocomplete="name"
                    required>
            </td>
        </tr>
        <tr>
            <td><label for="tipo" data-i18n="auth.type">Tipo</label></td>
            <td>
                <input
                    type="text"
                    id="tipo"
                    value="<?= htmlspecialchars($reg['tipo'], ENT_QUOTES, 'UTF-8') ?>"
                    readonly
                    aria-readonly="true">
            </td>
        </tr>
        <tr>
            <td><label for="senha1" data-i18n="auth.password">Nova senha</label></td>
            <td>
                <input
                    type="password"
                    name="senha1"
                    id="senha1"
                    maxlength="72"
                    autocomplete="new-password"
                    required>
            </td>
        </tr>
        <tr>
            <td><label for="senha2" data-i18n="auth.confirmPassword">Confirme a nova senha</label></td>
            <td>
                <input
                    type="password"
                    name="senha2"
                    id="senha2"
                    maxlength="72"
                    autocomplete="new-password"
                    required>
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="submit" data-i18n="auth.save">Salvar</button>
            </td>
        </tr>
    </table>
</form>
