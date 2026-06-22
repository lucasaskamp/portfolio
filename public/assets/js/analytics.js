(function () {
    // Script-locatie onthouden om endpoint + privacy-link af te leiden.
    var thisScript = document.currentScript;

    // ---- Cookie-helpers ----
    function getCookie(name) {
        var m = document.cookie.match(new RegExp('(?:^|;\\s*)' + name + '=([^;]*)'));
        return m ? decodeURIComponent(m[1]) : null;
    }
    function setCookie(name, value, maxAgeSeconds) {
        document.cookie = name + '=' + encodeURIComponent(value) +
            '; Max-Age=' + maxAgeSeconds + '; Path=/; SameSite=Lax';
    }
    function consentChoice() { return getCookie('cookie_consent'); } // 'accepted' | 'declined' | null

    // ---- Statistiek (draait alleen NA toestemming) ----
    function trackUrl() {
        var base = (thisScript && thisScript.src) ? thisScript.src : location.href;
        return new URL('../../api/track.php', base).href;
    }
    function ensureSid() {
        if (getCookie('pv_sid')) return;
        var bytes = crypto.getRandomValues(new Uint8Array(16));
        var sid = Array.from(bytes).map(function (b) { return b.toString(16).padStart(2, '0'); }).join('');
        setCookie('pv_sid', sid, 60 * 60 * 24 * 180); // 180 dagen
    }
    function track() {
        try {
            ensureSid();
            var payload = JSON.stringify({
                path: location.pathname + location.search,
                ref: document.referrer || ''
            });
            var url = trackUrl();
            if (navigator.sendBeacon) {
                navigator.sendBeacon(url, new Blob([payload], { type: 'application/json' }));
            } else {
                fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: payload, keepalive: true });
            }
        } catch (e) {}
    }
    // Beschikbaar maken zodat de banner direct kan tracken na 'Accepteren'.
    window.trackPageview = track;

    // ---- Cookiebanner ----
    function privacyHref() {
        // Pagina's in /pages/ linken relatief naar privacy.php; de homepage een niveau hoger.
        return /\/pages\//.test(location.pathname) ? 'privacy.php' : 'pages/privacy.php';
    }
    function showBanner() {
        if (document.getElementById('cookieBanner')) return;

        var style = document.createElement('style');
        style.textContent =
            '#cookieBanner{position:fixed;left:0;right:0;bottom:0;z-index:2000;background:#0b1530;' +
            'border-top:1px solid #1b2b4d;color:#cbd5e1;padding:16px;box-shadow:0 -8px 24px rgba(0,0,0,.35)}' +
            '#cookieBanner .cc-inner{max-width:1000px;margin:0 auto;display:flex;gap:16px;align-items:center;' +
            'justify-content:space-between;flex-wrap:wrap}' +
            '#cookieBanner p{margin:0;font-size:14px;line-height:1.5;flex:1 1 320px}' +
            '#cookieBanner a{color:#7aa2ff}' +
            '#cookieBanner .cc-actions{display:flex;gap:10px;flex-wrap:wrap}' +
            '#cookieBanner button{cursor:pointer;border-radius:10px;padding:9px 16px;font:inherit;' +
            'border:1px solid #2a3c63;background:transparent;color:#cbd5e1}' +
            '#cookieBanner button.cc-primary{background:#3b6cf6;border-color:#3b6cf6;color:#fff}';
        document.head.appendChild(style);

        var bar = document.createElement('div');
        bar.id = 'cookieBanner';
        bar.setAttribute('role', 'dialog');
        bar.setAttribute('aria-label', 'Cookietoestemming');
        bar.innerHTML =
            '<div class="cc-inner">' +
              '<p>Deze website gebruikt een statistiek-cookie om bezoeken te tellen. ' +
              'Functionele cookies zijn altijd actief. Lees meer in de ' +
              '<a href="' + privacyHref() + '">privacyverklaring</a>.</p>' +
              '<div class="cc-actions">' +
                '<button type="button" data-cc="decline">Weigeren</button>' +
                '<button type="button" class="cc-primary" data-cc="accept">Accepteren</button>' +
              '</div>' +
            '</div>';
        document.body.appendChild(bar);

        bar.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-cc]');
            if (!btn) return;
            var accepted = btn.getAttribute('data-cc') === 'accept';
            setCookie('cookie_consent', accepted ? 'accepted' : 'declined', 60 * 60 * 24 * 365); // 1 jaar
            if (bar.parentNode) bar.parentNode.removeChild(bar);
            if (accepted) track();
        });
    }

    // ---- Start ----
    function init() {
        var choice = consentChoice();
        if (choice === 'accepted') {
            track();              // toestemming al gegeven -> meteen tellen
        } else if (choice === null) {
            showBanner();         // nog geen keuze -> banner tonen
        }
        // 'declined' -> niets doen, geen cookie, geen tracking
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
