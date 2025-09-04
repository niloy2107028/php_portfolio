// flash.js
window.addEventListener("DOMContentLoaded", () => {
  // Auto-hide any flash toasts after 2s (slightly > progress bar)
  document.querySelectorAll(".flash-toast").forEach((flash) => {
    setTimeout(() => {
      flash.style.transition = "opacity 0.5s ease, transform 0.5s ease";
      flash.style.opacity = "0";
      flash.style.transform = "translateX(-2px)";
      setTimeout(() => flash.remove(), 500);
    }, 1500);
    // same as flash.css
  });

  // Remove ?status=... from URL after showing flash
  if (window.history.replaceState) {
    const url = new URL(window.location);
    url.searchParams.delete("status");
    url.searchParams.delete("msg");
    window.history.replaceState({}, document.title, url.pathname + url.search);
  }
});
