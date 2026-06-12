<aside id="sidebar" class="sidebar p-3 text-white bg-dark">
    <h4> Meu painel </h4>
    <h5> Bem-vindo(a) <?php echo $_SESSION['usuario'] ?> </h5>

    <ul class="nav flex-column">
        <?php if(($_SESSION['tipo'] ?? 'admin') == 'admin'){ ?>
            <li class="nav-item">
                <a class="nav-link" href="./principal.php">
                    <i class="fa-solid fa-user" style="color: rgb(255, 255, 255);"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./mercado.php">
                    <i class="fa-solid fa-shop" style="color: rgb(255, 255, 255);"></i> Mercados
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./receita.php">
                    <i class="fa-solid fa-book-open" style="color: rgb(255, 255, 255);"></i> Receitas
                </a>
            </li>
        <?php } ?>

        <li class="nav-item">
            <a class="nav-link" href="./produto.php">
                <i class="fa-solid fa-basket-shopping" style="color: rgb(255, 255, 255);"></i> Produtos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./backend/sair.php">
                <i class="fa-solid fa-right-from-bracket" style="color: rgb(255, 255, 255);"></i> Sair
            </a>
        </li>
    </ul>
</aside>
