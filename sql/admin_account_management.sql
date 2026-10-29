ALTER TABLE users
    MODIFY role ENUM('admin', 'registrar', 'dean', 'professor', 'student') NOT NULL DEFAULT 'student',
    ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1 AFTER profile_photo,
    ADD COLUMN archived_at TIMESTAMP NULL DEFAULT NULL AFTER is_active,
    ADD COLUMN created_by INT NULL DEFAULT NULL AFTER archived_at,
    ADD INDEX idx_users_account_state (is_active, archived_at, role),
    ADD INDEX idx_users_created_by (created_by),
    ADD CONSTRAINT fk_users_created_by
        FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL;
