<body>
  <div id="demo-top-bar">

    <div id="demo-bar-inside">

      <h2 id="demo-bar-badge">
        <a href="/home"><i class="fa fa-home fa-lg"></i></a>
      </h2>


      <div id="demo-bar-buttons">
        <a href="/reagents/stock">Reagenti</a>
        @if(auth()->user()->can('create orders') || auth()->user()->hasRole('admin'))
          <a href="/orders">Eliberare Noua</a>
        @endif
        <a href="/orders/active">Reagent Laborator</a>
        @if(auth()->user()->hasRole('admin'))
          <a href="/people">Persoane</a>
          <a href="/producers">Producatori</a>
        @endif
        <div id="search-container">
          <input type="search" id="search" placeholder="Search">
        </div>
      </div>


    </div>

  </div>

  <div class="scroller">
    <div class="scroll-up">
      <i class="fa fa-arrow-up"></i>
    </div>
    <div class="scroll-down">
      <i class="fa fa-arrow-down"></i>
    </div>
  </div>
