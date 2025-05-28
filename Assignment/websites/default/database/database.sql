CREATE TABLE `admins` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SELECT * FROM chronosrevel.admins;

DROP TABLE IF EXISTS `events`;
-- -----------------------------------------------------
-- Table structure for `events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `events` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `location` VARCHAR(255) NOT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `event_date` DATE NOT NULL,
  `image_path` VARCHAR(255) DEFAULT NULL,
  `created_by` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_event_date` (`event_date`),
  CONSTRAINT `fk_events_user`
    FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
  select*from events;
  
  
  INSERT INTO events (title, description, location, category, event_date, image_path, created_by)
VALUES
-- Music Events
('Sunburn Goa 2025', 'Asia’s biggest electronic music festival featuring top DJs.', 'Goa', 'Music', '2025-12-27', 'images/sunburn.jpg', 1),
('NH7 Weekender Pune', 'Multi-genre music fest with indie, rock, and electronic acts.', 'Pune, Maharashtra', 'Music', '2025-11-22', 'images/nh7.jpg', 1),

-- Technology Events
('India Mobile Congress', 'Biggest telecom and tech event in India.', 'Pragati Maidan, Delhi', 'Technology', '2025-10-14', 'images/imc.jpg', 1),
('TechSparks by YourStory', 'Startup and tech leadership conference.', 'Bangalore', 'Technology', '2025-09-10', 'images/techsparks.jpg', 1),

-- Culture Events
('Kala Ghoda Arts Festival', 'Celebration of Mumbai’s arts and culture.', 'Mumbai', 'Culture', '2025-02-01', 'images/kala_ghoda.jpg', 1),
('Surajkund Mela', 'Handicrafts, cuisines and folk arts of India.', 'Faridabad, Haryana', 'Culture', '2025-02-10', 'images/surajkund.jpg', 1),

-- Business Events
('TiE Global Summit', 'Business networking and entrepreneur development.', 'Hyderabad', 'Business', '2025-08-20', 'images/tie_summit.jpg', 1),
('Startup Mahakumbh', 'Largest convergence of Indian startups.', 'New Delhi', 'Business', '2025-07-15', 'images/startup_mahakumbh.jpg', 1),

-- Festival Events
('Holi Moo Festival', 'Color, music and fusion food to celebrate Holi.', 'Delhi', 'Festival', '2025-03-17', 'images/holi_moo.jpg', 1),
('Durga Puja Carnival', 'Procession of top pandals in Kolkata.', 'Kolkata', 'Festival', '2025-10-21', 'images/durga_puja.jpg', 1),

-- Comedy Events
('Comicstaan Live', 'Top Indian stand-up acts from Amazon Prime’s Comicstaan.', 'Bangalore', 'Comedy', '2025-06-30', 'images/comicstaan.jpg', 1),
('The Laugh Club Night', 'Local comedy night featuring top Indian stand-up talent.', 'Chennai', 'Comedy', '2025-07-25', 'images/laugh_club.jpg', 1),

-- Sports Events
('Pro Kabaddi League Final', 'High-intensity kabaddi final match.', 'Ahmedabad', 'Sports', '2025-08-02', 'images/pkl_final.jpg', 1),
('T20 India vs Australia', 'Exciting cricket showdown under floodlights.', 'Mumbai', 'Sports', '2025-09-18', 'images/t20_ind_aus.jpg', 1);


INSERT INTO events (title, description, location, category, event_date, image_path, created_by)
VALUES
-- Upcoming Music Events
('EDC Las Vegas 2025', 'Global electronic dance music festival at the Las Vegas Motor Speedway.', 'Las Vegas, NV', 'Music', '2025-06-20', 'images/edc_lv.jpg', 1),
('Coachella Valley Music and Arts Festival', 'Iconic annual festival showcasing contemporary artists across genres.', 'Indio, CA', 'Music', '2025-04-12', 'images/coachella.jpg', 1),

-- Upcoming Technology Events
('Google I/O 2025', 'Developer conference featuring the latest in Android, AI, and Web technologies.', 'Mountain View, CA', 'Technology', '2025-05-15', 'images/google_io.jpg', 1),
('Microsoft Build 2025', 'Keynotes and sessions on cloud, AI, and developer tools by Microsoft.', 'Seattle, WA', 'Technology', '2025-06-03', 'images/ms_build.jpg', 1),

-- Upcoming Culture Events
('Venice Biennale 2025', 'International art exhibition presenting contemporary installations and performances.', 'Venice, Italy', 'Culture', '2025-06-01', 'images/venice_biennale.jpg', 1),
('Oktoberfest Munich 2025', 'World’s largest beer festival with traditional Bavarian music and food.', 'Munich, Germany', 'Culture', '2025-09-21', 'images/oktoberfest.jpg', 1),

-- Upcoming Business Events
('Web Summit 2025', 'Europe’s largest technology conference drawing global startups and investors.', 'Lisbon, Portugal', 'Business', '2025-11-02', 'images/web_summit.jpg', 1),
('Davos World Economic Forum 2025', 'Annual gathering of global economic and political leaders.', 'Davos, Switzerland', 'Business', '2025-01-22', 'images/davos.jpg', 1),

-- Upcoming Festival Events
('Glastonbury Festival 2025', 'Renowned British music and performing arts festival.', 'Pilton, UK', 'Festival', '2025-06-25', 'images/glastonbury.jpg', 1),
('Rio Carnival 2026', 'Vibrant parade of samba schools and street parties.', 'Rio de Janeiro, Brazil', 'Festival', '2026-02-12', 'images/rio_carnival.jpg', 1),

-- Upcoming Comedy Events
('Just for Laughs Montreal 2025', 'International comedy festival featuring stand-up, improv, and panels.', 'Montreal, Canada', 'Comedy', '2025-07-21', 'images/just_for_laughs.jpg', 1),
('Melbourne International Comedy Festival 2025', 'Australia’s premier comedy festival with global acts.', 'Melbourne, Australia', 'Comedy', '2025-03-28', 'images/micf.jpg', 1),

-- Upcoming Sports Events
('Wimbledon Championships 2025', 'Grand Slam tennis tournament on grass courts.', 'London, UK', 'Sports', '2025-07-07', 'images/wimbledon.jpg', 1),
('FIFA Women’s World Cup 2027 Qualifiers', 'International women’s football qualifying matches.', 'Various Cities', 'Sports', '2025-09-03', 'images/womens_wc_q.jpg', 1),

-- Finished Events
('SXSW 2025', 'Annual conglomerate of film, interactive media, and music festivals.', 'Austin, TX', 'Music', '2025-03-17', 'images/sxsw.jpg', 1),
('AWS re:Invent 2024', 'Amazon Web Services annual conference on cloud computing.', 'Las Vegas, NV', 'Technology', '2024-11-29', 'images/aws_reinvent.jpg', 1),
('Dia de los Muertos Festival', 'Mexican cultural festival honoring the Day of the Dead.', 'Mexico City, Mexico', 'Culture', '2024-11-02', 'images/dia_muertos.jpg', 1),
('NYC Marathon 2024', 'Annual long-distance running race through all five New York City boroughs.', 'New York, NY', 'Sports', '2024-11-03', 'images/nyc_marathon.jpg', 1),
('Comic-Con International 2024', 'Convention celebrating comics, movies, and pop culture.', 'San Diego, CA', 'Culture', '2024-07-21', 'images/sdcc.jpg', 1),
('Oktoberfest Munich 2024', 'Traditional Bavarian beer festival and fairground attractions.', 'Munich, Germany', 'Festival', '2024-09-21', 'images/oktoberfest_2024.jpg', 1);