// assets/js/game-form.js — invulhulpjes voor het gameformulier (geen library)
document.addEventListener('DOMContentLoaded', () => {
  // Vandaag als jjjj-mm-dd in lokale tijd (toISOString zou 's avonds laat "gisteren" geven)
  const todayLocal = () => {
    const d = new Date();
    const p = n => String(n).padStart(2, '0');
    return `${d.getFullYear()}-${p(d.getMonth() + 1)}-${p(d.getDate())}`;
  };

  // ── Sterren met halve stappen ────────────────────────────────
  document.querySelectorAll('[data-stars]').forEach(box => {
    const input = box.querySelector('input[type="hidden"]');
    const fills = box.querySelectorAll('.stars__fill');
    const label = box.querySelector('[data-stars-label]');

    const paint = v => {
      fills.forEach((fill, i) => {
        const n = i + 1;
        fill.style.width = v >= n ? '100%' : (v >= n - 0.5 ? '50%' : '0');
      });
      if (label) label.textContent = v ? String(v).replace('.', ',') + ' / 5' : '—';
    };
    const current = () => parseFloat(input.value) || 0;

    box.querySelectorAll('.stars__hit').forEach(hit => {
      const v = parseFloat(hit.dataset.value);
      hit.addEventListener('mouseenter', () => paint(v));      // voorproefje bij hover
      hit.addEventListener('focus',      () => paint(v));
      hit.addEventListener('click',      () => { input.value = v; paint(v); });
    });
    box.addEventListener('mouseleave', () => paint(current()));
    box.querySelector('[data-stars-clear]')?.addEventListener('click', () => { input.value = ''; paint(0); });

    paint(current());
  });

  // ── Platform-knoppen (één klik kiest, nog een klik maakt leeg; "Anders…" wint als je typt) ──
  document.querySelectorAll('[data-chips]').forEach(box => {
    const hidden = box.querySelector('input[type="hidden"]');   // wordt verstuurd
    const other  = box.querySelector('[data-chips-other]');     // vrij tekstveld
    const chips  = box.querySelectorAll('.chip');
    const sync   = () => chips.forEach(c => c.classList.toggle('is-active', c.dataset.value === hidden.value));

    chips.forEach(c => c.addEventListener('click', () => {
      hidden.value = (hidden.value === c.dataset.value) ? '' : c.dataset.value;
      other.value  = '';
      sync();
    }));
    other.addEventListener('input', () => { hidden.value = other.value.trim(); sync(); });
    sync();
  });

  // ── Voortgang-slider: percentage meebewegen ──────────────────
  document.querySelectorAll('[data-range]').forEach(range => {
    const out  = document.querySelector(`[data-range-out="${range.id}"]`);
    const show = () => { if (out) out.textContent = range.value + '%'; };
    range.addEventListener('input', show);
    show();
  });

  // ── "Nu begonnen" / "Nu uitgespeeld" ─────────────────────────
  const status   = document.getElementById('status');
  const started  = document.getElementById('started_at');
  const finished = document.getElementById('finished_at');
  const progress = document.getElementById('progress');

  document.querySelector('[data-today="started_at"]')?.addEventListener('click', () => {
    started.value = todayLocal();
    if (status && (status.value === 'wishlist' || status.value === 'backlog')) status.value = 'playing';
  });

  document.querySelector('[data-today="finished_at"]')?.addEventListener('click', () => {
    finished.value = todayLocal();
    if (status) status.value = 'completed';
    if (progress) { progress.value = 100; progress.dispatchEvent(new Event('input')); }
  });

  // Kolom kiezen vult een nog lege datum in
  status?.addEventListener('change', () => {
    if (status.value === 'playing'   && started  && !started.value)  started.value  = todayLocal();
    if (status.value === 'completed' && finished && !finished.value) finished.value = todayLocal();
  });
});
