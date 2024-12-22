<!-- nav.php -->
<div class='navi' >
    <nav>
        <img src="../images/logo-white-version.png" alt="logo" class="logo">
        <ul>
            <li><a href="../views/accueil.php" class="nav-button"><img src="../images/accueil.png" class="nav-image">Accueil</a></li>
            <li><a href="../views/joueur.php" class="nav-button"><img src="../images/joueur-de-rugby.png" class="nav-image">Joueurs</a></li>
            <li><a href="../views/match.php" class="nav-button"><img src="../images/match.png" class="nav-image">Matchs</a></li>
        </ul>
        <div class="logout-div">
            <button id="logout-button" class="logout-button"><img src="../images/logout.png" class="nav-image">Log-Out</button>
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
        }
    });
    
</script>
