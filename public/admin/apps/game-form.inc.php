<?php
/**
 * Formuliervelden voor een game. Verwacht:
 *   $data  — array met huidige waarden (leeg bij een nieuwe game)
 * Gebruikt GAME_STATUSES uit game-helpers.inc.php.
 */
$defaults = [
    'title' => '', 'platform' => '', 'status' => 'backlog',
    'rating' => '', 'progress' => '', 'hours_played' => '',
    'started_at' => '', 'finished_at' => '', 'release_date' => '',
    'notes' => '',
];
$data = array_merge($defaults, array_filter($data ?? [], fn($v) => $v !== null));
?>
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:0 16px">
    <div class="form__row">
        <label for="title">Naam *</label>
        <input id="title" name="title" value="<?= e($data['title']) ?>" required maxlength="150" autofocus />
    </div>
    <div class="form__row">
        <label for="platform">Platform</label>
        <input id="platform" name="platform" value="<?= e($data['platform']) ?>" maxlength="60" placeholder="Switch, PC, PS5…" />
    </div>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(150px, 1fr)); gap:0 16px">
    <div class="form__row">
        <label for="status">Kolom</label>
        <select id="status" name="status">
            <?php foreach (GAME_STATUSES as $value => $label): ?>
                <option value="<?= e($value) ?>" <?= $data['status'] === $value ? 'selected' : '' ?>><?= e($label) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form__row">
        <label for="rating">Sterren (0,5–5)</label>
        <input id="rating" name="rating" type="number" min="0.5" max="5" step="0.5" value="<?= e($data['rating']) ?>" placeholder="bv. 3,5" />
    </div>
    <div class="form__row">
        <label for="progress">Voortgang %</label>
        <input id="progress" name="progress" type="number" min="0" max="100" step="1" value="<?= e($data['progress']) ?>" placeholder="0–100" />
    </div>
    <div class="form__row">
        <label for="hours_played">Uren gespeeld</label>
        <input id="hours_played" name="hours_played" type="number" min="0" max="99999.9" step="0.1" value="<?= e($data['hours_played']) ?>" placeholder="bv. 12,5" />
    </div>
</div>

<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:0 16px">
    <div class="form__row">
        <label for="started_at">Begonnen op</label>
        <input id="started_at" name="started_at" type="date" value="<?= e($data['started_at']) ?>" />
    </div>
    <div class="form__row">
        <label for="finished_at">Uitgespeeld op</label>
        <input id="finished_at" name="finished_at" type="date" value="<?= e($data['finished_at']) ?>" />
    </div>
    <div class="form__row">
        <label for="release_date">Releasedatum</label>
        <input id="release_date" name="release_date" type="date" value="<?= e($data['release_date']) ?>" />
    </div>
</div>

<div class="form__row">
    <label for="notes">Notes</label>
    <textarea id="notes" name="notes" rows="4" maxlength="5000" placeholder="Waar je gebleven bent, wat je ervan vindt…"><?= e($data['notes']) ?></textarea>
</div>
