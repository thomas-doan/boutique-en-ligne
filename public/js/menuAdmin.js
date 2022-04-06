window.addEventListener("DOMContentLoaded", () => {
    var mainMenu = document.querySelector("#menu");
    var burgerMenu = document.querySelector("#menu-burger");
    console.log(burgerMenu);

    var clickedEvent = "click";
    window.addEventListener(
        "touchstart",
        function detectTouch() {
            clickedEvent = "touchstart";
            window.removeEventListener("touchstart", detectTouch, false);
        },
        false
    );

    burgerMenu.addEventListener(
        clickedEvent,
        function(evt) {
            console.log(clickedEvent);

            if (!this.getAttribute("class")) {
                this.setAttribute("class", "clicked");
            } else {
                this.removeAttribute("class");
            }

            if (mainMenu.getAttribute("class") != "visible") {
                mainMenu.setAttribute("class", "visible");
            } else {
                mainMenu.setAttribute("class", "invisible");
            }
        },
        false
    );

    if (screen.width <= 1024) {
        var startX = 0;
        var distance = 100;

        // Au premier point de contact
        window.addEventListener(
            "touchstart",
            function(evt) {
                var touches = evt.changedTouches[0];
                startX = touches.pageX;
                between = 0;
            },
            false
        );

        // Quand les points de contact sont en mouvement
        window.addEventListener(
            "touchmove",
            function(evt) {
                evt.preventDefault();
                evt.stopPropagation();
            },
            false
        );

        // Quand le contact s'arrête
        window.addEventListener(
            "touchend",
            function(evt) {
                var touches = evt.changedTouches[0];
                var between = touches.pageX - startX;

                // Détection de la direction
                if (between > 0) {
                    var orientation = "ltr";
                } else {
                    var orientation = "rtl";
                }

                // Modification du menu burger
                if (
                    Math.abs(between) >= distance &&
                    orientation == "ltr" &&
                    mainMenu.getAttribute("class") != "visible"
                ) {
                    burgerMenu.setAttribute("class", "clicked");
                }
                if (
                    Math.abs(between) >= distance &&
                    orientation == "rtl" &&
                    mainMenu.getAttribute("class") != "invisible"
                ) {
                    burgerMenu.removeAttribute("class");
                }

                // Créé l'effet pour le menu slide (compatible partout)
                if (
                    Math.abs(between) >= distance &&
                    orientation == "ltr" &&
                    mainMenu.getAttribute("class") != "visible"
                ) {
                    mainMenu.setAttribute("class", "visible");
                }
                if (
                    Math.abs(between) >= distance &&
                    orientation == "rtl" &&
                    mainMenu.getAttribute("class") != "invisible"
                ) {
                    mainMenu.setAttribute("class", "invisible");
                }
            },
            false
        );
    }
});