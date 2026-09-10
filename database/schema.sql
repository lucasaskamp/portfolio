-- ============================================================
--  Portfolio — databaseschema (MySQL 8.0)
--  Draai dit IN je database (bv. dbs15451324) via phpMyAdmin.
--  De database zelf bestaat al; hier maken we alleen de tabellen.
-- ============================================================

SET NAMES utf8mb4;

-- ── Gebruikers (login) ──────────────────────────────────────
CREATE TABLE IF NOT EXISTS users (
  id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username      VARCHAR(50)  NOT NULL,
  password_hash VARCHAR(255) NOT NULL,           -- bcrypt hash, nooit platte tekst
  role          VARCHAR(20)  NOT NULL DEFAULT 'admin',
  is_active     TINYINT(1)   NOT NULL DEFAULT 1,
  last_login_at DATETIME     NULL,
  created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Projecten ───────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS projects (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  title      VARCHAR(150) NOT NULL,
  title_en   VARCHAR(150) NULL,                  -- Engelse titel (handmatig; leeg = val terug op NL)
  slug       VARCHAR(180) NOT NULL,
  excerpt    TEXT         NULL,
  excerpt_en TEXT         NULL,                  -- Engelse omschrijving (handmatig; leeg = val terug op NL)
  tech       VARCHAR(255) NULL,                  -- komma-gescheiden, bv. "HTML,CSS,JS"
  live_url   VARCHAR(255) NULL,
  status     ENUM('concept','live') NOT NULL DEFAULT 'concept',
  hero_image VARCHAR(255) NULL,                  -- optioneel pad; afbeelding zit meestal in project_images
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_slug (slug),
  KEY idx_status_updated (status, updated_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Projectafbeeldingen (opgeslagen als BLOB) ───────────────
CREATE TABLE IF NOT EXISTS project_images (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  project_id INT UNSIGNED NOT NULL,
  mime       VARCHAR(100) NOT NULL,
  size       INT UNSIGNED NOT NULL DEFAULT 0,
  data       LONGBLOB     NOT NULL,
  updated_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_project (project_id),          -- max. 1 afbeelding per project
  CONSTRAINT fk_images_project FOREIGN KEY (project_id)
    REFERENCES projects (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Contactberichten ────────────────────────────────────────
CREATE TABLE IF NOT EXISTS contact_messages (
  id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name       VARCHAR(120) NOT NULL,
  email      VARCHAR(190) NOT NULL,
  subject    VARCHAR(150) NOT NULL,
  message    TEXT         NOT NULL,
  status     ENUM('open','read','archived') NOT NULL DEFAULT 'open',
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ip         VARBINARY(16) NULL,                 -- binair (inet_pton), IPv4/IPv6
  user_agent VARCHAR(255) NULL,
  PRIMARY KEY (id),
  KEY idx_status_created (status, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Activiteitenlog (admin-acties) ──────────────────────────
CREATE TABLE IF NOT EXISTS activity_log (
  id         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id    INT UNSIGNED NULL,
  username   VARCHAR(50)  NULL,
  action     VARCHAR(40)  NOT NULL,
  entity     VARCHAR(40)  NOT NULL,
  entity_id  INT UNSIGNED NOT NULL DEFAULT 0,
  meta       JSON         NULL,
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Bezoekersstatistieken (pageviews) ───────────────────────
CREATE TABLE IF NOT EXISTS page_views (
  id          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  path        VARCHAR(255) NOT NULL,
  session_id  VARCHAR(64)  NOT NULL,
  ref         VARCHAR(255) NULL,
  occurred_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_session_path_time (session_id, path, occurred_at),
  KEY idx_occurred (occurred_at),
  KEY idx_path (path)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Interne app-status (housekeeping) ───────────────────────
CREATE TABLE IF NOT EXISTS app_state (
  k          VARCHAR(64) NOT NULL,
  v          TEXT        NULL,
  updated_at TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (k)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Games (Game Backlog-app) ─────────────────────────────────
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

-- ============================================================
--  Admin-account aanmaken
--  Gebruiker:  admin
--  Wachtwoord: ChangeMe!2026   (WIJZIG dit na de eerste login!)
--  Hash is bcrypt — de code gebruikt password_verify().
-- ============================================================
INSERT INTO users (username, password_hash, role, is_active)
VALUES (
  'admin',
  '$2y$12$hMD0i6uQnpBcBRluKpdCPOEirXTScDnh9hbSk28W.xEuXJcO0ZXu.',
  'admin',
  1
);
