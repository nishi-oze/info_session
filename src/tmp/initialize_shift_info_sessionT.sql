DROP TABLE IF EXISTS shift_info_sessionT;

CREATE TABLE shift_info_sessionT(
  id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
  reservation_date DATE,
  start_time TIME,
  employ_id INTEGER,
  place VARCHAR(255),
  cleated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE (reservation_date,start_time,employ_id)
) DEFAULT CHARACTER SET = utf8mb4;
