(function(){
    // Endpoint mount-onafhankelijk afleiden t.o.v. dit script
    // (.../assets/js/analytics.js -> .../api/track.php).
    const thisScript = document.currentScript;
    function trackUrl(){
        const base = thisScript && thisScript.src ? thisScript.src : location.href;
        return new URL('../../api/track.php', base).href;
    }
    function ensureSid(){
        const k='pv_sid';
        if (document.cookie.includes(k+'=')) return;
        const sid = Array.from(crypto.getRandomValues(new Uint8Array(16)))
            .map(b=>b.toString(16).padStart(2,'0')).join('');
        document.cookie = `${k}=${sid}; Max-Age=${60*60*24*180}; Path=/; SameSite=Lax`;
    }
    function send(){
        try{
            ensureSid();
            const payload = JSON.stringify({
                path: location.pathname + location.search,
                ref: document.referrer || ''
            });
            const url = trackUrl();
            if (navigator.sendBeacon) {
                navigator.sendBeacon(url, new Blob([payload], {type:'application/json'}));
            } else {
                fetch(url, {method:'POST', headers:{'Content-Type':'application/json'}, body:payload, keepalive:true});
            }
        }catch(e){}
    }
    if (document.readyState==='loading')
        document.addEventListener('DOMContentLoaded', send);
    else
        send();
})();
