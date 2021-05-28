
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.home')}}">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
        <div class="sidebar-brand-text mx-3">SIGOM<sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{URL::current() == route('admin.home')? 'active':''}} " >
          <a class="nav-link" href="{{route('admin.home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
          Gerenciamento
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ URL::current() == route('admin.cidades') || URL::current() == route('admin.estados') || URL::current() == route('admin.servicos') ? 'active' : '' }} ">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cadastros</span>
          </a>
        <div id="collapseTwo" class="collapse {{
                 URL::current() == route('admin.cidades') ||
                 URL::current() == route('admin.estados') ||
                 URL::current() == route('admin.servicos') ? 'show' : ''
             }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

              <a class="collapse-item" href="{{route('admin.cidades')}}">Cadastro de Cidades</a>
              <a class="collapse-item" href="{{route('admin.estados')}}">Visualizar os Estado</a>
              <a class="collapse-item" href="{{route('admin.servicos')}}">Cadastro de Serviço</a>
              <a class="collapse-item" href="{{route('admin.produtos')}}">Cadastro de Produtos</a>
            </div>
          </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user"></i>
            <span>Cadastro de Pessoas</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{route('admin.pessoafisica')}}">Pessoa Física</a>
              <a class="collapse-item" href="{{route('admin.pessoajuridica')}}">Pessoa Jurídica</a>
              <a class="collapse-item" href="{{route('admin.user')}}">Usuários</a>
              <a class="collapse-item" href="{{route('admin.perfil')}}">Perfil</a>

            </div>
          </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="charts.html">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Relatórios</span></a>
          </li>


          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
        <div class="sidebar-heading">
              Financeiro
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinanceiro" aria-expanded="true" aria-controls="collapseFinanceiro">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Financeiro</span>
          </a>
          <div id="collapseFinanceiro" class="collapse" aria-labelledby="headingFinanceiro" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{route('admin.bancos')}}">Banco</a>
              <a class="collapse-item" href="{{route('admin.agentes')}}">Agente Financeiro</a>
              <a class="collapse-item" href="{{route('admin.pagamentos')}}">Froma de Pagamento</a>
            </div>
          </div>


          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCaixa" aria-expanded="true" aria-controls="collapseCaixa">
            <i class="fas fa-fw fa-donate"></i>
            <span>Caixa</span>
          </a>
          <div id="collapseCaixa" class="collapse" aria-labelledby="headingCaixa" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{route('admin.caixa')}}">Baixa Manual</a>
              <a class="collapse-item" href="{{route('admin.caixa')}}">Relatório de Caixa</a>
            </div>
          </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
      <div class="sidebar-heading">
            Operacional
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrcamento" aria-expanded="true" aria-controls="collapseOrcamento">
          <i class="fas fa-fw fa-cog"></i>
          <span>Orçamentos</span>
        </a>
        <div id="collapseOrcamento" class="collapse" aria-labelledby="headingOrcamento" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.orcamentos')}}">Novo Orçamento</a>
            <a class="collapse-item" href="#">Consultar Orçamento</a>
          </div>
        </div>
      </li>

        <li class="nav-item ">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-cog "></i>
            <span>Lançamentos</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="#">Compra de Peças</a>
              <a class="collapse-item" href="#">Visualizar Estoque</a>

            </div>
          </div>
        </li>

        <!-- Nav Item - Charts -->


        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="{{route('site.login.sair')}}">
            <i class="fas fa-fw fa-times"></i>
            <span>Sair</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

      </ul>
      <!-- End of Sidebar -->
