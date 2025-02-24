<!-- nav.php -->
<div class='navi' >
    <nav>
        <img src="../images/logo-white-version.png" alt="logo" class="logo">
        <ul>
            <li><a href="../views/accueil.php" class="nav-button"><div class="vertical-hr"></div><img src="../images/accueil.png" class="nav-image">Accueil</a></li>
            <li><a href="../views/joueur.php" class="nav-button"><div class="vertical-hr"></div><img src="../images/joueur-de-rugby.png" class="nav-image">Joueurs</a></li>
            <li><a href="../views/match.php" class="nav-button"><div class="vertical-hr"></div><img src="../images/match.png" class="nav-image">Matchs</a></li>
            <li><a href="../views/selection.php" class="nav-button"><div class="vertical-hr"></div><img src="../images/selection.png" class="nav-image">Selection</a></li>
        </ul>
        <div class="logout-div">
            <a id="logout-button" class="logout-button"><img src="../images/logout.png" class="nav-image">Log-Out</a>
        </div>
    </nav>
</div>
<script>
    // fonctionnement du bouton logout
    const logoutButton = document.getElementById("logout-button");

    logoutButton.onclick = () => {
        document.cookie = "auth=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        window.location.href = "../views/login.php";
    }

    // disable le bouton de la page sur laquelle on est
    const currentPage = window.location.pathname.split("/").pop();
    const navButtons = document.querySelectorAll(".nav-button");

    navButtons.forEach(button => {
        const buttonHref = button.getAttribute("href").split("/").pop();
        if (buttonHref === currentPage) {
            button.onclick = (e) => e.preventDefault();
            button.classList.add('disabled-hover')
            const verticalHr = button.querySelector(".vertical-hr");
            if (verticalHr) {
                verticalHr.style.display = 'block';
            }
        }
    });
    
</script>
