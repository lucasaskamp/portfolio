<?php
/**
 * Formuliervelden voor een game. Verwacht:
 *   $data  — array met huidige waarden (leeg bij een nieuwe game)
 * Gebruikt GAME_STATUSES en GAME_PLATFORMS uit game-helpers.inc.php,
 * en assets/js/game-form.js voor sterren, platformknoppen, slider en datumknoppen.
 */
$defaults = [
    'title' => '', 'platform' => '', 'status' => 'backlog',
    'rating' => '', 'progress' => '', 'hours_played' => '',
    'started_at' => '', 'finished_at' => '',
    'notes' => '',
];
$data = array_merge($defaults, array_filter($data ?? [], fn($v) => $v !== null));
$ratingNow = $data['rating'] !== '' ? (float)$data['rating'] : 0.0;
?>
<div class="form__row">
    <label for="title">Naam *</label>
    <input id="title" name="title" value="<?= e($data['title']) ?>" required maxlength="150" autofocus />
</div>

<div class="form__row">
    <label>Platform</label>
    <?php $isKnown = in_array($data['platform'], GAME_PLATFORMS, true); ?>
    <div class="chips" data-chips>
        <input type="hidden" name="platform" value="<?= e($data['platform']) ?>">
        <?php foreach (GAME_PLATFORMS as $p): ?>
            <button type="button" class="chip<?= $data['platform'] === $p ? ' is-active' : '' ?>" data-value="<?= e($p) ?>"><?= e($p) ?></button>
        <?php endforeach; ?>
        <input class="chips__other" data-chips-other value="<?= $isKnown ? '' : e($data['platform']) ?>" maxlength="60" placeholder="Anders…" aria-label="Ander platform" />
    </div>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:0 16px">
    <div class="form__row">
        <label for="status">Kolom</label>
        <select id="status" name="status">
            <?php foreach (GAME_STATUSES as $value => $label): ?>
                <option value="<?= e($value) ?>" <?= $data['status'] === $value ? 'selected' : '' ?>><?= e($label) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form__row">
        <label>Sterren</label>
        <div class="stars" data-stars>
            <input type="hidden" name="rating" value="<?= e($data['rating']) ?>">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <span class="stars__star">
                    <span class="stars__fill" style="width:<?= $ratingNow >= $i ? '100%' : ($ratingNow >= $i - 0.5 ? '50%' : '0') ?>">★</span>★
                    <button type="button" class="stars__hit stars__hit--left"  data-value="<?= $i - 0.5 ?>" aria-label="<?= $i - 0.5 ?> sterren"></button>
                    <button type="button" class="stars__hit stars__hit--right" data-value="<?= $i ?>"       aria-label="<?= $i ?> sterren"></button>
                </span>
            <?php endfor; ?>
            <span class="stars__label card__meta" data-stars-label>—</span>
            <button type="button" class="btn btn-ghost btn-sm" data-stars-clear>Wis</button>
        </div>
    </div>
    <div class="form__row">
        <label for="hours_played">Uren gespeeld</label>
        <input id="hours_played" name="hours_played" type="number" min="0" max="99999.9" step="0.1" value="<?= e($data['hours_played']) ?>" placeholder="bv. 12,5" />
    </div>
</div>

<div class="form__row">
    <label for="progress">Voortgang: <output data-range-out="progress">—</output></label>
    <input id="progress" name="progress" type="range" min="0" max="100" step="1" value="<?= $data['progress'] !== '' ? (int)$data['progress'] : 0 ?>" data-range />
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(260px, 1fr)); gap:0 16px">
    <div class="form__row">
        <label for="started_at">Begonnen op</label>
        <div class="date-row">
            <input id="started_at" name="started_at" type="date" value="<?= e($data['started_at']) ?>" />
            <button type="button" class="btn btn-ghost btn-sm" data-today="started_at">Nu begonnen</button>
        </div>
    </div>
    <div class="form__row">
        <label for="finished_at">Uitgespeeld op</label>
        <div class="date-row">
            <input id="finished_at" name="finished_at" type="date" value="<?= e($data['finished_at']) ?>" />
            <button type="button" class="btn btn-ghost btn-sm" data-today="finished_at">Nu uitgespeeld</button>
        </div>
    </div>
</div>

<div class="form__row">
    <label for="notes">Notes</label>
    <textarea id="notes" name="notes" rows="4" maxlength="5000" placeholder="Waar je gebleven bent, wat je ervan vindt…"><?= e($data['notes']) ?></textarea>
</div>
