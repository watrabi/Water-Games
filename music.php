    <?php if(!isset($_COOKIE["WARNING-DO-NOT-SHARE-WATERGAME-USCID"])){
        header("Location: /login");
    }
    ?>

<?php define("tabname","Home"); ?>
<?php include_once("base/header.php"); ?>
<div class="main" id="main">
    <br><br>
    
    <h1>Music</h1>
    <h2>Cant find music you want to listen to? Request a song in our discord!</h2>

        <input id="search-input" placeholder="Search">
    <br><br>
    
         <div id="itemContainer"></div>
    <div class="pagination" id="paginationContainer"></div>
<script>
        var currentPage = 1;
        var itemsPerPage = 5; // Number of games to display per page

        function fetchGames(page) {
            var url = '/api/getgames?page=' + page;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    var games = response.games;
                    var totalGames = response.totalGames;

                    // Display the games on the webpage
                    var itemContainer = document.getElementById('itemContainer');
                    itemContainer.innerHTML = '';

                    games.forEach(function(game) {
                        var gameContainer = document.createElement('div');
                        gameContainer.className = 'gamecontainer';
                        gameContainer.setAttribute('onclick', 'document.location.href = \'#\';');

                        var gameImage = document.createElement('img');
                        gameImage.src = '/assets/img/placeholder.png';
                        gameImage.height = 112;
                        gameImage.width = 112;
                        gameContainer.appendChild(gameImage);

                        var gameTitle = document.createElement('h1');
                        gameTitle.innerHTML = game.name;
                        gameContainer.appendChild(gameTitle);

                        var gamePlays = document.createElement('p');
                        gamePlays.innerHTML = game.plays + ' Plays';
                        gameContainer.appendChild(gamePlays);

                        itemContainer.appendChild(gameContainer);
                    });

                    // Build pagination links
                    var totalPages = Math.ceil(totalGames / itemsPerPage);
                    var paginationContainer = document.getElementById('paginationContainer');
                    paginationContainer.innerHTML = '';

                    for (var i = 1; i <= totalPages; i++) {
                        var pageLink = document.createElement('a');
                        pageLink.href = '#';
                        pageLink.innerHTML = i;
                        pageLink.addEventListener('click', function() {
                            var page = parseInt(this.innerHTML);
                            currentPage = page;
                            fetchGames(page);
                        });

                        if (i === currentPage) {
                            pageLink.className = 'active';
                        }

                        paginationContainer.appendChild(pageLink);
                    }
                }
            };
            xhttp.open('GET', url, true);
            xhttp.send();
        }

        // Initial fetch on page load
        fetchGames(currentPage);

    var searchInput = document.getElementById('search-input');
    var listContainer = document.getElementById('itemContainer');
    var listItems = listContainer.getElementsByTagName('div');
    
    searchInput.addEventListener('input', function() {
      var searchQuery = searchInput.value.trim().toLowerCase();
    
      for (var i = 0; i < listItems.length; i++) {
        var listItem = listItems[i];
        var listItemText = listItem.textContent.toLowerCase();
    
        if (listItemText.includes(searchQuery)) {
          listItem.style.display = '';
        } else {
          listItem.style.display = 'none';
        }
      }
    });

</script>
    
</div>
</body>
</html>