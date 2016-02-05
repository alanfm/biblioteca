    <div class="container-fluid">
      <div class="row">
        <!-- Menu -->
        <div class="col-md-2">          
          <ul class="nav nav-pills nav-stacked" id="stacked-menu">          
            <li>
              <a class="nav-container" href="./"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home<div class="caret-container"></div></a>
            </li>
            <li>
              <a class="nav-container" data-toggle="collapse" data-parent="#stacked-menu" href="#emprestimos"><span class="glyphicon glyphicon-export" aria-hidden="true"></span> Emprestimos<div class="caret-container"><span class="caret arrow"></span></div></a>          
              <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('emprestimos')? 'in': '';?>" id="emprestimos">
                <li><a href="#">Novo</a></li>
                <li><a href="#">Listar</a></li>
                <li><a href="#">Buscar</a></li>
              </ul>
            </li>
            <li>
              <a class="nav-container" data-toggle="collapse" data-parent="#stacked-menu" href="#p1"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Gerenciar<div class="caret-container"><span class="caret arrow"></span></div></a>    
              <ul class="nav nav-pills nav-stacked collapse in" id="p1">
                <li data-toggle="collapse" data-parent="#p1" href="#livros">
                  <a class="nav-sub-container">Livros<div class="caret-container"><span class="caret arrow"></span></div></a>
                </li>
                <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('livros')? 'in': '';?>" id="livros">
                  <li><a href="#">Novo</a></li>
                  <li><a href="#">Listar</a></li>
                  <li><a href="#">Buscar</a></li>
                </ul>
                <li data-toggle="collapse" data-parent="#p1" href="#pessoas">
                  <a class="nav-sub-container">Pessoas<div class="caret-container"><span class="caret arrow"></span></div></a>
                </li>
                <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('pessoa')? 'in': '';?>" id="pessoas">
                  <li><a href="pessoa/listar">Listar</a></li>
                </ul>
                <li data-toggle="collapse" data-parent="#p1" href="#autor">
                  <a class="nav-sub-container">Autor<div class="caret-container"><span class="caret arrow"></span></div></a>
                </li>
                <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('autor')? 'in': '';?>" id="autor">
                  <li><a href="autor/listar">Listar</a></li>
                </ul>
                <li data-toggle="collapse" data-parent="#p1" href="#categorias">
                  <a class="nav-sub-container">Categorias<div class="caret-container"><span class="caret arrow"></span></div></a>
                </li>
                <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('categoria')? 'in': '';?>" id="categorias">
                  <li><a href="categoria/listar">Listar</a></li>
                </ul>
                <li data-toggle="collapse" data-parent="#p1" href="#tipos">
                  <a class="nav-sub-container">Tipo<div class="caret-container"><span class="caret arrow"></span></div></a>
                </li>
                <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('tipo')? 'in': '';?>" id="tipos">
                  <li><a href="tipo/listar">Listar</a></li>
                </ul>
                <li data-toggle="collapse" data-parent="#p1" href="#editora">
                  <a class="nav-sub-container">Editora<div class="caret-container"><span class="caret arrow"></span></div></a>
                </li>
                <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('editora')? 'in': '';?>" id="editora">
                  <li><a href="editora/listar">Listar</a></li>
                </ul>
                <li data-toggle="collapse" data-parent="#p1" href="#serie">
                  <a class="nav-sub-container">Série/Ano<div class="caret-container"><span class="caret arrow"></span></div></a>
                </li>
                <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('serie')? 'in': '';?>" id="serie">
                  <li><a href="serie/listar">Listar</a></li>
                </ul>
                <li data-toggle="collapse" data-parent="#p1" href="#vinculo">
                  <a class="nav-sub-container">Vinculo<div class="caret-container"><span class="caret arrow"></span></div></a>
                </li>
                <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('vinculo')? 'in': '';?>" id="vinculo">
                  <li><a href="vinculo/listar">Listar</a></li>
                </ul>
              </ul>
            </li>
            <li>
              <a class="nav-container" data-toggle="collapse" data-parent="#stacked-menu" href="#usuario"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuário<div class="caret-container"><span class="caret arrow"></span></div></a>          
              <ul class="nav nav-pills nav-stacked collapse <?php echo App::getMenu('usuario')? 'in': '';?>" id="usuario">
                <li><a href="usuario/cadastrados">Listar</a></li>
                <li class="nav-divider"></li>
                <li><a href="security/logout">Sair</a></li>
              </ul>
            </li>            
          </ul>          
        </div> <!-- ./Menu -->
        <!-- Content -->
        <div class="col-md-10">