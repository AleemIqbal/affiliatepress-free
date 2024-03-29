const CookieAlert = () => {
  var cookieAlert = document.querySelector(".cookie-consent");
  var acceptCookies = document.querySelector(".button-cookie");
  if (!cookieAlert) {
    return;
  }

  cookieAlert.offsetHeight;

  if (!getCookie("acceptCookies")) {
    cookieAlert.classList.add("show");
  }

  acceptCookies.addEventListener("click", function () {
    setCookie("acceptCookies", true, 365);
    cookieAlert.classList.remove("show");

    window.dispatchEvent(new Event("cookieAlertAccept"));
  });

  function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) === " ") {
        c = c.substring(1);
      }
      if (c.indexOf(name) === 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
};

document.addEventListener("DOMContentLoaded", () => {
  document.querySelector(".header .hamburger").addEventListener("click", () => {
    document.querySelector(".header#masthead").classList.toggle("active");
  });

  document.querySelectorAll(".menu-item__open-btn").forEach((item) => {
    item.addEventListener("click", (e) => {
      console.log(e.target);
      e.target.parentElement.classList.toggle("open");
    });
  });

  const hostName = document.location.hostname;
  const allAddedFetch = [];

  const addFetch = (element) => {
    if (!allAddedFetch.includes(element.getAttribute("href"))) {
      const fetch = document.createElement("link");
      fetch.setAttribute("rel", "prefetch");
      fetch.setAttribute("href", element.getAttribute("href"));

      document.head.append(fetch);

      allAddedFetch.push(element.getAttribute("href"));
    }
  };

  document.querySelectorAll(`.navigation a[href*="${hostName}"], .footer__menu a[href*="${hostName}"]`).forEach(addFetch);

  document.querySelectorAll(`.site-content a[href*="${hostName}"]`).forEach((element) => {
    element.addEventListener("mouseenter", (event) => addFetch(event.target), false);
  });

  document.querySelectorAll(`.single .entry-content a[href*="${hostName}"]`).forEach((element) => {
    window.addEventListener("scroll", () => {
      const distanceFromElement = element.getBoundingClientRect().top - window.screen.availHeight;

      if (distanceFromElement <= 200) {
        addFetch(element);
      }
    });
  });

  CookieAlert();
});

(function($) {
  $(document).ready(function() {
    // Add keyboard navigation to all menu items
    $('.menu-item a').on('keydown', function(e) {
      if (e.keyCode === 13 || e.keyCode === 32) { // Enter or space key
        $(this).trigger('click');
      }
    });

    // Add keyboard navigation to all form fields
    $('input, select, textarea').on('keydown', function(e) {
      if (e.keyCode === 13) { // Enter key
        $(this).trigger('blur');
        $(this).next().focus();
        return false;
      }
    });

        // Add visual focus highlighting to all focusable elements
        $('a, button, input, textarea, select, [tabindex]').on({
          focus: function() {
            $(this).addClass('focus');
          },
          keydown: function(e) {
            if (e.keyCode === 9) { // Tab key
              $(this).addClass('focus');
            }
          }
        });
      });
    })(jQuery);