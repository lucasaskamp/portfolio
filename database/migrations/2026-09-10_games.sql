-- ============================================================
--  Migratie: tabel `games` voor de Game Backlog-app
--  Plak dit in phpMyAdmin (tabblad SQL) in je bestaande database.
--  Veilig om nogmaals te draaien: IF NOT EXISTS.
--  Hetzelfde blok staat ook in schema.sql voor verse installaties.
-- ============================================================

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS games (
  id               INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title            VARCHAR(150) NOT NULL,
  platform         VARCHAR(60)  NULL,                -- vrije tekst, bv. "Switch", "PC"
  status           ENUM('wishlist','backlog','playing','completed','dropped') NOT NULL DEFAULT 'backlog',
  rating           DECIMAL(2,1) NULL,                -- 0.5 t/m 5.0 in halve sterren; PHP bewaakt de grenzen
  progress         TINYINT UNSIGNED NULL,            -- 0 t/m 100 procent
  hours_played     DECIMAL(6,1) NULL,                -- bv. 12.5
  notes            TEXT         NULL,
  started_at       DATE         NULL,                -- wordt gezet bij verslepen naar 'playing'
  finished_at      DATE         NULL,                -- wordt gezet bij verslepen naar 'completed'
  release_date     DATE         NULL,                -- later gevuld door de game-API
  external_game_id VARCHAR(64)  NULL,                -- id bij de game-API (fase 9)
  cover_url        VARCHAR(255) NULL,                -- link naar de cover; we hosten geen covers zelf
  created_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_status_updated (status, updated_at)        -- kanban: per kolom, laatst verplaatst bovenaan
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
