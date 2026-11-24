<h1 data-i18n="auth.newUser">Novo Usuário</h1>

<form action="user-new.php" method="POST" class="form-usuario">

    <div class="campo">
        <label for="usuario" data-i18n="auth.username">Usuário</label>
        <input type="text" name="usuario" id="usuario" required>
    </div>

    <div class="campo">
        <label for="nome" data-i18n="auth.name">Nome</label>
        <input type="text" name="nome" id="nome" required>
    </div>

    <div class="campo">
        <label for="senha1" data-i18n="auth.password">Senha</label>
        <input type="password" name="senha1" id="senha1" required>
    </div>

    <div class="campo">
        <label for="senha2" data-i18n="auth.repeatPassword">Repita a Senha</label>
        <input type="password" name="senha2" id="senha2" required>
    </div>

    <div class="campo">
        <label for="tipo" data-i18n="auth.type">Tipo</label>
        <select name="tipo" id="tipo">
            <option value="admin" data-i18n="auth.systemAdmin">Administrador do Sistema</option>
            <option value="editor" data-i18n="auth.systemEditor">Editor do Sistema</option>
        </select>
    </div>

    <button type="submit" data-i18n="auth.add">Adicionar</button>

</form>