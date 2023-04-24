const globalChatElem = document.getElementById("global-chat");

function changeLang(newLang) {
    axios.get("/changeLang/" + newLang).then((response) => {
        console.log(response.data);
        window.location.reload();
    });
}

function mobileNav() {
    const hamburger = document.getElementById("hamburger-icon");
    const menu = document.getElementById("mobile-menu");

    if (menu.style.display != "none") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

//GLOBAL CHAT VISIBILITY
function globalChat() {
    if (
        globalChatElem.style.visibility === "" ||
        globalChatElem.style.visibility === "hidden"
    ) {
        globalChatElem.style.visibility = "visible";
    } else {
        globalChatElem.style.visibility = "hidden";
    }
}
