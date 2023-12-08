<?php define("tabname","Games"); ?>
<?php include_once("base/header.php"); ?>
<div class="main" id="main">
    <h1><?php echo tabname; ?></h1>
    <h2>Here are some of the top games!</h2>
    <input id="search-input" placeholder="Search">
    <br><br>

    <div id="itemContainer"></div>
    <div class="pagination" id="paginationContainer"></div>
    <div id="games">
        <!-- <div class="gamecontainer"><a href="#"></a><img src="/assets/img/slope.png"><h1>game</h1><p>0 plays</p></div> -->
    <script>
        var currentPage = 1;
        var itemsPerPage = 6; // Number of games to display per page

        function fetchGames(page) {
            var url = '/api/getgames?page=' + page;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    var games = response.games;
                    var totalGames = response.totalGames;

                    // Display the games on the webpage
                    var itemContainer = document.getElementById('itemContainer');
                    itemContainer.innerHTML = '';

                    games.forEach(function (game) {
                        var gameContainer = document.createElement('div');
                        gameContainer.className = 'gamecontainer';

                        var gameLink = document.createElement('a');
                        gameLink.href = '/play/' + game.id;

                        var gameImage = document.createElement('img');
                        gameImage.src = game.icon || '/assets/img/default-icon.png'; // Use default icon URL if game.icon is undefined or empty
                        gameImage.height = 112;
                        gameImage.width = 112;
                        gameLink.appendChild(gameImage);

                        var gameTitle = document.createElement('h1');
                        gameTitle.innerHTML = game.name;
                        gameLink.appendChild(gameTitle);

                        var gamePlays = document.createElement('p');
                        gamePlays.innerHTML = game.plays + ' Plays';
                        gameLink.appendChild(gamePlays);

                        gameContainer.appendChild(gameLink);
                        itemContainer.appendChild(gameContainer);
                        document.createElement('br');
                    });

                    // Build pagination links
                    var totalPages = Math.ceil(totalGames / itemsPerPage);
                    var paginationContainer = document.getElementById('paginationContainer');
                    paginationContainer.innerHTML = '';

                    for (var i = 1; i <= totalPages; i++) {
                        var pageLink = document.createElement('a');
                        pageLink.href = '#';
                        pageLink.innerHTML = i;
                        pageLink.addEventListener('click', function () {
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

        searchInput.addEventListener('input', function () {
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
</div>
<br><br><br>
<?php include_once("base/footer.php"); ?>
</body>
</html>
