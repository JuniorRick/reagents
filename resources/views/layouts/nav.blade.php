<body>
  <div id="demo-top-bar">

    <div id="demo-bar-inside">

      <h2 id="demo-bar-badge">
        <a href="/home">Home</a>
      </h2>


      <div id="demo-bar-buttons">
        <a href="/reagents">Reagenti</a>
        @can('create')
          <a href="/orders">Eliberare Noua</a>
        @endcan
        <a href="/orders/all">Eliberari Totale</a>
        <a href="/people">Persoane</a>
        <a href="/producers">Producatori</a>

        <div id="search-container">
          <input type="search" id="search" placeholder="Search">
        </div>
      </div>


    </div>

  </div>
