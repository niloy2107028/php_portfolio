var tab_links = document.getElementsByClassName("tab_links");
var tab_contents = document.getElementsByClassName("tab_contents");

function opentab(tab_name) {
  for (tab_link of tab_links) {
    tab_link.classList.remove("active_link");
  }
  for (tab_content of tab_contents) {
    tab_content.classList.remove("active_tab");
  }
  event.currentTarget.classList.add("active_link");
  document.getElementById(tab_name).classList.add("active_tab");
}

var sidemenu = document.getElementById("sidemenu");

function open_menu() {
  sidemenu.style.right = "0";
}

function close_menu() {
  sidemenu.style.right = "-12.5rem";
}
